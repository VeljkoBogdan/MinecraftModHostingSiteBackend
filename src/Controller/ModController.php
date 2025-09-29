<?php

namespace App\Controller;

use App\Entity\Mod;
use App\Form\ModType;
use App\Util\ContextGroup;
use Doctrine\ORM\EntityManagerInterface;
use Nebkam\SymfonyTraits\ControllerTrait;
use Nebkam\SymfonyTraits\FormTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class ModController extends AbstractController
{
    use ControllerTrait;
    use FormTrait;

    public function __construct(
         private readonly EntityManagerInterface $entityManager
    ) {
    }

    #[Route('api/mod/', methods: Request::METHOD_GET)]
    public function index(): JsonResponse {
        return $this->jsonWithGroup($this->entityManager->getRepository(Mod::class)->findAll(),
            ContextGroup::MOD_INDEX);
    }

    #[Route('api/mod/', methods: Request::METHOD_POST)]
    public function create(Request $request): Response {
        $this->handleJSONForm($request, new Mod(), ModType::class);
        $this->entityManager->flush();

        return $this->createOkResponse();
    }

    #[Route('api/mod/{id}', requirements: ['id' => Requirement::POSITIVE_INT], methods: Request::METHOD_PATCH)]
    public function update(Mod $mod, Request $request): Response {
        $this->handleJSONForm($request, $mod, ModType::class, [], false);
        $this->entityManager->flush();

        return $this->createOkResponse();
    }
    #[Route('api/mod/{id}', requirements: ['id' => Requirement::POSITIVE_INT], methods: Request::METHOD_DELETE)]
    public function delete(Mod $mod): Response {
        $mod->setDeleted(true);
        $this->entityManager->flush();

        return $this->createOkResponse();
    }
}
