<?php

namespace App\Entity;

use App\Repository\CarPoolRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarPoolRepository::class)]
class CarPool
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    /**
    * @Assert\NotBlank
    */
    private $start_location;

    #[ORM\Column(type: 'string', length: 255)]
    /**
    * @Assert\NotBlank
    */
    private $stop_location;

    #[ORM\Column(type: 'datetime')]
    /**
    * @Assert\NotBlank
    */
    private $start_time;

    #[ORM\Column(type: 'datetime')]
    /**
    * @Assert\NotBlank
    */
    private $stop_time;

    #[ORM\Column(type: 'integer')]
    /**
    * @Assert\NotBlank
    */
    private $price;

    #[ORM\Column(type: 'integer')]
    /**
    * @Assert\NotBlank
    */
    private $user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartLocation(): ?string
    {
        return $this->start_location;
    }

    public function setStartLocation(string $start_location): self
    {
        $this->start_location = $start_location;

        return $this;
    }

    public function getStopLocation(): ?string
    {
        return $this->stop_location;
    }

    public function setStopLocation(string $stop_location): self
    {
        $this->stop_location = $stop_location;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    public function setStartTime(\DateTimeInterface $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getStopTime(): ?\DateTimeInterface
    {
        return $this->stop_time;
    }

    public function setStopTime(\DateTimeInterface $stop_time): self
    {
        $this->stop_time = $stop_time;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}