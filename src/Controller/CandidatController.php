<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Sondage;
use App\Form\CandidatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Repository\CandidatRepository;


//Amer Kouki
class CandidatController extends AbstractController
{
    /**
     * @Route("/candidat", name="candidat_index", methods={"GET"})
     */
    public function index(): Response
    {
        $candidats = $this->getDoctrine()->getRepository(Candidat::class)->findAll();
        $sondages = $this->getDoctrine()->getRepository(Sondage::class)->findAll();

        return $this->render('candidat/index.html.twig', [
            'candidats' => $candidats,
            'sondages' => $sondages,
        ]);
    }

    /**
     * @Route("/candidat/create", name="candidat_create", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $nom = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        $informations = $request->request->get('informations');
        $sondageId = $request->request->get('sondage');

        $entityManager = $this->getDoctrine()->getManager();
        
        $sondage = $entityManager->getRepository(Sondage::class)->find($sondageId);

        $candidat = new Candidat();
        $candidat->setNom($nom);
        $candidat->setPrenom($prenom);
        $candidat->setInformations($informations);
        $candidat->setSondage($sondage);

        $entityManager->persist($candidat);
        $entityManager->flush();

        return $this->redirectToRoute('candidat_index');
    }

/** 
 * @Route("/candidat/{id}/edit", name="candidat_edit", methods={"GET", "POST"})
 */
public function edit(Request $request, Candidat $candidat): Response
{
    $form = $this->createForm(CandidatType::class, $candidat);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('candidat_index');
    }

    return $this->render('candidat/edit.html.twig', [
        'form' => $form->createView(),
        'candidat' => $candidat, 
    ]);
}


/**
 * @Route("/candidat/{id}/delete", name="candidat_delete", methods={"POST"})
 */

public function delete(Request $request, CandidatRepository $candidatRepository, $id): RedirectResponse
{
    $candidat = $candidatRepository->find($id);

    if (!$candidat) {
        throw $this->createNotFoundException('Candidat not found');
    }

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($candidat);
    $entityManager->flush();

    return $this->redirectToRoute('candidat_index');
}
}
