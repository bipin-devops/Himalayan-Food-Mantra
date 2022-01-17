<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function __construct(Employee $employee)
    {
        $this->model = $employee;
        $this->pageTitle = "Employee Management";
        $this->redirectUrl = 'system/employee';
    }

    public function index(Request $request)
    {
        $datas = $this->model->getAllData($request->all());
        $pageTitle = $this->pageTitle;
        return view('Admin.employee.index', compact('datas', 'pageTitle'));

    }

    public function create()
    {
        $gender = ['male' => 'Male', 'female' => 'Female'];

        return view('Admin.employee.create', compact('gender'));
    }

    public function store(Request $request)
    {


        $data['name'] = $request->name;
        $data['last'] = $request->last;
        $data['phone'] = $request->phone;
        $data['temp_address'] = $request->temp_address;
        $data['per_address'] = $request->per_address;
        $data['date_of_join'] = $request->date_of_join;
        $data['dob'] = $request->dob;
        $data['gender'] = $request->gender;
        $file = $request->file('file_name');
        try {
            if ($request->hasFile('file_name')) {
                $data['file_name'] = $this->model->upload($file);
            }

            $this->model->create($data);
            return redirect($this->redirectUrl)->withErrors(['alert-success' => 'Successfully Added']);
        } catch (\Exception $e) {
            dd($e);
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Data was not saved!']);


        }

    }

    public function edit($id)
    {

        $pageTitle = $this->pageTitle;
        $data = $this->model->find($id);
        $gender = ['male' => 'Male', 'female' => 'Female'];
        $is_edit = true;
        if (empty($data)) {
            return redirect()->back()->withErrors(['alert-danger' => 'Data was not found!']);
        }


        return view('Admin.employee.edit', compact('data', 'pageTitle', 'gender', 'is_edit'));
    }

    public function update(Request $request, $id)
    {


        try {
            $data = $this->model->find($id);

            $file = $request->file('file_name');

            if (empty($data)) {
                return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Data was not found!']);
            }
            $attributes = $request->all();

            if ($request->hasFile('file_name')) {
                $path = 'uploads/employee/' . $data->file_name;

                if ($data->file_name) {
                    unlink($path);
                }
                $attributes['file_name'] = $this->model->upload($file);
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
                    $path = 'uploads/employee/' . $data->image;
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
