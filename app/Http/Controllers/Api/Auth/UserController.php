<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = User::all();

        return $this->responseJson($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $user = User::find($id);

        return $this->responseJson($user);
    }

    /**
     * Update the user profile details.
     */
    public function update_profile(UpdateRequest $request): JsonResponse
    {
        $user = auth()->user();

        User::find($user['id']);

        $user->update($request->only(['name', 'email']));

        return $this->responseJson($user);
    }

    /**
     * Update the user password.
     */
    public function update_password(UpdatePasswordRequest $request): JsonResponse
    {
        $user = auth()->user();

        User::find($user['id']);

        if (Hash::check($request->password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
            return $this->responseJson('Password Updated');
        }
        return $this->responseJsonError('Old password is wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): JsonResponse
    {

        $user = auth()->user()->id;
        User::destroy($user);
        return $this->responseJson(['User Successfully Deleted']);

    }
}
