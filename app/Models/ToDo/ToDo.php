<?php namespace App\Models\ToDo;

/**
 * Class ToDo
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\ToDo\Traits\Attribute\Attribute;
use App\Models\ToDo\Traits\Relationship\Relationship;

class ToDo extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_todos";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'user_id',
        'title',
        'notes',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}