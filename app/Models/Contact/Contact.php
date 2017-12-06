<?php namespace App\Models\Contact;

/**
 * Class Contact
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\Contact\Traits\Attribute\Attribute;
use App\Models\Contact\Traits\Relationship\Relationship;

class Contact extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_contacts";

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
        'description',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}