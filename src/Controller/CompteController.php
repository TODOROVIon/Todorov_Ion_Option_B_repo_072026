<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CompteController extends AbstractController
{
    #[Route('/compte', name: 'app_compte')]
    public function compte(OrderRepository $orderRepo): Response
    {
        $user = $this->getUser();
    
        $orders = $orderRepo->findBy(['user' => $user, 'status' => 'validated'], ['orderDate' => 'ASC']);

        return $this->render('compte/index.html.twig', [
            'orders' => $orders,
        ]);
    }
}
