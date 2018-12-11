<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserChangePassword;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\SignupActivate;
use App\Notifications\ChangePassword;
use App\Http\Controllers\SMSController;

class UserAuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     *
     * @return [string] message
     */
    public function signup(RegisterRequest $request)
    {

        $activation_token = str_random(7);
        $user             = new User();

        $user->fill($request->all());
        $user->password         = bcrypt($request->password);
        $user->activation_token = $activation_token;

        $user->save();

        $user->notify(new SignupActivate($user));

        return response()->json([
            'status'  => 'Success' ,
            'message' => trans('auth.success_created') ,
        ] , 201);

    }

    public function signupActivate($token)
    {
        $user = User::where('activation_token' , $token)->first();
        if ( ! $user)
        {

            return response()->json([
                'status'  => 'Failed' ,
                'message' => trans('auth.invalid_token') ,
            ] , 400);

        }
        $user->active           = true;
        $user->activation_token = '';
        $user->save();

        return response([
            'status'  => 'Success' ,
            'message' => $user ,
        ] , 200);
    }


    public function signupActivateWeb($token)
    {
        $user    = User::where('activation_token' , $token)->first();
        $status  = 'success';
        $message = 'Email Verified!';
        if ( ! $user)
        {

            $status  = 'Failed';
            $message = trans('auth.invalid_token');
        } else
        {
            $user->active           = true;
            $user->activation_token = '';
            $user->save();
        }

        return view('auth.verification')->with('status' , $status)->with('message' , $message);
    }


    public function login(Request $request)
    {
        if ($request->has('email'))
        {
            $request->validate([
                'email'    => 'required|email|exists:users' ,
                'password' => 'required' ,
            ]);
            $credentials['email'] = $request->email;
        } else
        {
            $request->validate([
                'phone'    => 'required|numeric|exists:users' ,
                'password' => 'required' ,
            ]);
            $credentials['phone'] = $request->phone;
        }

        $credentials['password'] = $request->password;
        $credentials['active']   = 1;

        if ( ! Auth::attempt($credentials))
        {
            return response()->json([
                'status'  => 'Failed' ,
                'message' => trans('auth.failed') ,
            ] , 400);
        }

        $user        = $request->user();
        $tokenResult = $user->createToken('Login Token');
        $token       = $tokenResult->token;

        if ($request->remember_me)
        {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            'status'      => 'Success' ,
            'data'        => $user ,
            'accessToken' => $tokenResult->accessToken ,
            'token_type'  => 'Bearer' ,
            'expires_at'  => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString() ,
        ] ,
            200);

    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response([
            'status'  => 'Success' ,
            'message' => trans('auth.logout') ,
        ] , 200);

    }

    public function ChangeMyPassword(UserChangePassword $request)
    {

        $user = $request->user('api'); // OR auth('api')->user();

        if ( ! $user)
        {
            return response()->json([
                'status'  => 'Failed' ,
                'message' => trans('main.credentials') ,
            ] , 400);

        } elseif (Hash::check($request->input('old_password') , $user->password))
        {
            $user->password = Hash::make($request->input('password'));
            $user->save();

            $sms     = new SMSController();
            $message = "Your Password has been changed.";
            $result  = $sms->send($user->phone , $message);
            $result  = $result->getData();
            if ($result->Result == 'false')
            {
                $user->notify(new ChangePassword());
            }

            return response([
                'status'  => 'Success' ,
                'message' => trans('passwords.reset') ,
            ] , 200);
        }

        return response()->json([
            'status'  => 'Failed' ,
            'message' => trans('main.credentials') ,
        ] , 400);

    }

}


