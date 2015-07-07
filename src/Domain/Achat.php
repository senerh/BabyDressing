<?php

namespace BabyDressing\Domain;

class Achat
{
	/**
     * User id.
     *
     * @var int
     */
    private $user_id;
    
    /**
     * achat date.
     *
     * @var date
     */
    private $date;
    
    /**
     * achat total.
     *
     * @var float
     */
    private $total;



    public function getUserId()
	{
        return $this->user_id;
    }

    public function setUserId($user_id)
	{
        $this->user_id = $user_id;
    }
    
    public function getAchatTotal()
	{
        return $this->total;
    }

    public function setAchatTotal($total)
	{
        $this->total = $total;
    }
    
    public function getAchatDate()
	{
        return $this->date;
    }

    public function setAchatDate($date)
	{
        $this->date = $date;
    }
}