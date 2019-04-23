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

    /**
     * Return the user where firstname  = $firstname
     * @param string $firstname
     * @return User|array
     */
    public function findFirstname($firstname)
    {
        return $this->findOneBy([
                                'firstname' => $firstname]);
    }
}