<?php

namespace BabyDressing\DAO;

use BabyDressing\Domain\Panier;
use BabyDressing\Domain\Produit;

class PanierDAO extends DAO
{
	/**
     * Creates an Panier object based on a DB row.
     *
     * @param array $row The DB row containing Panier data.
     * @return \Babydressing\Domain\Panier
     */
    protected function buildDomainObject($row) 
    {
        $produitPanier = new produit();
        $produitPanier->setId($row['prod_id']);
        $produitPanier->setNom($row['prod_title']);
        $produitPanier->setDescription($row['prod_description']);
        $produitPanier->setPrix($row['prod_prix']);
		$produitPanier->setImage($row['prod_image']);
        $produitPanier->setCategorie($row['cat_id']);
        return $produitPanier;
    }
	
	/**
     * Return liste des produits commandés par un utilisateur
     *
     * @return array liste des produits
     */
    public function findProductsByUser($user_id) 
    {
        $sql = "select Produit.* from Produit, Panier where Produit.prod_id = Panier.prod_id and Panier.user_id = ?";
        $result = $this->getDb()->fetchAll($sql, array($user_id));

        // Convert query result to an array of domain objects
        $produits = array();
        foreach ($result as $row)
        {
            $produitId = $row['prod_id'];
            $produits[$produitId] = $this->buildDomainObject($row);
        }
        return $produits;
    }
    
	public function supprimerPanier($user_id)
    {
    	$sql = "select * from Panier where user_id = ?";
    	$result = $this->getDb()->fetchAll($sql, array($user_id));
    	
    	$sql = "delete from Panier where user_id = ?";
    	$this->getDb()->executeQuery($sql, array($user_id));
    	foreach ($result as $row)
        {
        	//on supprime le produit des autres paniers
            $sql = "delete from Panier where prod_id = ?";
            $this->getDb()->executeQuery($sql, array($row['prod_id']));
            
            //on supprime le produit de la liste des produits en vente
			$sql = "delete from Produit where prod_id = ?";
			$this->getDb()->executeQuery($sql, array($row['prod_id']));      
		}
    }
    
	/**
     * Return total du prix du panier d'un utilisateur
     *
     * @param user_id $user_id Id de l'utilisateur
     */
    public function totalPanier($user_id) 
    {
        $sql = "SELECT SUM(Produit.prod_prix) AS total FROM Produit, Panier WHERE Panier.user_id=? and Panier.prod_id = Produit.prod_id";
        $prix = $this->getDb()->fetchAssoc($sql, array($user_id));

        return $prix['total'];
    }
    
    
    /**
     * Return si l'article est deja dans le panier
     *
     * @param user_id $user_id Id de l'utilisateur et prod_id
     */
    public function articleExistant($user_id, $prod_id) 
    {
        $sql = "SELECT * FROM Panier WHERE Panier.user_id=? and Panier.prod_id = ?";
        $result = $this->getDb()->fetchAssoc($sql, array($user_id, $prod_id));

        return ($result != NULL);
    }

	/**
     * Ajoute le produit indiqué au panier de l'utilisateur indiqué
     *
     * @param int $user_id id de l'utilisateur
	 * @param int $prod_id id du produit
     */
	public function addProduct($user_id, $prod_id)
	{
		$data = array(
			'user_id' => $user_id,
			'prod_id' => $prod_id
			);
		$this->getDb()->insert('Panier', $data);
	}
	
	/**
     * Enleve le produit indiqué au panier de l'utilisateur indiqué
     *
     * @param int $user_id id de l'utilisateur
	 * @param int $prod_id id du produit
     */
	public function removeProduct($user_id, $prod_id)
	{
		$sql = "DELETE FROM Panier WHERE Panier.user_id = ? AND Panier.prod_id = ?";
		$this->getDb()->executeQuery($sql, array($user_id, $prod_id));
	}
}