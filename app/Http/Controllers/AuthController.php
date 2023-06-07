<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function show_signup_form()
    {
        return view('auth.register');
    }

    public function process_signup(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        $current_date = Carbon::now();
        $expires_date = $current_date->addDays(7)->toDateTimeString();

        $user = new User;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->personal_link = Str::random(15);
        $user->link_expires_at = $expires_date;
        $user->save();

        $user_link = url('/') . '/' . $user->personal_link;

        return response()->json(
            [
                'success' => true,
                'message' => 'Registration is completed. Your personal link to home page is <a href="' . $user_link . '">' . $user_link . '</a>'
            ]
        );

    }
}
