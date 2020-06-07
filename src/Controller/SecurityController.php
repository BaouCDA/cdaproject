<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{

    public function registration(UserPasswordEncoderInterface $encoder, Request $request, EntityManagerInterface $manager)
    {
        $membre = new Member();

        $form = $this->createForm(RegistrationType::class, $membre);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($membre, $membre->getPass());
            $membre->setPass($hash);

            $membre->setCreatedAt(new \DateTime());
            $membre->setSignature('Aucune signature');
            $membre->setPhoto('http://placehold.it/350x150');
            $manager->persist($membre);
            $manager->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('security/registration.html.twig', [
            'formInscription' => $form->createView(),
        ]);
    }

    public function login(){
        
        return $this->render('security/login.html.twig', [
            
        ]);
    }

    public function logout(){
        
    }
}
