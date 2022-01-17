<?php

namespace App\Http\Controllers\Admin\User;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    /**
     * @param Customer       $users
     * @param Permission $permisionModel
     */
    public function __construct(Customer $users)
    {
        $this->pageTitle = "Customer";
        $this->model = $users;
        $this->permissionService = new PermissionService();
        $this->redirectUrl = 'system/user';
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $title = $this->pageTitle;
        $input = $request->all();
        $route = 'customer.';
        $permission = 'user.customer.';
        $data = $this->model->getAllData($request->all());

        return view('Admin.customer.index', compact('title', 'data', 'route', 'input', 'permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->model->whereId($id)->delete();
        return redirect()->back()->withErrors(['alert-success' => "Customer deleted successfully"]);
    }
}
