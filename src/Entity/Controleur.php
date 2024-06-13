<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ControleurRepository;

#[ORM\Entity(repositoryClass: ControleurRepository::class)]
class Controleur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 255)]
    private $numeroDeTel;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresseEmail;

    #[ORM\Column(type: 'string', length: 255)]
    private $numeroDeBadge;

    #[ORM\Column(type: 'date')]
    private $dateDeNaissance;

    #[ORM\Column(type: 'string', length: 255)]
    private $categoriesPermis;


    // Getters and Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumeroDeTel(): ?string
    {
        return $this->numeroDeTel;
    }

    public function setNumeroDeTel(string $numeroDeTel): self
    {
        $this->numeroDeTel = $numeroDeTel;

        return $this;
    }

    public function getAdresseEmail(): ?string
    {
        return $this->adresseEmail;
    }

    public function setAdresseEmail(string $adresseEmail): self
    {
        $this->adresseEmail = $adresseEmail;

        return $this;
    }

    public function getNumeroDeBadge(): ?string
    {
        return $this->numeroDeBadge;
    }

    public function setNumeroDeBadge(string $numeroDeBadge): self
    {
        $this->numeroDeBadge = $numeroDeBadge;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getCategoriesPermis(): ?string
    {
        return $this->categoriesPermis;
    }

    public function setCategoriesPermis(string $categoriesPermis): self
    {
        $this->categoriesPermis = $categoriesPermis;

        return $this;
    }

    }
