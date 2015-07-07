<?php

namespace BabyDressing\Domain;

class Produit 
{
    /**
     * Produit id.
     *
     * @var integer
     */
    private $id;

    /**
     * Produit nom.
     *
     * @var string
     */
    private $nom;

    /**
     * Produit description.
     *
     * @var string
     */
    private $description;
    
    /**
     * Produit image.
     *
     * @var string
     */
    private $image;

    /**
     * Produit prix.
     *
     * @var float
     */
    private $prix;
    
    /**
     * Produit categorie.
     *
     * @var int
     */
    private $categorie;
    
    /**
     * produit author.
     *
     * @var \BabyDressing\Domain\User
     */
    private $author;

    public function getId() 
    {
        return $this->id;
    }

    public function setId($id)
     {
        $this->id = $id;
    }

    public function getNom() 
    {
        return $this->nom;
    }

    public function setNom($title)
    {
        $this->nom = $title;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }
    
    public function getImage() 
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getPrix() 
    {
        return $this->prix;
    }

    public function setPrix($prix) 
    {
        $this->prix = $prix;
    }
    
    public function getCategorie() 
    {
        return $this->categorie;
    }

    public function setCategorie($categorie) 
    {
        $this->categorie = $categorie;
    }
    
    
    public function setAuthor(User $author) {
        $this->author = $author;
    }
}