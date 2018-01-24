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
    private $price;

   /**
     * Eleveur linked to this Eleveur
     *
     * @ManyToOne(targetEntity="Entity\Eleveur", inversedBy="ad")
     */   
    private $farmer;

    /**
     * Eleveur linked to this Animal
     *
     * @ManyToOne(targetEntity="Entity\Animal", inversedBy="ad")
     */   
    private $animal;

    /**
     * Eleveur linked to this Photo
     *
     * @OneToMany(targetEntity="Entity\Photo", mappedBy="ad")
     */
    private $picture;

    /**
     * @Column(type="datetime")
     */
    private $dateDeCreation;

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

    public function getAnimal()
    {
        return $this->animal;
    }

    public function setAnimal($animal)
    {
        $this->animal = $animal;
    }

    public function getDateDeCreation()
    {
        return $this->dateDeCreation;
    }

    public function setDateDeCreation($dateDeCreation)
    {
        $this->dateDeCreation = $dateDeCreation;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }
}
