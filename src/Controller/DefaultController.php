<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * Entity Manager.
     *
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * Entity Manager.
     */
    public function __construct(
        EntityManagerInterface $manager
    ) {
        $this->manager = $manager;
    }

    protected function manager(): EntityManagerInterface
    {
        return $this->manager;
    }
}
