<?php

namespace App\Command;

use App\Entity\License;
use App\Entity\Mod;
use App\Entity\ModCategories;
use App\Entity\ModLoader;
use App\Entity\ModSide;
use DateTimeImmutable;
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
            ->addArgument('amount', null, InputOption::VALUE_NONE, 'Amount of test mods to generate')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $amount = $input->getArgument('amount');

        if ($amount <= 0 || $amount == null) {
            $io->error('Amount has to be at least 1');
            return Command::FAILURE;
        }

        for ($i = 0; $i < $amount; $i++) {
            $now = new DateTimeImmutable('now');

            $mod = new Mod();
            $mod->setName('modName')
                ->setDownloads(100)
                ->setCategories([ModCategories::CATEGORY_TECH])
                ->setSide(ModSide::SIDE_BOTH)
                ->setLoaders([ModLoader::LOADER_FORGE])
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
