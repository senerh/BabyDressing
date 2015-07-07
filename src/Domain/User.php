<?php

namespace BabyDressing\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * User id.
     *
     * @var integer
     */
    private $id;

	/**
     * User nom.
     *
     * @var string
     */
    private $nom;

	/**
     * User prenom.
     *
     * @var string
     */
    private $prenom;


    /**
     * User name.
     *
     * @var string
     */
    private $username;

    /**
     * User password.
     *
     * @var string
     */
    private $password;

    /**
     * Salt that was originally used to encode the password.
     *
     * @var string
     */
    private $salt;

    /**
     * Role.
     * Values : ROLE_USER or ROLE_ADMIN.
     *
     * @var string
     */
    private $role;
    
    /**
     * numeroRue.
     *
     * @var int
     */
    private $numero;
    
    /**
     * Rue.
     *
     * @var string
     */
    private $rue;
    
    /**
     * CodePostal.
     *
     * @var int
     */
    private $codePostal;
    
    /**
     * Ville.
     *
     * @var string
     */
    private $ville;
    
    /**
     * Telephone.
     *
     * @var int
     */
    private $telephone;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

	 public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }
	
	 public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
	
    /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }
    
    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }
    
    public function getRue()
    {
        return $this->rue;
    }

    public function setRue($rue) {
        $this->rue = $rue;
    }
    
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    public function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;
    }
    
    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }
    
    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
}