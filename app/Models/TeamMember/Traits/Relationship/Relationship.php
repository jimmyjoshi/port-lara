<?php namespace App\Models\TeamMember\Traits\Relationship;


use App\Models\Team\Team;

trait Relationship
{
	/**
	 * Belongs To relations with Team
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function team()
	{
	    return $this->belongsTo(Team::class);
	}
}