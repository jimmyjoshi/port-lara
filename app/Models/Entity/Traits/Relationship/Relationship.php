<?php namespace App\Models\Entity\Traits\Relationship;

use App\Models\FundNote\FundNote;
use App\Models\Company\Company;
use App\Models\FundDocument\FundDocument;
use App\Models\KeyContact\KeyContact;

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

	/** HasMany
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function fund_documents()
	{
	    return $this->hasMany(FundDocument::class, 'fund_id');
	}


	/** HasMany
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function fund_contacts()
	{
	    return $this->hasMany(KeyContact::class, 'fund_id');
	}

	/** HasMany
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function fund_notes()
	{
	    return $this->hasMany(FundNote::class, 'fund_id');
	}
}