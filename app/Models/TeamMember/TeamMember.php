<?php namespace App\Models\TeamMember;

/**
 * Class Team
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\TeamMember\Traits\Attribute\Attribute;
use App\Models\TeamMember\Traits\Relationship\Relationship;

class TeamMember extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_teams_members";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'team_id',
        'title',
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