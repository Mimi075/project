<?php
/**
 * @Entity 
 * @Table(name="Annonce")
 **/
class Annonce
{
    /**
     * @Id ()
     * @Column(type="integer")
     * @GeneratedValue()
     */
    private $id;
    /**
     * @Column(type="integer")
     */
    private $idEleveur;
    /**
     * @Column(type="integer")
     */
    private $idAnimal;
    /**
     * @Column(type="string")
     */
    private $titre;
    /**
     * @Column(type="string")
     */
    private $contenue;
    /**
     * @Column(type="integer")
     */
    private $idRegion;
    /**
     * @Column(type="integer")
     */
    private $prix;
    /**
     * @Column(type="datetime")
     */
    private $dateDeCreation;
       

    public function getId()
    {
        return $this->id;
    }

    public function getIdEleveur()
    {
        return $this->idEleveur;
    }

    public function setIdEleveur($idEleveur)
    {
        $this->idEleveur = $idEleveur;
    }

    public function getIdAnimal()
    {
        return $this->idAnimal;
    }

    public function setIdAnimal($idAnimal)
    {
        $this->idAnimal = $idAnimal;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getContenue()
    {
        return $this->contenue;
    }

    public function setContenue($contenue)
    {
        $this->contenue = $contenue;
    }

    public function getIdRegion()
    {
        return $this->idRegion;
    }

    public function setIdRegion($idRegion)
    {
        $this->idRegion = $idRegion;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function getDateDeCreation()
    {
        return $this->dateDeCreation;
    }

    public function setDateDeCreation($dateDeCreation)
    {
        $this->dateDeCreation = $dateDeCreation;
    }
}
