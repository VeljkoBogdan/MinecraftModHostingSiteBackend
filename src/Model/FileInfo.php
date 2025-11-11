<?php

namespace App\Model;

use App\Entity\Mod;

class FileInfo {
    public Mod $mod;
    public ?string $modVersion = null;
    public ?string $changelog = null;
    public ?string $checksum = null;

    public function __construct(Mod $mod) {
        $this->mod = $mod;
    }

    public function getModVersion(): ?string {
        return $this->modVersion;
    }

    public function setModVersion(?string $modVersion): void {
        $this->modVersion = $modVersion;
    }

    public function getChangelog(): ?string {
        return $this->changelog;
    }

    public function setChangelog(?string $changelog): void {
        $this->changelog = $changelog;
    }

    public function getMod(): Mod {
        return $this->mod;
    }

    public function setMod(Mod $mod): void {
        $this->mod = $mod;
    }

    public function getChecksum(): ?string {
        return $this->checksum;
    }

    public function setChecksum(?string $checksum): void {
        $this->checksum = $checksum;
    }

}
