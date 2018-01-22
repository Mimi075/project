<?php
namespace Entity;
/**
 * @Entity 
 * @Table(name="Annonce")
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

    public function getCategory()
    {
        return $this->category;
    }
 
    public function setCategory($category)
    {
        $this->category = $category;
    }
 
   
}
