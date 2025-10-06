<?php

namespace App\Tests\Controller;

use App\Entity\GameVersion;
use App\Entity\Mod;
use App\Entity\ModCategory;
use App\Entity\ModFile;
use App\Entity\ModLoader;
use App\Entity\ModSide;
use App\Tests\EntityManagerAwareTrait;
use App\Tests\MockEntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Nebkam\FluentTest\RequestBuilder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class ModSearchController extends WebTestCase {
    use MockEntityTrait;
    use EntityManagerAwareTrait;

    private static ?ModCategory $category = null;
    private static ?ModLoader $loader = null;
    private static ?GameVersion $version = null;
    private static ?ModFile $modFile = null;
    private static ?Mod $mod = null;

    public static function setUpBeforeClass(): void {
        parent::setUpBeforeClass();

        self::$category = self::generateTestModCategory();
        self::$loader = self::generateTestModLoader();
        self::$version = self::generateTestGameVersion();
        self::$modFile = self::generateTestModFile(new ArrayCollection([self::$version]));

        self::$mod = self::generateTestMod(
            new ArrayCollection([self::$category]),
            new ArrayCollection([self::$loader]),
            new ArrayCollection([self::$modFile]),
            new ArrayCollection([self::$version]),
        );

        self::persistEntity(self::$category);
        self::persistEntity(self::$loader);
        self::persistEntity(self::$version);
        self::persistEntity(self::$modFile);
        self::persistEntity(self::$mod);

        self::flushEntities();

        parent::ensureKernelShutdown();
    }

    public static function testSearch(): void {
        $response = RequestBuilder::create(self::createClient())
            ->setUri('/api/mod/search')
            ->setJsonContent([
                'side' => ModSide::SIDE_BOTH
            ])
            ->setMethod(Request::METHOD_GET)
            ->getResponse();
        self::assertResponseIsSuccessful();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public static function tearDownAfterClass(): void {
        self::removeEntityById(Mod::class, self::$mod->getId());
        self::removeEntityById(ModCategory::class, self::$category->getId());
        self::removeEntityById(ModLoader::class, self::$loader->getId());
        self::removeEntityById(GameVersion::class, self::$version->getId());

        parent::tearDownAfterClass();
    }
}
