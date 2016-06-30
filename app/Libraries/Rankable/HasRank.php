<?php

namespace App\Libraries\Rankable;

trait HasRank
{
    public function rankUp()
    {

    }

    public function rankDown()
    {

    }

    public function makeFirst()
    {

    }

    public function makeLast()
    {

    }
    
    public function getFirstRank($query = false)
    {
        if($query)
            return $this->orderBy('rank', 'ASC');

        return $this->orderBy('rank', 'ASC')->first();
    }

    public function getLastRank($query = false)
    {
        if($query)
            return $this->orderBy('rank', 'DESC');

        return $this->orderBy('rank', 'DESC')->first();
    }

    public function swapRank($swapper)
    {
        if(is_numeric($swapper))
            $swapper = $this->find((int) $swapper)->first();

        $swapperModelRank = $swapper->rank;
        $currentModelRank = $this->getRank();

        $swapper->rank = $currentModelRank;
        $this->rank = $swapperModelRank;
        $swapper->save();
        $this->save();

        return $this;
    }

    /**
     * Set rank to model.
     * 
     * @param $rank
     * @return $this
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
        
        $this->save();
        
        return $this;
    }

    public function getRankIndex()
    {
        return $this->id;
    }

    public function getRank()
    {
        return $this->rank();
    }

    public function rank()
    {
        return $this->rank();
    }

    public function scopeRanked($query, $order = 'DESC')
    {
        return $query->orderBy('rank', $order);
    }

    public function scopeFindRank($query, $rank)
    {
        return $query->whereRank($rank);
    }
}