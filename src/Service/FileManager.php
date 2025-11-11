<?php

namespace App\Service;

use App\Entity\Mod;
use App\Entity\ModFile;
use App\Model\FileInfo;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use phpDocumentor\Reflection\Types\Integer;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

readonly class FileManager {
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LoggerInterface $logger
    ) {
    }

    public function upload(Mod $mod, UploadedFile $file, FileInfo $fileInfo): Mod {
        $file = $this->moveUploadedFile($file, $mod->getId(), $file->getFilename());

        $modFile = new ModFile();
        $modFile->populateFromFile($file);
        $modFile->populateFromFileInfo($fileInfo);
        $mod->addModFile($modFile);

        $this->entityManager->persist($modFile);
        $this->entityManager->flush();

        return $mod;
    }

    private function moveUploadedFile(UploadedFile $file, string $modId, string $fileId): File {
        $dir = $this->resolveDir($modId);
        try {
            mkdir($dir, 0775, true);
        } catch (Exception $e) {
            $this->logger->info($this::class . ": This directory already exists.");
        }

        return $file->move($dir, $fileId . '.' . $file->getClientOriginalExtension());
    }

    private function resolveDir(string $id): string {
        return __DIR__ . "/../../files/" . $id;
    }
}
