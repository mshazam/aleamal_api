<?php

namespace App\Http\Controllers;

use App\Contracts\UserRepository;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->resourceItem = UserResource::class;
        $this->resourceCollection = UserCollection::class;
        $this->authorizeResource(User::class);
    }

    /**
     * List all users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cacheTag = 'users';
        $cacheKey = 'users:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, 3600, function () {
            $collection = $this->userRepository->findByFilters();

            return $this->respondWithCollection($collection);
        });
    }

    /**
     * Show a current logged user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        return $this->show($request, $user);
    }
    public function userCreateApi(){
        echo "okss";
    }
    /**
     * Show an user.
     *
     * @param Request $request
     * @param User    $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, User $user)
    {
        $allowedIncludes = [
            'profile',
            'loginhistories',
            'authorizeddevices',
            'notifications',
            'unreadnotifications',
        ];

        if ($request->has('include')) {
            $with = array_intersect($allowedIncludes, explode(',', strtolower($request->get('include'))));

            $cacheTag = 'users';
            $cacheKey = implode($with) . $user->id;

            $user = Cache::tags($cacheTag)->remember($cacheKey, 3600, function () use ($with, $user) {
                return $user->load($with);
            });
        }

        return $this->respondWithItem($user);
    }

    /**
     * Update the current logged user.
     *
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateMe(UserUpdateRequest $request)
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        return $this->update($request, $user);
    }

    /**
     * Update an user.
     *
     * @param UserUpdateRequest $request
     * @param User              $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->only(array_keys($request->rules()));
        $response = $this->userRepository->update($user, $data);

        return $this->respondWithItem($response);
    }

    /**
     * Update password of logged user.
     *
     * @param PasswordUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(PasswordUpdateRequest $request)
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        $data = $request->only(['password']);

        $response = $this->userRepository->update($user, $data);

        return $this->respondWithItem($response);
    }
}
