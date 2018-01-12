<?php
/**
 * @Entity 
 * @Table(name="Eleveur")
 **/
class Eleveur
{
    /**
     * @Id ()
     * @Column(type="integer")
     * @GeneratedValue()
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $nom;
    /**
     * @Column(type="string")
     */
    private $prenom;
    /**
     * @Column(type="string")
     */
    private $adresseMail;
    /**
     * @Column(type="string")
     */
    private $motDePasse;
    /**
     * @Column(type="string")
     */

    private $adresse;
    /**
     * @Column(type="string")
     */
    private $codePostal;
    /**
     * @Column(type="string")
     */
    private $ville;
    /**
     * @Column(type="integer")
     */
    private $idRegion;
    /**
     * @Column(type="string")
     */
    private $siren;
    /**
     * @Column(type="datetime")
     */
    private $dateDinscription;
    /**
     * @Column(type="datetime")
     */
    private $dateDerniereVisite;
    

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getAdresseMail()
    {
        return $this->adresseMail;
    }

    public function setAdresseMail($adresseMail)
    {
        $this->adresseMail = $adresseMail;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function getCodePostal()
    {
        return $this->codePostal;
    }

    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function getIdRegion()
    {
        return $this->idRegion;
    }

    public function setIdRegion($idRegion)
    {
        $this->idRegion = $idRegion;
    }

    public function getSiren()
    {
        return $this->siren;
    }

    public function setSiren($siren)
    {
        $this->siren = $siren;
    }

    public function getDateDinscription()
    {
        return $this->dateDinscription;
    }

    public function setDateDinscription($dateDinscription)
    {
        $this->dateDinscription = $dateDinscription;
    }

    public function getDateDerniereVisite()
    {
        return $this->dateDerniereVisite;
    }

    public function setDateDerniereVisite($dateDerniereVisite)
    {
        $this->dateDerniereVisite = $dateDerniereVisite;
    }
}