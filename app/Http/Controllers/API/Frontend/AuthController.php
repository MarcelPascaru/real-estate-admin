<?php

namespace App\Http\Controllers\API\Frontend;

use App\Http\Controllers\API\RestResponseFactory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

/**
 * Auth controller.
 */
class AuthController
{
    /** @var RestResponseFactory $restResponseFactory */
    private RestResponseFactory $restResponseFactory;

    /**
     * Construct.
     *
     * @param RestResponseFactory $restResponseFactory
     */
    public function __construct(RestResponseFactory $restResponseFactory)
    {
        $this->restResponseFactory = $restResponseFactory;
    }

    /**
     * Login.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            Auth::attempt(['email' => $request['email'], 'password' => $request['password']]);

            $authUser = Auth::user();
            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
            $success['name'] =  $authUser['name'];

            return $this->restResponseFactory->ok($success);
        } catch (Exception $exception) {
            return $this->restResponseFactory->serverError($exception);
        }
    }

    /**
     * Register.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);

            if($validator->fails()){
                throw new Exception('Error validation', (array)$validator->errors());
            }

            $input = $request->all();

            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->restResponseFactory->ok($success);
        } catch (Exception $exception) {
            return $this->restResponseFactory->serverError($exception);
        }
    }

    /**
     * Get auth user.`
     *
     * @return JsonResponse
     */
    public function getAuthUser(): JsonResponse
    {
        try {
            $user = Auth::user();

            return $this->restResponseFactory->ok(
                [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role_id' => $user['role_id'],
                ]
            );
        } catch (Exception $exception) {
            return $this->restResponseFactory->serverError($exception);
        }
    }
}
