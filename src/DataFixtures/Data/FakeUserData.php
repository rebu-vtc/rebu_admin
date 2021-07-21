<?php

namespace App\DataFixtures\Data;

use App\Entity\Personnel;
use Faker\Generator;
use Faker\Factory;
class FakeUserData
{
    /** @var Generator */
    protected $faker;
    /**
     * Admin user data.
     *
     * @var array<mixed>
     */
    private $users = [
        [
            'id' => 1,
            'email' => 'hasana.ali@gmail.com',
            'password' => 'adminPassword',
            'roles' => ['ROLE_ADMIN'],
            'isVerify' => true,
            'status' => 1, // 1 = vérifié et actif
            'agreeTerms' => true,
        ],
        [
            'id' => 2,
            'email' => 'ttestbh@gmail.com',
            'password' => 'adminPassword',
            'roles' => ['ROLE_ADMIN'],
            'isVerify' => true,
            'status' => 1, // 1 = vérifié et actif
            'agreeTerms' => true,
        ],
    ];

    public function __construct() {
        $this->faker = Factory::create();
    }

    // users data getter
    public function getUsers(): array
    {
        return $this->users;
    }

    public function getPersonnel (): Personnel
    {
        $personnel = new Personnel();
        $personnel
        ->setFirstName($this->faker->firstName)
        ->setLastName($this->faker->lastName)
        ->setDob($this->faker->dateTime())
        ->setIdNumber($this->faker->shuffleString())
        ->setFacebookToken($this->faker->shuffleString())
        ;

        return $personnel;
    }

}
