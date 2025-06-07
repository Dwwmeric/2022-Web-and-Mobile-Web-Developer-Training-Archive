<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * Participants
 *
 * @ORM\Table(name="participants", indexes={@ORM\Index(name="FK_participants_utilisateur", columns={"id_user"}), @ORM\Index(name="FK_participants_trajet", columns={"id_trajet"})})
 * @ORM\Entity
 */
class Participants
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_participant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParticipant;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer", nullable=false)
     */
    private $statut;

    /**
     * @var \int
     *
     * @ORM\Column(name="id_trajet", type="integer", nullable=false)
     */
    private $idTrajet;

    /**
     * @var \int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    public function getIdParticipant(): ?int
    {
        return $this->idParticipant;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getIdTrajet(): ?Trajet
    {
        return $this->idTrajet;
    }

    public function setIdTrajet(?int $idTrajet): self
    {
        $this->idTrajet = $idTrajet;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(?int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}


?>