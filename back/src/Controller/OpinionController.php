<?php

namespace App\Controller;

use App\Entity\Opinion;
use App\Entity\User;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/opinion")
 */

class OpinionController extends AbstractController
{
    /**
     * @Route("/create", name="opinion_create" , methods={"POST"} )
     */
    public function create(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $user = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "id" => $requete->get("id_user")
            ]);
        $product = $doctrine
            ->getRepository(Product::class)
            ->findOneBy([
                "id" => $requete->get("id_product")
            ]);

        if (!$user) {
            return $this->json([
                "error" => "to put an opinion you have to be registered"
            ]);
        } else {

            $opinion = new Opinion();
            $opinion->setUser($user);
            $opinion->setProduct($product);
            $opinion->setRemark($requete->get('remark'));
            $opinion->setRating($requete->get('rating'));

            $entityManager->persist($opinion);
            $entityManager->flush();


            return $this->json([
                "success" => "opinion registered"
            ]);
        }
    }

    /**
     * @Route("/read", name="opinion_read" , methods={"POST"} )
     */
    public function read(ManagerRegistry $doctrine, Request $request): Response
    {
        $requete = $request->request;

        $opinion = $doctrine
            ->getRepository(Opinion::class)
            ->findBy([
                "product_id" => $requete->get("product_id")
            ]);

        if (!$opinion) {
            return $this->json([
                "error" => "there is no opinion for this article"
            ]);
        } else {
            return $this->json([
                "success" => $opinion
            ]);
        }
    }

    /**
     * @Route("/update", name="opinion_update" , methods={"POST"} )
     */
    public function update(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $opignion = $doctrine
            ->getRepository(Opinion::class)
            ->findOneBy([
                "id" => $requete->get("opinion_id")
            ]);

        if (!$opignion) {
            return $this->json([
                "error" => "opinion not found"
            ]);
        } else {

            foreach ($requete as $key => $value) {

                switch ($key) {
                    case 'remark':
                        $opignion->setRemark($value);
                        break;
                    case 'rating':
                        $opignion->setRating($value);
                        break;
                }
            }
            
            $entityManager->flush();
            
            return $this->json([
                "sucess" => "your opinion has been updated sucessfully"
            ]);
        }
    }

    /**
     * @Route("/delete", name="opinion_delete" , methods={"POST"} )
     */
    public function delete(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $opignion = $doctrine
            ->getRepository(Opinion::class)
            ->findOneBy([
                "id" => $requete->get("opinion_id")
            ]);

        if (!$opignion) {
            return $this->json([
                "error" => "opinion not found"
            ]);
        } else {

            $entityManager->remove($opignion);
            $entityManager->flush();

            return $this->json([
                "sucess" => "your opinion has been deleted sucessfully"
            ]);
        }
    }
}
