<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\PostLike;
use App\Entity\Theme;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Form\PostType;
use App\Repository\PostLikeRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil_bis")
     */
    public function index()
    {
        return $this->render('front/index.html.twig', []);
    }

    public function listeHistoires(Request $request, PaginatorInterface $paginator)
    {
        // Rcupere le repository des posts
        $repo = $this->get('doctrine')->getRepository(Post::class); 
        // Effectue la requete pour recuperer les posts par rpport  leurs categorie
        $donnees = $repo->findAllPostByCategory("histoire");
        
        // Permet d'afficher 4 posts par pages
        $posts = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            4 
        );
        // Retourne la vue avec le resultt d la requete formater pour la pagination
        return $this->render('front/liste-histoires.html.twig', [
            'posts' => $posts
        ]);
    }

    public function showHistoire(Post $post, Request $request, EntityManagerInterface $manager, PaginatorInterface $paginator)
    {
        // Rcupere le repository des posts
        $repoPost = $this->getDoctrine()->getRepository(Post::class);
        // Recupere le repository des commentaires
        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        // Effectue la requete pour recuperer le post souhaité
        $donnees = $repoComment->findBy(array('post' => $post));

        $comments = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            6 
        );

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $comment->setCreatedAt(new \DateTime());
            $comment->setPost($post);
            $comment->setMember($this->getUser());
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
        $repo = $this->get('doctrine')->getRepository(Post::class);
        $donnees = $repo->findAllPostByCategory("entreprise");

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

    public function showEntreprise(Post $post, Request $request, EntityManagerInterface $manager, PaginatorInterface $paginator)
    {
        $repoPost = $this->getDoctrine()->getRepository(Post::class);

        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $donnees = $repoComment->findBy(array('post' => $post));

        $comments = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            6 
        );

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $comment->setCreatedAt(new \DateTime());
            $comment->setPost($post);
            $comment->setMember($this->getUser());
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
        $repo = $this->get('doctrine')->getRepository(Post::class);
        $donnees = $repo->findAllPostByCategory("politique");

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

    public function showPolitique(Post $post, Request $request, EntityManagerInterface $manager, PaginatorInterface $paginator)
    {
        $repoPost = $this->getDoctrine()->getRepository(Post::class);

        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $donnees = $repoComment->findBy(array('post' => $post));

        $comments = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            6 
        );

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $comment->setCreatedAt(new \DateTime());
            $comment->setPost($post);
            $comment->setMember($this->getUser());
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
        $repo = $this->get('doctrine')->getRepository(Post::class);
        $donnees = $repo->findAllPostByCategory("planete");

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

    public function showPlanete(Post $post, Request $request, EntityManagerInterface $manager, PaginatorInterface $paginator)
    {
        $repoPost = $this->getDoctrine()->getRepository(Post::class);

        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $donnees = $repoComment->findBy(array('post' => $post));

        $comments = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            6 
        );
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $comment->setCreatedAt(new \DateTime());
            $comment->setPost($post);
            $comment->setMember($this->getUser());
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

    public function themeView(Request $request, EntityManagerInterface $manager, PaginatorInterface $paginator)
    {
        $repoPost = $this->getDoctrine()->getRepository(Theme::class);
        $theme = $repoPost->find(1);
        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $donnees = $repoComment->findBy(array('theme' => $theme));

        $comments = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            6 
        );

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $comment->setCreatedAt(new \DateTime());
            $comment->setPost(null);
            $comment->setMember($this->getUser());
            $comment->setTheme($theme);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('view_theme',[
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

    public function like(Post $post, EntityManagerInterface $manager, PostLikeRepository $likeRepos) : Response {
        
        $user =$this->getUser();
        if(!$user) return $this->json([
            'code' => 403,
            'message' => "Unauthoriezd"
        ], 403);
        //Si le membre a deja liker ce poste, suppression de son like
        if($post->isLikedByMember($user)){
            $like = $likeRepos->findOneBy([
                'post' => $post,
                'member' => $user
            ]);

            $manager->remove($like);
            $manager->flush();
            // mise a jour du nbr de like
            return $this->json([
                'code' => 200,
                'message' => 'Like bien supprimé',
                'likes' => $likeRepos->count(['post' => $post])
            ], 200);
        }

        $like = new PostLike();
        $like->setPost($post)
             ->setMember($user);

        $manager->persist($like);
        $manager->flush();

        return $this->json([
            'code' => 200,
            'message' => 'Like bien ajouté',
            'likes' => $likeRepos->count(['post' => $post])
        ], 200);
        
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
