<?php

namespace App\Controller;

use App\Entity\Mod;
use App\Form\FileModelType;
use App\Model\FileModel;
use App\Service\FileManager;
use App\Service\ModFileUploadManager;
use App\Util\ContextGroup;
use Doctrine\ORM\EntityManagerInterface;
use Nebkam\SymfonyTraits\ControllerTrait;
use Nebkam\SymfonyTraits\FormTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class FileController extends AbstractController {
    use FormTrait;
    use ControllerTrait;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/api/mod/{mod}/files', requirements: ['mod' => Requirement::POSITIVE_INT], methods: Request::METHOD_POST)]
    public function upload(Mod $mod, Request $request, ModFileUploadManager $fileManager): JsonResponse {
        $fileModel = new FileModel($mod);
        $fileModel->fileName = $this->handleUpload($request, 'fileName');
        $this->handleForm($request, $fileModel, FileModelType::class);
        $fileManager->uploadModFile($mod, $fileModel);

        return $this->jsonWithGroup($mod, ContextGroup::MOD_INDEX, Response::HTTP_CREATED);
    }
}
