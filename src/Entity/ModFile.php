<?php

namespace App\Entity;

use App\Repository\ModFileRepository;
use App\Util\ContextGroup;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
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
    #[ORM\Column(enumType: FileStatus::class)]
    private ?FileStatus $status = null;
    #[ORM\Column]
    private ?bool $isActive = null;

    public function __construct() {
        $this->gameVersions = new ArrayCollection();
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
}
