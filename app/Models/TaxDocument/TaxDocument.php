<?php namespace App\Models\TaxDocument;

/**
 * Class TaxDocument
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\TaxDocument\Traits\Attribute\Attribute;
use App\Models\TaxDocument\Traits\Relationship\Relationship;

class TaxDocument extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_tax_documents";

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