<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\GameVersion;
use App\Entity\Mod;
use App\Entity\ModFile;
use App\Tests\EntityManagerAwareTrait;
use App\Tests\MockEntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Nebkam\FluentTest\RequestBuilder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class ModFileControllerTest extends WebTestCase {
    use MockEntityTrait;
    use EntityManagerAwareTrait;

    private static ?ModFile $modFile;
    private static ?GameVersion $gameVersion;
    private static ?Mod $mod;
    public static function setUpBeforeClass(): void {
        parent::setUpBeforeClass();

        self::$gameVersion = self::generateTestGameVersion();
        self::persistEntity(self::$gameVersion);

        self::$modFile = self::generateTestModFile(new ArrayCollection([self::$gameVersion]));

        self::$mod = self::generateTestMod(
            new ArrayCollection([]),
            new ArrayCollection([]),
            new ArrayCollection([self::$modFile]),
            new ArrayCollection([])
        );
        self::persistEntity(self::$mod);
        self::$modFile->setModEntity(self::$mod);
        self::persistEntity(self::$modFile);

        parent::ensureKernelShutdown();
    }

    public static function testCreate() {
        $response = RequestBuilder::create(self::createClient())
            ->setMethod(Request::METHOD_POST)
            ->setUri('/api/mod/files')
            ->setJsonContent(self::getModFileJsonData([self::$gameVersion]))
            ->getResponse();
        self::assertResponseIsSuccessful();
    }

    public static function testUpdate() {
        $response = RequestBuilder::create(self::createClient())
            ->setMethod(Request::METHOD_PATCH)
            ->setUri('/api/mod/files/' . self::$modFile->getId())
            ->setJsonContent(['name' => "Updated mod"])
            ->getResponse();
        self::assertResponseIsSuccessful();
    }

    public static function testGetAllFromModId() {
        $response = RequestBuilder::create(self::createClient())
            ->setMethod(Request::METHOD_GET)
            ->setUri('/api/mod/' . self::$modFile->getModEntity()->getId() . '/files')
            ->getResponse();
        self::assertResponseIsSuccessful();

        $content = $response->getJsonContent();
        self::assertNotEmpty($content);
    }

    public static function testGetLatestFromModId() {
        $response = RequestBuilder::create(self::createClient())
            ->setMethod(Request::METHOD_GET)
            ->setUri('/api/mod/' . self::$modFile->getModEntity()->getId() . '/files/latest')
            ->getResponse();
        self::assertResponseIsSuccessful();

        $content = $response->getJsonContent();
        self::assertNotEmpty($content);
    }

    public static function tearDownAfterClass(): void {
        self::removeEntityById(Mod::class, self::$mod->getId());
        self::removeEntityById(GameVersion::class, self::$gameVersion->getId());

        parent::tearDownAfterClass();
    }
}
