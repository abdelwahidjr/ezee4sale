<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\password_reset_phone;
use App\Http\Controllers\SMSController;
/**
 * Class ResetPasswordController
 *
 * @package App\Http\Controllers\Auth
 */
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $this->validate($request , $this->rules() ,
            $this->validationErrorMessages());

        $response = $this->broker()->reset(
            $this->credentials($request) , function ($user , $password)
        {
            $this->resetPassword($user , $password);
        });

        if ($request->wantsJson())
        {
            if ($response == Password::PASSWORD_RESET)
            {
                return response()->json(['message' => trans($response)]);
            } else
            {
                return response()->json([
                    'email'   => $request->input('email') ,
                    'message' => trans($response) ,
                ] , 400);
            }
        }

        if ($response == Password::PASSWORD_RESET)
        {
            $user = User::where('email' , $request->input('email'))->first();
            Auth::login($user);

            return $this->sendResetResponse($request , $response);
        } else
        {
            return $this->sendResetFailedResponse($request , $response);
        }

    }

        /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function resetByPhone(Request $request)
    {

        $this->validate($request ,[
            'token' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('phone' , $request->phone)->first();

        if(!$user)
            return response()->json([
                'Success' => false,
                'Result' => trans('main.null_entity')
            ] , 400);

        $reset = password_reset_phone::where('phone' , $request->phone)
                    ->where('token' , $request->token)->first();

        if(!$reset)
            return response()->json([
                'Success' => false,
                'Result' => trans('main.null_entity')
            ] , 400);

        $user->password = Hash::make($request->password);
        $user->save();

        $reset->delete();

        $sms = new SMSController();
        $message = "Your Password Has Been Changed";
        $result = $sms->send($request->phone , $message);

        Auth::login($user);

        return response()->json([
            'Success' => true,
            'Result' => trans('passwords.reset')
        ] , 200);
    }

    /**
     * @param User $user
     * @param      $password
     */
    protected function resetPassword(User $user , $password)
    {
        $user->password = Hash::make($password);
        $user->save();

        event(new PasswordReset($user));
    }
}