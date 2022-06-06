<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 */
class Account extends  AbstractUser
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $address;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="account")
     */
    private Collection $posts;

    /**
     * @ORM\OneToMany(targetEntity=Notification::class, mappedBy="owner")
     */
    private Collection $notifications;

    /**
     * @ORM\OneToMany(targetEntity=Followers::class, mappedBy="account")
     * @ORM\JoinColumn(nullable=false)
     */
    private Collection $followers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avatar;


    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->followers = new ArrayCollection();
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setAccount($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getAccount() === $this) {
                $post->setAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setOwner($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getOwner() === $this) {
                $notification->setOwner(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Followers>
     */
    public function getFollowers(): Collection
    {
        return $this->followers;
    }

    public function addFollower(Followers $follower): self
    {
        if (!$this->followers->contains($follower)) {
            $this->followers[] = $follower;
            $follower->setAccount($this);
        }

        return $this;
    }

    public function removeFollower(Followers $follower): self
    {
        if ($this->followers->removeElement($follower)) {
            // set the owning side to null (unless already changed)
            if ($follower->getAccount() === $this) {
                $follower->setAccount(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
    public  function  getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }
}
