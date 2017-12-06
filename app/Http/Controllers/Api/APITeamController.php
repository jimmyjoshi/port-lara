<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Transformers\APITransformer;
use App\Http\Controllers\Api\BaseApiController;
use App\Repositories\Team\EloquentTeamRepository;
use App\Repositories\Contact\EloquentContactRepository;

class APITeamController extends BaseApiController 
{   
    /**
     * Event Transformer
     * 
     * @var Object
     */
    protected $eventTransformer;

    /**
     * Repository
     * 
     * @var Object
     */
    protected $repository;

    /**
     * __construct
     * 
     * @param EventTransformer $eventTransformer
     */
    public function __construct()
    {
        parent::__construct();

        $this->repository           = new EloquentTeamRepository;
        $this->contactRepository    = new EloquentContactRepository;
        $this->apiTransformer       = new APITransformer;
    }

    /**
     * List of All Events
     * 
     * @param Request $request
     * @return json
     */
    public function index(Request $request) 
    {
        $members  = $this->repository->getAll();
        
        if($members && count($members))
        {
            $responseData = $this->apiTransformer->getTeamMembers($members);
            return $this->successResponse($responseData);
        }

        $error = [
            'reason' => 'Unable to find Team Members!'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'No Team Members Found !');
    }

    public function getContacts(Request $request)
    {
        $members  = $this->contactRepository->getAll();
        
        if($members && count($members))
        {
            $responseData = $this->apiTransformer->getContacts($members);
            return $this->successResponse($responseData);
        }

        $error = [
            'reason' => 'Unable to find Team Members!'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'No Team Members Found !');
    }
}
