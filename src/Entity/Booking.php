<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $bookingnumber;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     */
    private $visitdate;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $totalprice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookingnumber(): ?string
    {
        return $this->bookingnumber;
    }

    public function setBookingnumber(string $bookingnumber): self
    {
        $this->bookingnumber = $bookingnumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getVisitdate(): ?\DateTimeInterface
    {
        return $this->visitdate;
    }

    public function setVisitdate(\DateTimeInterface $visitdate): self
    {
        $this->visitdate = $visitdate;

        return $this;
    }

    public function getTotalprice()
    {
        return $this->totalprice;
    }

    public function setTotalprice($totalprice): self
    {
        $this->totalprice = $totalprice;

        return $this;
    }
}
