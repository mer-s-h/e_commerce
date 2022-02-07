<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/adress")
 */
class AdressController extends AbstractController
{
    /**
     * @Route("/create", name="adress_create", methods={"POST"})
     */
    public function createAdress (ManagerRegistry $doctrine, Request $request): Response
    {
        $EntityManager = $doctrine->getManager();
        $NewRequest = $request->request;


        $adress = $doctrine 
            ->getRepository(Adress::class)
            ->findBy([
                'n_voie' => $NewRequest->get('n_voie'),
                'rue' => $NewRequest->get('rue'),
                'code_postale'=> $NewRequest->get('code_postale')]); 
            

        $user = $doctrine
            ->getRepository(User::class)
            ->findOneBy(['id' => $NewRequest->get('id')]);

        if(empty($adress)){

            $newAdress = new Adress();
            $newAdress->setNVoie($NewRequest->get('n_voie'));
            $newAdress->setRue($NewRequest->get('rue'));
            $newAdress->setCodePostale($NewRequest->get('code_postale'));
            $newAdress->setVille($NewRequest->get('ville'));

            foreach ($NewRequest as $key => $value) {

                if (!empty($key == 'complement_adress')) {
                    
                    $newAdress->setComplementAdress($value); 
                }
            }

            if(!empty($user)){
                $newAdress->setUser($NewRequest->get('user'));
            }

            $EntityManager->persist($newAdress);
            $EntityManager->flush();

            return $this->json([
                'success' => 'adress registered'
            ]);

        }else {
            
            return $this->json([
                'error' => 'adress already in the db'
            ]);
        }

    }

    /**
    * @Route("/read", name="adress_read" , methods={"POST"} )
    */
    public function readAdress (ManagerRegistry $doctrine, Request $request): Response
    {
        $NewRequest = $request->request;
        $adress = $doctrine
            ->getRepository(Adress::class)
            ->findOneBy(['id' => $NewRequest->get('id')]);
        
        if (!$adress) {
            return $this->json([
                "error" => "can't find this adress"
            ]);
        } else {
            return $this->json([
                "success" => $adress
            ]);
        }
    }

    /**
    * @Route("/update", name="adress_update" , methods={"POST"} )
    */
    public function updateAdress (ManagerRegistry $doctrine, Request $request): Response
    {
        $EntityManager = $doctrine->getManager();
        $NewRequest = $request->request;
        
        $adress =  $doctrine
            ->getRepository(Adress::class)
            ->findOneBy(['id' => $NewRequest->get('id')]);
            
        if(empty($adress)){

            return $this->json([
                'error' => "can't find adress"
            ]);
        }else{
            foreach ($NewRequest as $key => $value) {
                
                switch ($key) {
                    // case 'user':
                    //     $adress->setUser($value);
                    //     break;
                    case 'n_voie':
                        $adress->setNVoie($value);
                        break;
                    case 'rue':
                        $adress->setRue($value);
                        break;
                    case 'complement_adress':
                        $adress->setComplementAdress($value);
                        break;
                    case 'code_postale':
                        $adress->setCodePostale($value);
                        break;
                    case 'ville':
                        $adress->setVille($value);
                        break;
                }

            }
        }

        $EntityManager->flush();

        return $this->json([
            'success' => 'adress has been updated sucessfully'
        ]);

    }

    /**
    * @Route("/delete", name="adress_delete" , methods={"POST"} )
    */
    public function deleteAdress (ManagerRegistry $doctrine, Request $request): Response
    {
        $EntityManager = $doctrine->getManager();
        $NewRequest = $request->request;

        $adress = $doctrine
            ->getRepository(Adress::class)
            ->findOneBy([
                'id' => $NewRequest->get('id')
            ]);

        if(empty($adress)){

            return $this->json([
                'success' =>  "adress not found"
            ]);
        }else {

            $EntityManager->remove($adress);
            $EntityManager->flush();

            return $this->json([
                "sucess" => "card information has been deleted sucessfully"
            ]);
        }

    }

}
