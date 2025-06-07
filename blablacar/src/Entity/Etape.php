<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etape
 *
 * @ORM\Table(name="etape", indexes={@ORM\Index(name="id_ville", columns={"id_ville"}), @ORM\Index(name="FK_etape_trajet", columns={"id_trajet"})})
 * @ORM\Entity
 */
class Etape
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_etape", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEtape;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_ville", type="integer", nullable=true)
     */
    private $idVille;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=250, nullable=false)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=false)
     */
    private $longitude;

    /**
      * @var string
     *
     * @ORM\Column(name="id_trajet", type="integer", length=11, nullable=false)
     */
    private $idTrajet;

      /**
      * @var string
     *
     * @ORM\Column(name="etape_time", type="integer", length=11 , nullable=true)
     */
    private $etapeTime;

    public function getIdEtape(): ?int
    {
        return $this->idEtape;
    }

    public function getIdVille(): ?int
    {
        return $this->idVille;
    }

    public function setIdVille(?int $idVille): self
    {
        $this->idVille = $idVille;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getIdTrajet(): ?int
    {
        return $this->idTrajet;
    }

    public function setIdTrajet(?int $idTrajet): self
    {
        $this->idTrajet = $idTrajet;

        return $this;
    }

    public function getEtapeTime(): ?int
    {
        return $this->etapeTime;
    }

    public function setEtapeTime(?int $etapeTime): self
    {
        $this->etapeTime = $etapeTime;

        return $this;
    }


}
