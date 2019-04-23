<?php


namespace App\Controller;

use App\Document\Product;
use App\Repository\ProductRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use MongoDB\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OtherController extends AbstractController
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
     * @Route("/product/show", name="product_show")
     * @return Response
     */
    public function show(DocumentManager $dm):Response{

        /** @var Collection $products */

        /** @var DocumentRepository $repository */
        $repository = $dm->getRepository(Product::class);
        $products = $repository->findAll();
        dump($products);
            return $this->render('product/show.html.twig',[
                'products' => $products
            ]);
    }
}