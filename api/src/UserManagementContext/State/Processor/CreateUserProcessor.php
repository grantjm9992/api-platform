<?php

namespace App\UserManagementContext\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Validator\ValidatorInterface;
use App\UserManagementContext\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherAwareInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

readonly class CreateUserProcessor implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordEncoder,
        private ValidatorInterface $validator
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): JsonResponse
    {
        // Validate the user entity (optional, depends on your validation strategy)
        $this->validator->validate($data);

        // Hash the password
        $encodedPassword = $this->passwordEncoder->hashPassword(
            $data,
            $data->getPassword(),
        );

        $data->setPassword($encodedPassword);

        // Persist the user to the database
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        // Return a response (you can customize this as needed)
        return new JsonResponse(['status' => 'User created!'], Response::HTTP_CREATED);
    }
}
