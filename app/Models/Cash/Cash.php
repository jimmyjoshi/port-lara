<?php namespace App\Models\Cash;

/**
 * Class Cash
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\Cash\Traits\Attribute\Attribute;
use App\Models\Cash\Traits\Relationship\Relationship;

class Cash extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_cash";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'title',
        'cash_type',
        'amount'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}