<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(User::with(['tempatLahir', 'roles'])->get());
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('user_foto_profil', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('user_foto_profil'))))->toMediaCollection('user_foto_profil');
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['tempatLahir', 'roles']));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('user_foto_profil', false)) {
            if (!$user->user_foto_profil || $request->input('user_foto_profil') !== $user->user_foto_profil->file_name) {
                if ($user->user_foto_profil) {
                    $user->user_foto_profil->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('user_foto_profil'))))->toMediaCollection('user_foto_profil');
            }
        } elseif ($user->user_foto_profil) {
            $user->user_foto_profil->delete();
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
