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

    /**
     * Document Upload Transform
     * 
     * @param object $uploads
     * @return array
     */
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

    /**
     * All ToDos Transform
     * 
     * @param array $items
     * @return array
     */
    public function allToDosTransform($items)
    {
        $response = [];

        if(isset($items) && count($items))
        {
            foreach($items as $item)   
            {
                $response[] = [
                    'toDoId'    => (int) $item->id,
                    'title'     => $item->title,
                    'notes'     => $item->notes,
                    'status'    => $item->status ? $item->status : 1,
                    'created'   => date('d-m-Y', strtotime($item->created_at))
                ];
            }
        }

        return $response;
    }

    /**
     * Single ToDos Transform
     * 
     * @param object $items
     * @return array
     */
    public function singleToDosTransform($item)
    {
        return [
            'toDoId'    => (int) $item->id,
            'title'     => $item->title,
            'notes'     => $item->notes,
            'status'    => $item->status ? $item->status : 1,
            'created'   => date('d-m-Y', strtotime($item->created_at))
        ];
    }

    public function allTaxDocumentsTransform($items)
    {
        $response = [];

        if(isset($items) && count($items))
        {
            foreach($items as $item)   
            {
                $response[] = [
                    'taxDocumentId'     => (int) $item->id,
                    'title'             => $item->title,
                    'additionalLink'    => $item->additional_link ? $item->additional_link : '',
                    'notes'             => $item->notes,
                    'status'            => $item->status ? $item->status : 1,
                    'created'           => date('d-m-Y', strtotime($item->created_at))
                ];
            }
        }

        return $response;
    }

    public function allFinancialSummaryTransform($items)
    {
        $response = [];

        if(isset($items) && count($items))
        {
            foreach($items as $item)   
            {
                $response[] = [
                    'taxDocumentId'     => (int) $item->id,
                    'title'             => $item->title,
                    'additionalLink'    => $item->additional_link ? $item->additional_link : '',
                    'notes'             => $item->notes,
                    'status'            => $item->status ? $item->status : 1,
                    'created'           => date('d-m-Y', strtotime($item->created_at))
                ];
            }
        }

        return $response;
    }

    public function allCompaniesTransform($items)
    {
        $response   = [];
        $totalCash  = 0;
        $totalLabel = 'Total Cash';

        if(isset($items) && count($items))
        {
            foreach($items as $item)   
            {
                $totalCash = $totalCash + $item->amount;

                $response[] = [
                    'companyId'             => (int) $item->id,
                    'companyCategoryId'     => isset($item->company_category->id) ? (int) $item->company_category->id : 0,
                    'fundId'                => isset($item->fund) ? (int) $item->fund->id : 0,
                    'fundTitle'             => isset($item->fund) ? $item->fund->title : '',
                    'companyCategoryTitle'  => isset($item->company_category) ? $item->company_category->title : '',
                    'title'                 => $item->title,    
                    'amount'                => $item->amount,
                    'percentage'            => $item->percentage,
                    'notes'                 => $item->notes,
                    'status'                => $item->status ? $item->status : 1,
                    'created'               => date('d-m-Y', strtotime($item->created_at))
                ];
            }
        }

        return [
            'label'     => $totalLabel,
            'totalCash' => $totalCash,
            'companies' => $response
        ];
    }

    public function fundDetailsTransform($fund)
    {
        $notes       = [];
        $documents   = [];
        $companyData = [];
        $contacts    = [];
        $response    = [
            'fundId'        => (int) $fund->id,
            'fundTitle'     => $fund->title,
            'inceptionDate' => date('d M y', strtotime($fund->inception_date)),
            'assetClass'    => (string) $fund->asset_class,
            'fundSize'      => $fund->fund_size,
            'description'   => $fund->description,
            'totalInvested' => isset($fund->fund_companies) ? $fund->fund_companies->sum('amount') : 0,
            'companies'     => $companyData,
            'contacts'      => $contacts,
            'documents'     => $documents,
            'notes'         => $notes
        ];

        if(isset($fund->fund_companies) && count($fund->fund_companies))
        {
            foreach($fund->fund_companies as $company)
            {
                $companyData[$company->company_category->title][] = [
                        'companyCategoryId'     => (int) $company->company_category->id,
                        'companyId'             => $company->id,
                        'companyTitle'          => $company->title,
                        'amount'                => $company->amount,
                        'percentage'            => $company->percentage,
                    ];
            }
        }

        if(isset($fund->fund_documents) && count($fund->fund_documents))
        {
            foreach($fund->fund_documents as $document)
            {
                $documents[] = [
                        'documentId'        => (int) $document->id,
                        'title'             => $document->title,
                        'category'          => $document->amount,
                        'additional_link'   => $document->additional_link,
                        'description'       => $document->description
                    ];
            }
        }

        if(isset($fund->fund_notes) && count($fund->fund_notes))
        {
            foreach($fund->fund_notes as $note)
            {
                $notes[][] = [
                        'noteId'        => (int) $note->id,
                        'title'         => $note->title,
                        'title_by'      => $note->title_by,
                        'description'   => $note->description
                    ];
            }
        }

        if(isset($fund->fund_contacts) && count($fund->fund_contacts))
        {
            foreach($fund->fund_contacts as $contact)
            {
                $notes[][] = [
                        'contactId'     => (int) $contact->id,
                        'title'         => $contact->title,
                        'company'       => $contact->company,
                        'designation'   => $contact->designation
                    ];
            }
        }

        $response['companies']  = $companyData;
        $response['contacts']   = $contacts;
        $response['documents']  = $documents;
        $response['notes']      = $notes;

        return $response;
    }
}
