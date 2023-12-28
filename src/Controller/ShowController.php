<?php

namespace App\Controller;

use App\Repository\SondageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Sondage;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
//Safa Brahmi 
class ShowController extends AbstractController
{
    /**
     * @Route("/show", name="show")
     */
    public function index(SondageRepository $sondageRepository)
    {
        $sondages = $sondageRepository->findAll();

        return $this->render('show/index.html.twig', [
            'sondages' => $sondages,
        ]);
    }

    /**
     * @Route("/show/vote/{id}", name="show_vote")
     */
    public function vote($id, SessionInterface $session): Response
    {
        
        $session->set('user_id', 123);

        
        $userId = $session->get('user_id');

        
        $sondage = $this->getDoctrine()->getRepository(Sondage::class)->find($id);

        
        return $this->render('show/vote.html.twig', [
            'sondage' => $sondage,
        ]);
    }
}
