<?php

namespace App\Http\Controllers\cms;
use App\Http\Controllers\Controller;

use App\Helpers\Helpers;
use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index($type)
    {
        list($t, $st) = $this->getIdVars($type);
        $breadcrumbs = [['name' => __('catalog.title.' . $t)]];
        $prev = Catalog::find($st);

        return view(
            'cms.catalog.catalogList',
            [
                'breadcrumbs' => $breadcrumbs,
                'catalogs' => Catalog::where('type', $t)->where('subtype', $st)->get(),
                'type' => $type,
                't' => $t,
                'back' => $prev ? $prev->subtype : 0
            ]
        );
    }

    public function create($type)
    {
        list($t, $st) = $this->getIdVars($type);
        $breadcrumbs = [['link' => route('catalogs', $type), 'name' => __('catalog.title.' . $t)], ['name' => __('catalog.add.' . $t)]];
        return view('cms.catalog.catalogForm', ['breadcrumbs' => $breadcrumbs, 'catalog' => new Catalog(), 'action' => route('catalogs.store', $type), 'method' => 'create', 'type' => $type]);
    }

    public function edit($type, $cid)
    {
        list($t, $st) = $this->getIdVars($type);
        $cat = Catalog::find($cid);
        $breadcrumbs = [['link' => route('catalogs', $type), 'name' => __('catalog.title.' . $t)], ['name' => __('catalog.edit.' . $t)]];
        return view('cms.catalog.catalogForm', ['breadcrumbs' => $breadcrumbs, 'catalog' => $cat, 'action' => route('catalogs.update', $type), 'method' => 'edit', 'type' => $type]);
    }

    public function store($type, Request $request)
    {
        list($t, $st) = $this->getIdVars($type);
        $request->merge(['type' => $t]);
        $request->merge(['subtype' => $st]);

        $validated = CatalogController::validateForm($request, 0);
        if ($validated){
            $cc = new Catalog($request->all());
            $cc->save();
        }
        return redirect()->route('catalogs', $type)->with(['saved' => true]);
    }

    public function update(Request $request, $type)
    {
        $id = $request->input('id');
        $cc = Catalog::find($id);

        list($t, $st) = $this->getIdVars($type);
        $request->merge(['type' => $t]);
        $request->merge(['subtype' => $st]);

        $validated = CatalogController::validateForm($request, $id);
        if ($validated && $cc){
            $cc->name = $request->input('name');
            $cc->type = $request->input('type');
            $cc->subtype = $request->input('subtype');
            $cc->save();
        }
        return redirect()->route('catalogs', $type)->with(['saved' => true]);
    }

    public function destroy($type, $id)
    {
        Catalog::destroy($id);
        return back()->with(['deleted' => true]);
    }

    public function getCatalogoSelect(Request $request){
        $name = $request->input('name');
        $t = $request->input('t');
        $ext = $request->input('ext');
        $null = $request->input('nl');

        echo Helpers::getCatalogSelect($name, '', $t, $ext, $null) ;
    }

    private static function validateForm(Request $request, $id){
        return $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);
    }

    private function getIdVars($var){
        $vars = explode('_', $var);
        return [$vars[0], isset($vars[1]) ? $vars[1] : 0];
    }

}
