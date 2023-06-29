<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    /**
     * Register api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required',
            'confirm_password' => ['required', 'same:password']
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $user = User::query()->create($input);
        $response['token'] = $user->createToken(env('APP_NAME', 'MyApp'))->plainTextToken;
        $response['user'] = $user;

        return $this->sendResponse($response, 'User registered successfully.');
    }

    /**
     * Login api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('web')->user();
            $response['token'] = $user->createToken('MyApp')->plainTextToken;
            $response['user'] = $user;

            return $this->sendResponse($response, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    /**
     * Logout api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse(null, 'User logout successfully.');
    }

    /**
     * show user api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $response['user'] = $request->user();

        return $this->sendResponse($response, 'user fetched successfully.');
    }

    /**
     * show user events api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function events(Request $request): JsonResponse
    {
        $response['events'] = $request->user()->events;

        return $this->sendResponse($response, 'user events fetched successfully.');
    }


}
