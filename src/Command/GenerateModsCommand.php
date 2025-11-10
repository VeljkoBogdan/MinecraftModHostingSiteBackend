<?php

namespace App\Command;

use App\Entity\FileStatus;
use App\Entity\GameVersion;
use App\Entity\License;
use App\Entity\Mod;
use App\Entity\ModCategory;
use App\Entity\ModFile;
use App\Entity\ModLoader;
use App\Entity\ModSide;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:generate-mods',
    description: 'Add a short description for your command',
)]
class GenerateModsCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('amount', null, InputOption::VALUE_REQUIRED, 0)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $amount = $input->getArgument('amount');

        if ($amount <= 0 || !is_integer($amount)) {
            $io->error('Amount has to be at least 1');
            return Command::FAILURE;
        }

        for ($i = 0; $i < $amount; $i++) {
            $now = new DateTimeImmutable('now');

            $mod = new Mod();
            $modCategory = new ModCategory();
            $modLoader = new ModLoader();
            $gameVersion = new GameVersion();
            $modFile = new ModFile();

            $modCategory->setName("Test category");
            $modLoader->setName("Test Loader");
            $gameVersion->setSlug("1.20.1");

            $this->entityManager->persist($gameVersion);

            $modFile
                ->setModEntity($mod)
                ->setName("Test Mod file")
                ->setStatus(FileStatus::APPROVED)
                ->setChecksum("t3st_ch3cksum")
                ->setGameVersions(new ArrayCollection([$gameVersion]))
                ->setModVersion("1.0.0")
                ->setChangelog("Test changelog")
                ->setIsActive(true);

            $this->entityManager->persist($modCategory);
            $this->entityManager->persist($modLoader);
            $this->entityManager->persist($modFile);


            $mod->setName('modName')
                ->setDownloads(100)
                ->setDeleted(false)
                ->setDescription("Test mod description")
                ->setCategories(new ArrayCollection([$modCategory]))
                ->setModFiles(new ArrayCollection([$modFile]))
                ->setVersions(new ArrayCollection([$gameVersion]))
                ->setSide(ModSide::SIDE_BOTH)
                ->setLoaders(new ArrayCollection([$modLoader]))
                ->setLicense(License::AFL_3_0)
                ->setCreatedAt($now)
                ->setSlug('modname')
                ->setUpdatedAt($now);

            $this->entityManager->persist($mod);
        }

        $this->entityManager->flush();
        $io->success('Generated ' . $amount . ' mods.');

        return Command::SUCCESS;
    }
}
