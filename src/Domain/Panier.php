<?php

namespace BabyDressing\Domain;

class Panier
{
    /**
     * Product id.
     *
     * @var int
     */
    private $prod_id;

	/**
     * User id.
     *
     * @var int
     */
    private $user_id;
    
    /**
     * Product id.
     *
     * @var float
     */
    private $prod_prix;



    public function getUserId()
	{
        return $this->user_id;
    }

    public function setUserId($user_id)
	{
        $this->user_id = $user_id;
    }

	 public function getProdId()
	{
        return $this->prod_id;
    }

    public function setProdId($prod_id)
	{
        $this->prod_id = $prod_id;
    }
    
    public function getProdPrix()
	{
        return $this->prod_prix;
    }

    public function setProdPrix($prod_prix)
	{
        $this->prod_prix = $prod_prix;
    }
}