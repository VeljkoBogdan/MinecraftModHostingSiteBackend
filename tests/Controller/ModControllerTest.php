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
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Nebkam\FluentTest\RequestBuilder;
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

    public function testCreate() {
        $response = RequestBuilder::create(self::createClient())
            ->setMethod(Request::METHOD_POST)
            ->setUri('/api/mod/')
            ->setJsonContent(self::getModJsonData([self::$modCategory], [self::$modLoader]))
            ->getResponse();
        self::assertResponseIsSuccessful();
    }

    public function testUpdate() {
        $updatedName = "Updated mod";
        $response = RequestBuilder::create(self::createClient())
            ->setMethod(Request::METHOD_PATCH)
            ->setUri('/api/mod/' . self::$mod->getId())
            ->setJsonContent(["name" => $updatedName])
            ->getResponse();
        self::assertResponseIsSuccessful();
    }

    public function testDelete() {
        $response = RequestBuilder::create(self::createClient())
            ->setMethod(Request::METHOD_DELETE)
            ->setUri('/api/mod/' . self::$mod->getId())
            ->getResponse();
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public static function tearDownAfterClass(): void {
        self::removeEntityById(Mod::class, self::$mod->getId());
        self::removeEntityById(ModFile::class, self::$modFile->getId());

        parent::tearDownAfterClass();
    }
}
