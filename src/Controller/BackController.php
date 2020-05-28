<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\Post;
use App\Entity\Upload;
use App\Form\MemberType;
use App\Form\UploadType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends AbstractController
{
    
    public function administation(Request $request, PaginatorInterface $paginator)
    {
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

    public function profil(Request $request, EntityManagerInterface $manager)
    {
        $user = $this->getUser();

        $repoMembre = $this->getDoctrine()->getRepository(Member::class);
        $membreSelect = $repoMembre->find($user->getId());

        //$membreSelect = $repoMembre->findBy(array('member' => $user->getId()));

        $upload = new Upload();
        $formUpload = $this->createForm(UploadType::class, $upload);


        $formUpload->handleRequest($request);
        if($formUpload->isSubmitted() && $formUpload->isValid()){
            $file = $upload->getName();
            $fileName = $this->getUser()->getPseudo().'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $upload->setName($fileName);
            $membreSelect->setPhoto($fileName);
            dump($fileName);
            $manager->persist($membreSelect);
            $manager->flush();
            return $this->redirectToRoute('profil_user');
        }

        $formMemberSiganature = $this->createFormBuilder($membreSelect)
                                     ->add('signature')
                                     ->add('Valider',SubmitType::class)
                                     ->getForm();

        $formMemberSiganature->handleRequest($request);
        if($formMemberSiganature->isSubmitted() && $formMemberSiganature->isValid()){
            $membreSelect->setSignature($formMemberSiganature->get('signature')->getData());
            $manager->persist($membreSelect);
            $manager->flush();
            return $this->redirectToRoute('profil_user');
        }

        return $this->render('back/profil.html.twig', [
            'member' => $membreSelect,
            'formupload' => $formUpload->createView(),
            'formsignature' => $formMemberSiganature->createView(),
        ]);
    }
}
