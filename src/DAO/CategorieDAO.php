<?php

namespace BabyDressing\DAO;

use BabyDressing\Domain\Categorie;

class CategorieDAO extends DAO
{
    /**
     * Return a list of all categorie, sorted by date (most recent first).
     *
     * @return array A list of all categorie.
     */
    public function findAllCategorie() 
    {
        $sql = "select * from Categorie order by cat_nom asc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $categories = array();
        foreach ($result as $row) 
        {
            $categorieId = $row['cat_id'];
            $categories[$categorieId] = $this->buildDomainObject($row);
        }
        return $categories;
    }


    /**
     * Creates an categorie object based on a DB row.
     *
     * @param array $row The DB row containing categorie data.
     * @return \Babydressing\Domain\categorie
     */
    protected function buildDomainObject($row) 
    {
        $categorie = new categorie();
        $categorie->setId($row['cat_id']);
        $categorie->setnom($row['cat_nom']);
        return $categorie;
    }
    
    /**
     * Returns an categorie matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Babydressing\Domain\categorie|throws an exception if no matching categorie is found
     */
    public function find($id) 
    {
        $sql = "select * from Categorie where cat_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No categorie matching id " . $id);
    }
    
    /**
     * Returns all products
     *
     *
     * @return \Babydressing\Domain\categorie|throws an exception if no matching categorie is found
     */
    public function getAll()
    {
    	$categorie = new categorie();
    	$categorie->setnom('Toutes');
    	return $categorie;
    }

}