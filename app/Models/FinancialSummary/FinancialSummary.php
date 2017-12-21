<?php namespace App\Models\FinancialSummary;

/**
 * Class FinancialSummary
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\FinancialSummary\Traits\Attribute\Attribute;
use App\Models\FinancialSummary\Traits\Relationship\Relationship;

class FinancialSummary extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_financial_summary";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'user_id',
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