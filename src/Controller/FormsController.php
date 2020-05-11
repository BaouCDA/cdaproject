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
        if(!$post){
            $post = new Post();
        }
        $userId = $this->getUser()->getId();
        $repoMembre = $this->getDoctrine()->getRepository(Member::class);
        $membre = $repoMembre->find($userId);


        // $form = $this->createFormBuilder($post)
        //             ->add('title')
        //             ->add('content')
        //             ->add('image')
        //             ->add('category')
        //             ->getForm();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        
        dump($post);

        if($form->isSubmitted() && $form->isValid()){
            if(!$post->getId()){
                $post->setCreatedAt(new \DateTime());
            }
            if($form->get('image')->getData()==null){
                $post->setImage("http://placehold.it/350x150");
            }
            $post->setMember($membre);

            $manager->persist($post);
            $manager->flush();

            return $this->redirectToRoute($post->getCategory(), [
                'id' => $post->getId()
            ]);
        }

        return $this->render('forms/create-update.html.twig', [
            'controller_name' => 'FormsController',
            'formPost' => $form->createView(),
            'modeUpdate' => $post->getId() !== null
        ]);
    }
    
    
}

