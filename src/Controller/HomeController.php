<?php

namespace App\Controller;

use App\Service\TmdbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    
    /**
     * @Route("/home", name="app_home")
     */
    public function index(TmdbService $tmdbService): Response
    {
        //dd($tmdbService->showPopulars('tv'));
        return $this->json($tmdbService->showPopulars('tv', '2'));
        /*return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ])*/;
    }
}
