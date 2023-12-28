<?php

namespace App\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//Ayoub Madyouni
class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_index")
     */
    public function index(UrlGeneratorInterface $urlGenerator): Response
{
    $userRepository = $this->getDoctrine()->getRepository(User::class);
    $users = $userRepository->findAll();

    $adminRoute = $urlGenerator->generate('admin_index');

    return $this->render('user/index.html.twig', [
        'users' => $users,
        'admin_route' => $adminRoute,
    ]);
}
}
