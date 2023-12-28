<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Sondage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//Rania Tarkhani
class VoteController extends AbstractController
{
    /** 
    * @Route("/vote", name="vote_index")
    */
   public function index(Request $request): Response
   {
       $entityManager = $this->getDoctrine()->getManager();
       $candidatRepository = $entityManager->getRepository(Candidat::class);
       $candidats = $candidatRepository->findAll();

       if ($request->isMethod('POST')) {
           $candidatId = $request->request->get('candidat');
           $selectedCandidat = $candidatRepository->find($candidatId);

           if ($selectedCandidat) {
               $selectedCandidat->incrementVoteCount();
               $entityManager->flush();
           }
       }

       return $this->render('vote/index.html.twig', [
           'candidats' => $candidats,
       ]);
   }

   /**
    * @Route("/vote/cast/{sondageId}/{candidatId}", name="vote_cast")
    */
   public function cast(int $sondageId, int $candidatId): Response
   {
       $entityManager = $this->getDoctrine()->getManager();
       
       
       $sondage = $entityManager->getRepository(Sondage::class)->find($sondageId);
       $candidat = $entityManager->getRepository(Candidat::class)->find($candidatId);
       
       if (!$sondage || !$candidat) {
           throw $this->createNotFoundException('Sondage or Candidat not found.');
       }
       
       
       $voteCount = $candidat->getVoteCount();
       $candidat->setVoteCount($voteCount + 1);
       
      
       $entityManager->flush();
       
       return $this->redirectToRoute('show');
   }
}
