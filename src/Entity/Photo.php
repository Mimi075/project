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
     * Eleveur linked to this Annonce
     *
     * @ManyToOne(targetEntity="Entity\Annonce", inversedBy="picture")
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

    public function getAd()
    {
        return $this->ad;
    }

    public function setAd($ad)
    {
        $this->ad = $ad;
    }
}
