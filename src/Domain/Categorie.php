<?php

namespace BabyDressing\Domain;

class Categorie
{
    /**
     * categorie id.
     *
     * @var integer
     */
    private $id;

    /**
     * categorie nom.
     *
     * @var string
     */
    private $nom;

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

    public function setNom($nom)
    {
        $this->nom = $nom;
    }
}