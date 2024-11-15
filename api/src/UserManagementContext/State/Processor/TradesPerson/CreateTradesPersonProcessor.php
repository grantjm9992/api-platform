<?php

namespace App\UserManagementContext\State\Processor\TradesPerson;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Validator\ValidatorInterface;
use App\UserManagementContext\Entity\TradesPerson;
use App\UserManagementContext\Repository\TradesPersonRepositoryInterface;
use App\UserManagementContext\Repository\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

final readonly class CreateTradesPersonProcessor implements ProcessorInterface
{
    public function __construct(
        private TokenInterface $tokenInterface,
        private ValidatorInterface $validator,
        private UserRepositoryInterface $userRepository,
        private TradesPersonRepositoryInterface $tradesPersonRepository
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): JsonResponse
    {
        $this->validator->validate($data);
        $user = $this->tokenInterface->getUser();

        if (!$user instanceof UserInterface) {
            throw new UserNotFoundException();
        }

        if ($this->tradesPersonRepository->findByUser($user->getUserIdentifier())) {
            throw new \Exception('Already exists');
        }

        if (!$data instanceof TradesPerson) {
            throw new \InvalidArgumentException();
        }

        $userEntity = $this->userRepository->find(
            $user->getUserIdentifier()
        );

        $data->setUser($userEntity);
        $this->tradesPersonRepository->save($data);

        return new JsonResponse(['status' => 'TradesPerson profile created!'], Response::HTTP_CREATED);
    }
}
