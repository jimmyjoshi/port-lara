<?php namespace App\Models\DocumentCategory;

/**
 * Class DocumentCategory
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\DocumentCategory\Traits\Attribute\Attribute;
use App\Models\DocumentCategory\Traits\Relationship\Relationship;

class DocumentCategory extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_document_categories";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'title',
        'icon',
        'description',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}