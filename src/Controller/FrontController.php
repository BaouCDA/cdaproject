<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Theme;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Form\PostType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
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

    public function showHistoire(Post $post, Request $request, EntityManagerInterface $manager)
    {
        $repoPost = $this->getDoctrine()->getRepository(Post::class);

        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repoComment->findBy(array('post' => $post));

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $comment->setCreatedAt(new \DateTime());
            $comment->setJaime(0);
            $comment->setDisliked(0);
            $comment->setPost($post);
            $comment->setMember(null);
            $comment->setTheme(null);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('histoire',[
                'id' => $post->getId()
            ]);
        }

        return $this->render('front/show-histoire.html.twig', [
            'controller_name' => 'FrontController',
            'post' => $post,
            'comments' => $comments,
            'formComment' => $form->createView()
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

    public function showEntreprise(Post $post, Request $request, EntityManagerInterface $manager)
    {
        $repoPost = $this->getDoctrine()->getRepository(Post::class);

        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repoComment->findBy(array('post' => $post));

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $comment->setCreatedAt(new \DateTime());
            $comment->setJaime(0);
            $comment->setDisliked(0);
            $comment->setPost($post);
            $comment->setMember(null);
            $comment->setTheme(null);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('entreprise',[
                'id' => $post->getId()
            ]);
        }

        return $this->render('front/show-entreprise.html.twig', [
            'controller_name' => 'FrontController',
            'post' => $post,
            'comments' => $comments,
            'formComment' => $form->createView()
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

    public function showPolitique(Post $post, Request $request, EntityManagerInterface $manager)
    {
        $repoPost = $this->getDoctrine()->getRepository(Post::class);

        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repoComment->findBy(array('post' => $post));

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $comment->setCreatedAt(new \DateTime());
            $comment->setJaime(0);
            $comment->setDisliked(0);
            $comment->setPost($post);
            $comment->setMember(null);
            $comment->setTheme(null);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('politique',[
                'id' => $post->getId()
            ]);
        }

        return $this->render('front/show-politique.html.twig', [
            'controller_name' => 'FrontController',
            'post' => $post,
            'comments' => $comments,
            'formComment' => $form->createView()
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

    public function showPlanete(Post $post, Request $request, EntityManagerInterface $manager)
    {
        $repoPost = $this->getDoctrine()->getRepository(Post::class);

        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repoComment->findBy(array('post' => $post));

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $comment->setCreatedAt(new \DateTime());
            $comment->setJaime(0);
            $comment->setDisliked(0);
            $comment->setPost($post);
            $comment->setMember(null);
            $comment->setTheme(null);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('planete',[
                'id' => $post->getId()
            ]);
        }

        return $this->render('front/show-planete.html.twig', [
            'controller_name' => 'FrontController',
            'post' => $post,
            'comments' => $comments,
            'formComment' => $form->createView()
        ]);
    }

    public function theme()
    {
        return $this->render('front/theme.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    public function themeView(Request $request, EntityManagerInterface $manager)
    {
        $repoPost = $this->getDoctrine()->getRepository(Theme::class);
        $theme = $repoPost->find(1);
        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repoComment->findBy(array('theme' => $theme));

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $comment->setCreatedAt(new \DateTime());
            $comment->setJaime(0);
            $comment->setDisliked(0);
            $comment->setPost(null);
            $comment->setMember(null);
            $comment->setTheme($theme);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('view-theme',[
                'id' => $theme->getId()
            ]);
        }

        return $this->render('front/theme-view.html.twig', [
            'controller_name' => 'FrontController',
            'theme' => $theme,
            'comments' => $comments,
            'formComment' => $form->createView()
        ]);
    }
//------------------------section informations-----------------
    public function propos()
    {
        return $this->render('front/apropos.html.twig', [
        ]);
    }

    public function contact()
    {
        return $this->redirectToRoute('apropos');
    }

    public function terms()
    {
        return $this->render('front/terms.html.twig', [
        ]);
    }

    public function viePrive()
    {
        return $this->redirectToRoute('terms');
    }

    public function cookieSite()
    {
        return $this->redirectToRoute('terms');
    }
}
