<?php

namespace App\Tests;

use App\Entity\FileStatus;
use App\Entity\GameVersion;
use App\Entity\License;
use App\Entity\Mod;
use App\Entity\ModCategory;
use App\Entity\ModFile;
use App\Entity\ModLoader;
use App\Entity\ModSide;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;

trait MockEntityTrait {
    protected static array $modJsonData = [
        "name" => "Epic Weapons Mod",
        "description" => "Adds new weapons and armors for all game versions.",
        "categories" => [1, 3],
        "loaders" => ["forge", "fabric"],
        "side" => ModSide::SIDE_BOTH,
        "license" => License::MIT
    ];

    protected static function generateTestMod(
        Collection $categories,
        Collection $loaders,
        Collection $modFiles,
        Collection $versions
    ): Mod {
        return (new Mod())
            ->setName("Epic Weapons Mod 2")
            ->setSlug("epicweaponsmod2")
            ->setDescription("Adds even better weapons")
            ->setDownloads(100)
            ->setSide(ModSide::SIDE_BOTH)
            ->setLicense(License::AFL_3_0)
            ->setCategories($categories)
            ->setLoaders($loaders)
            ->setModFiles($modFiles)
            ->setVersions($versions)
            ->setCreatedAt(new DateTimeImmutable('now'))
            ->setUpdatedAt(new DateTimeImmutable('now'))
            ->setDeleted(false)
            ;
    }

    protected static function generateTestModLoader(): ModLoader {
        return (new ModLoader())->setName("forge");
    }
    protected static function generateTestModCategory(): ModCategory {
        return (new ModCategory())->setName("tech");
    }
    protected static function generateTestModFile(Collection $gameVersions): ModFile {
        return (new ModFile())
            ->setName("forge")
            ->setModVersion("1.0.0")
            ->setChangelog("Added very important stuff")
            ->setChecksum("t3st_ch3cksum")
            ->setGameVersions($gameVersions)
            ->setStatus(FileStatus::APPROVED)
            ;
    }
    protected static function generateTestGameVersion(): GameVersion {
        return (new GameVersion())->setSlug("1.20.1");
    }
}
