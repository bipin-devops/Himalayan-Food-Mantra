<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Mockery\Exception;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login()
    {


        if (Auth::check()) {
            return redirect()->intended(route('home'));
        } else {
            return view('login.login');
        }
    }

    public function authenticate(Request $request)
    {

        $data = $request->all(['email', 'password']);
        try{
            if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {

                return redirect()->intended(route('home'));

            } else {
                Flash('Invalid Access')->warning();
                return redirect(route('login'));
            }
        }catch (Exception $e)
        {
            Flash('Invalid Access')->warning();
            return redirect(route('login'));
        }

    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('login'));
    }
    public function changePassword()
{

    return view('Admin.user.change-password');
}

    public function updatePassword(ChangePasswordRequest $request)
    {


        $oldPassword = $request->get('old_password');
        $newPassword = $request->get('password');


        $id = Auth::user()->id;
        $users = Auth::user()->find($id);

        if(!is_null($users)) {
            if (!(Hash::check($oldPassword, $users->password))) {
                return back()->withErrors(['alert-danger' => 'Old Password Do Not Match !']);

            } else {
                $data['password'] = Hash::make($newPassword);

                $users->update(['password' => $data['password']]);

                Auth::logout();
                return redirect(route('login'))->withErrors(['alert-success' => 'Password Success Changed']);
            }
        }

    }


}
