<?php namespace App\Models\Company;

/**
 * Class Company
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\Company\Traits\Attribute\Attribute;
use App\Models\Company\Traits\Relationship\Relationship;

class Company extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_companies";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'company_category_id',
        'user_id',
        'fund_id',
        'title',
        'amount',
        'percentage',
        'notes',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}