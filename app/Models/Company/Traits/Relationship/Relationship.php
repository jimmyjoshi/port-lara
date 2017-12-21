<?php namespace App\Models\Company\Traits\Relationship;

use App\Models\Entity\Entity;

trait Relationship
{
	/**
	 * Many-to-Many relations with Role.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function fund()
	{
	    return $this->belongsTo(Entity::class);
	}
}