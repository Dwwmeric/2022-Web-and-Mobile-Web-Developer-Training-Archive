<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;



/**
 * Trajet
 *

 * @ORM\Table(name="trajet", indexes={@ORM\Index(name="id_ville_depart", columns={"id_ville_depart"}), @ORM\Index(name="id_ville_retour", columns={"id_ville_retour"}), @ORM\Index(name="FK_trajet_utilisateur", columns={"id_utilisateur"})})
 * @ORM\Entity
 */
class Trajet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_trajet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTrajet;

    /**
     *  @var string
     *
     * @ORM\Column(name="id_ville_depart", type="string", length=255, nullable=false)
     */
    private $idVilleDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="id_ville_retour", type="string", length=255, nullable=false)
     */
    private $idVilleRetour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_depart", type="datetime", nullable=false)
     */
    private $dateDepart;

    /**
     * @var int
     *
     * @ORM\Column(name="nbre_place", type="integer", nullable=false)
     */
    private $nbrePlace;

    /**
     * @var int
     *
        * @ORM\Column(name="distance_trajet", type="string", nullable=true)
     */
    private $distanceTrajet;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_trajet", type="string", nullable=true)
     */
    private $prixTrajet;

   /**
     * @var int
     *
     * @ORM\Column(name="id_utilisateur", type="integer", nullable=true)
     */
    private $idUtilisateur;

    public function getIdTrajet(): ?int
    {
        return $this->idTrajet;
    }

    public function getIdVilleDepart(): ?string
    {
        return $this->idVilleDepart;
    }

    public function setIdVilleDepart(string $idVilleDepart): self
    {
        $this->idVilleDepart = $idVilleDepart;

        return $this;
    }

    public function getIdVilleRetour(): ?string
    {
        return $this->idVilleRetour;
    }

    public function setIdVilleRetour(string $idVilleRetour): self
    {
        $this->idVilleRetour = $idVilleRetour;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getNbrePlace(): ?int
    {
        return $this->nbrePlace;
    }

    public function setNbrePlace(int $nbrePlace): self
    {
        $this->nbrePlace = $nbrePlace;

        return $this;
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(?int $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    public function getDistanceTrajet(): ?string
    {
        return $this->distanceTrajet;
    }

    public function setDistanceTrajet(string $distanceTrajet): self
    {
        $this->distanceTrajet = $distanceTrajet;

        return $this;
    }

    public function getPrixTrajet(): ?string
    {
        return $this->prixTrajet;
    }

    public function setPrixTrajet(string $prixTrajet): self
    {
        $this->prixTrajet = $prixTrajet;

        return $this;
    }


}
