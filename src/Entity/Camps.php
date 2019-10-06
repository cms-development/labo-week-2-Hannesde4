<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CampsRepository")
 */
class Camps
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
    private $camp_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $camp_description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $camp_time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $camp_owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $quote;

    /**
     * @ORM\Column(type="boolean")
     */
    private $in_the_picture;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="camp_id")
     */
    private $reactions;

    public function __construct()
    {
        $this->reactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCampName(): ?string
    {
        return $this->camp_name;
    }

    public function setCampName(string $camp_name): self
    {
        $this->camp_name = $camp_name;

        return $this;
    }

    public function getCampDescription(): ?string
    {
        return $this->camp_description;
    }

    public function setCampDescription(string $camp_description): self
    {
        $this->camp_description = $camp_description;

        return $this;
    }

    public function getCampTime(): ?\DateTimeInterface
    {
        return $this->camp_time;
    }

    public function setCampTime(\DateTimeInterface $camp_time): self
    {
        $this->camp_time = $camp_time;

        return $this;
    }

    public function getCampOwner(): ?string
    {
        return $this->camp_owner;
    }

    public function setCampOwner(string $camp_owner): self
    {
        $this->camp_owner = $camp_owner;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getQuote(): ?string
    {
        return $this->quote;
    }

    public function setQuote(?string $quote): self
    {
        $this->quote = $quote;

        return $this;
    }

    public function getInThePicture(): ?bool
    {
        return $this->in_the_picture;
    }

    public function setInThePicture(bool $in_the_picture): self
    {
        $this->in_the_picture = $in_the_picture;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(?int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getReactions(): Collection
    {
        return $this->reactions;
    }

    public function addReaction(Comments $reaction): self
    {
        if (!$this->reactions->contains($reaction)) {
            $this->reactions[] = $reaction;
            $reaction->setCampId($this);
        }

        return $this;
    }

    public function removeReaction(Comments $reaction): self
    {
        if ($this->reactions->contains($reaction)) {
            $this->reactions->removeElement($reaction);
            // set the owning side to null (unless already changed)
            if ($reaction->getCampId() === $this) {
                $reaction->setCampId(null);
            }
        }

        return $this;
    }
}
