<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Transformers\APITransformer;
use App\Http\Transformers\APIMasterTransformer;
use App\Http\Controllers\Api\BaseApiController;
use App\Repositories\Team\EloquentTeamRepository;
use App\Repositories\Contact\EloquentContactRepository;
use App\Repositories\DocumentCategory\EloquentDocumentCategoryRepository;
use App\Repositories\Upload\EloquentUploadRepository;
use App\Repositories\Entity\EloquentEntityRepository;

class APIMasterController extends BaseApiController 
{   
    public $masterTransformer;

    /**
     * __construct
     * 
     * @param EventTransformer $eventTransformer
     */
    public function __construct()
    {
        parent::__construct();

        $this->documentRepository   = new EloquentDocumentCategoryRepository;
        $this->masterTransformer    = new APIMasterTransformer;
        $this->entityRepository     = new EloquentEntityRepository;
        $this->uploadRepository     = new EloquentUploadRepository;
    }

   public function getDocumentCategories(Request $request)
   {
        $categories = $this->documentRepository->getAll();

        if($categories && count($categories))
        {
            $responseData = $this->masterTransformer->documentCategoryTransform($categories);

            return $this->successResponse($responseData);
        }

        $error = [
            'reason' => 'Unable to find Document Categories!'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'No Document Category Found !');
   }

   public function getAllDocuments(Request $request)
   {
        $categories = $this->uploadRepository->getAll();

        if($categories && count($categories))
        {
            $responseData = $this->masterTransformer->documentUploadTransform($categories);

            return $this->successResponse($responseData);
        }

        $error = [
            'reason' => 'Unable to find Document Categories!'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'No Document Category Found !'); 
   }

   public function getAllEntities(Request $request)
   {
        $entities = $this->entityRepository->getAll();

        if($entities && count($entities))
        {
            $responseData = $this->masterTransformer->allEntitiesTransform($entities);

            return $this->successResponse($responseData);
        }

        $error = [
            'reason' => 'Unable to find Document Categories!'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'No Document Category Found !'); 
   }
}
