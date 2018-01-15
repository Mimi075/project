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
     * @Column(type="integer")
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