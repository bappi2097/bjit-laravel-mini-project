<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginFormRequest;
use App\Traits\ApiResponseWithHttpStatus;
use App\Http\Requests\RegistrationFormRequest;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    use ApiResponseWithHttpStatus;

    public function __construct()
    {
        Auth::shouldUse('users');
    }

    public function login(LoginFormRequest $request)
    {
        $input = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($input)) {
            return $this->apiResponse('Invalid credential', null, Response::HTTP_BAD_REQUEST, false);
        }
        $data = ['access_token' => $token, 'user' => Auth::user()];

        return $this->apiResponse('Success Login', $data, Response::HTTP_OK, true);
    }

    public function register(RegistrationFormRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);

        $data = [
            'access_token' => $token,
            'user' => Auth::user()
        ];
        return $this->apiResponse('Response successfull', $data, Response::HTTP_OK, true);
    }

    public function profile()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
        if (Auth::check()) {
            $token = Auth::getToken();
            JWTAuth::setToken($token);
            JWTAuth::invalidate();
            Auth::logout();
            return $this->apiResponse('Logout Success', null, Response::HTTP_OK, true);
        } else {
            return $this->apiResponse('Logout Error', null, Response::HTTP_UNAUTHORIZED, false);
        }
    }
}
