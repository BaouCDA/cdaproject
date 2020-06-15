<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\Post;
use App\Form\PostType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;

class FormsController extends AbstractController
{

    public function formPost(Post $post = null, Request $request, EntityManagerInterface $manager)
    {
        //si il n'y a pas de post. creation d'un post
        if(!$post){
            $post = new Post();
        }
        // Récupération du membre connecté
        $userId = $this->getUser()->getId();
        $repoMembre = $this->getDoctrine()->getRepository(Member::class);
        $membre = $repoMembre->find($userId);

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // si c'est un nouveau post, ajout de la date de création
            if(!$post->getId()){
                $post->setCreatedAt(new \DateTime());
            }
            // si il n'y a pas d'image, une image est mise par defaut
            if($form->get('image')->getData()==null){
                $post->setImage("http://placehold.it/350x150");
            }
            $post->setMember($membre);

            $manager->persist($post);
            $manager->flush();
            //Redirection vers la page du post
            return $this->redirectToRoute($post->getCategory(), [
                'id' => $post->getId()
            ]);
        }
        //retour de la vue avec le formulaire
        // modeUpdate indique si c'est une modification ou une création de post
        return $this->render('forms/create-update.html.twig', [
            'formPost' => $form->createView(),
            'modeUpdate' => $post->getId() !== null
        ]);
    }
    
    
}

