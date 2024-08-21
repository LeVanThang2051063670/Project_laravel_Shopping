<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Mail\VerifyAccount;
use App\Models\Customer;
use App\Models\CustomerResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Hash;
use Illuminate\Support\Facades\Log;


class AccountController extends Controller
{
    // dang nhap
    public function login()
    {
        return view('account.login');
    }
    public function favorite()
    {
        // $favorites = auth()->user()->favorites;
        $favorites = auth('cus')->user()->favorites ? auth('cus')->user()->favorites : [];
        return view('account.favorite', compact('favorites'));
    }
    public function logout()
    {
        auth('cus')->logout();
        return redirect()->route('account.login')->with('ok', 'your logouted');

    }

    public function check_login(Request $req)
    {
        $req->validate([

            'email' => 'required|exists:customers',
            'password' => 'required',

        ]);
        $data = $req->only('email', 'password');
        $check = auth('cus')->attempt($data);
        if ($check) {
            if (auth('cus')->user()->email_verified_at == '') {
                auth('cus')->logout();
                return redirect()->back()->with('no', 'you account is not verify,please check email again');
            }
            return redirect()->route('home.index')->with('ok', 'welcome back');

        }
        return redirect()->back()->with('no', 'your account or password invalid');
    }
    // dang ky
    public function register()
    {
        return view('account.register');
    }
    public function check_register(Request $req)
    {
        $req->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:6|max:100|unique:customers',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ], [
            'name.required' => 'Họ tên không được để trống,',
            'name.min' => 'Họ tên tối thiếu 6 kí tự',

        ]);

        $data = $req->only('name', 'email', 'phone', 'address', 'gender');
        $data['password'] = bcrypt($req->password);

        //dd($data);
        if ($acc = Customer::create($data)) {
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('account.login')->with('ok', 'register successfully,check your account ,click on the link to compelete');
        }

        return redirect()->back()->with('no', 'Something error,try again');

    }
    public function veryfy($email)
    {
        $acc = Customer::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        // dd($acc);
        Customer::where('email', $email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('account.login')->with('ok', 'veryfy successfully,you can login');
    }
    // doi mat khau
    public function change_password()
    {
        //$auth = auth('cus')->user();
        return view('account.change_password');
    }
    public function check_change_password(Request $req)
    {
        $auth = auth('cus')->user();//ng dung dn thi co bien auth
        $req->validate([
            'old_password' => [
                'required',
                function ($attr, $value, $fail) use ($auth) {
                    //$auth = auth('cus')->user();
                    if (!Hash::check($value, $auth->password)) {
                        $fail('Your pass word is not match');
                    }

                }
            ],
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ]);

        $data['password'] = bcrypt($req->password);

        if ($auth->update($data)) {
            //auth('cus')->logout();
            return redirect()->route('account.logout')->with('ok', 'Update password success');

        }

    }
    // quen mat khau
    public function forgot_password()
    {
        return view('account.forgot_password');
    }
    public function check_forgot_password(Request $req)
    {
        $req->validate([

            'email' => 'required|exists:customers',
        ]);
        // lay tt tai khoan xuong
        $customer = Customer::where('email', $req->email)->first();

        //dd($customer);
        // thu xem
        $token = \Str::random(40);
        $tokenData = [
            'email' => $req->email,
            'token' => $token
        ];
        //dd($tokenData);
        if (CustomerResetToken::create($tokenData)) {
            Mail::to($req->email)->send(new ForgotPassword($customer, $token));
            return redirect()->back()->with('ok', 'Send mail successfully,please check email to continue');
        }

        return redirect()->back()->with('no', 'Something error,try again');





    }
    // profile
    public function profile()
    {
        $auth = auth('cus')->user();
        return view('account.profile', compact('auth'));
    }
    public function check_profile(Request $req)
    {
        $auth = auth('cus')->user();
        $req->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:6|max:100|unique:customers,email,' . $auth->id,
            'password' => [
                'required',
                function ($attr, $value, $fail) use ($auth) {
                    // c3 global $auth; 
                    // c1 dung use,c2 $auth = auth('cus')->user();
                    if (!Hash::check($value, $auth->password)) {
                        return $fail('Your password does not mutch');
                    }

                }
            ],

        ], [
            'name.required' => 'Họ tên không được để trống,',
            'name.min' => 'Họ tên tối thiếu 6 kí tự',

        ]);
        $data = $req->only('name', 'email', 'phone', 'address', 'gender');


        // Customer::where('email', $auth->email)->update($data);
        // return redirect()->back()->with('ok', 'Update profile success');
        //hoac 
        $check = $auth->update($data);
        if ($check) {
            return redirect()->back()->with('ok', 'Update profile success');

        }
    }


    public function reset_password($token)
    {
        // lay du lieu tu bang 

        //$tokenData = CustomerResetToken::where('token', $token)->firstOrFail();
        //dd($tokenData);
        //khi co func checkToken trong model ne ta cai tien mot chut
        $tokenData = CustomerResetToken::checkToken($token);

        //c1
        // $customer = Customer::where('email', $tokenData->email)->firstOrFail();
        //dd($customer);

        //c2 ,khai bao quan he trong CustomerResetToken ,voi ham customer
        $customer = $tokenData->customer;
        //dd($customer);
        return view('account.reset_password');





    }


    public function check_reset_password($token)
    {
        request()->validate([
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'

        ]);

        $tokenData = CustomerResetToken::checkToken($token);
        $customer = $tokenData->customer;
        $data = [
            'password' => bcrypt(request(('password')))
        ];

        //dd($data);
        $check = $customer->update($data);

        //dd($check);
        if ($check) {
            return redirect()->back()->with('ok', 'Update password success');

        }

        return redirect()->back()->with('no', 'Update fail');



    }



}
