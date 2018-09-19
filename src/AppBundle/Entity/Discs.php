<?php
/**
 * Created by PhpStorm.
 * User: Armen
 * Date: 19/09/18
 * Time: 7:25 PM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\DiscsRepository")
 * @ORM\Table(name="discs")
 *
 */
class Discs
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @var string name
     * @Assert\Regex(pattern="([a-zA-Z])", message="illegal_symbols")
     * @ORM\Column(name="name", type="string", length=50)
     *
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Singers" , inversedBy="discs" ,cascade={"persist"})
     * @ORM\JoinColumn(name="singers_id", referencedColumnName="id")
     */
    protected $singers;



    public function __construct()
    {
        $this->singers = new ArrayCollection();
        //...
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Discs
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Discs
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set singers
     *
     * @param \AppBundle\Entity\Singers $singers
     *
     * @return Discs
     */
    public function setSingers(\AppBundle\Entity\Singers $singers = null)
    {
        $this->singers = $singers;

        return $this;
    }

    /**
     * Get singers
     *
     * @return \AppBundle\Entity\Singers
     */
    public function getSingers()
    {
        return $this->singers;
    }
}
