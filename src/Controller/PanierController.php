<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function show(OrderRepository $orderRepo): Response
    {
        $user = $this->getUser();

        $order = $orderRepo->findOneBy(['user'=>$user, 'status'=>'cart']);

        if (!$order){
            return $this->render('panier/index.html.twig', [
                'items' => [],
                'total' => 0,
            ]);
        }

        return $this->render('panier/index.html.twig', [
            'items' => $order->getOrderItems(),
            'total' => $order->getTotalPrice(),
        ]);
    }

    #[Route('/panier/add/{id}', name: 'app_panier_add')]
    public function add(int $id, Request $request, ProductRepository $productRepo, OrderRepository $orderRepo, EntityManagerInterface $em
        ): Response
    {
        $user = $this->getUser();
        $product = $productRepo->find($id);

        $order = $orderRepo->findOneBy(['user'=>$user, 'status'=>'cart']);

        if (!$order) {
            $order = new Order();
            $order->setUser($user);
            $order->setStatus('cart');
            $order->setOrderDate(new \DateTimeImmutable());
            $order->setTotalPrice('0.00');
        }

        $qty = max(1, (int) $request->request->get('quantity', 1));
        
        $existingItem = null;
        foreach ($order->getOrderItems() as $item) {
            if ($item->getProduct()->getId() === $product->getId()) {
                $existingItem = $item;
                break;
            }
        }

        if ($existingItem) {
            $existingItem->setQuantity($existingItem->getQuantity() + $qty);
        } else {
            $orderItem = new OrderItem();
            $orderItem->setProduct($product);
            $orderItem->setQuantity($qty);
            $orderItem->setUnitPrice($product->getPrice());
            $orderItem->setProductName($product->getName());
            $orderItem->setProductPicture($product->getPicture());
            $order->addOrderItem($orderItem);
        }
        $total = 0;

        foreach ($order->getOrderItems() as $item) {
            $total += $item->getQuantity() * $item->getUnitPrice();
        }
        $order->setTotalPrice($total);

        $em->persist($order);
        $em->flush();

        return $this->redirectToRoute('app_panier');
    }

        #[Route('/panier/remove', name: 'app_panier_remove')]
    public function remove(OrderRepository $orderRepo, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
    
        $order =$orderRepo->findOneBy(['user'=>$user, 'status'=>'cart']);

        if ($order){
            $em->remove($order);
            $em->flush();
        }
        return $this->redirectToRoute('app_panier');
    }

}
