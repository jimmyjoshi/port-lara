<?php namespace App\Models\Entity;

/**
 * Class Entity
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\Entity\Traits\Attribute\Attribute;
use App\Models\Entity\Traits\Relationship\Relationship;

class Entity extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_entities";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'user_id',
        'title',
        'inception_date',
        'asset_class',
        'fund_size',
        'description',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}