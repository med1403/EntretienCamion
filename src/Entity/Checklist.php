<?php
// src/Entity/Checklist.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChecklistRepository")
 */
class Checklist
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SEB;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $IT;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sebBerne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $horometre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $km;

    /**
     * @ORM\Column(type="date")
     */
    private $dateControle;

    /**
     * @ORM\Column(type="time")
     */
    private $heureControle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $site;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $controleur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $feuxPlaqueImmatriculation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $temoinVeilleBatterie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $feuxClignotantGd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $feuxStop;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $feuxPosition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $feuxCroisement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $feuxRecul;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $feuxGabarit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $feuxAntibrouillard;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gyrophare;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eclairageInterieur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $klaxon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eclairageTableau;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $amortisseurHydro;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $barreTorsion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lameRessortAv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $barreStabiliteAv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bielletteBarreStabAv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $buteeDebattement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lameRessortAr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tamponLameAr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etrierLameBride;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $visSerrageAnneauAccouplement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cricLevageCabine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $amortisseurCabineAv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $amortisseurCabineAr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $verinEssieux2Av;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tiranStabilisationEtat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $triangleStabilisateurEtat;

    /**
     * @ORM\Column(type="text")
     */
    private $observations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomManager;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getSEB(): ?string
    {
        return $this->SEB;
    }

    public function setSEB(string $SEB): self
    {
        $this->SEB = $SEB;

        return $this;
    }

    public function getIT(): ?string
    {
        return $this->IT;
    }

    public function setIT(string $IT): self
    {
        $this->IT = $IT;

        return $this;
    }

    public function getSebBerne(): ?string
    {
        return $this->sebBerne;
    }

    public function setSebBerne(string $sebBerne): self
    {
        $this->sebBerne = $sebBerne;

        return $this;
    }

    public function getHorometre(): ?string
    {
        return $this->horometre;
    }

    public function setHorometre(string $horometre): self
    {
        $this->horometre = $horometre;

        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(string $vin): self
    {
        $this->vin = $vin;

        return $this;
    }

    public function getKm(): ?string
    {
        return $this->km;
    }

    public function setKm(string $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getDateControle(): ?\DateTimeInterface
    {
        return $this->dateControle;
    }

    public function setDateControle(\DateTimeInterface $dateControle): self
    {
        $this->dateControle = $dateControle;

        return $this;
    }

    public function getHeureControle(): ?\DateTimeInterface
    {
        return $this->heureControle;
    }

    public function setHeureControle(\DateTimeInterface $heureControle): self
    {
        $this->heureControle = $heureControle;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(string $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getControleur(): ?string
    {
        return $this->controleur;
    }

    public function setControleur(string $controleur): self
    {
        $this->controleur = $controleur;

        return $this;
    }

    public function getFeuxPlaqueImmatriculation(): ?string
    {
        return $this->feuxPlaqueImmatriculation;
    }

    public function setFeuxPlaqueImmatriculation(string $feuxPlaqueImmatriculation): self
    {
        $this->feuxPlaqueImmatriculation = $feuxPlaqueImmatriculation;

        return $this;
    }

    public function getTemoinVeilleBatterie(): ?string
    {
        return $this->temoinVeilleBatterie;
    }

    public function setTemoinVeilleBatterie(string $temoinVeilleBatterie): self
    {
        $this->temoinVeilleBatterie=$temoinVeilleBatterie;
        return $this;
    }
   

   public function getFeuxClignotantGd(): ?string
   {
       return $this->feuxClignotantGd;
   }

   public function setFeuxClignotantGd(string $feuxClignotantGd): self
   {
       $this->feuxClignotantGd = $feuxClignotantGd;

       return $this;
   }

   public function getFeuxStop(): ?string
   {
       return $this->feuxStop;
   }

   public function setFeuxStop(string $feuxStop): self
   {
       $this->feuxStop = $feuxStop;

       return $this;
   }

   public function getFeuxPosition(): ?string
   {
       return $this->feuxPosition;
   }

   public function setFeuxPosition(string $feuxPosition): self
   {
       $this->feuxPosition = $feuxPosition;

       return $this;
   }

   public function getFeuxCroisement(): ?string
   {
       return $this->feuxCroisement;
   }

   public function setFeuxCroisement(string $feuxCroisement): self
   {
       $this->feuxCroisement = $feuxCroisement;

       return $this;
   }

   public function getFeuxRecul(): ?string
   {
       return $this->feuxRecul;
   }

   public function setFeuxRecul(string $feuxRecul): self
   {
       $this->feuxRecul = $feuxRecul;

       return $this;
   }

   public function getFeuxGabarit(): ?string
   {
       return $this->feuxGabarit;
   }

   public function setFeuxGabarit(string $feuxGabarit): self
   {
       $this->feuxGabarit = $feuxGabarit;

       return $this;
   }

   public function getFeuxAntibrouillard(): ?string
   {
       return $this->feuxAntibrouillard;
   }

   public function setFeuxAntibrouillard(string $feuxAntibrouillard): self
   {
       $this->feuxAntibrouillard = $feuxAntibrouillard;

       return $this;
   }

   public function getGyrophare(): ?string
   {
       return $this->gyrophare;
   }

   public function setGyrophare(string $gyrophare): self
   {
       $this->gyrophare = $gyrophare;

       return $this;
   }

   public function getEclairageInterieur(): ?string
   {
       return $this->eclairageInterieur;
   }

   public function setEclairageInterieur(string $eclairageInterieur): self
   {
       $this->eclairageInterieur = $eclairageInterieur;

       return $this;
   }

   public function getKlaxon(): ?string
   {
       return $this->klaxon;
   }

   public function setKlaxon(string $klaxon): self
   {
       $this->klaxon = $klaxon;

       return $this;
   }

   public function getEclairageTableau(): ?string
   {
       return $this->eclairageTableau;
   }

   public function setEclairageTableau(string $eclairageTableau): self
   {
       $this->eclairageTableau = $eclairageTableau;

       return $this;
   }

   public function getAmortisseurHydro(): ?string
   {
       return $this->amortisseurHydro;
   }

   public function setAmortisseurHydro(string $amortisseurHydro): self
   {
       $this->amortisseurHydro = $amortisseurHydro;

       return $this;
   }

   public function getBarreTorsion(): ?string
   {
       return $this->barreTorsion;
   }

   public function setBarreTorsion(string $barreTorsion): self
   {
       $this->barreTorsion = $barreTorsion;

       return $this;
   }

   public function getLameRessortAv(): ?string
   {
       return $this->lameRessortAv;
   }

   public function setLameRessortAv(string $lameRessortAv): self
   {
       $this->lameRessortAv = $lameRessortAv;

       return $this;
   }

   public function getBarreStabiliteAv(): ?string
   {
       return $this->barreStabiliteAv;
   }

   public function setBarreStabiliteAv(string $barreStabiliteAv): self
   {
       $this->barreStabiliteAv = $barreStabiliteAv;

       return $this;
   }

   public function getBielletteBarreStabAv(): ?string
   {
       return $this->bielletteBarreStabAv;
   }

   public function setBielletteBarreStabAv(string $bielletteBarreStabAv): self
   {
       $this->bielletteBarreStabAv = $bielletteBarreStabAv;

       return $this;
   }

   public function getButeeDebattement(): ?string
   {
       return $this->buteeDebattement;
   }

   public function setButeeDebattement(string $buteeDebattement): self
   {
       $this->buteeDebattement = $buteeDebattement;

       return $this;
   }

   public function getLameRessortAr(): ?string
   {
       return $this->lameRessortAr;
   }

   public function setLameRessortAr(string $lameRessortAr): self
   {
       $this->lameRessortAr = $lameRessortAr;

       return $this;
   }

   public function getTamponLameAr(): ?string
   {
       return $this->tamponLameAr;
   }

   public function setTamponLameAr(string $tamponLameAr): self
   {
       $this->tamponLameAr = $tamponLameAr;

       return $this;
   }

   public function getEtrierLameBride(): ?string
   {
       return $this->etrierLameBride;
   }

   public function setEtrierLameBride(string $etrierLameBride): self
   {
       $this->etrierLameBride = $etrierLameBride;

       return $this;
   }

   public function getVisSerrageAnneauAccouplement(): ?string
   {
       return $this->visSerrageAnneauAccouplement;
   }

   public function setVisSerrageAnneauAccouplement(string $visSerrageAnneauAccouplement): self
   {
       $this->visSerrageAnneauAccouplement = $visSerrageAnneauAccouplement;

       return $this;
   }

   public function getCricLevageCabine(): ?string
   {
       return $this->cricLevageCabine;
   }

   public function setCricLevageCabine(string $cricLevageCabine): self
   {
       $this->cricLevageCabine = $cricLevageCabine;

       return $this;
   }

   public function getAmortisseurCabineAv(): ?string
   {
       return $this->amortisseurCabineAv;
   }

   public function setAmortisseurCabineAv(string $amortisseurCabineAv): self
   {
       $this->amortisseurCabineAv = $amortisseurCabineAv;

       return $this;
   }

   public function getAmortisseurCabineAr(): ?string
   {
       return $this->amortisseurCabineAr;
   }

   public function setAmortisseurCabineAr(string $amortisseurCabineAr): self
   {
       $this->amortisseurCabineAr = $amortisseurCabineAr;

       return $this;
   }

   public function getVerinEssieux2Av(): ?string
   {
       return $this->verinEssieux2Av;
   }

   public function setVerinEssieux2Av(string $verinEssieux2Av): self
   {
       $this->verinEssieux2Av = $verinEssieux2Av;

       return $this;
   }

   public function getTiranStabilisationEtat(): ?string
   {
       return $this->tiranStabilisationEtat;
   }

   public function setTiranStabilisationEtat(string $tiranStabilisationEtat): self
   {
       $this->tiranStabilisationEtat = $tiranStabilisationEtat;

       return $this;
   }

   public function getTriangleStabilisateurEtat(): ?string
   {
       return $this->triangleStabilisateurEtat;
   }

   public function setTriangleStabilisateurEtat(string $triangleStabilisateurEtat): self
   {
    $this->triangleStabilisateurEtat = $triangleStabilisateurEtat;

    return $this;
    }
   


public function getObservations(): ?string
{
    return $this->observations;
}

public function setObservations(string $observations): self
{
    $this->observations = $observations;

    return $this;
}

public function getNomManager(): ?string
{
    return $this->nomManager;
}

public function setNomManager(string $nomManager): self
{
    $this->nomManager = $nomManager;

    return $this;
}

}
