<?php

namespace App\Http\Controllers;

use App\Exceptions\NotAuthorizedException;
use App\Exceptions\UserExistException;
use App\Exceptions\UserNotFoundException;
use App\Http\Requests\LoginPostRequest;
use App\Http\Requests\UserPostRequest;
use App\Interfaces\User\Service\UserServiceInterface;
use App\Utils\ResponseApi;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class UserController extends Controller
{

    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function auth(LoginPostRequest $request)
    {
        try {
            $token = $this->userService->auth($request);
            return ResponseApi::success(
                ["token" => $token]
            );
        } catch (UserNotFoundException $e) {
            return ResponseApi::warning(
                $request->all(),
                $e->getMessage(),
                Response::HTTP_NOT_FOUND
            );
        } catch (NotAuthorizedException $e) {
            return ResponseApi::warning(
                $request->all(),
                $e->getMessage(),
                Response::HTTP_UNAUTHORIZED
            );
        }
    }

    public function save(UserPostRequest $request)
    {
        try {
            $user = $this->userService->save($request);
            return ResponseApi::success(
                $user->toArray()
            );
        } catch (UserExistException $e) {
            return ResponseApi::warning(
                $request->all(),
                $e->getMessage()
            );
        }
    }
}
