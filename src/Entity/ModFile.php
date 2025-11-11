<?php

namespace App\Entity;

use App\Model\FileInfo;
use App\Repository\ModFileRepository;
use App\Util\ContextGroup;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ModFileRepository::class)]
#[ORM\Table(name: 'modFile')]
#[Groups([ContextGroup::MOD_FILE_INDEX])]
class ModFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column]
    private ?string $name = null;
    #[ORM\ManyToOne(targetEntity: Mod::class, inversedBy: 'modFiles')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Mod $modEntity = null;
    #[ORM\Column]
    private ?string $modVersion = null;
    #[ORM\Column]
    private ?string $changelog = null;
    #[ORM\Column]
    private ?string $checksum = null;
    #[ORM\ManyToMany(targetEntity: GameVersion::class)]
    private ?Collection $gameVersions;
    #[ORM\Column(nullable: true, enumType: FileStatus::class)]
    private ?FileStatus $status = null;
    #[ORM\Column(nullable: true)]
    private ?bool $isActive = null;
    #[ORM\Column]
    private ?int $size = 0;
    #[ORM\Column]
    private ?string $location = null;

    public function __construct() {
        $this->gameVersions = new ArrayCollection();
    }

    public function populateFromFile(File $file): self {
        $this
            ->setName($file->getFilename())
            ->setLocation($file->getRealPath())
            ->setSize($file->getSize());
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModVersion(): ?string {
        return $this->modVersion;
    }

    public function setModVersion(?string $modVersion): ModFile {
        $this->modVersion = $modVersion;
        return $this;
    }

    public function getChangelog(): ?string {
        return $this->changelog;
    }

    public function setChangelog(?string $changelog): ModFile {
        $this->changelog = $changelog;
        return $this;
    }

    public function getChecksum(): ?string {
        return $this->checksum;
    }

    public function setChecksum(?string $checksum): ModFile {
        $this->checksum = $checksum;
        return $this;
    }

    public function getGameVersions(): ?Collection {
        return $this->gameVersions;
    }

    public function setGameVersions(?Collection $gameVersions): ModFile {
        $this->gameVersions = $gameVersions;
        return $this;
    }

    public function getStatus(): ?FileStatus {
        return $this->status;
    }

    public function setStatus(?FileStatus $status): ModFile {
        $this->status = $status;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getModEntity(): ?Mod {
        return $this->modEntity;
    }

    public function setModEntity(?Mod $modEntity): self {
        $this->modEntity = $modEntity;
        return $this;
    }

    public function getIsActive(): ?bool {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self {
        $this->isActive = $isActive;
        return $this;
    }

    public function getSize(): ?int {
        return $this->size;
    }

    public function setSize(?int $size): self {
        $this->size = $size;
        return $this;
    }

    public function getLocation(): ?string {
        return $this->location;
    }

    public function setLocation(?string $location): self {
        $this->location = $location;
        return $this;
    }

    public function populateFromFileInfo(FileInfo $fileInfo): self {
        $this
            ->setIsActive(true)
            ->setStatus(FileStatus::WAITING_APPROVAL)
            ->setChecksum($fileInfo->checksum)
            ->setModVersion($fileInfo->modVersion)
            ->setChangelog($fileInfo->changelog);
        return $this;
    }
}
