<?php namespace App\Models\Upload;

/**
 * Class Upload
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\Upload\Traits\Attribute\Attribute;
use App\Models\Upload\Traits\Relationship\Relationship;

class Upload extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_uploads";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'category_id',
        'title',
        'upload_file',
        'external_link',
        'doc_type',
        'description',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}