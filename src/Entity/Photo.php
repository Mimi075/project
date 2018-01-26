<?php
namespace Entity;
/**
 * @Entity 
 * @Table(name="Photo")
 **/
class Photo
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
    private $url;

    /**
     * @Column(type="boolean")
     */
    private $bool;

     /**
     * Eleveur linked to this Ad
     *
     * @ManyToOne(targetEntity="Entity\Ad", inversedBy="picture")
     */
    private $ad;

    public function getId()
    {
        return $this->id;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getBool()
    {
        return $this->bool;
    }

    public function setBool($bool)
    {
        $this->bool = $bool;
    }

    public function getAd()
    {
        return $this->ad;
    }

    public function setAd($ad)
    {
        $this->ad = $ad;
    }
}
