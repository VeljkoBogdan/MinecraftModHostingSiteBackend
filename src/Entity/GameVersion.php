<?php

namespace App\Entity;

use App\Repository\GameVersionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameVersionRepository::class)]
#[ORM\Table(name: 'game_version')]
class GameVersion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $slug = null;

    #[ORM\ManyToMany(targetEntity: Mod::class, mappedBy: 'versions')]
    private ?Collection $mods;

    public function __construct() {
        $this->mods = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getMods(): ?Collection {
        return $this->mods;
    }

    public function setMods(?Collection $mods): self {
        $this->mods = $mods;
        return $this;
    }
}
