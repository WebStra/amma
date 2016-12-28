<?php

namespace App\Libraries\Likeable;

use App\Libraries\Likeable\LikeCounter;
use Conner\Likeable\LikeableTrait;

trait Likeable 
{
	use LikeableTrait;

	public function like($type = 'like', $userId = null)
	{
		if(is_null($userId)) {
			$userId = $this->loggedInUserId();
		}
		
		if($userId) {
			$like = $this->likes()
				->where('user_id', '=', $userId)
				->typelike($type)
				->first();
	
			if($like) return;
	
			$like = new Like();
			$like->user_id = $userId;
			$like->type = $type;
			$this->likes()
				->typelike($type)
				->save($like);
		}

		$this->incrementLikeCount($type);
	}

	public function unlike($type = 'like', $userId = null)
	{
		if(is_null($userId)) {
			$userId = $this->loggedInUserId();
		}
		
		if($userId) {
			$like = $this->likes()
				->where('user_id', '=', $userId)
				->typelike($type)
				->first();
			
			if(!$like) { return; }
	
			$like->delete();
		}

		$this->decrementLikeCount($type);
	}

	public function wasLiked($type = 'like', $userId = null) {
		if(is_null($userId)) {
			$userId = $this->loggedInUserId();
		}
		
		return (bool) $this->likes()
			->where('user_id', '=', $userId)
			->typelike($type)
			->count();
	}

	private function incrementLikeCount($type ='like')
	{
		$counter = $this->likeCounter()
				->typelike($type)
				->first();
		
		if($counter) {
			$counter->count++;
			$counter->save();
		} else {
			$counter = new LikeCounter;
			$counter->type = $type;
			$counter->count = 1;
			$this->likeCounter()
				->typelike($type)
				->save($counter);
		}
	}
	
	/**
	 * Private. Decrement the total like count stored in the counter
	 */
	private function decrementLikeCount($type ='like')
	{
		$counter = $this->likeCounter()
			->typelike($type)
			->first();

		if($counter) {
			$counter->count--;
			if($counter->count) {
				$counter->type = $type;
				$counter->save();
			} else {
				$counter->delete();
			}
		}
	}

	public function likes($type = 'like')
	{
		return $this->morphMany(Like::class, 'likable');
	}

	public function getLikes($type = 'like')
	{
		return $this->likes()->typelike($type)->get();
	}

	public function likeCounter()
	{
		return $this->morphOne(LikeCounter::class, 'likable');
	}
}