<?php namespace App\Models\Team;

/**
 * Class Team
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\Team\Traits\Attribute\Attribute;
use App\Models\Team\Traits\Relationship\Relationship;

class Team extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_teams";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'title',
        'company',
        'designation',
        'contact_number',
        'profile_picture',
        'category',
        'description',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}