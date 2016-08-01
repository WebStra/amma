<?php 

namespace App\Libraries\Likeable;

trait LikeableModels 
{
	public function scopeTypeLike($query, $type)
	{
		return $query->where('type', $type);
	}
}