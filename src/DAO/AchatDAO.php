<?php

namespace BabyDressing\DAO;

use BabyDressing\Domain\Achat;

class AchatDAO extends DAO
{
    /**
     * Creates an achat object based on a DB row.
     *
     * @param array $row The DB row containing achat data.
     * @return \Babydressing\Domain\Achat
     */
    protected function buildDomainObject($row) 
    {
        $achat = new achat();
        $achat->setUserId($row['user_id']);
        $achat->setAchatDate($row['achat_date']);
        $achat->setAchatTotal($row['achat_total']);
        return $achat;
    }
    
    /**
     * Returns an achat matching the supplied id.
     *
     * @param integer $id
     *
     * @return \Babydressing\Domain\Achat|throws an exception if no matching achat is found
     */
    public function findByUser($id) 
    {
        $sql = "select * from Achat where user_id=?";
        $result = $this->getDb()->fetchAll($sql, array($id));

		$achats = array();
        foreach ($result as $row) 
        {
            $achats[] = $this->buildDomainObject($row);
        }
        return $achats;
    }
    
    public function NbAchat($user_id)
    {
    	$sql = "select count(*) AS Nb from achat where user_id=?";
		$nombre = $this->getDb()->fetchAssoc($sql, array($user_id));

        return $nombre['Nb'];
    }
    
    /**
     * Ajoute l'achat indiqué au profil de l'utilisateur indiqué
     *
     * @param int $user_id id de l'utilisateur
	 * @param int $achat_id id du produit
     */
	public function addAchat($user_id, $total, $date)
	{
		$data = array(
			'user_id' => $user_id,
			'achat_date' => $date,
			'achat_total' => $total
			);
		$this->getDb()->insert('Achat', $data);
	}
}