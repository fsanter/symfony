<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 * Attention cette classe n'est pas vraiment mappée
 * car on ne peut pas mélanger entité yml et entité annotation
 * au sein d'un même bundle
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TestRepository")
 */
class Test
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="test", type="string", length=255)
     */
    private $test;

    /**
     * @var int|null
     *
     * @ORM\Column(name="quantity", type="smallint", nullable=true)
     */
    private $quantity;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set test.
     *
     * @param string $test
     *
     * @return Test
     */
    public function setTest($test)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test.
     *
     * @return string
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Set quantity.
     *
     * @param int|null $quantity
     *
     * @return Test
     */
    public function setQuantity($quantity = null)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return int|null
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
