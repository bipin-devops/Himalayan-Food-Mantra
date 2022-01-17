<?php

namespace App\Providers;

use App\Cart;
use App\Category;
use App\Gallery;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    protected static $frontendData = [];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('Admin.includes.sidebar_menu', function ($view) {
            $modules = config('cmsconfig.modules');
            $modulePages = config('cmsconfig.modulepages');
            $modulePermissions = config('cmsconfig.modulepermissions');
            $moduleIcons = config('cmsconfig.moduleicons');
            $userPermission = Auth::guard("web")->user()->permission;
            $allData = [];
            $home = array('home' => ['home.home.index' => "Home"]);
            $modulePermissions = array_merge($home, $modulePermissions);


            if (Auth::guard("web")->user()->isSuperUser()) {
                //Checking if superuser or not
                foreach ($modules as $moduleID => $moduleTitle) {
                    if (!array_key_exists($moduleID, $modulePermissions)) {
                        continue;
                    }
                    $arrayData['id'] = $moduleID;
                    $arrayData['title'] = $moduleTitle;
                    $arrayData['pages'] = count($modulePages[$moduleID]);
                    $arrayData['subPages'] = $modulePages[$moduleID];
                    foreach ($moduleIcons as $id => $icons) {
                        if ($id == $moduleID) {
                            $arrayData['icon'] = $icons;
                        }
                    }
                    array_push($allData, $arrayData);
                }
            } else {
                $permissions = Auth::guard("web")->user()->allUserPermission();
                $userPermission = array_intersect_key($permissions, $modules);
                foreach ($userPermission as $k => $module) {
                    $arrayData['id'] = $k;
                    $arrayData['title'] = $modules[$k];
                    $subModule = array();
                    $count = 0;
                    foreach ($modulePages[$k] as $subModuleId => $subModuleTitle) {
                        $count++;
                        foreach ($module as $m => $v) {
                            if (preg_match("/\b$subModuleId\b/i", $m)) {
                                $subModule[$subModuleId] = $subModuleTitle;
                            }
                        }
                    }
                    $arrayData['subPages'] = $subModule;
                    $arrayData['pages'] = $count;
                    foreach ($moduleIcons as $id => $icons) {
                        if ($id == $k) {
                            $arrayData['icon'] = $icons;
                        }
                    }
                    array_push($allData, $arrayData);
                }
            }
            $view->with('modulesPermission', $allData);
            return $allData;
        });


        view()->composer(['Frontend.*.*', 'Frontend.*'], function ($view) {
            if (!count(self::$frontendData)) {
                $data = [];
                $data['isUserLoggedIn'] = Auth::guard('customer')->check();
                $data['user'] = null;
                $data['cartProductId'] = null;
                $data['totalCartProduct'] = 0;
                $data['cart'] = null;
                $data['cartProductIds'] = [];
                if ($data['isUserLoggedIn']) {
                    $data['user'] = Auth::guard('customer')->user();
                    $data['cart'] = $data['user']->cart;
                    $data['totalCartProduct'] = $data['cart'] ? $data['cart']->totalProduct : 0;
                    $data['cartProductIds'] = $data['cart'] ? $data['cart']->cartProduct->pluck('id')->toArray(): [];
                }
                self::$frontendData = $data;
            }
            $view->with(self::$frontendData);
        });

        view()->composer('Frontend.includes.master', function ($view) {
            $category = Category::orderBy('created_at', 'DESC')
                ->take(6)
                ->get();

            $view->with('categories', $category);
        });

        view()->composer('Frontend.includes.master', function ($view) {
            $setting = Setting::find(1);

            $view->with('setting', $setting);
        });
    }
}
