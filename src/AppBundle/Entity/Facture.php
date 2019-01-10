<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FactureRepository")
 */
class Facture
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
     * @ORM\Column(name="numero", type="string", length=255, nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="montantHT", type="string", length=255, nullable=true)
     */
    private $montantHT;

    /**
     * @var int
     *
     * @ORM\Column(name="remise", type="integer", nullable=true)
     */
    private $remise;

    /**
     * @var string
     *
     * @ORM\Column(name="tva", type="string", length=255, nullable=true)
     */
    private $tva;

    /**
     * @var string
     *
     * @ORM\Column(name="montantTTC", type="string", length=255, nullable=true)
     */
    private $montantTTC;

    /**
     * @var string
     *
     * @ORM\Column(name="acompte", type="string", length=255, nullable=true)
     */
    private $acompte;

    /**
     * @var int
     *
     * @ORM\Column(name="rap", type="integer", nullable=true)
     */
    private $rap;

    /**
     * @var string
     *
     * @ORM\Column(name="partAssurance", type="string", length=255, nullable=true)
     */
    private $partAssurance;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255, nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="odSph", type="string", length=255, nullable=true)
     */
    private $odSph;

    /**
     * @var string
     *
     * @ORM\Column(name="odCyl", type="string", length=255, nullable=true)
     */
    private $odCyl;

    /**
     * @var string
     *
     * @ORM\Column(name="odAxe", type="string", length=255, nullable=true)
     */
    private $odAxe;

    /**
     * @var string
     *
     * @ORM\Column(name="odAdd", type="string", length=255, nullable=true)
     */
    private $odAdd;

    /**
     * @var int
     *
     * @ORM\Column(name="odQte", type="integer", nullable=true)
     */
    private $odQte;

    /**
     * @var string
     *
     * @ORM\Column(name="odMontant", type="string", length=255, nullable=true)
     */
    private $odMontant;

    /**
     * @var string
     *
     * @ORM\Column(name="ogSph", type="string", length=255, nullable=true)
     */
    private $ogSph;

    /**
     * @var string
     *
     * @ORM\Column(name="ogCyl", type="string", length=255, nullable=true)
     */
    private $ogCyl;

    /**
     * @var string
     *
     * @ORM\Column(name="ogAxe", type="string", length=255, nullable=true)
     */
    private $ogAxe;

    /**
     * @var string
     *
     * @ORM\Column(name="ogAdd", type="string", length=255, nullable=true)
     */
    private $ogAdd;

    /**
     * @var string
     *
     * @ORM\Column(name="ogQte", type="string", length=255, nullable=true)
     */
    private $ogQte;

    /**
     * @var string
     *
     * @ORM\Column(name="ogMontant", type="string", length=255, nullable=true)
     */
    private $ogMontant;

    /**
     * @var string
     *
     * @ORM\Column(name="monturePrix", type="string", length=255, nullable=true)
     */
    private $monturePrix;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean", nullable=true)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="factures")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Monture", inversedBy="factures")
     * @ORM\JoinColumn(name="monture_id", referencedColumnName="id")
     */
    private $monture;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Traitement", inversedBy="factures")
     * @ORM\JoinColumn(name="traitement_id", referencedColumnName="id")
     */
    private $traitement;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Typeverre", inversedBy="factures")
     * @ORM\JoinColumn(name="typeverre_id", referencedColumnName="id")
     */
    private $typeverre;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"numero"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

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
     * Set montantHT
     *
     * @param integer $montantHT
     *
     * @return Facture
     */
    public function setMontantHT($montantHT)
    {
        $this->montantHT = $montantHT;

        return $this;
    }

    /**
     * Get montantHT
     *
     * @return int
     */
    public function getMontantHT()
    {
        return $this->montantHT;
    }

    /**
     * Set remise
     *
     * @param integer $remise
     *
     * @return Facture
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get remise
     *
     * @return int
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set tva
     *
     * @param string $tva
     *
     * @return Facture
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return string
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set montantTTC
     *
     * @param integer $montantTTC
     *
     * @return Facture
     */
    public function setMontantTTC($montantTTC)
    {
        $this->montantTTC = $montantTTC;

        return $this;
    }

    /**
     * Get montantTTC
     *
     * @return int
     */
    public function getMontantTTC()
    {
        return $this->montantTTC;
    }

    /**
     * Set acompte
     *
     * @param integer $acompte
     *
     * @return Facture
     */
    public function setAcompte($acompte)
    {
        $this->acompte = $acompte;

        return $this;
    }

    /**
     * Get acompte
     *
     * @return int
     */
    public function getAcompte()
    {
        return $this->acompte;
    }

    /**
     * Set rap
     *
     * @param integer $rap
     *
     * @return Facture
     */
    public function setRap($rap)
    {
        $this->rap = $rap;

        return $this;
    }

    /**
     * Get rap
     *
     * @return int
     */
    public function getRap()
    {
        return $this->rap;
    }

    /**
     * Set partAssurance
     *
     * @param integer $partAssurance
     *
     * @return Facture
     */
    public function setPartAssurance($partAssurance)
    {
        $this->partAssurance = $partAssurance;

        return $this;
    }

    /**
     * Get partAssurance
     *
     * @return int
     */
    public function getPartAssurance()
    {
        return $this->partAssurance;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Facture
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set odSph
     *
     * @param string $odSph
     *
     * @return Facture
     */
    public function setOdSph($odSph)
    {
        $this->odSph = $odSph;

        return $this;
    }

    /**
     * Get odSph
     *
     * @return string
     */
    public function getOdSph()
    {
        return $this->odSph;
    }

    /**
     * Set odCyl
     *
     * @param string $odCyl
     *
     * @return Facture
     */
    public function setOdCyl($odCyl)
    {
        $this->odCyl = $odCyl;

        return $this;
    }

    /**
     * Get odCyl
     *
     * @return string
     */
    public function getOdCyl()
    {
        return $this->odCyl;
    }

    /**
     * Set odAxe
     *
     * @param string $odAxe
     *
     * @return Facture
     */
    public function setOdAxe($odAxe)
    {
        $this->odAxe = $odAxe;

        return $this;
    }

    /**
     * Get odAxe
     *
     * @return string
     */
    public function getOdAxe()
    {
        return $this->odAxe;
    }

    /**
     * Set odAdd
     *
     * @param string $odAdd
     *
     * @return Facture
     */
    public function setOdAdd($odAdd)
    {
        $this->odAdd = $odAdd;

        return $this;
    }

    /**
     * Get odAdd
     *
     * @return string
     */
    public function getOdAdd()
    {
        return $this->odAdd;
    }

    /**
     * Set odQte
     *
     * @param integer $odQte
     *
     * @return Facture
     */
    public function setOdQte($odQte)
    {
        $this->odQte = $odQte;

        return $this;
    }

    /**
     * Get odQte
     *
     * @return int
     */
    public function getOdQte()
    {
        return $this->odQte;
    }

    /**
     * Set odMontant
     *
     * @param integer $odMontant
     *
     * @return Facture
     */
    public function setOdMontant($odMontant)
    {
        $this->odMontant = $odMontant;

        return $this;
    }

    /**
     * Get odMontant
     *
     * @return int
     */
    public function getOdMontant()
    {
        return $this->odMontant;
    }

    /**
     * Set ogSph
     *
     * @param string $ogSph
     *
     * @return Facture
     */
    public function setOgSph($ogSph)
    {
        $this->ogSph = $ogSph;

        return $this;
    }

    /**
     * Get ogSph
     *
     * @return string
     */
    public function getOgSph()
    {
        return $this->ogSph;
    }

    /**
     * Set ogCyl
     *
     * @param string $ogCyl
     *
     * @return Facture
     */
    public function setOgCyl($ogCyl)
    {
        $this->ogCyl = $ogCyl;

        return $this;
    }

    /**
     * Get ogCyl
     *
     * @return string
     */
    public function getOgCyl()
    {
        return $this->ogCyl;
    }

    /**
     * Set ogAxe
     *
     * @param string $ogAxe
     *
     * @return Facture
     */
    public function setOgAxe($ogAxe)
    {
        $this->ogAxe = $ogAxe;

        return $this;
    }

    /**
     * Get ogAxe
     *
     * @return string
     */
    public function getOgAxe()
    {
        return $this->ogAxe;
    }

    /**
     * Set ogAdd
     *
     * @param string $ogAdd
     *
     * @return Facture
     */
    public function setOgAdd($ogAdd)
    {
        $this->ogAdd = $ogAdd;

        return $this;
    }

    /**
     * Get ogAdd
     *
     * @return string
     */
    public function getOgAdd()
    {
        return $this->ogAdd;
    }

    /**
     * Set ogQte
     *
     * @param string $ogQte
     *
     * @return Facture
     */
    public function setOgQte($ogQte)
    {
        $this->ogQte = $ogQte;

        return $this;
    }

    /**
     * Get ogQte
     *
     * @return string
     */
    public function getOgQte()
    {
        return $this->ogQte;
    }

    /**
     * Set ogMontant
     *
     * @param integer $ogMontant
     *
     * @return Facture
     */
    public function setOgMontant($ogMontant)
    {
        $this->ogMontant = $ogMontant;

        return $this;
    }

    /**
     * Get ogMontant
     *
     * @return int
     */
    public function getOgMontant()
    {
        return $this->ogMontant;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     *
     * @return Facture
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
     * Set numero
     *
     * @param string $numero
     *
     * @return Facture
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @return int
     */
    public function getMonturePrix()
    {
        return $this->monturePrix;
    }

    /**
     * @param int $monturePrix
     */
    public function setMonturePrix($monturePrix)
    {
        $this->monturePrix = $monturePrix;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Facture
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set publiePar
     *
     * @param string $publiePar
     *
     * @return Facture
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
     * @return Facture
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
     * @return Facture
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
     * @return Facture
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
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Facture
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set monture
     *
     * @param \AppBundle\Entity\Monture $monture
     *
     * @return Facture
     */
    public function setMonture(\AppBundle\Entity\Monture $monture = null)
    {
        $this->monture = $monture;

        return $this;
    }

    /**
     * Get monture
     *
     * @return \AppBundle\Entity\Monture
     */
    public function getMonture()
    {
        return $this->monture;
    }

    /**
     * Set traitement
     *
     * @param \AppBundle\Entity\Traitement $traitement
     *
     * @return Facture
     */
    public function setTraitement(\AppBundle\Entity\Traitement $traitement = null)
    {
        $this->traitement = $traitement;

        return $this;
    }

    /**
     * Get traitement
     *
     * @return \AppBundle\Entity\Traitement
     */
    public function getTraitement()
    {
        return $this->traitement;
    }

    /**
     * Set typeverre
     *
     * @param \AppBundle\Entity\Typeverre $typeverre
     *
     * @return Facture
     */
    public function setTypeverre(\AppBundle\Entity\Typeverre $typeverre = null)
    {
        $this->typeverre = $typeverre;

        return $this;
    }

    /**
     * Get typeverre
     *
     * @return \AppBundle\Entity\Typeverre
     */
    public function getTypeverre()
    {
        return $this->typeverre;
    }
}
