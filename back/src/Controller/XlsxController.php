<?php

namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


/**
     * @Route("/export")
     */
class XlsxController extends AbstractController
{
    
    /**
     * @Route("/users", name="userExel")
     */
    
    public function userExel(ManagerRegistry $doctrine): Response
    {
         
        $list = [];
        $users = $doctrine
        ->getRepository(User::class)
        ->findAll();
        
        foreach ($users as $user) {
            $tempList = [
                $user->getLastname(),
                $user->getFirstname(),
                $user->getEmail()
            ];
            foreach ($user->getAdresses() as $adress) {
                $string = $adress->getNVoie() . " " . $adress->getRue() . " " . $adress->getComplementAdress();
                array_push($tempList, $string);
                array_push($tempList, $adress->getCodePostale());
                array_push($tempList, $adress->getVille());
            }
            $list[] = $tempList;
        }

        $spreadsheet = new Spreadsheet();
        
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setTitle('User List');
        
        $sheet->getCell('A1')->setValue('LastName');
        $sheet->getCell('B1')->setValue('FirstName');
        $sheet->getCell('C1')->setValue('Email');
        $sheet->getCell('D1')->setValue('Adresses');
        $sheet->getCell('E1')->setValue('CodePostale');
        $sheet->getCell('F1')->setValue('Ville');

         $sheet->fromArray($list,null, 'A3', true);

        $writer = new Xlsx($spreadsheet);

        $writer->save('Customers.xlsx');

        return $this->json([
                "success" => "helloworld.xlsx creates"
            ]);
    }

}
