<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Member;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlanateFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $category = new Category();
        $category->setTitle("planete")
                 ->setDescription("Idée pour une meilleur vie en société");
        $manager->persist($category);

        $membre = new Member();
        $membre->setNom("Marco")
                 ->setPrenom("Logie")
                 ->setMail("marco@site.com")
                 ->setPass("0000")
                 ->setPhoto("http://placehold.it/350x150")
                 ->setSignature("Ma signature")
                 ->setPseudo("Ecocolo");
        $manager->persist($membre);

        for($i = 1; $i <= 5; $i++){

            $post = new Post();
            $post->setTitle("Titre de l'article n°$i")
                    ->setContent("<p>Contenu de l'article n°$i</p>")
                    ->setImage("http://placehold.it/350x150")
                    ->setCreatedAt(new \DateTime())
                    ->setLiked(0)
                    ->setDisliked(0)
                    ->setCategory($category)
                    ->setMember($membre);

            $manager->persist($post);

            for($j = 1; $j<=10; $j++){
                $comment = new Comment();
                $content = '<p> commentaire test <p>';

                $comment->setAuthor($membre->getPseudo())
                        ->setContent("contenu du commentaire")
                        ->setCreatedAt(new \DateTime())
                        ->setJaime(0)
                        ->setDisliked(0)
                        ->setPost($post)
                        ->setMember($membre);
                $manager->persist($comment);

            }
        }
        $manager->flush();
    }
}
