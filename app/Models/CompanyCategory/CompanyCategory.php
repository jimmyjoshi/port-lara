<?php namespace App\Models\CompanyCategory;

/**
 * Class CompanyCategory
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\CompanyCategory\Traits\Attribute\Attribute;
use App\Models\CompanyCategory\Traits\Relationship\Relationship;

class CompanyCategory extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_company_categories";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'title',
        'additional_link',
        'notes',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}