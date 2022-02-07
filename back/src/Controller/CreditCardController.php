<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\CreditCard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/credit")
 */
class CreditCardController extends AbstractController
{
    /**
     * @Route("/create", name="create" , methods={"POST"} )
     */
    public function create(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $card = $doctrine
            ->getRepository(CreditCard::class)
            ->findOneBy([
                "card_number" => $requete->get("number")
            ]);

        $user = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "id" => $requete->get("id")
            ]);

        if (!$card) {

            $newCard = new CreditCard();
            $newCard->setCardNumber($requete->get('number'));
            $newCard->setCardFirstname($requete->get('firstname'));
            $newCard->setCardLastname($requete->get('lastname'));
            $newCard->setExpirationDate($requete->get('expiration'));

            if (!empty($user)) {
                $newCard->setUser($user);
            }

            $entityManager->persist($newCard);
            $entityManager->flush();


            return $this->json([
                "success" => "you have successfully registered you credit card"
            ]);
        } else {
            return $this->json([
                "error" => "we already have this card"
            ]);
        }
    }

    /**
     * @Route("/read", name="credit_read" , methods={"POST"} )
     */
    public function read(ManagerRegistry $doctrine, Request $request): Response
    {
        $requete = $request->request;

        $card = $doctrine
            ->getRepository(CreditCard::class)
            ->findOneBy([
                "id" => $requete->get("card_id")
            ]);

        if (!$card) {
            return $this->json([
                "error" => "can't find this card"
            ]);
        } else {
            return $this->json([
                "success" => $card
            ]);
        }
    }

    /**
     * @Route("/update", name="credit_update" , methods={"POST"} )
     */
    public function update(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $card = $doctrine
            ->getRepository(CreditCard::class)
            ->findOneBy([
                "id" => $requete->get("card_id")
            ]);

        if (!$card) {
            return $this->json([
                "error" => "card not found"
            ]);
        } else {
            foreach ($requete as $key => $value) {

                switch ($key) {
                    case 'number':
                        $card->setCardNumber($value);
                        break;
                    case 'firstname':
                        $card->setCardFirstname($value);
                        break;
                    case 'lastname':
                        $card->setCardLastname($value);
                        break;
                    case 'expiration':
                        $card->setExpirationDate($value);
                        break;
                }
            }
        }

        $entityManager->flush();

        return $this->json([
            "sucess" => "card information has been updated sucessfully"
        ]);
    }

    /**
     * @Route("/delete", name="credit_delete" , methods={"POST"} )
     */
    public function delete(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $card = $doctrine
            ->getRepository(CreditCard::class)
            ->findOneBy([
                "id" => $requete->get("card_id")
            ]);

        if (!$card) {
            return $this->json([
                "error" => "card not found"
            ]);
        } else {

            $entityManager->remove($card);
            $entityManager->flush();

            return $this->json([
                "sucess" => "card information has been deleted sucessfully"
            ]);
        }
    }
}
