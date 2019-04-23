<?php


namespace App\Repository;


use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Repository\AbstractRepositoryFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class MyRepositoryFactory extends AbstractRepositoryFactory
{
 private $eventDispatcher;
 public function __construct(EventDispatcherInterface $eventDispatcher)
 {
     $this->eventDispatcher = $eventDispatcher;
 }

    protected function instantiateRepository($repositoryClassName, DocumentManager $documentManager, ClassMetadata $metadata)
 {
      switch ($repositoryClassName){
          case UserRepository::class:
              return new UserRepository($this->eventDispatcher,$documentManager,$metadata);
          default:
              return new $repositoryClassName($documentManager,$documentManager->getUnitOfWork(),$metadata);
      }
 }
}