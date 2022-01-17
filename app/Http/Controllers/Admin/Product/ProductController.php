<?php

namespace App\Http\Controllers\Admin\Product;

use App\Category;
use App\Helper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(Product $product)
    {
        $this->model = $product;
        $this->pageTitle = "Product Management";
        $this->redirectUrl = 'system/product';
    }

    public function index(Request $request)
    {
        $datas = $this->model->getAllData($request->all());
        $pageTitle = $this->pageTitle;
        return view('Admin.product.index', compact('datas', 'pageTitle'));
    }

    public function create()
    {
        $category = Category::pluck('name', 'id')->toArray();

        return view('Admin.product.create', compact('category'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $file = $request->file('image');

        try {
            if ($request->hasFile('image')) {
                $data['image'] = ImageUploadHelper::uploadImage($file, '/storage/product', 'product');
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
        $category = Category::pluck('name', 'id')->toArray();
        $is_edit = true;
        if (empty($data)) {
            return redirect()->back()->withErrors(['alert-danger' => 'Data was not found!']);
        }


        return view('Admin.product.edit', compact('data', 'pageTitle', 'category', 'is_edit'));
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
                    $path = public_path('storage/product'. '/' . $data->image);

                    if (!empty($data->image) && file_exists($path)) {
                        unlink($path);
                    }
                }

                $attributes['image'] = ImageUploadHelper::uploadImage($file, '/storage/product', 'product');
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
                    $path = public_path('storage/product'. '/' . $data->image);

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
}
