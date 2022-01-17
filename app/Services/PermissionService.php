<?php

namespace App\Services;

use Auth;
use Config;

class PermissionService
{
    public function __construct()
    {
    }

    public function allPermission($modelId = null)
    {
        $permissionText =  $modelId ? "cmsconfig.modulepermissions.$modelId" : "cmsconfig.modulepermissions";
        $permissions = Config::get($permissionText);
        $allPermission = [];
        foreach ($permissions as $permission => $val) {
            $allPermission = array_merge($allPermission, array_keys($val));
        }
        return $allPermission;
    }

    public function modelPermission($modelId, $modelRoute)
    {
        $permissions = Config::get('cmsconfig.modulepermissions.' . $modelId);
        foreach ($permissions as $permission => $val) {
            $tem = explode('.', $permission);
            if ($tem[1] == $modelRoute) {
                $key = str_replace('-', '', ucwords($tem[2] . 'Permission', '-'));

                $data[lcfirst($key)] = Auth::user()->canDo($modelId . '.' . $modelRoute . '.' . $tem[2]);
            } else {
                $data[$tem[1] . $tem[2] . 'Permission'] = Auth::user()->canDo($modelId . '.' . $tem[1] . '.' . $tem[2]);
            }
        }
        return $data;
    }


    public function modelPermissionRequest($request, $modelId, $modelRoute, $subRoute = false)
    {
        $customPermission = basename(request()->path());
        if (!Auth::user()->isSuperUser()) {
            $permissions = Auth::user()->allUserPermission();
            if (in_array($modelId, array_keys($permissions))) {
                foreach ($permissions[$modelId] as $permission => $val) {
                    $tem = explode('.', $permission);
                    if ($tem[0] == $modelRoute) {
                        if ($request->isMethod('POST') || $request->is('*/create')) {
                            return $request->user()->canDo($modelId . '.' . $modelRoute . '.create');
                        }
                        if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit') || $request->is('*/password')) {
                            return $request->user()->canDo($modelId . '.' . $modelRoute . '.edit');
                        }
                        if ($request->isMethod('DELETE') || $request->is('*/destroy')) {
                            return $request->user()->canDo($modelId . '.' . $modelRoute . '.destroy');
                        }
                        if ($customPermission != $modelRoute) {
                            if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/' . $customPermission)) {
                                return $request->user()->canDo($modelId . '.' . $modelRoute . '.' . $customPermission);
                            }
                        }
                    }
                }
            }
        }

        return $request->user()->canDo($modelId . '.' . $modelRoute . '.' . 'index');
    }

    public function groupedPermissions($grouped = false)
    {
        $permissionData = array();
        foreach (config('cmsconfig.modulepermissions') as $permission) {
            foreach ($permission as $key => $value) {
                $permissionData[$key] = $value;
            }
        }

        $array = [];

        foreach ($permissionData as $key => $value) {
            $key = explode('.', $key, 2);
            if (count($key) == 1) {
                @$array[$key[0]][$key[0]] = $value;
            } else {
                @$array[$key[0]][$key[1]] = $value;
            }
        }
        return $array;
    }
}
