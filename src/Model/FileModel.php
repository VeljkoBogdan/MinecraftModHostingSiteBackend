<?php

namespace App\Model;

use App\Entity\Mod;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileModel {
    public UploadedFile $fileName;

    public Mod $mod;
    public string $modVersion = "";
    public string $changelog = "";
    public string $checksum = "";

    public function __construct(Mod $mod) {
        $this->mod = $mod;
    }
}
