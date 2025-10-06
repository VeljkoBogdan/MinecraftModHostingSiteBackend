<?php

namespace App\Controller;

use App\Form\ModSearchFilterType;
use App\Search\Filter\ModSearchFilter;
use App\Service\ModSearchService;
use App\Util\ContextGroup;
use Nebkam\SymfonyTraits\ControllerTrait;
use Nebkam\SymfonyTraits\FormTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Attribute\Route;

final class ModSearchController extends AbstractController
{
    use FormTrait;
    use ControllerTrait;

    #[Route('/api/mod/search', methods: Request::METHOD_GET)]
    #[Cache(maxage: 30, public: true, vary: ["Origin"])]
    public function search(Request $request, ModSearchService $modSearchService): JsonResponse {
        $filter = new ModSearchFilter();
        $this->handleJSONForm($request, $filter, ModSearchFilterType::class);

        return $this->jsonWithGroup($modSearchService->search($filter), ContextGroup::SEARCH);
    }
}
