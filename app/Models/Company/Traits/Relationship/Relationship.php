<?php namespace App\Models\Company\Traits\Relationship;

use App\Models\CompanyCategory\CompanyCategory;
use App\Models\Entity\Entity;

trait Relationship
{
	/**
	 * Belongs TO
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function fund()
	{
	    return $this->belongsTo(Entity::class);
	}

	/**
	 * Belongs TO
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function company_category()
	{
	    return $this->belongsTo(CompanyCategory::class, 'company_category_id');
	}
}

