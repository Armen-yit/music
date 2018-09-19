<?php
/**
 * Created by PhpStorm.
 * User: Armen
 * Date: 19/09/18
 * Time: 7:20 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SingersRepository")
 * @ORM\Table(name="singers")
 *
 */
class Singers
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
     * @ORM\OneToMany(targetEntity="Discs", mappedBy="singers" , cascade={"persist", "remove"})
     */
    protected $discs;
    

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name ;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->discs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Singers
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
     * @return Singers
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
     * Add disc
     *
     * @param \AppBundle\Entity\Discs $disc
     *
     * @return Singers
     */
    public function addDisc(\AppBundle\Entity\Discs $disc)
    {
        $this->discs[] = $disc;

        return $this;
    }

    /**
     * Remove disc
     *
     * @param \AppBundle\Entity\Discs $disc
     */
    public function removeDisc(\AppBundle\Entity\Discs $disc)
    {
        $this->discs->removeElement($disc);
    }

    /**
     * Get discs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiscs()
    {
        return $this->discs;
    }
}
