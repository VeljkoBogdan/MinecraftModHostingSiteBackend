<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ModFileController extends AbstractController
{
    #[Route('/mod/file', name: 'app_mod_file')]
    public function index(): Response
    {
        return $this->render('mod_file/index.html.twig', [
            'controller_name' => 'ModFileController',
        ]);
    }
}
