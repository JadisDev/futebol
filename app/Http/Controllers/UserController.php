<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Http\Requests\LoginPostRequest;
use App\Interfaces\Services\User\UserServiceInterface;
use App\Utils\ResponseApi;
use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;

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
            return ResponseApi::error(
                $request->all(),
                $e->getMessage()
            );
        } catch (Exception $e) {
            return ResponseApi::error(
                $request->all()
            );
        }
    }
}
