<?php

declare(strict_types=1);

namespace App\Bridge\MyAmazingFramework\Controller\PublicApi;

use App\Application\Dto\Phone\GetUserDto;
use App\Application\Exception\User\UserNotFound;
use App\Application\Service\User\ViewUserService;
use Exception;
use Lib\MyAmazingFramework\MyController;
use Lib\MyAmazingFramework\Request\MyRequest;
use Lib\MyAmazingFramework\Response\MyJsonResponse;

final class UserController extends MyController
{
    public function __construct(private ViewUserService $service)
    {
    }

    /**
     * View user.
     */
    public function view(MyRequest $request): MyJsonResponse
    {
        $email = (string)$request->param('email');

        if (!$email) {
            throw new Exception('Email param required.', MyJsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $result = $this->service->execute(new GetUserDto($email));
        } catch (UserNotFound $e) {
            throw new Exception($e->getMessage(), MyJsonResponse::HTTP_NOT_FOUND);
        }

        return new MyJsonResponse($result, MyJsonResponse::HTTP_OK);
    }
}
