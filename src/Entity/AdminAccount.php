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
     * @ORM\Column(type="string", length=255)
     */
    private $adminRole;

    public function getAdminRole(): ?string
    {
        return $this->adminRole;
    }

    public function setAdminRole(string $adminRole): self
    {
        $this->adminRole = $adminRole;

        return $this;
    }
}
