<?php

namespace App\Controller;

use App\Entity\Mod;
use App\Util\ContextGroup;
use Doctrine\ORM\EntityManagerInterface;
use Nebkam\SymfonyTraits\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class ModController extends AbstractController
{
    use ControllerTrait;

    public function __construct(
         private readonly EntityManagerInterface $entityManager
    ) {
    }

    #[Route('api/mod/', methods: Request::METHOD_GET)]
    public function index(): JsonResponse {
        return $this->jsonWithGroup($this->entityManager->getRepository(Mod::class)->findAll(),
            ContextGroup::MOD_INDEX);
    }
}
