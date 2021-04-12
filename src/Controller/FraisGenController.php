<?php

namespace App\Controller;

use App\Entity\FraisGen;
use App\Form\FraisGenType;
use App\Repository\FraisGenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/frais_gen")
 */
class FraisGenController extends AbstractController
{
    /**
     * @Route("/", name="frais_gen_index", methods={"GET"})
     */
    public function index(FraisGenRepository $fraisGenRepository): Response
    {
        return $this->render('frais_gen/index.html.twig', [
            'frais_gens' => $fraisGenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="frais_gen_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fraisGen = new FraisGen();
        $form = $this->createForm(FraisGenType::class, $fraisGen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fraisGen);
            $entityManager->flush();

            return $this->redirectToRoute('frais_gen_index');
        }

        return $this->render('frais_gen/new.html.twig', [
            'frais_gen' => $fraisGen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="frais_gen_show", methods={"GET"})
     */
    public function show(FraisGen $fraisGen): Response
    {
        return $this->render('frais_gen/show.html.twig', [
            'frais_gen' => $fraisGen,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="frais_gen_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FraisGen $fraisGen): Response
    {
        $form = $this->createForm(FraisGenType::class, $fraisGen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('frais_gen_index');
        }

        return $this->render('frais_gen/edit.html.twig', [
            'frais_gen' => $fraisGen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="frais_gen_delete", methods={"POST"})
     */
    public function delete(Request $request, FraisGen $fraisGen): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fraisGen->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fraisGen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('frais_gen_index');
    }
}
