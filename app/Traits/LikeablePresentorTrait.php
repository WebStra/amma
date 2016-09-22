<?php

namespace App\Traits;

trait LikeablePresentorTrait
{
    public function renderPozitiveVotes()
    {
        if($this->model->likes()->count())
            return ($this->model->likes()->count() - $this->model->getLikes('dislike')->count()) / 
                $this->model->likes()->count() * 100;

        return 0;
    }

    public function roundPozitiveVotes()
    {   
        if($this->model->likes()->count())
        return (round(0.05 * (($this->model->likes()->count() - $this->model->getLikes('dislike')->count()) /     $this->model->likes()->count() * 100)));

        return 0;
    }
}