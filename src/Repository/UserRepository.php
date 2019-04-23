<?php


namespace App\Repository;
use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository as DocumentRepository;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\UnitOfWork;

class UserRepository extends DocumentRepository
{
    /**
     * UserRepository constructor.
     * @param DocumentManager $dm
     */
    public function __construct(DocumentManager $dm)
            {

                $uow = $dm->getUnitOfWork();
                $classMetaData = $dm->getClassMetadata(User::class);
                parent::__construct($dm, $uow, $classMetaData);
            }
}