<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/sport", name="sport")
     */
    public function sport()
    {
        return $this->render('informations/sport.html.twig');
    }
    /**
     * @Route("/culture", name="culture")
     */
    public function culture()
    {
        return $this->render('informations/culture.html.twig');

    }
    /**
     * @Route("/politique", name="politique")
     */
    public function politique()
    {
        return $this->render('informations/politique.html.twig');

    }
    /**
     * @Route("/travail", name="travail")
     */
    public function travail()
    {
        return $this->render('informations/travail.html.twig');

    }
    /**
     * @Route("/art", name="art")
     */
    public function art()
    {
        return $this->render('informations/art.html.twig');

    }

    
//    Contenu suivant

    /**
     * @Route("/conférences", name="conférences")
     */
    public function conf()
    {
        return $this->render('conférences/réflexions.html.twig');
}
    /**
     * @Route("/podcasts", name="podcasts")
     */
    public function pod()
    {
        return $this->render('conférences/podcasts.html.twig');

    }
    /**
     * @Route("/documents", name="documents")
     */
    public function doc()
    {
        return $this->render('conférences/documents.html.twig');

    }
    /**
     * @Route("/réflexions", name="réflexions")
     */
    public function ref()
    {
        return $this->render('conférences/réflexions.html.twig');

    }

// CONTENU SUIVANT
    /**
     * @Route("/témoignages", name="témoignages")
     */
    public function tem()
    {
        return $this->render('discussions/témoignages.html.twig');

    }/**
 * @Route("/ressources", name="ressources")
 */
    public function res()
    {
        return $this->render('discussions/ressources.html.twig');

    }
}
