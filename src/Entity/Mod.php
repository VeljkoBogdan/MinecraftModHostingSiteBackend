<?php

namespace App\Entity;

use App\Repository\ModRepository;
use App\Util\ContextGroup;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ModRepository::class)]
#[Groups([ContextGroup::MOD_INDEX])]
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
    #[ORM\Column(type: "simple_array", nullable: true)]
    private ?array $categories = null;
    #[ORM\Column(type: 'json')]
    private ?array $loaders = null;
    #[ORM\Column(enumType: ModSide::class)]
    private ?ModSide $side = null;
    #[ORM\Column]
    private ?int $downloads = null;
    #[ORM\Column(type: 'date_immutable')]
    private ?DateTimeImmutable $createdAt = null;
    #[ORM\Column(type: 'date_immutable')]
    private ?DateTimeImmutable $updatedAt = null;
    #[ORM\Column(enumType: License::class)]
    private ?License $license = null;
    // TODO: Add ModFile target entity
//    #[ORM\OneToMany(mappedBy: 'mod', targetEntity: ADDHERE)]
//    private ?Collection $modFiles;

    public function __construct() {
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

    public function getCategories(): ?array {
        return $this->categories;
    }

    public function setCategories(?array $categories): Mod {
        $this->categories = $categories;
        return $this;
    }

    public function getLoaders(): ?array {
        return array_map(fn(string $value) => ModLoader::from($value), $this->loaders);
    }

    public function setLoaders(?array $loaders): Mod {
        $this->loaders = array_map(fn(ModLoader $loader) => $loader->value, $loaders);
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

}
