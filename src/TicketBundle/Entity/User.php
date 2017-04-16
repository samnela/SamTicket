<?php

namespace TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Table(name="sam_user")
 * @ORM\Entity(repositoryClass="TicketBundle\Entity\Repository\UserRepository")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=25,unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string",length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="active", type="boolean", options={"default": true})
     */
    private $active;

    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    public function __construct()
    {
        $this->active = true;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        return;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        $roles[] = UserRoles::ROLE_DEFAULT;

        return array_unique($roles);
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->active,
        ));
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->active
            ) = unserialize($serialized);
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive.
     *
     * @param bool $active
     *
     * @return User
     */
    public function setActive($isActive)
    {
        $this->active = $isActive;

        return $this;
    }

    /**
     * isActive.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    public function addRole($role)
    {
        if (UserRoles::ROLE_DEFAULT === strtoupper($role)) {
            return $this;
        }

        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }
    /**
     * Set roles.
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function isAccountNonExpired()
    {
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function isAccountNonLocked()
    {
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->isActive;
    }
}
