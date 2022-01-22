<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    /**
     * @var int|null
     */
    private $maxPrice;


    /**
     * @Assert\Range(min=10, max=400)
     * @var int|null
     */
    private $minSurface;

    /**
     * @var ArrayCollection
     */
    private $options;


    /**
     * Get the value of maxPrice
     *
     * @return  int|null
     */ 
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }


    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * Set the value of maxPrice
     *
     * @param  int|null  $maxPrice
     * @return  PropertySearch
     */ 
    public function setMaxPrice(int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get the value of minSurface
     *
     * @return  int|null
     */ 
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * Set the value of minSurface
     *
     * @param  int|null  $minSurface
     * @return  PropertySearch
     */ 
    public function setMinSurface(int $minSurface): PropertySearch
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    /**
     * Get the value of options
     *
     * @return  ArrayCollection
     */ 
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * Set the value of options
     *
     * @param  ArrayCollection  $options
     *
     * @return  self
     */ 
    public function setOptions(ArrayCollection $options): self
    {
        $this->options = $options;

        return $this;
    }
}