<?php namespace App\Models\FundDocument\Traits\Relationship;

use App\Models\Entity\Entity;

trait Relationship
{
	/**
	 * Belongs To
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function roles()
	{
	    return $this->belongsTo(Entity::class, 'fund_id');
	}

}