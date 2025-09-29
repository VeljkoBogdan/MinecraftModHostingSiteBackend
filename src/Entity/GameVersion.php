<?php

namespace App\Entity;

use App\Repository\GameVersionRepository;
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
}
