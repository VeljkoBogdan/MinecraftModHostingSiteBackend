<?php

namespace App\Entity;

use App\Repository\ModLoaderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModLoaderRepository::class)]
class ModLoader
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Mod::class, mappedBy: 'loaders')]
    private ?Collection $mods;

    public function __construct() {
        $this->mods = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMods(): ?Collection {
        return $this->mods;
    }

    public function setMods(?Collection $mods): ModLoader {
        $this->mods = $mods;
        return $this;
    }
}
