<?php

namespace App\Controller;

use App\Entity\NoteFraisMois;
use App\Form\NoteFraisMoisType;
use App\Repository\NoteFraisMoisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/note_frais_mois")
 */
class NoteFraisMoisController extends AbstractController
{
    /**
     * @Route("/", name="note_frais_mois_index", methods={"GET"})
     */
    public function index(NoteFraisMoisRepository $noteFraisMoisRepository): Response
    {
        return $this->render('note_frais_mois/index.html.twig', [
            'note_frais_mois' => $noteFraisMoisRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="note_frais_mois_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $noteFraisMoi = new NoteFraisMois();
        $form = $this->createForm(NoteFraisMoisType::class, $noteFraisMoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($noteFraisMoi);
            $entityManager->flush();

            return $this->redirectToRoute('note_frais_mois_index');
        }

        return $this->render('note_frais_mois/new.html.twig', [
            'note_frais_moi' => $noteFraisMoi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_frais_mois_show", methods={"GET"})
     */
    public function show(NoteFraisMois $noteFraisMoi): Response
    {
        dump($noteFraisMoi);
        return $this->render('note_frais_mois/show.html.twig', [
            'noteFraisMois' => $noteFraisMoi,
            'frais'=>$noteFraisMoi->getFrais()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="note_frais_mois_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NoteFraisMois $noteFraisMoi): Response
    {
        $form = $this->createForm(NoteFraisMoisType::class, $noteFraisMoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('note_frais_mois_index');
        }

        return $this->render('note_frais_mois/edit.html.twig', [
            'note_frais_moi' => $noteFraisMoi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_frais_mois_delete", methods={"POST"})
     */
    public function delete(Request $request, NoteFraisMois $noteFraisMoi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$noteFraisMoi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($noteFraisMoi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('note_frais_mois_index');
    }
}
