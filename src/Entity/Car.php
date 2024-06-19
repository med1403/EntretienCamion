<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $mileage = null;

    #[ORM\Column]
    private ?float $fuelconsumption = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMileage(): ?float
    {
        return $this->mileage;
    }

    public function setMileage(float $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getFuelconsumption(): ?float
    {
        return $this->fuelconsumption;
    }

    public function setFuelconsumption(float $fuelconsumption): static
    {
        $this->fuelconsumption = $fuelconsumption;

        return $this;
    }
}
