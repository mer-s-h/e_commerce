<?php

namespace App\Entity;

use App\Repository\CreditCardRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreditCardRepository::class)
 */
class CreditCard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="creditCards")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\Column(type="bigint")
     */
    private $card_number;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $card_firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $card_lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $expiration_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCardNumber(): ?string
    {
        return $this->card_number;
    }

    public function setCardNumber(string $card_number): self
    {
        $this->card_number = $card_number;

        return $this;
    }

    public function getCardFirstname(): ?string
    {
        return $this->card_firstname;
    }

    public function setCardFirstname(string $card_firstname): self
    {
        $this->card_firstname = $card_firstname;

        return $this;
    }

    public function getCardLastname(): ?string
    {
        return $this->card_lastname;
    }

    public function setCardLastname(string $card_lastname): self
    {
        $this->card_lastname = $card_lastname;

        return $this;
    }

    public function getExpirationDate(): ?string
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(string $expiration_date): self
    {
        $this->expiration_date = $expiration_date;

        return $this;
    }
}
