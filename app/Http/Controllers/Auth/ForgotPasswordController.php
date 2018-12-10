<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPassword;
use App\Models\User;
use App\Models\password_reset_phone;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Mail;
use App\Http\Controllers\SMSController;

/**
 * Class ForgotPasswordController
 *
 * @package App\Http\Controllers\Auth
 */
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

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getResetToken(Request $request)
    {
        $this->validate($request ,
            ['email' => 'required|string|email|max:255|exists:users']);

        $user = User::where('email' , $request->input('email'))->first();
        if ( ! $user)
        {
            return response(['message' => trans('passwords.user')] , 400);
        }

        $token = $this->broker()->createToken($user);
        Mail::to($request->input('email'))->send(new ForgetPassword($token));

        return response([
            'message' => trans('passwords.sent') ,
            'token'   => $token ,

        ] , 200);

    }

        /**
     * Send a sms reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getPhoneResetToken(Request $request)
    {
        $this->validate($request ,
            ['phone' => 'required|string|min:8|max:8|exists:users']);

        $user = User::where('phone' , $request->input('phone'))->first();
        if ( ! $user)
        {
            return response(['message' => trans('passwords.user')] , 400);
        }

        $token = str_random(7);
        
        $sms = new SMSController();
        $message = "You are receiving this email because we received a password reset request for your account.";
        $message .= "Your reset token is " . $token;

        $result = $sms->send($request->phone , $message);

        if($result->getData()->Result == "true"){
            $oldReset = password_reset_phone::where('phone' , $request->input('phone'))->first();
            
            if($oldReset){
                $oldReset->token = $token;
                $oldReset->save();
            }else{
                $reset = new password_reset_phone();
                $reset->phone = $request->input('phone');
                $reset->token = $token;
                $reset->save();
            }
            
        }
        return response([
            'result'   => $result->getData() ,
        ] , 200);

    }
}
