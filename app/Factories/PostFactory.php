<?php

namespace App\Factories;

use App\Models\Post;

class PostFactory 
{
	public static function create (array $data):Post
	{
		return Post::create($data);
	}


	public static function createMany(array $postsData):array

	{
		return collect($postsData)->map(function ($data) {
		    return aself::create($data);
		})->toArray();

	}

}
