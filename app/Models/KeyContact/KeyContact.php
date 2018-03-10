<?php namespace App\Models\KeyContact;

/**
 * Class KeyContact
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\KeyContact\Traits\Attribute\Attribute;
use App\Models\KeyContact\Traits\Relationship\Relationship;

class KeyContact extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_key_contacts";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'company_id',
        'title',
        'company',
        'designation',
        'contact_number',
        'email_id',
        'description',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}