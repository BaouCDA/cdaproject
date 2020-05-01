<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /***
     * @Route("/accueil", name="accueil")
     */
    public function index()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    public function listeHistoires()
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repo->findAll();

        return $this->render('front/liste-histoires.html.twig', [
            'controller_name' => 'FrontController',
            'posts' => $posts
        ]);
    }

    public function listeEntreprises()
    {
        return $this->render('front/liste-entreprises.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    public function listePolitique()
    {
        return $this->render('front/liste-politique.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    public function listePlanete()
    {
        return $this->render('front/liste-planete.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    public function theme()
    {
        return $this->render('front/theme.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    public function themeView()
    {
        return $this->render('front/theme-view.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
}
