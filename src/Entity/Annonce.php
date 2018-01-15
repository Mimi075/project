<?php
namespace Entity;
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
    private $farmer;
    /**
     * @Column(type="integer")
     */
    private $animal;
    /**
     * @Column(type="string")
     */
    private $title;
    /**
     * @Column(type="string")
     */
    private $container;
    /**
     * @Column(type="integer")
     */
    private $region;
    /**
     * @Column(type="integer")
     */
    private $price;
    /**
     * @Column(type="datetime")
     */
   /* private $dateDeCreation;*/
       

    public function getId()
    {
        return $this->id;
    }

    public function getFarmer()
    {
        return $this->farmer;
    }

    public function setFarmer($farmer)
    {
        $this->farmer = $farmer;
    }

    public function getAnimal()
    {
        return $this->animal;
    }

    public function setAnimal($animal)
    {
        $this->animal = $animal;
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

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region)
    {
        $this->region = $region;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
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
