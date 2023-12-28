<?php

namespace App\Controller;

use App\Entity\Sondage;
use App\Form\SondageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//Maha Jabri
class SondageController extends AbstractController
{
    /**
     * @Route("/sondage", name="sondage_index")
     */
    public function index(): Response
    {
        $sondages = $this->getDoctrine()->getRepository(Sondage::class)->findAll();

        return $this->render('sondage/index.html.twig', [
            'sondages' => $sondages,
        ]);
    }

    /**
     * @Route("/sondage/create", name="sondage_create", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $sondage = new Sondage();
        $sondage->setNom($request->request->get('nom'));
        $sondage->setDate(new \DateTime($request->request->get('date')));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($sondage);
        $entityManager->flush();

        return $this->redirectToRoute('sondage_index');
    }

    /**
     * @Route("/sondage/{id}/edit", name="sondage_edit")
     */
    public function edit(Request $request, Sondage $sondage): Response
    {
        $form = $this->createForm(SondageType::class, $sondage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sondage_index');
        }

        return $this->render('sondage/edit.html.twig', [
            'form' => $form->createView(),
            'sondage' => $sondage, 
        ]);
    }

    /**
     * @Route("/sondage/{id}/delete", name="sondage_delete")
     * @param Sondage $sondage
     * @return RedirectResponse
     */
    public function delete(Sondage $sondage): RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($sondage);
        $entityManager->flush();

        return $this->redirectToRoute('sondage_index');
    }
}

