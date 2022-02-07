<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Product;
use App\Entity\Adress;
use App\Entity\Orders;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;



/**
 * @Route("/orders",)
 */
class OrdersController extends AbstractController
{
    /**
     * @Route("/create", name="orders_create", methods={"POST"})
     */
    public function create(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $today = date("Y-m-d H:i:s");
        $month = date("m");
        $year = date("y");
        $day = date("d");

        $order = $doctrine
            ->getRepository(Orders::class)
            ->findOneBy([
                "id" => $requete->get("id_order")
            ]);
        $product = $doctrine
            ->getRepository(Product::class)
            ->findOneBy([
                "id" => $requete->get("id_product")
            ]);
        $user = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "id" => $requete->get("id_profile")
            ]);
        $adress = $doctrine
            ->getRepository(Adress::class)
            ->findOneBy([
                "id" => $requete->get("id_adress")
            ]);

        $order = new orders();
        $order->setProduct($product);
        $order->setAdress($adress);
        $order->setQuantity($requete->get('quatity'));
        // $order->setOrderDate($today);  // get date to set it
        $order->setOrderNumber($year . $month . $day . $user->get("id"));
        $order->setStatus("Order is under treatment");

        if (!$user) {
            $order->setUser($user);
        }

        $entityManager->persist($order);
        $entityManager->flush();


        return $this->json([
            "success" => "order registered"
        ]);
    }

    /**
     * @Route("/read", name="orders_read" , methods={"POST"} )
     */
    public function read(ManagerRegistry $doctrine, Request $request): Response
    {
        $requete = $request->request;

        $order = $doctrine
            ->getRepository(Orders::class)
            ->findAll();

        return $this->json([
            "sucess" => $order
        ]);

        // foreach ($requete as $key => $value) {

        //     switch ($key) {
        //         case 'order_number':
        //             $orderNumber = $doctrine
        //                 ->getRepository(Orders::class)
        //                 ->findOneBy([
        //                     "order_number" => $value
        //                 ]);

        //             return $this->json([
        //                 "sucess" => $orderNumber
        //             ]);
        //             break;

        //         case 'user_id':
        //             $orderUser = $doctrine
        //                 ->getRepository(Orders::class)
        //                 ->findBy([
        //                     "user_id" => $value
        //                 ]);

        //             return $this->json([
        //                 "sucess" => $orderUser
        //             ]);
        //             break;

        //             case 'all':
        //             $allOrder = $doctrine
        //                 ->getRepository(Orders::class)
        //                 ->findAll();

        //             return $this->json([
        //                 "sucess" => $allOrder
        //             ]);
        //             break;
        //     }
        // }
    }

    /**
     * @Route("/update", name="orders_update" , methods={"POST"} )
     */
    public function update(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $order = $doctrine
            ->getRepository(Orders::class)
            ->findOneBy([
                "order_number" => $requete->get("order_number")
            ]);

        if (!$order) {
            return $this->json([
                "error" => "order not found"
            ]);
        } else {
            $order->setStatus($requete->get('status'));

            $entityManager->flush();

            return $this->json([
                "sucess" => "order number " . $requete->get("order_number") . "statu's has been updated sucessfully"
            ]);
        }
    }

    /**
     * @Route("/delete", name="orders_delete" , methods={"POST"} )
     */
    public function delete(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $order = $doctrine
            ->getRepository(Orders::class)
            ->findOneBy([
                "id" => $requete->get("order_id")
            ]);

        if (!$order) {
            return $this->json([
                "error" => "order not found"
            ]);
        } else {

            $entityManager->remove($order);
            $entityManager->flush();

            return $this->json([
                "sucess" => "order " . $requete->get("order_number") . " has been deleted sucessfully"
            ]);
        }
    }
}
