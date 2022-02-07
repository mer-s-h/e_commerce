<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Opinion;
// use App\Form\ProductType;
// use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    // /**
    //  * @Route("/", name="product_index", methods={"GET"})
    //  */
    // public function index(ProductRepository $productRepository): Response
    // {
    //     dd($productRepository);
    //     return $this->render('product/index.html.twig', [
    //         'products' => $productRepository->findAll(),
    //     ]);
    // }

    /**
     * @Route("/create", name="product_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $newProduct = $request->request;
        $verifyProduct = $doctrine->getRepository(Product::class)->findBy([
            'name_product' => $newProduct->get('name_product'),
        ]);

        if (!$verifyProduct) {
            $product = new Product();
            $product->setNameProduct($newProduct->get('name_product'));
            $product->setCategoryProduct($newProduct->get('category_product'));
            $product->setQuantityProduct($newProduct->get('quantity_product'));
            $product->setPrice10ml(0);
            $product->setPrice30ml(0);
            $product->setPrice50ml(0);
            $product->setPrice100ml(0);
            $product->setPrice200ml(0);

            $entityManager->persist($product);
            $entityManager->flush();
            return $this->json([
                "success" => 200
            ]);
        } else {
            return $this->json([
                "error" => "this product already exist"
            ]);
        }
    }

    /**
     * @Route("/read/id", name="product_show_ID", methods={"POST"})
     */
    public function showId(Request $request, ManagerRegistry $doctrine): Response
    {
        $requete = $request->request;

        $product = $doctrine
            ->getRepository(Product::class)
            ->findOneBy([
                "id" => $requete->get("id")
            ]);

        if (!empty($product)) {
            return $this->json([
                "product" =>  $product
            ]);
        } else {
            return $this->json([
                "error" =>  "product not found"
            ]);
        }
    }

    /**
     * @Route("/read/all", name="product_show_all", methods={"POST"})
     */
    public function showAll(Request $request, ManagerRegistry $doctrine): Response
    {
        $requete = $request->request;

        $product = $doctrine
            ->getRepository(Product::class)
            ->findAll();

        if (!empty($product)) {
            return $this->json([
                "product" =>  $product
            ]);
        } else {
            return $this->json([
                "error" =>  "can't find any product"
            ]);
        }
    }

    /**
     * @Route("/update", name="product_edit", methods={"POST"})
     */
    public function edit(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $newProduct = $request->request;

        $productProfile = $doctrine
            ->getRepository(Product::class)
            ->findOneBy([
                "id" => $newProduct->get("id")
            ]);

        foreach ($newProduct as $key => $value) {
            switch ($key) {
                case 'name_product':
                    $productProfile->setNameProduct($value);
                    break;
                case 'description_product':
                    $productProfile->setDescriptionProduct($value);
                    break;
                case 'category_product':
                    $productProfile->setCategoryProduct($value);
                    break;
                case 'image_product':
                    $productProfile->setImageProduct($value);
                    break;
                case 'quantity_product':
                    $productProfile->setQuantityProduct($value);
                    break;
                case 'price_product':
                    $productProfile->setPriceProduct($value);
                    break;
                case 'price_10ml':
                    $productProfile->setPrice10ml($value);
                    break;
                case 'price_30ml':
                    $productProfile->setPrice30ml($value);
                    break;
                case 'price_50ml':
                    $productProfile->setPrice50ml($value);
                    break;
                case 'price_10ml':
                    $productProfile->setPrice100ml($value);
                    break;
                case 'price_10ml':
                    $productProfile->setPrice200ml($value);
                    break;
            }
        }

        $entityManager->flush();

        return $this->json([
            "success" => "your products has been updated"
        ]);
    }

    /**
     * @Route("/delete", name="product_delete", methods={"POST"})
     */
    public function delete(Request $request, ManagerRegistry $doctrine): Response
    {

        $newProduct = $request->request;
        $entityManager = $doctrine->getManager();

        $verifyProduct = $doctrine
            ->getRepository(Product::class)
            ->findOneBy([
                'id' => $newProduct->get('id'),
            ]);
        $entityManager->remove($verifyProduct);
        $entityManager->flush();
        return $this->json([
            "success" => 200
        ]);
    }
}
