<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Versement
 *
 * @ORM\Table(name="versement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VersementRepository")
 */
class Versement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="string", length=255)
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="acompte", type="string", length=255, nullable=true)
     */
    private $acompte;

    /**
     * @var string
     *
     * @ORM\Column(name="reste", type="string", length=255, nullable=true)
     */
    private $reste;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean", nullable=true)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Facture", inversedBy="versements")
     * @ORM\JoinColumn(name="facture_id", referencedColumnName="id")
     */
    private $facture;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(name="publie_par", type="string", length=25, nullable=true)
     */
    private $publiePar;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(name="modifie_par", type="string", length=25, nullable=true)
     */
    private $modifiePar;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="publie_le", type="datetimetz", nullable=true)
     */
    private $publieLe;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="modifie_le", type="datetimetz", nullable=true)
     */
    private $modifieLe;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set montant
     *
     * @param string $montant
     *
     * @return Versement
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set acompte
     *
     * @param string $acompte
     *
     * @return Versement
     */
    public function setAcompte($acompte)
    {
        $this->acompte = $acompte;

        return $this;
    }

    /**
     * Get acompte
     *
     * @return string
     */
    public function getAcompte()
    {
        return $this->acompte;
    }

    /**
     * Set reste
     *
     * @param string $reste
     *
     * @return Versement
     */
    public function setReste($reste)
    {
        $this->reste = $reste;

        return $this;
    }

    /**
     * Get reste
     *
     * @return string
     */
    public function getReste()
    {
        return $this->reste;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     *
     * @return Versement
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return bool
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set publiePar
     *
     * @param string $publiePar
     *
     * @return Versement
     */
    public function setPubliePar($publiePar)
    {
        $this->publiePar = $publiePar;

        return $this;
    }

    /**
     * Get publiePar
     *
     * @return string
     */
    public function getPubliePar()
    {
        return $this->publiePar;
    }

    /**
     * Set modifiePar
     *
     * @param string $modifiePar
     *
     * @return Versement
     */
    public function setModifiePar($modifiePar)
    {
        $this->modifiePar = $modifiePar;

        return $this;
    }

    /**
     * Get modifiePar
     *
     * @return string
     */
    public function getModifiePar()
    {
        return $this->modifiePar;
    }

    /**
     * Set publieLe
     *
     * @param \DateTime $publieLe
     *
     * @return Versement
     */
    public function setPublieLe($publieLe)
    {
        $this->publieLe = $publieLe;

        return $this;
    }

    /**
     * Get publieLe
     *
     * @return \DateTime
     */
    public function getPublieLe()
    {
        return $this->publieLe;
    }

    /**
     * Set modifieLe
     *
     * @param \DateTime $modifieLe
     *
     * @return Versement
     */
    public function setModifieLe($modifieLe)
    {
        $this->modifieLe = $modifieLe;

        return $this;
    }

    /**
     * Get modifieLe
     *
     * @return \DateTime
     */
    public function getModifieLe()
    {
        return $this->modifieLe;
    }

    /**
     * Set facture
     *
     * @param \AppBundle\Entity\Facture $facture
     *
     * @return Versement
     */
    public function setFacture(\AppBundle\Entity\Facture $facture = null)
    {
        $this->facture = $facture;

        return $this;
    }

    /**
     * Get facture
     *
     * @return \AppBundle\Entity\Facture
     */
    public function getFacture()
    {
        return $this->facture;
    }
}
