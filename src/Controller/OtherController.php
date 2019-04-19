<?php


namespace App\Controller;

use App\Document\Product;
use App\Repository\ProductRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use MongoDB\Collection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OtherController
{
    /**
     * @var Product $product
     * @Route("/product/create")
     * @return Response
     */
    public function create(DocumentManager $dm):Response{
        $product = new Product();
        $product->setName('HP');
        $product->setPrice('1200');
        $dm->persist($product);
        $dm->flush();
        return new Response('Created product id '.$product->getName().'hii mongodb');

    }

    /**
     * @Route("/product/show")
     * @return Response
     */
    public function show(DocumentManager $dm,ProductRepository $repository):Response{

        /** @var Collection $products */
        $products = $repository->findAll();
            return new Response('Nous avons '.$products->getCollectionName());
    }
}