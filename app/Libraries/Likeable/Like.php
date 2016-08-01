<?php

namespace App\Libraries\Likeable;

use Conner\Likeable\Like as Model;
use App\Libraries\Likeable\LikeableModels;

class Like extends Model
{
	use LikeableModels;

	protected $fillable = ['likable_id', 'likable_type', 'user_id', 'type'];
}