<?php

namespace App\Traits;

trait LikeablePresentorTrait
{
    /**
     * @return float|int
     */
    public function renderPozitiveVotes()
    {
        if ($this->model->likes()->count())
            return ($this->model->likes()->count() - $this->model->getLikes('dislike')->count()) /
            $this->model->likes()->count() * 100;

        return 0;
    }

    /**
     * @return int
     */
    public function getLikesNumber()
    {   if ($this->model->likes()->count())
            return $this->model->likes()->count();

        return 0;
    }
}