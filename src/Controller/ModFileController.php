<?php

namespace App\Controller;

use App\Entity\FileStatus;
use App\Entity\Mod;
use App\Entity\ModFile;
use App\Form\ModFileType;
use App\Util\ContextGroup;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Nebkam\SymfonyTraits\ControllerTrait;
use Nebkam\SymfonyTraits\FormTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class ModFileController extends AbstractController
{
    use ControllerTrait;
    use FormTrait;

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    #[Route('/api/mod/files', methods: Request::METHOD_POST)]
    public function create(Request $request): Response {
        $this->handleJSONForm($request, new ModFile(), ModFileType::class);
        $this->entityManager->flush();

        return $this->createOkResponse();
    }

    #[Route('/api/mod/files/{id}', requirements: ['id' => Requirement::POSITIVE_INT], methods: Request::METHOD_PATCH)]
    public function update(ModFile $modFile, Request $request): Response {
        $this->handleJSONForm($request, $modFile, ModFileType::class, [], false);
        $this->entityManager->flush();

        return $this->createOkResponse();
    }

    #[Route('/api/mod/{mod}/files', requirements: ['mod' => Requirement::POSITIVE_INT], methods: Request::METHOD_GET)]
    public function getAllFromModId(Mod $mod): JsonResponse {
        return $this->jsonWithGroup($mod->getModFiles(), ContextGroup::MOD_FILE_INDEX);
    }

    #[Route('/api/mod/{mod}/files/latest', methods: Request::METHOD_GET)]
    public function getLatestFromModId(Mod $mod): JsonResponse {
        $data = $this->entityManager->createQueryBuilder()
            ->select('mf')
            ->from(ModFile::class, 'mf')
            ->where('mf.modEntity = :mod')
            ->andWhere('mf.status = :status')
            ->andWhere('mf.isActive = :active')
            ->setParameter('mod', $mod)
            ->setParameter('active', true)
            ->setParameter('status', FileStatus::APPROVED)
            ->orderBy('mf.modVersion', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $this->jsonWithGroup($data, ContextGroup::MOD_FILE_INDEX);
    }

    #[Route('/api/mod/files/{modFile}/delete', methods: Request::METHOD_DELETE)]
    public function delete(ModFile $modFile): Response {
        $modFile->setIsActive(false);
        $this->entityManager->persist($modFile);
        $this->entityManager->flush();

        return $this->createOkResponse();
    }

}
