<?php

namespace App\Controller;

use App\Entity\Piano;
use App\Form\PianoType;
use App\Repository\PianoRepository;
use App\Service\UploaderHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/piano")
 */
class PianoController extends AbstractController
{
    /**
     * @Route("/", name="piano_chords", methods={"GET"})
     */
    public function index(PianoRepository $pianoRepository): Response
    {
        return $this->render('piano/_piano-chords.html.twig', [
            'pianos' => $pianoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin", name="admin_piano", methods={"GET"})
     */
    public function adminPanel(PianoRepository $pianosRepository)
    {
        return $this->render('piano/index.html.twig', [
            'pianos' => $pianosRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="piano_new", methods={"GET","POST"})
     */
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
    {
        $piano = new Piano();
        $form = $this->createForm(PianoType::class, $piano);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($piano);
            $entityManager->flush();

            return $this->redirectToRoute('piano_chords');
        }

        return $this->render('piano/new.html.twig', [
            'piano' => $piano,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="piano_show", methods={"GET"})
     */
    public function show(Piano $piano): Response
    {
        return $this->render('piano/show.html.twig', [
            'piano' => $piano,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="piano_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Piano $piano): Response
    {
        $form = $this->createForm(PianoType::class, $piano);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('piano_index');
        }

        return $this->render('piano/edit.html.twig', [
            'piano' => $piano,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="piano_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Piano $piano): Response
    {
        if ($this->isCsrfTokenValid('delete'.$piano->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($piano);
            $entityManager->flush();
        }

        return $this->redirectToRoute('piano_index');
    }
}
