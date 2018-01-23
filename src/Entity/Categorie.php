<?php
namespace Entity;
/**
 * @Entity 
 * @Table(name="Category")
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
     * Eleveur linked to this Animal
     *
     * @OneToMany(targetEntity="Entity\Animal", mappedBy="category")
     */
    private $animal;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAd()
    {
        return $this->ad;
    }

    public function setAd($ad)
    {
        $this->ad = $ad;
    }

    public function getAnimal()
    {
        return $this->animal;
    }

    public function setAnimal($animal)
    {
        $this->animal = $animal;
    }
}
