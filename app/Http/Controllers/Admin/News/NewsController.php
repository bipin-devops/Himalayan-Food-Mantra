<?php

namespace App\Http\Controllers\Admin\News;

use App\Helper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct(News $news)
    {
        $this->model = $news;
        $this->pageTitle = "News Management";
        $this->redirectUrl = 'system/news';
    }

    public function index(Request $request)
    {
        $datas = $this->model->getAllData($request->all());
        $pageTitle = $this->pageTitle;
        return view('Admin.news.index', compact('datas', 'pageTitle'));
    }

    public function create()
    {


        return view('Admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $file = $request->file('image');

        try {
            if ($request->hasFile('image')) {
                $data['image'] = ImageUploadHelper::uploadImage($file, '/storage/news', 'news');
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

        $is_edit = true;
        if (empty($data)) {
            return redirect()->back()->withErrors(['alert-danger' => 'Data was not found!']);
        }


        return view('Admin.news.edit', compact('data', 'pageTitle',  'is_edit'));
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
                    $path = public_path('storage/news'. '/' . $data->image);

                    if (!empty($data->image) && file_exists($path)) {
                        unlink($path);
                    }
                }

                $attributes['image'] = ImageUploadHelper::uploadImage($file, '/storage/news', 'news');
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
                    $path = public_path('storage/news'. '/' . $data->image);
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
