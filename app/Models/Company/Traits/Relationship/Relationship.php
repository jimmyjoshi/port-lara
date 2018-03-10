<?php namespace App\Models\Company\Traits\Relationship;

use App\Models\CompanyCategory\CompanyCategory;
use App\Models\Entity\Entity;
use App\Models\FundNote\FundNote;
use App\Models\FundDocument\FundDocument;
use App\Models\KeyContact\KeyContact;
use App\Models\ToDo\ToDo;

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

	/** HasMany
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function company_documents()
	{
		return $this->hasMany(FundDocument::class, 'company_id');
	}


	/** HasMany
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function company_contacts()
	{
	    return $this->hasMany(KeyContact::class, 'company_id');
	}

	/** HasMany
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function company_notes()
	{
	    return $this->hasMany(FundNote::class, 'company_id');
	}

	/** HasMany
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function company_todos()
	{
	    return $this->hasMany(ToDo::class, 'company_id');
	}
}

