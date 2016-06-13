<?php

namespace App\Libraries\Presenterable\Presenters;

use Jenssegers\Date\Date;

class PostPresenter extends Presenter
{
    /**
     * Render short description from post's body.
     *
     * @param $range
     * @return string
     */
    public function renderShortDescription($range = 75)
    {
        return sprintf('%s...', substr($this->model->body, 0, $range));
    }

    /**
     * Render post title.
     *
     * @return string
     */
    public function renderTitle()
    {
        return ucfirst($this->model->title);
    }

    /**
     * Render published date from created_at.
     *
     * @param string
     * @return string
     */
    public function renderPublishedDate($format = 'd F Y')
    {
        Date::setLocale(\Lang::slug());

        $date = Date::createFromTimestamp(
            $this->model->created_at->timestamp
        );

        return $date->format($format);
    }

    /**
     * Render post's views.
     *
     * @return string
     */
    public function renderPostViews()
    {
        return $this->model->view_count;
    }
}