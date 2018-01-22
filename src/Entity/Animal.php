<?php
namespace Entity;
/**
 * @Entity 
 * @Table(name="Animal")
 **/
class Animal
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
     * Animal linked to this Annonce
     *
     * @OneToMany(targetEntity="Entity\Annonce", mappedBy="animal")
     */
    private $annonces;

    /**
     * Animal linked to this Categorie
     *
     * @ManyToOne(targetEntity="Entity\Categorie", inversedBy="animal")
     */
    private $category;


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

    public function getaAnnonce()
    {
        return $this->annonce;
    }

    public function setAnnonce($annonce)
    {
        $this->annonce = $annonce;
    }


    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }
}
