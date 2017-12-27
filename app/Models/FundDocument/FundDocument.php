<?php namespace App\Models\FundDocument;

/**
 * Class FundDocument
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\FundDocument\Traits\Attribute\Attribute;
use App\Models\FundDocument\Traits\Relationship\Relationship;

class FundDocument extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_fund_documents";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'fund_id',
        'title',
        'category',
        'additional_link',
        'description',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}