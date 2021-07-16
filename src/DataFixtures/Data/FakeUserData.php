<?php

namespace App\DataFixtures\Data;

class FakeUserData
{
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
            'type' => 'Administrateur',
        ],
        [
            'id' => 2,
            'email' => 'ttestbh@gmail.com',
            'password' => 'adminPassword',
            'roles' => ['ROLE_ADMIN'],
            'isVerify' => true,
            'status' => 1, // 1 = vérifié et actif
            'agreeTerms' => true,
            'type' => 'Administrateur',
        ],
    ];


    // users data getter
    public function getUsers(): array
    {
        return $this->users;
    }


}
