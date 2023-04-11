<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;


class AuthController extends Controller
{

    /**
     * Register user.
     */
    public function register(CreateRequest $request): JsonResponse
    {
        $request->only(['name', 'email', 'password', 'confirm_password']);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password'])
        ]);

        return $this->responseJson('Your Account Successfully Created');
    }

    /**
     * Login user.
     */
    public function login(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return $this->responseJson([
                    'message' => 'You Login Successfully',
                    'token' => $user->createToken('passport_token')->accessToken,
                ]);
            }
        }

        return $this->responseJsonError('Incorrect email or password');

    }

    /**
     * Access method to authenticate.
     */
    public function userDetail(): JsonResponse
    {
        return $this->responseJson(auth()->user());
    }

    /**
     * Logout user.
     */
    public function logout(Request $request): JsonResponse
    {
//
//        // logout from only current device
//        $tokenRepository = app(TokenRepository::class);
//        $tokenRepository->revokeAccessToken($access_token->id);

        // use this method to logout from all devices
//         $refreshTokenRepository = app(RefreshTokenRepository::class);
//         $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($$access_token->id);

        $request->user()->token()->revoke();
        return $this->responseJsonError(['message' => 'Successfully logged out']);
    }
}
