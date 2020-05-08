<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\Post;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends AbstractController
{
    
    public function administation(Request $request, PaginatorInterface $paginator)
    {
        //$userA= $this->get('security.context')->getToken()->getUser();
        $user = $this->getUser();
        
        $repo = $this->getDoctrine()->getRepository(Post::class);

        if($user->getPseudo() == "cda"){
            $donnees = $repo->findAll();
        }else{
            $donnees = $repo->findBy(array('member' => $user->getId()));
        }

        $posts = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            10 
        );

        return $this->render('back/tableau-de-bord.html.twig', [
            'posts' => $posts,
            'user' => $user
        ]);
    }

    public function viewMembers(Request $request, PaginatorInterface $paginator)
    {
        $repo = $this->getDoctrine()->getRepository(Member::class);
        $donnees = $repo->findAll();

        $members = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            10 
        );

        return $this->render('back/view-member.html.twig', [
            'members' => $members,
        ]);
    }

    public function deletePost(Post $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('administration');
    }

    public function profil()
    {
        return $this->render('back/profil.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }
}
