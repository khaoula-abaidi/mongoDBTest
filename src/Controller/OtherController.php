<?php


namespace App\Controller;

use App\Document\Product;
use Doctrine\ODM\MongoDB\DocumentManager;
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
        $product->setName('DELL');
        $product->setPrice('800');
        $dm->persist($product);
        $dm->flush();
        return new Response('Created product id '.$product->getName().'hii mongodb');

    }
}