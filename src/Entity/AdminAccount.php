<?php

namespace App\Entity;

use App\Repository\AdminAccountRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdminAccountRepository::class)
 */
class AdminAccount extends  AbstractUser
{
    public  const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AdminRole;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdminRole(): ?string
    {
        return $this->AdminRole;
    }

    public function setAdminRole(string $AdminRole): self
    {
        $this->AdminRole = $AdminRole;

        return $this;
    }
}
