<?php

namespace App\Libraries\Likeable;

use Conner\Likeable\LikeCounter as Eloquent;
use App\Libraries\Likeable\LikeableModels;

class LikeCounter extends Eloquent
{
	use LikeableModels;
	protected $table = 'likeable_like_counters';
	public $timestamps = false;
	protected $fillable = ['likable_id', 'likable_type', 'count', 'type'];

	public function likable()
	{
		return $this->morphTo();
	}
}