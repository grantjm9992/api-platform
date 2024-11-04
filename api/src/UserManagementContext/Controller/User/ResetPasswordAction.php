<?php

namespace App\UserManagementContext\Controller\User;

use App\UserManagementContext\Entity\User;
use App\UserManagementContext\Repository\UserRepositoryInterface;
use App\UserManagementContext\Request\User\ChangePasswordRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsController]
class ResetPasswordAction extends AbstractController
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserPasswordHasherInterface $passwordEncoder,
    ) {
    }

    public function __invoke(
       #[MapRequestPayload] ChangePasswordRequest $changePasswordRequest
    ): Response {
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw new AccessDeniedHttpException();
        }

        $user->setPassword(
            $this->passwordEncoder->hashPassword(
                user: $user,
                plainPassword: $changePasswordRequest->password
            )
        );

        $this->userRepository->save($user);

        return new JsonResponse(
            data: [],
            status: Response::HTTP_NO_CONTENT
        );
    }
}
