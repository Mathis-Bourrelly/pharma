<?php

namespace App\Controller;

use App\Entity\FraisKm;
use App\Form\FraisKmType;
use App\Repository\FraisKmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/frais_km")
 */
class FraisKmController extends AbstractController
{
    /**
     * @Route("/", name="frais_km_index", methods={"GET"})
     */
    public function index(FraisKmRepository $fraisKmRepository): Response
    {
        return $this->render('frais_km/index.html.twig', [
            'frais_kms' => $fraisKmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="frais_km_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fraisKm = new FraisKm();
        $form = $this->createForm(FraisKmType::class, $fraisKm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fraisKm);
            $entityManager->flush();

            return $this->redirectToRoute('frais_km_index');
        }

        return $this->render('frais_km/new.html.twig', [
            'frais_km' => $fraisKm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="frais_km_show", methods={"GET"})
     */
    public function show(FraisKm $fraisKm): Response
    {
        return $this->render('frais_km/show.html.twig', [
            'frais_km' => $fraisKm,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="frais_km_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FraisKm $fraisKm): Response
    {
        $form = $this->createForm(FraisKmType::class, $fraisKm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('frais_km_index');
        }

        return $this->render('frais_km/edit.html.twig', [
            'frais_km' => $fraisKm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="frais_km_delete", methods={"POST"})
     */
    public function delete(Request $request, FraisKm $fraisKm): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fraisKm->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fraisKm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('frais_km_index');
    }
}
