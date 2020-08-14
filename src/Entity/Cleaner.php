<?php

namespace App\Entity;

use App\Repository\CleanerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CleanerRepository::class)
 */
class Cleaner
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyId;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyId(): ?int
    {
        return $this->companyId;
    }

    public function setCompanyId(int $companyId): self
    {
        $this->companyId = $companyId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
