<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Role;
use App\RoleUser;
use App\Services\PermissionService;
use App\User;
use Illuminate\Http\Request;
Use DB;
use Carbon\Carbon;

class UserController extends Controller
{

    private $pageTitle;
    private $model;
    private $permisionModel;
    private $redirectUrl;

    /**
     * usersController constructor.
     * @param User       $users
     * @param Permission $permisionModel
     */
    public function __construct(User $users)
    {
        $this->pageTitle = "Users";
        $this->model = $users;
        $this->permissionService = new PermissionService();
        $this->redirectUrl = 'system/user';
    }


    public function index(Request $request)
    {
        $data = $this->permissionService->modelPermission('user', 'user');
        $title = $this->pageTitle;
        $users = $this->model->getAllData($request->all());
        $roles = Role::all();
        $superUserCount = count(RoleUser::where('role_id', 1)->get());
        return view('Admin.user.index', compact('data', 'title', 'superUserCount', 'users', 'roles'));
    }


    public function create(Request $request)
    {

        $title = $this->pageTitle;

        $roles = ["" => 'Please Select'] + Role::pluck('name', 'id')->all();

        return view('Admin.user.create', compact('roles', 'title'));
    }



    public function store(Request $request)
    {

        try {
            $rolesData = Role::where('id', $request->roles)->first();
            if (!$rolesData) {
                return redirect()->back()->withErrors(['Internal Sever Error']);
            }

            $insertedData['first_name']     = $request->first_name;
            $insertedData['last_name']      = $request->last_name;
            $insertedData['username']       = $request->username;
            $insertedData['email']          = $request->email;
            $insertedData['status']         = $request->status;
            $insertedData['password']       = bcrypt($request->password);
            $insertedData['created_at']     = Carbon::now();


            $usersData = $this->model->create($insertedData);

            $roleData['user_id'] = $usersData->id;
            $roleData['role_id'] = $rolesData->id;
            RoleUser::create($roleData);
            return redirect($this->redirectUrl)->withErrors(['alert-success' => 'Invalid character used in URL!']);

            return redirect($this->redirectUrl);

        } catch (\Exception $e) {

            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Data was not saved!']);
        }
    }



    public function edit(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Invalid character used in URL!']);
        }
        $title = $this->pageTitle;
        $data = $this->model->find($id);
        $superUserCount = count(RoleUser::where('role_id', 1)->get());
        if (empty($data)) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Data was not found!']);
        }
        $roles = ["" => 'Please Select'] + Role::pluck('name', 'id')->all();

        return view('Admin.user.edit', compact('data', 'title', 'roles', 'superUserCount'));
    }

    public function update_old(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Invalid character used in URL!']);
        }

        $usersData = $this->model->find($request->id);
        // $attributes            = $request->all();
        $rolesData = Role::where('id', $request->roles)->first();
        if (empty($rolesData) || empty($usersData)) {
            return redirect()->back()->withErrors(['alert-danger' => 'Data was not found!']);
        }
        $insertedData['first_name'] = $request->first_name;
        $insertedData['last_name'] = $request->last_name;
        $insertedData['username'] = $request->username;
        $insertedData['email'] = $request->email;
        if ($request->status == 0) {
            $insertedData['status'] = false;
        } elseif ($request->status == 1) {
            $insertedData['status'] = true;
        } else {
            $insertedData['status'] = $request->status;
        }

        $insertedData['updated_at'] = Carbon::now();
        $insertedData['updated_by'] = Auth::guard('web')->user()->id;
        try {
            $usersData->update($insertedData);
            if ($request->roles == 1) {
                if ($usersData->rolesUser !== null) {
                    if ($usersData->rolesUser->role_id !== 1) {
                        RoleUser::where('user_id', $usersData->id)->delete();
                        $roleData['user_id'] = $usersData->id;
                        $roleData['role_id'] = $rolesData->id;
                        RoleUser::create($roleData);
                    }
                }
            } else {
                $superUserCount = count(RoleUser::where('role_id', 1)->get());
                if ($superUserCount < 1) {
                    return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Sorry role cannot be changed because there is only one super admin in our syustem!']);
                }
                RoleUser::where('user_id', $usersData->id)->delete();
                $roleData['user_id'] = $usersData->id;
                $roleData['role_id'] = $rolesData->id;
                RoleUser::create($roleData);
            }
            return redirect($this->redirectUrl)->withErrors(['alert-success' => 'Successfully updated!']);
        } catch (\Exception $e) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Data was not saved!']);
        }
    }

    public function update(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Invalid character used in URL!']);
        }

        $usersData = $this->model->find($request->id);
        $rolesData = Role::where('id', $request->roles)->first();
        if (empty($rolesData) || empty($usersData)) {
            return redirect()->back()->withErrors(['alert-danger' => 'Data was not found!']);
        }

        $insertedData['first_name'] = $request->first_name;
        $insertedData['last_name'] = $request->last_name;
        $insertedData['username'] = $request->username;
        $insertedData['email'] = $request->email;
        if ($request->status == 0) {
            $insertedData['status'] = false;
        } elseif ($request->status == 1) {
            $insertedData['status'] = true;
        } else {
            $insertedData['status'] = $request->status;
        }

        $insertedData['updated_at'] = Carbon::now();
        $insertedData['updated_by'] = \Auth::user()->id;
        try {
            $usersData->update($insertedData);


            if ($request->roles == 1) {

                if ($usersData->rolesUser !== null) {
                    if ($usersData->rolesUser->role_id !== 1) {
                        RoleUser::where('user_id', $usersData->id)->delete();
                        $roleData['user_id'] = $usersData->id;
                        $roleData['role_id'] = $rolesData->id;
                        RoleUser::create($roleData);
                    }
                }

            } else {
                $superUserCount = count(RoleUser::where('role_id', 1)->get());
                if ($superUserCount < 1) {
                    return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Sorry role cannot be changed because there is only one super admin in our syustem!']);
                }
                RoleUser::where('user_id', $usersData->id)->delete();
                $roleData['user_id'] = $usersData->id;
                $roleData['role_id'] = $rolesData->id;
                RoleUser::create($roleData);
            }

            return redirect($this->redirectUrl)->withErrors(['alert-success' => 'Successfully updated!']);
        } catch (\Exception $e) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Data was not saved!']);
        }
    }



    public function password(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Invalid character used in URL!']);
        }
        $data = $this->model->where('id', $id)->first();

        if (empty($data)) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Data was not found!']);
        }
        return view('system.users.changepass', compact('data'));
    }


    /**
     * @param UsersRequest $request
     * @return $this
     */
    public function updatepassword(Request $request)
    {

        if (!is_numeric(Input::get('id'))) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Invalid character used in URL!']);
        }
        $id = $request->id;
        $data = $this->model->find($id);
        if (empty($data)) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Data was not found!']);
        }
        $data->update(['password' => $request->password]);
        return redirect($this->redirectUrl)->withErrors(['alert-success' => 'Successfully updated!']);
    }


    /**
     * @param UsersRequest $request
     * @param              $id
     * @return $this
     */
    public function delete(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Invalid character used in URL!']);
        }
        $users = $this->model->find($id);
        if (empty($users)) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => 'Data was not found!']);
        }
        if ($this->model->count() == 1) {
            return redirect()->back()->withErrors(['Deletion unsuccessful because there must be at least one admin!']);
        }
        try {
            $users = $this->model->find($id);
            $t = $users->delete();
            RoleUser::where('user_id', $users->id)->delete();
            return redirect()->back()->withErrors(['alert-success' => 'Successfully deleted!']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['alert-danger' => $e->getMessage()]);
        }
    }
}
