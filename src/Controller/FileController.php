<?php

namespace App\Controller;

use App\Entity\Mod;
use App\Form\FileInfoType;
use App\Model\FileInfo;
use App\Service\FileManager;
use App\Util\ContextGroup;
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
    use ControllerTrait;
    use FormTrait;

    #[Route('/api/mod/{mod}/files', requirements: ['mod' => Requirement::POSITIVE_INT], methods: Request::METHOD_POST)]
    public function upload(Mod $mod, Request $request, FileManager $fileManager): JsonResponse {
        // Get file info from request
        $fileInfo = new FileInfo($mod);
        $fileInfo->setModVersion($request->request->get('modVersion'));
        $fileInfo->setChangelog($request->request->get('changelog'));
        $fileInfo->setChecksum($request->request->get('checksum'));

        // Get uploaded file from request
        $uploaded = $request->files->get('fileName');

        if (!($uploaded instanceof UploadedFile)) {
            $files = $request->files->all();
            $debug = [
                'error' => 'No file uploaded',
                'files_count' => count($files),
                'files_keys' => array_keys($files),
                'content_type' => $request->headers->get('content-type') ?? $request->server->get('CONTENT_TYPE'),
                'post_max_size' => ini_get('post_max_size'),
                'upload_max_filesize' => ini_get('upload_max_filesize'),
                'file_uploads' => ini_get('file_uploads'),
            ];

            return $this->json($debug, Response::HTTP_BAD_REQUEST);
        }

        $fileManager->upload($mod, $uploaded, $fileInfo);

        return $this->jsonWithGroup($mod, ContextGroup::MOD_INDEX, Response::HTTP_CREATED);
    }
}
