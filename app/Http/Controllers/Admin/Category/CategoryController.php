<?php

namespace App\Http\Controllers\Admin\Category;

use App\Category;
use App\Helper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(Category $category)
    {
        $this->model = $category;
        $this->pageTitle = "Category Management";
        $this->redirectUrl = 'system/category';
    }

    public function index(Request $request)
    {
        $datas = $this->model->getAllData($request->all());
        $pageTitle = $this->pageTitle;
        return view('Admin.category.index', compact('datas', 'pageTitle'));
    }

    public function create()
    {
        return view('Admin.category.create');
    }

    public function store(Request $request)
    {

        $data = $request->except('_token');
        $data['status'] = 'Active';
        $file = $request->file('image');

        try {
            if ($request->hasFile('image')) {
                $data['image'] = ImageUploadHelper::uploadImage($file, '/storage/category', 'category');
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


        return view('Admin.category.edit', compact('data', 'pageTitle'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $this->model->find($id);


            if (empty($data)) {
                return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Data was not found!']);
            }
            $attributes = $request->all();

            $file = $request->file('image');
            if ($request->hasFile('image')) {
                if ($data->image) {
                    $path = public_path('storage/category'. '/' . $data->image);

                    if (!empty($data->image) && file_exists($path)) {
                        unlink($path);
                    }
                }

                $attributes['image'] = ImageUploadHelper::uploadImage($file, '/storage/category', 'category');
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
                if ($data->image) {
                    $path = public_path('storage/category'. '/' . $data->image);

                    if (!empty($data->image) && file_exists($path)) {
                        unlink($path);
                    }
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

    public function changeStatus(Request $request, $id)
    {
    }
}
