<?php

namespace App\Entity;

use App\Repository\ModRepository;
use App\Util\ContextGroup;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ModRepository::class)]
#[Groups([ContextGroup::MOD_INDEX, ContextGroup::SEARCH])]
#[ORM\Table(name: 'mods')]
class Mod
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column]
    private ?string $slug = null;
    #[ORM\Column]
    private ?string $name = null;
    #[ORM\Column]
    private ?string $description = null;
    #[ORM\ManyToMany(targetEntity: ModCategory::class, inversedBy: 'mods', cascade: ['persist', 'remove'])]
    private ?Collection $categories;
    #[ORM\ManyToMany(targetEntity: ModLoader::class, inversedBy: 'mods', cascade: ['persist', 'remove'])]
    private ?Collection $loaders;
    #[ORM\Column(enumType: ModSide::class)]
    private ?ModSide $side = null;
    #[ORM\Column]
    private ?int $downloads = null;
    #[ORM\Column(type: 'date_immutable')]
    private ?DateTimeImmutable $createdAt = null;
    #[ORM\Column(type: 'date_immutable')]
    private ?DateTimeImmutable $updatedAt = null;
    #[ORM\Column(enumType: License::class)]
    private ?License $license;
    #[ORM\OneToMany(targetEntity: ModFile::class, mappedBy: 'modEntity', cascade: ['persist', 'remove'])]
    private ?Collection $modFiles;
    #[ORM\ManyToMany(targetEntity: GameVersion::class, inversedBy: 'mods', cascade: ['persist', 'remove'])]
    private ?Collection $versions;
    #[ORM\Column]
    private ?bool $deleted = null;

    public function __construct() {
        $this->modFiles = new ArrayCollection();
        $this->versions = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->loaders = new ArrayCollection();

        $this->license = License::default();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getSlug(): ?string {
        return $this->slug;
    }

    public function setSlug(?string $slug): Mod {
        $this->slug = $slug;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): Mod {
        $this->name = $name;
        return $this;
    }

    public function getCategories(): ?Collection {
        return $this->categories;
    }

    public function setCategories(?Collection $categories): Mod {
        $this->categories = $categories;
        return $this;
    }

    public function getLoaders(): ?Collection {
        return $this->loaders;
    }

    public function setLoaders(?Collection $loaders): Mod {
        $this->loaders = $loaders;
        return $this;
    }

    public function getSide(): ?ModSide {
        return $this->side;
    }

    public function setSide(?ModSide $side): Mod {
        $this->side = $side;
        return $this;
    }

    public function getDownloads(): ?int {
        return $this->downloads;
    }

    public function setDownloads(?int $downloads): Mod {
        $this->downloads = $downloads;
        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeImmutable $createdAt): Mod {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTimeImmutable {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): Mod {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getLicense(): ?License {
        return $this->license;
    }

    public function setLicense(?License $license): Mod {
        $this->license = $license;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): self {
        $this->description = $description;
        return $this;
    }

    public function getDeleted(): ?bool {
        return $this->deleted;
    }

    public function setDeleted(?bool $deleted): self {
        $this->deleted = $deleted;
        return $this;
    }

    public function getModFiles(): ?Collection {
        return $this->modFiles;
    }

    public function setModFiles(?Collection $modFiles): self {
        $this->modFiles = $modFiles;
        return $this;
    }

    public function getVersions(): ?Collection {
        return $this->versions;
    }

    public function setVersions(?Collection $versions): self {
        $this->versions = $versions;
        return $this;
    }

}
