<?php

use App\Entity\Member;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

Class MemberTest extends KernelTestCase {
    // verifie une contrainte de mot de passe
    public function testInvalidAssert(){
        $membre = new Member();
        $membre->setPass("1234567");
        self::bootKernel();
        $error = self::$container->get('validator')->validate($membre);
        $this->assertCount(1, $error);
    }
    // verifie une contrainte de mot de passe
    public function testValidAssert(){
        $membre = new Member();
        $membre->setPass("12345678");
        self::bootKernel();
        $error = self::$container->get('validator')->validate($membre);
        $this->assertCount(0, $error);
    }
    // Test la confirmation du mot de passe
    public function testValidAssertConfirmPass(){
        $membre = new Member();
        $membre->setPass("motdepasse");
        $membre->confirm_pass="motdepasse";
        self::bootKernel();
        $error = self::$container->get('validator')->validate($membre);
        $this->assertCount(0, $error);
    }
    //Test la confirmation du mot de passe
    public function testInvalidAssertConfirmPass(){
        $membre = new Member();
        $membre->setPass("motdepasse");
        $membre->confirm_pass="motdepassedifferent";
        self::bootKernel();
        $error = self::$container->get('validator')->validate($membre);
        $this->assertCount(1, $error);
    }

}
