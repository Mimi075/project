<?php
namespace Entity;
/**
 * @Entity 
 * @Table(name="Categorie")
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
    private $nom;
      /**
     * Animal linked to this Categorie
     *
     * @OneToMany(targetEntity="Entity\Animal", mappedBy="categorie")
     */
    private $animal;


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

     public function getAnimal()
    {
        return $this->animal;
    }

    public function setAnimal($animal)
    {
        $this->animal = $animal;
    }
}