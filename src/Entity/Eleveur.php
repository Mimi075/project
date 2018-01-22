<?php
namespace Entity;
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
    private $lastName;

    /**
     * @Column(type="string")
     */
    private $firstName;

    /**
     * @Column(type="string")
     */
    private $email;

    /**
     * @Column(type="string")
     */
    private $password;

    /**
     * @Column(type="string")
     */

    private $adress;

    /**
     * @Column(type="string")
     */
    private $zip;

    /**
     * @Column(type="string")
     */
    private $city;

    /**
     * @Column(type="string")
     */
    private $region;

    /**
     * @Column(type="string")
     */
    private $siren;

    /**
     * @Column(type="datetime")
     */
    /*private $dateDinscription;*/

    /**
     * @Column(type="datetime")
     */
    /*private $dateDerniereVisite;*/

     /**
     * Eleveur linked to this Annonce
     *
     * @OneToMany(targetEntity="Entity\Annonce", mappedBy="eleveur")
     */
    private $annonces;
    

    public function getId()
    {
        return $this->id;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getAdress()
    {
        return $this->adress;
    }

    public function setAdress($adress)
    {
        $this->adress = $adress;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getAnnonce()
    {
        return $this->annonce;
    }

    public function setAnnonce($annonce)
    {
        $this->annonce = $annonce;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region)
    {
        $this->region = $region;
    }

    public function getSiren()
    {
        return $this->siren;
    }

    public function setSiren($siren)
    {
        $this->siren = $siren;
    }

   /* public function getDateDinscription()
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
    }*/
}