<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Resume
 * @package App\Entity
 */
class Resume
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Repo", mappedBy="resume")
     */
    private $repos;

    /**
     * @ORM\Column(type="integer")
     */
    private $reposAmount;

    /**
     * @var array
     * @ORM\Column(type="json_array")
     */
    private $languageStats;

    /**
     * @return array
     */
    public function getLanguageStats(): array
    {
        return $this->languageStats;
    }

    /**
     * @param array $languageStats
     */
    public function setLanguageStats(array $languageStats): void
    {
        $this->languageStats = $languageStats;
    }

    /**
     * Resume constructor.
     */
    public function __construct()
    {
        $this->repos = new ArrayCollection();
    }

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
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     * @return $this
     */
    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection|Repo[]
     */
    public function getRepo(): Collection
    {
        return $this->repos;
    }

    /**
     * @param Repo $repos
     * @return $this
     */
    public function addRepo(Repo $repos): self
    {
        if (!$this->repos->contains($repos)) {
            $this->repos[] = $repos;
            $repos->setResume($this);
        }

        return $this;
    }

    /**
     * @param Repo $repos
     * @return $this
     */
    public function removeRepo(Repo $repos): self
    {
        if ($this->repos->contains($repos)) {
            $this->repos->removeElement($repos);
            // set the owning side to null (unless already changed)
            if ($repos->getResume() === $this) {
                $repos->setResume(null);
            }
        }

        return $this;
    }

    /**
     * @return int|null
     */
    public function getReposAmount(): ?int
    {
        return $this->reposAmount;
    }

    /**
     * @param int $reposAmount
     * @return $this
     */
    public function setReposAmount(int $reposAmount): self
    {
        $this->reposAmount = $reposAmount;

        return $this;
    }
}
