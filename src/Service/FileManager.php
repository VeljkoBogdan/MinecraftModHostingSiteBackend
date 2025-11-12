<?php

namespace App\Service;

use App\Entity\Mod;
use App\Entity\ModFile;
use App\Model\FileModel;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use phpDocumentor\Reflection\Types\Integer;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

readonly class FileManager {
    public function __construct(
        private SluggerInterface $slugger,
    ) {
    }

    public function moveUploadedFile(UploadedFile $file, string $modId): File {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFileName = $this->slugger->slug($originalName);
        $fileName = $originalName . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

        $dir = $this->resolveDir($modId);

        return $file->move($dir, $fileName);
    }

    private function resolveDir(string $id): string {
        return __DIR__ . "/../../files/" . $id;
    }
}
