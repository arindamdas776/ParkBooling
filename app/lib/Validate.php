<?php
namespace App\Lib;

use App\User;
use App\Models\Module;
use DB;

class Validate {
    public static function pwdPolicy($password) {
        if(!preg_match('/(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,})/u', $password)) {
            return false;
        } else {
            return true;
        }
    }

    public static function hasModuleAccess($modulename,$action=[])
    {
        $usertype = session('usertype');
        $permissionArr = []; 
        $action = array_fill_keys(explode(',', strtolower(implode(',', $action))), 0);
        if($usertype == 'employee') {
            if(auth()->guard($usertype)->user()) {
                $userInfo = auth()->guard($usertype)->user();
                // dd(auth()->guard($usertype)->user()->group_id);
                $userGroupRolePermission = Module::select('id')->where('name', $modulename)->with(['permisionRole' => function($query) use($userInfo) {
                    $query->where('group_id', $userInfo->group_id)->select(['id', 'module_id', 'c', 'r', 'u', 'd']);
                }])->first()->toArray();

                $permissionArr = sizeof($userGroupRolePermission['permision_role']) ? $userGroupRolePermission['permision_role'][0] : [];

                
                foreach ($action as $key => $value) {
                    if(array_key_exists($key, $permissionArr)) {
                        $action[$key] = $permissionArr[$key];
                    }
                }
                // $action = array_values($action);
                // // dd($action);
                
                // if(sizeof($action) > 0) {
                //     $cndtn = true;
                //     for ($i=0; $i < sizeof($action); $i++) { 
                //         $cndtn = $cndtn && $action[$i];
                //         if(!$cndtn) {
                //             break;
                //         }
                //     }
                // }
            }
            return (object) $action;
        } else {
            $action = [
                'c' => 1,
                'r' => 1,
                'u' => 1,
                'd' => 1
            ];
            return (object) $action;
        }
        
    }

    public static function permissionCheckMessage($action) {
        $perform = '';
        if($action == 'c') {
            $perform = 'Create';
        }
        if($action == 'r') {
            $perform = 'Read';
        }
        if($action == 'u') {
            $perform = 'Update';
        }
        if($action == 'd') {
            $perform = 'Delete';
        }

        return response()->json(['message' => '', 'errors' => ['validation_error' => ["Sorry you dont have permission to  ."]]], 422);
    }

}