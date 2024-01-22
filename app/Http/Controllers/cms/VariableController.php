<?php

namespace App\Http\Controllers\cms;
use App\Http\Controllers\Controller;

use App\Models\ExtraVariable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VariableController extends Controller
{
    public function index()
    {
        $breadcrumbs = [['link' => route('dashboard'), 'name' => "Dashboard"], ['name' => "Variables"]];
        return view('cms.others.variables', ['breadcrumbs' => $breadcrumbs, 'vars' => ExtraVariable::pluck('value', 'name'),
            'ogg_img' => ExtraVariable::where('name', 'OGG_IMAGE')->first()]);
    }

    public function save(Request $request){
        $extra = $request->input('extra', []);
        foreach ($extra as $key => $value) ExtraVariable::where('name', $key)->update(['value' => $value]);

        if ($request->hasFile('ogg_image')) {
            $file = request()->file('ogg_image');
            $name = $file->hashName();
            $file->storeAs('', $name, 'public');
            $ev = ExtraVariable::where('name', 'OGG_IMAGE')->first();
            $ev->value = $name;
            $ev->save();
        }

        return back()->with(['saved' => true]);
    }

    public function testMail(){
        Mail::raw('Hello World!', function($msg) {$msg->to('test@test.com')->subject('Test Email'); });
        echo 'OK';
    }
}
