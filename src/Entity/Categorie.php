<?php
namespace Entity;
/**
 * @Entity 
 * @Table(name="Annonce")
 **/
class Categorie
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
    private $name;

    /**
     * Eleveur linked to this Annonce
     *
     * @OneToMany(targetEntity="Entity\Annonce", mappedBy="category")
     */
    private $ad;

    /**
     * Eleveur linked to this Annonce
     *
     * @OneToMany(targetEntity="Entity\Annonce", mappedBy="category")
     */
    private $animal;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getFarmer()
    {
        return $this->farmer;
    }

    public function setFarmer($farmer)
    {
        $this->farmer = $farmer;
    }

    /*public function getDateDeCreation()
    {
        return $this->dateDeCreation;
    }

    public function setDateDeCreation($dateDeCreation)
    {
        $this->dateDeCreation = $dateDeCreation;
    }*/
}
