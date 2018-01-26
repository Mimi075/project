<?php
namespace Entity;
/**
 * @Entity 
 * @Table(name="Category")
 **/
class Category
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
     * Eleveur linked to this SubCategory
     *
     * @OneToMany(targetEntity="Entity\SubCategory", mappedBy="category")
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
