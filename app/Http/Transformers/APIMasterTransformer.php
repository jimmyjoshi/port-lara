<?php

namespace App\Http\Transformers;

use App\Http\Transformers;
use URL;

class APIMasterTransformer extends Transformer 
{
    /**
     * Transform
     * 
     * @param array $data
     * @return array
     */
    public function transform($data) 
    {
        return $data;
    }

    public function documentCategoryTransform($categories = null)
    {
        $response = [];

        if(isset($categories) && count($categories))
        {
            foreach($categories as $category)   
            {
                $response[] = [
                    'categoryId'    => (int) $category->id,
                    'title'         => $category->title,
                    'icon'          => URL::to('/').'/uploads/document-category/'.$category->icon,
                    'description'   => $category->description
                ];
            }
        }

        return $response;
    }

    public function documentUploadTransform($uploads)
    {
        $response = [];

        if(isset($uploads) && count($uploads))
        {
            foreach($uploads as $upload)   
            {
                $response[] = [
                    'uploadId'          => (int) $upload->id,
                    'categoryId'        => (int) $upload->category_id,
                    'title'             => $upload->title,
                    'upload_file'       => ($upload->doc_type == 1) ? URL::to('/').'/uploads/media/'.$upload->upload_file : '',
                    'external_link'     => ($upload->doc_type != 1) ? $upload->external_link : '',
                    'doc_type'          => $upload->doc_type
                ];
            }
        }

        return $response;
    }

    public function allEntitiesTransform($entities)
    {
        $response = [];

        if(isset($entities) && count($entities))
        {
            foreach($entities as $entity)   
            {
                $response[] = [
                    'entityId'          => (int) $entity->id,
                    'title'             => $entity->title,
                    'inceptionDate'     => $entity->inception_date,
                    'assetClass'        => $entity->asset_class,
                    'fundSize'          => $entity->fund_size,
                    'description'       => $entity->description
                ];
            }
        }

        return $response;
    }
}
