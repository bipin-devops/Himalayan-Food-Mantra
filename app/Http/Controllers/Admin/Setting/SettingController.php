<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Helper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class SettingController extends Controller
{

    public function __construct(Setting $setting)
    {
        $this->setting=$setting;
    }
    public function index()
    {
        $data['setting'] = $this->setting->where('slug', 'setting')->first();

        return view('Admin.setting.index', $data);
    }

    public function UpdateCreate(Request $request)
    {



        $input = $request->all();
        $cover = $request->file('logo');
        $footer_logo = $request->file('footer_logo');
        try {
            $input['slug'] = 'setting';
            if ($cover) {



                $input['logo'] = ImageUploadHelper::uploadImage($cover, '/storage/setting', 'setting');


            }

            if ($footer_logo) {

                $input['footer_logo'] = $this->setting->upload($footer_logo);

            }


            $this->createOrupdate(['id' => 1], $input);
            flash("Information Saved Successfully")->success();


            return redirect()->back();

        } catch (Throwable $e) {

            \Flash::error($e->getMessage());

        }

    }


    public function createOrupdate($where, $data)
    {
        try {
            Setting::updateOrCreate($where, $data);
        } catch (\Throwable $t) {
            dd($t->getMessage());
        }
    }

}

