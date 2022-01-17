<?php

namespace App\Http\Controllers\Admin\Page;

use App\Helper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(Page $page)
    {
        $this->model = $page;
        $this->pageTitle = "PageManagement";
        $this->redirectUrl = 'system/page';
    }

    public function index(Request $request)
    {
        $pageTitle = $this->pageTitle;
        $datas = $this->model->getAllData($request->all());

        return view('Admin.page.index', compact('datas','pageTitle'));
    }

    public function create()
    {
        return view('Admin.page.create');
    }

    public function store(Request $request)
    {
    $data=$request->all();
        $file = $request->file('cover_image');
        try {
            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = ImageUploadHelper::uploadImage($file, '/storage/page', 'page');

            }

            $this->model->create($data);
            return redirect($this->redirectUrl)->withErrors(['alert-success' => 'Successfully Added']);
        } catch (\Exception $e) {

            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Data was not saved!']);


        }

    }

    public function edit($id)
    {

        $pageTitle = $this->pageTitle;
        $data = $this->model->find($id);

        if (empty($data)) {
            return redirect()->back()->withErrors(['alert-danger' => 'Data was not found!']);
        }


        return view('Admin.page.edit', compact('data', 'pageTitle'));
    }

    public function update(Request $request, $id)
    {


        try {
            $data = $this->model->find($id);

            $file = $request->file('cover_image');

            if (empty($data)) {
                return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Data was not found!']);
            }
            $attributes = $request->all();

            if ($request->hasFile('cover_image')) {
                $path = public_path('storage/page'. '/' . $data->cover_image);

                if ($data->image) {
                    unlink($path);
                }
                $attributes['cover_image'] = ImageUploadHelper::uploadImage($file, '/storage/page', 'page');
            }

            $data->update($attributes);
            return redirect($this->redirectUrl)->withErrors(['alert-success' => 'Successfully updated!']);
        } catch (\Exception $e) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {

        if ($id != null && !is_numeric($id)) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => "Data not found!"]);
        }


        $data = $this->model->find($id);
        if (isset($data)) {
            try {
                if (isset($data->image)) {
                    $path = public_path('storage/page'. '/' . $data->cover_image);
                    unlink($path);
                }
                $data->delete();
                return redirect($this->redirectUrl)->withErrors(['alert-success' => 'Deletion successful!']);
            } catch (\Exception $e) {
                return redirect($this->redirectUrl)->withErrors(['alert-danger' => $e->getMessage()]);
            }
        } else {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => "Data not found!"]);

        }
    }
}
