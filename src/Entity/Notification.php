<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=NotificationRepository::class)
 */
class Notification
{
    use TimestampableEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="notifications")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Account $owner;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Account $account;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $IsSeen;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class)
     */
    private ?Post $post;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?Account
    {
        return $this->owner;
    }

    public function setOwner(?Account $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(Account $account): self
    {
        $this->account = $account;

        return $this;
    }

    public function getIsSeen(): ?bool
    {
        return $this->IsSeen;
    }

    public function setIsSeen(bool $IsSeen): self
    {
        $this->IsSeen = $IsSeen;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }
}
