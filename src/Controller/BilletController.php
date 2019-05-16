<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entiy\ChoixBillet;

class BilletController extends AbstractController
{
    /**
     * @Route("/billet", name="billet")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(ChoixBillet::class);
        $billets = $repo->findAll();

        return $this->render('billet/index.html.twig', [
            'controller_name' => 'BilletController',
            'billets' => $billets
        ]);
    }


    /**
     * @Route("/", name="home")
     */
    public function home() {

        return $this->render('billet/home.html.twig',['title' => "La Billetterie du Louvre"]);
    }
}
