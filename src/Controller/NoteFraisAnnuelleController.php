<?php

namespace App\Controller;

use App\Entity\NoteFraisAnnuelle;
use App\Form\NoteFraisAnnuelleType;
use App\Repository\NoteFraisAnnuelleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/note_frais_annuelle")
 */
class NoteFraisAnnuelleController extends AbstractController
{
    /**
     * @Route("/", name="note_frais_annuelle_index", methods={"GET"})
     */
    public function index(NoteFraisAnnuelleRepository $noteFraisAnnuelleRepository): Response
    {
        return $this->render('note_frais_annuelle/index.html.twig', [
            'note_frais_annuelles' => $noteFraisAnnuelleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="note_frais_annuelle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $noteFraisAnnuelle = new NoteFraisAnnuelle();
        $form = $this->createForm(NoteFraisAnnuelleType::class, $noteFraisAnnuelle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($noteFraisAnnuelle);
            $entityManager->flush();

            return $this->redirectToRoute('note_frais_annuelle_index');
        }

        return $this->render('note_frais_annuelle/new.html.twig', [
            'note_frais_annuelle' => $noteFraisAnnuelle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_frais_annuelle_show", methods={"GET"})
     */
    public function show(NoteFraisAnnuelle $noteFraisAnnuelle): Response
    {
        return $this->render('note_frais_annuelle/show.html.twig', [
            'note_frais_annuelle' => $noteFraisAnnuelle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="note_frais_annuelle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NoteFraisAnnuelle $noteFraisAnnuelle): Response
    {
        $form = $this->createForm(NoteFraisAnnuelleType::class, $noteFraisAnnuelle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('note_frais_annuelle_index');
        }

        return $this->render('note_frais_annuelle/edit.html.twig', [
            'note_frais_annuelle' => $noteFraisAnnuelle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_frais_annuelle_delete", methods={"POST"})
     */
    public function delete(Request $request, NoteFraisAnnuelle $noteFraisAnnuelle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$noteFraisAnnuelle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($noteFraisAnnuelle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('note_frais_annuelle_index');
    }
}
