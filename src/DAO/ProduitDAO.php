<?php

namespace BabyDressing\DAO;

use BabyDressing\Domain\Produit;

class ProduitDAO extends DAO
{
    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAll() 
    {
        $sql = "select * from Produit order by prod_id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $produits = array();
        foreach ($result as $row) 
        {
            $produitId = $row['prod_id'];
            $produits[$produitId] = $this->buildDomainObject($row);
        }
        return $produits;
    }

    /**
     * Creates an Article object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \Babydressing\Domain\Article
     */
    protected function buildDomainObject($row) 
    {
        $produit = new produit();
        $produit->setId($row['prod_id']);
        $produit->setNom($row['prod_title']);
        $produit->setDescription($row['prod_description']);
        $produit->setPrix($row['prod_prix']);
		$produit->setImage($row['prod_image']);
        $produit->setCategorie($row['cat_id']);
        return $produit;
    }
    
    /**
     * Returns an article matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Babydressing\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) 
    {
        $sql = "select * from Produit where prod_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No article matching id " . $id);
    }

	/**
     * Return a list of all articles by categorie.
     *
     * @return array A list of all articles by categorie.
     */
    public function findByCategorie($id) 
    {
        $sql = "select * from Produit, Categorie where Produit.cat_id=? AND Produit.cat_id=Categorie.cat_id";
        $result = $this->getDb()->fetchAll($sql, array($id));

		if ($result)
		{
       		 // Convert query result to an array of domain objects
        	$produits = array();
        	foreach ($result as $row) 
        	{
            	$produitId = $row['prod_id'];
            	$produits[$produitId] = $this->buildDomainObject($row);
        	}
        	return $produits;
        }
        else
            throw new \Exception("No article matching in categorie " . $nom);
    }
	
	/**
     * Return le nom de la categorie du produit.
     *
	 * @param integer $id
	 *
     * @return string.
     */
    public function findCategoryName($id) 
    {
        $sql = "select Categorie.cat_nom from Produit, Categorie where Produit.prod_id=? AND Produit.cat_id=Categorie.cat_id";
		$row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $row['cat_nom'];
        else
            throw new \Exception("No article matching id " . $id);
    }
    
    
    /**
     * Return le nom de l'auteur du produit.
     *
	 * @param integer $id
	 *
     * @return string.
     */
    public function findAuteur($id) 
    {
        $sql = "select user_nom, user_prenom from Produit, Utilisateur where Produit.prod_id=? AND Produit.user_id=Utilisateur.user_id";
		$row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return array('nom' => $row['user_nom'], 'prenom' => $row['user_prenom']);
        else
            throw new \Exception("No user matching id " . $id);
    }

}