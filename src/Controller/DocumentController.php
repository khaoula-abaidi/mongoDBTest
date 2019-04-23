<?php

namespace App\Controller;

use App\Document\Product;
use App\Entity\Document;
use App\Form\DocumentType;
use App\Repository\DocumentRepository;
use App\Repository\ProductRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/document")
 */
class DocumentController extends AbstractController
{
    /**
     * @Route("/",name="document_index")
     * @param DocumentRepository $documentRepository
     * @return Response
     */
    public function index(DocumentRepository $documentRepository):Response
    {
        /**
         * @var Document $document
         */
        $document = $documentRepository->find(1);
        dump($document); //die;
        $resonse = new Response();
        $resonse->headers->set('Content-Type','xml');
        return $this->render('document/show.xml.twig',[
                'document' => $document,
            ],$resonse);
    }
    /**
     * Route("/", name="document_index", methods={"GET"})

    public function index(DocumentRepository $documentRepository, SerializerInterface $serializer)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        /**
         * @var Document $document

        $document = $documentRepository->find(1);
        dump($document);
        $xmlContent = $serializer->serialize($document,'xml',[
            'circular_reference_handler' => /**
             * @param Document $object
             function($object){
            return $object->getId();
            }
        ]);
        echo $xmlContent;
                 /*
         $document = new Document();
        $document->setDoi('10-1111')
            ->setTitle('Json Document')
            ->setSummary('It\s my first json document');

        $jsonContent = $serializer->serialize($document, 'json');
                */
// $jsonContent contains {"name":"foo","age":99,"sportsperson":false,"createdAt":null}
    /*    $data = <<<EOF
                <document>
                    <doi>foo</doi>
                    <title>99</title>
                    <summary>false</summary>
                </document>
EOF;

        $document = $serializer->deserialize($data, Document::class, 'xml');
 dump($document);
       // return $jsonContent; // or return it in a Response

        /*
        return $this->render('document/index.html.twig', [
            'documents' => $documentRepository->findAll(),
        ]);

    }
        */


    /**
     * @Route("/new", name="document_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($document);
            $entityManager->flush();

            return $this->redirectToRoute('document_index');
        }

        return $this->render('document/new.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show", name="document_show", methods={"GET"})
     * @param Document $document
     * @return Response
     */
    public function show(Document $document,DocumentManager $documentManager): Response
    {
        //$documents = $repository->findAll();

        $products = $documentManager->getRepository(Product::class)->findAll();

        dump($products);die;
        return $this->render('document/show.html.twig', [
            'documents' => $products,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="document_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Document $document): Response
    {
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('document_index', [
                'id' => $document->getId(),
            ]);
        }

        return $this->render('document/edit.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="document_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Document $document): Response
    {
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($document);
            $entityManager->flush();
        }

        return $this->redirectToRoute('document_index');
    }
}
