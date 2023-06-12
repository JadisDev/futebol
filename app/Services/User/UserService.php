<?php

namespace App\Services\User;

use App\Exceptions\NotAuthorizedException;
use App\Exceptions\UserExistException;
use App\Exceptions\UserNotFoundException;
use App\Http\Requests\LoginPostRequest;
use App\Http\Requests\UserPostRequest;
use App\Interfaces\User\Repository\UserRepositoryInterface;
use App\Interfaces\User\Service\UserServiceInterface;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService implements UserServiceInterface
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function auth(LoginPostRequest $request): string
    {
        $credentials = $request->only('login', 'password');
        $user = User::where('login', $credentials['login'])->first();
        if (!$user) {
            throw new UserNotFoundException('Usuário não encontrado');
        }
        if ($user['password'] === md5($credentials['password'])) {
            return JWTAuth::claims($user->toArray())->fromUser($user);
        }
        throw new NotAuthorizedException();
    }

    public function save(UserPostRequest $request): User
    {
        $data = $request->all();
        $data['password'] = md5($data['password']);
        $user = $this->userRepository->getByLogin($data['login']);
        if ($user) {
            throw new UserExistException();
        }
        return $this->userRepository->create($data);
    }
}
