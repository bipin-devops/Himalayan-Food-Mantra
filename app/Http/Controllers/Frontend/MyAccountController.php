<?php

namespace App\Http\Controllers\Frontend;

use App\Customer;
use App\CustomerRegisterToken;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Mail\ForgotPasswordMail;
use App\Order;
use App\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;


class MyAccountController extends Controller
{

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    public function myAccount()
    {
        $user = Auth::guard('customer')->user();

        $orderDetails = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->take(5)->get();


        return view('Frontend.myaccount', compact('user', 'orderDetails'));
    }

    public function register()
    {
        return view('Frontend.register');

    }


    public function registerUser(RegisterRequest $request)
    {
        try {
            $data['first_name'] = $request->first_name;
            $data['last_name'] = $request->last_name;
            $data['email'] = $request->email;
            $data['mobile_number'] = $request->mobile_number;
            $data['username'] = $request->username;
            $data['address'] = $request->address;
            $data['password'] = bcrypt($request->password);
            $userData = $this->model->create($data);

            if ($userData) {

                $attributes['user_id'] = $userData->id;
                $attributes['token'] = $this->uniqueToken($length = 6, $add_dashes = false, $available_sets = 'ud');
                $attributes['expiry_time'] = Carbon::now()->addHour(1);
                CustomerRegisterToken::create($attributes);

            }
            return redirect('/register')->withErrors(['alert-success' => 'Successfully User Register']);
        } catch (\Exception $exception) {

            return redirect()->back()->withErrors(['alert-danger' => 'failed to register']);
        }
    }

    public function login()
    {
        return view('Frontend.login');

    }

    public function loginPost(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required|min:6'
            ]);

            if (Auth::guard('customer')->attempt(['email' => $request['email'], 'password' => $request['password']])) {

                return redirect()->intended('/profile');
            } else {


                return redirect()->back()->withErrors('Incorrect login details');

            }


        } catch (\Exception $exception) {

            return redirect()->back()->withErrors('Incorrect login details');

        }
    }

    public function aboutUs()
    {
        $about = Page::where('slug', 'about-us')->first();
        return view('Frontend.about', compact('about'));
    }

    public function forgotPassword()
    {
        return view('Frontend.forgotPassword');
    }


    public function forgotPasswordSendLink(Request $request)
    {
        $checkEmail = Customer::whereEmail($request['email'])->first();


        try {
            if ($checkEmail) {
                $token = CustomerRegisterToken::where('user_id', $checkEmail['id'])->first();

                $url = env('APP_URL') . '/reset-password/' . $token['token'];


                Mail::to($request['email'])->send(new ForgotPasswordMail($url));
                return redirect()->back()->withErrors(['alert-success' => 'Please check your email box']);

            } else {
                return redirect()->back()->withErrors('Email Not Found In Our System');

            }

        } catch (\Exception $exception) {

            return redirect()->back()->withErrors(['alert-success' => 'Please check your email box']);
        }
    }

    public function resetPassword(Request $request, $token)
    {

        $tokenId = $token;
        return view('Frontend.ResetPassword', compact('tokenId'));
    }

    public function updatePassword(Request $request)
    {

        $token = CustomerRegisterToken::where('token', $request['token'])->first();
        $user = Customer::where('id', $token['user_id'])->first();
        if ($user) {

            $data['password'] = bcrypt($request->password);

            $user->update($data);

            return view('Frontend.login');

        }

        return redirect('/login')->withErrors(['alert-success' => 'Your Password is Changed,Please login with New Password!!']);
    }



    public function logout()
    {
        Auth::guard('customer')->logout();

        return redirect('/login')->withErrors(['alert-success' => 'Your are Successfully Logout!!']);
    }

    public function uniqueToken($length = 6, $add_dashes = false, $available_sets = 'luds')
    {

        $sets = array();
        if (strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if (strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if (strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if (strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if (!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }


}
