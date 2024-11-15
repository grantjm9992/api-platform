<?php

namespace App\UserManagementContext\State\Processor\User;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Validator\ValidatorInterface;
use App\UserManagementContext\Repository\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class CreateUserProcessor implements ProcessorInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserPasswordHasherInterface $passwordEncoder,
        private ValidatorInterface $validator
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): JsonResponse
    {
        $this->validator->validate($data);

        $encodedPassword = $this->passwordEncoder->hashPassword(
            $data,
            $data->getPassword(),
        );

        $data->setPassword($encodedPassword);

        $this->userRepository->save($data);

        return new JsonResponse(['status' => 'User created!'], Response::HTTP_CREATED);
    }
}
