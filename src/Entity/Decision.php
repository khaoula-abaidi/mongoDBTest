<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DecisionRepository")
 */
class Decision
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTaken;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Document", inversedBy="decisions")
     */
    private $document;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsTaken(): ?bool
    {
        return $this->isTaken;
    }

    public function setIsTaken(bool $isTaken): self
    {
        $this->isTaken = $isTaken;

        return $this;
    }

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

        return $this;
    }

}
