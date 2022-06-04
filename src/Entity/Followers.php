<?php

namespace App\Entity;

use App\Repository\FollowersRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FollowersRepository::class)
 */
class Followers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="followers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $account;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $followedBy;

    /**
     * @ORM\Column(type="date")
     */
    private  DateTime  $followed_since;

    public function __construct()
    {
        $this->followed_since = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }

    public function getFollowedBy(): ?Account
    {
        return $this->followedBy;
    }

    public function setFollowedBy(?Account $followedBy): self
    {
        $this->followedBy = $followedBy;

        return $this;
    }

    public function getFollowedSince(): ?\DateTimeInterface
    {
        return $this->followed_since;
    }

    /**
     * @param DateTime $followed_since
     * @return Followers
     */
    public function setFollowedSince(DateTime $followed_since): Followers
    {
        $this->followed_since = $followed_since;
        return $this;
    }
}
