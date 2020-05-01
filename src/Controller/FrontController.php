<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Theme;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    public function listeHistoires(Request $request, PaginatorInterface $paginator)
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $donnees = $repo->findBy(array('category' => 11));

        $posts = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            4 
        );

        return $this->render('front/liste-histoires.html.twig', [
            'controller_name' => 'FrontController',
            'posts' => $posts
        ]);
    }

    public function showHistoire($id)
    {
        $repoPost = $this->getDoctrine()->getRepository(Post::class);
        $post = $repoPost->find($id);
        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repoComment->findBy(array('post' => $id));

        return $this->render('front/show-histoire.html.twig', [
            'controller_name' => 'FrontController',
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function listeEntreprises(Request $request, PaginatorInterface $paginator)
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $donnees = $repo->findBy(array('category' => 8));

        $posts = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            4 
        );

        return $this->render('front/liste-entreprises.html.twig', [
            'controller_name' => 'FrontController',
            'posts' => $posts
        ]);
    }

    public function showEntreprise($id)
    {
        $repoPost = $this->getDoctrine()->getRepository(Post::class);
        $post = $repoPost->find($id);
        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repoComment->findBy(array('post' => $id));

        return $this->render('front/show-entreprise.html.twig', [
            'controller_name' => 'FrontController',
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function listePolitiques(Request $request, PaginatorInterface $paginator)
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $donnees = $repo->findBy(array('category' => 10));

        $posts = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            4 
        );

        return $this->render('front/liste-politique.html.twig', [
            'controller_name' => 'FrontController',
            'posts' => $posts
        ]);
    }

    public function showPolitique($id)
    {
        $repoPost = $this->getDoctrine()->getRepository(Post::class);
        $post = $repoPost->find($id);
        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repoComment->findBy(array('post' => $id));

        return $this->render('front/show-politique.html.twig', [
            'controller_name' => 'FrontController',
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function listePlanetes(Request $request, PaginatorInterface $paginator)
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $donnees = $repo->findBy(array('category' => 9));

        $posts = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            4 
        );

        return $this->render('front/liste-planete.html.twig', [
            'controller_name' => 'FrontController',
            'posts' => $posts
        ]);
    }

    public function showPlanete($id)
    {
        $repoPost = $this->getDoctrine()->getRepository(Post::class);
        $post = $repoPost->find($id);
        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repoComment->findBy(array('post' => $id));

        return $this->render('front/show-planete.html.twig', [
            'controller_name' => 'FrontController',
            'post' => $post,
            'comments' => $comments
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
        $repoPost = $this->getDoctrine()->getRepository(Theme::class);
        $theme = $repoPost->find(1);
        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repoComment->findBy(array('theme' => 1));

        return $this->render('front/theme-view.html.twig', [
            'controller_name' => 'FrontController',
            'theme' => $theme,
            'comments' => $comments
        ]);
    }
}
