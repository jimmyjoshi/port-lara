<?php namespace App\Models\Entity\Traits\Relationship;


use App\Models\Company\Company;

trait Relationship
{
	/** HasMany
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function fund_companies()
	{
	    return $this->hasMany(Company::class, 'fund_id');
	}
}