<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests\ResetPasswordRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetPassword()
    {
        return Inertia::render('Auth/ResetPassword');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        //action send mail
        Mail::to($request->email)->send(new ResetPasswordMail());
        return redirect('login')->with('success', 'We did it!');
    }
}
