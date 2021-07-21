<?php

namespace App\DataFixtures;

use App\DataFixtures\Data\FakeAdminData;
use App\DataFixtures\Data\FakeParentData;
use App\DataFixtures\Data\FakeStudentData;
use App\DataFixtures\Data\FakeUserData;
use App\Entity\Admin;
use App\Entity\ParentStudent;
use App\Entity\Student;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface;
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $fakeUserData = new FakeUserData();
        // --- START USER ---
        
        $usersAdmin = [];
        foreach ($fakeUserData->getUsers() as $user) {
            $userAdmin = new User();

            $userAdmin->setEmail($user['email'])
                ->setPassword($this->passwordEncoder->encodePassword($userAdmin, $user['password']))
                ->setIsVerified($user['isVerify'])
                ->setStatus($user['status'])
                ->setAgreeTerms($user['agreeTerms'])
                ->setRoles($user['roles'])
                ->setPersonnel($fakeUserData->getPersonnel())
                ;
            $manager->persist($userAdmin);
            $usersAdmin[] = $userAdmin;
        }// --- END USER ---

        $manager->flush();
    }
}
