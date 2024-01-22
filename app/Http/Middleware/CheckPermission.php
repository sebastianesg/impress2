<?php

namespace App\Http\Middleware;

use App\Models\Rol;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->status === 0){
                if ($path = $request->path())
                if (($path = $request->path() !== "accesocms/bloqued" ) and ($path = $request->path() !== "accesocms/login" )){
                    return redirect()->route('bloqued');
                }
            }
            if ($user->first_login === 0){
                if ($path = $request->path())
                if (($path = $request->path() !== "accesocms/firstActivity" ) and ($path = $request->path() !== "accesocms/changePassword" )){
                    return redirect()->route('password.firstActivity');
                }
            }

            $path = $request->path();
            if (strpos($path, 'admins/') !== false && strpos($path, '/edit') !== false) {
                $id = $request->route('admin');
                if ($id->id===$user->id){
                    return $next($request);
                }
            }
            if (in_array($user->rol->name, $roles)) {
                return $next($request);
            }
            return redirect()->route('dashboard');
        }

//        switch($action){
//            case "index": $letter = 'A'; break;
//            case "create": case "store": $letter = 'B'; break;
//            case "edit": case "update": $letter = 'C'; break;
//            case "destroy": $letter = 'D'; break;
//        }
//
//        switch($controller){
//            case "AdminControler": $section = [1]; break;
//            case "AgentController": $section = [10]; break;
//            case "BudgetController": $section = [28]; break;
//            case "BudgetOrderController": $section = [26]; break;
//            case "CatalogController": $section = [11]; break;
//            case "ChatController": $section = [5]; break;
//            case "ClientController": $section = [6]; break;
//            case "CtaCteController": $section = [6]; break;
//            //case "DashboardController": $section = 1; break;
//            case "DepositController": $section = [24]; break;
//            case "EquipmentController": $section = [23]; break;
//            case "EquipmentPlanController": $section = [23]; break;
//            //case "LabelledController": $section = 1; break;
//            case "PlanRecordController": $section = [23]; break;
//            case "ProductController": $section = [8]; break;
//            case "ProductionController": $section = [29]; break;
//            case "RawMaterialController": $section = [7]; break;
//            case "RolController": $section = [2]; break;
//            case "SaleItemController": $section = [27]; break;
//            case "SaleOrderController": $section = [27]; break;
//            case "SaleRequestController": $section = [27]; break;
//            case "SupplierController": $section = [9]; break;
//            case "VariableController": $section = [3]; break;
//        }
//
//        $continue = false;
//        foreach($section as $s){
//            if (in_array($s.$letter, $perms)) $continue = true;
//        }
//
//        //if (Auth::user()->id == 1 || Auth::user()->id == 5){
//            $perms = [];
//            for ($i = 1; $i <= ROL::MAX_SECTIONS; $i++){
//                $perms[] = $i.'A';
//                $perms[] = $i.'B';
//                $perms[] = $i.'C';
//                $perms[] = $i.'D';
//            }
//        //}

//        define('ALL_PERMS', $perms);
//        define('CLIENT_ID', Auth::user()->client_id);

        //dd($controller);
        //if ()
        //return $continue ? $next($request) : abort(403, 'Access denied');;
        return $next($request);
    }
}
