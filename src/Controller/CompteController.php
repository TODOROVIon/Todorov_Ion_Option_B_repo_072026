<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
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
            'user' => $user,
        ]);
    }

    #[Route('/compte/active_api', name: 'app_active_api')]
    public function activeApi(EntityManagerInterface $em): Response
    {

        $user = $this->getUser();
    
        $user->setApiAccess(!$user->getApiAccess());
        $em->flush();
        return $this->redirectToRoute('app_compte');
    }

    #[Route('/compte/delete', name: 'app_delete')]
    public function delete(EntityManagerInterface $em, Security $security): Response
    {
        $user = $this->getUser();

        $em->remove($user);
        $em->flush();

        $security->logout(false);

        return $this->redirectToRoute('app_home');

    }
}
