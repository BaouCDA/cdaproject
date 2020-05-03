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
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $donnees = $repo->findAll();

        $posts = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            10 
        );

        return $this->render('back/tableau-de-bord.html.twig', [
            'posts' => $posts,
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

    public function profil()
    {
        return $this->render('back/profil.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }
}
