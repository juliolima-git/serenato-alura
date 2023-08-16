<?php

namespace Serenatto\Web\Model;

class Product {
    private ?int $id;
    private string $type;
    private string $name;
    private string $description;
    private string $image;
    private float $price;

    public function __construct(?int $id, string $name, string $type, string $description, float $price, string $image)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = empty($image)  ? "logo-serenatto.png" : $image;
    }
 
    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
 
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getFormattedPrice() {
        return 'R$ ' . number_format($this->getPrice(), 2);
    }

    public function getImagePath() {
        return 'img/' . $this->getImage();
    }
}