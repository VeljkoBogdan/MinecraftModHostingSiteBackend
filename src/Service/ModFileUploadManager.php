<?php

namespace App\Service;

use App\Entity\Mod;
use App\Entity\ModFile;
use App\Model\FileModel;
use Doctrine\ORM\EntityManagerInterface;

readonly class ModFileUploadManager {

    public function __construct(
        private FileManager            $fileManager,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function uploadModFile(Mod $mod, FileModel $fileModel): Mod {
        $this->fileManager->moveUploadedFile($fileModel->fileName, $mod->getId());

        $modFile = new ModFile();
        $modFile->populateFromFileModel($fileModel);
        $mod->addModFile($modFile);

        $this->entityManager->persist($modFile);
        $this->entityManager->flush();

        return $mod;
    }
}
