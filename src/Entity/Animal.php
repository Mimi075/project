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
     * Animal linked to this SousCategorie
     *
     * @ManyToOne(targetEntity="Entity\SousCategorie", inversedBy="animal")
     */
    private $subCategory;
 

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

    public function getSubCategory()
    {
        return $this->subCategory;
    }
 
    public function setSubCategory($subCategory)
    {
        $this->subCategory = $subCategory;
    }
 
   
}
