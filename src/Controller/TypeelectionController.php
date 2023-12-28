<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//Safa Brahmi
class TypeelectionController extends AbstractController
{
    /**
     * @Route("/typeelection", name="app_typeelection")
     */
    public function index(): Response
    {
        return $this->render('typeelection/index.html.twig', [
            'controller_name' => 'TypeelectionController',
        ]);
    }
}
