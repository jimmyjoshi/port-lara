<?php namespace App\Models\FundNote;

/**
 * Class FundNote
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\FundNote\Traits\Attribute\Attribute;
use App\Models\FundNote\Traits\Relationship\Relationship;

class FundNote extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_fund_notes";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'company_id',
        'title',
        'title_by',
        'description',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}