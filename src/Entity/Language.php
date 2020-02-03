<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguageRepository")
 */
class Language
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bytes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Repo", inversedBy="languages")
     */
    private $repo;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBytes(): ?int
    {
        return $this->bytes;
    }

    /**
     * @param int|null $bytes
     * @return $this
     */
    public function setBytes(?int $bytes): self
    {
        $this->bytes = $bytes;

        return $this;
    }

    /**
     * @return Repo|null
     */
    public function getRepo(): ?Repo
    {
        return $this->repo;
    }

    /**
     * @param Repo|null $repo
     * @return $this
     */
    public function setRepo(?Repo $repo): self
    {
        $this->repo = $repo;

        return $this;
    }
}
