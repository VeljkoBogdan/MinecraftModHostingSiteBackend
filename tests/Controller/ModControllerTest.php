<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\GameVersion;
use App\Entity\Mod;
use App\Entity\ModCategory;
use App\Entity\ModFile;
use App\Entity\ModLoader;
use App\Tests\EntityManagerAwareTrait;
use App\Tests\MockEntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Nebkam\FluentTest\RequestBuilder;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class ModControllerTest extends WebTestCase {
    use MockEntityTrait;
    use EntityManagerAwareTrait;
    private static ?Mod $mod;
    private static ?GameVersion $gameVersion;
    private static ?ModCategory $modCategory;
    private static ?ModFile $modFile;
    private static ?ModLoader $modLoader;

    public static function setUpBeforeClass(): void {
        parent::setUpBeforeClass();

        self::$gameVersion = self::generateTestGameVersion();
        self::$modLoader = self::generateTestModLoader();
        self::$modCategory = self::generateTestModCategory();
        self::persistEntity(self::$gameVersion);
        self::persistEntity(self::$modLoader);
        self::persistEntity(self::$modCategory);

        self::$modFile = self::generateTestModFile(new ArrayCollection([self::$gameVersion]));
        self::persistEntity(self::$modFile);

        self::$mod = self::generateTestMod(
            new ArrayCollection([self::$modCategory]),
            new ArrayCollection([self::$modLoader]),
            new ArrayCollection([self::$modFile]),
            new ArrayCollection([self::$gameVersion])
        );
        self::persistEntity(self::$mod);

        parent::ensureKernelShutdown();
    }

    public function testIndex() {
        $response = RequestBuilder::create(self::createClient())
            ->setMethod(Request::METHOD_GET)
            ->setUri('/api/mod/')
            ->getResponse();
        self::assertResponseIsSuccessful();

        $content = $response->getJsonContent();
        self::assertNotEmpty($content);
    }
}
