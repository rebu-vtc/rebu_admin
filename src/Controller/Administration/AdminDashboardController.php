<?php

namespace App\Controller\Administration;

use App\Controller\DefaultController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/dashboard")
 */
class AdminDashboardController extends DefaultController
{
    /**
     * @Route(name="dashboard")
     */
    public function dashboard(): Response
    {
        return $this->render('administration/dashboard/dashboard.html.twig', [
            // 'controller_name' => 'DashboardController',
        ]);
    }
}
