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
use App\Repositories\ToDo\EloquentToDoRepository;
use App\Repositories\TaxDocument\EloquentTaxDocumentRepository;
use App\Repositories\FinancialSummary\EloquentFinancialSummaryRepository;
use App\Repositories\Company\EloquentCompanyRepository;

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
        $this->toDoRepository       = new EloquentToDoRepository;
        $this->taxRepository        = new EloquentTaxDocumentRepository;
        $this->financialRepository  = new EloquentFinancialSummaryRepository;
        $this->companyRepository    = new EloquentCompanyRepository;
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

    /**
     * Get All Todos
     * 
     * @param  Request $request
     * @return json
     */
    public function getAllTodos(Request $request)
    {
        $user   = (object) $this->getApiUserInfo();
        $todos  = $this->toDoRepository->getAllByUserId($user->userId);

        if($todos && count($todos))
        {
            $responseData = $this->masterTransformer->allToDosTransform($todos);

            return $this->successResponse($responseData);
        }

        $error = [
            'reason' => 'Unable to find ToDos!'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'No ToDo Found !'); 
    }

    /**
     * Create Todos
     * 
     * @param  Request $request
     * @return json
     */
    public function createTodos(Request $request)
    {
        if($request->get('title') && $request->get('notes'))
        {
            $user   = (object) $this->getApiUserInfo();
            $data   = [
                'user_id'   => $user->userId,
                'title'     => $request->get('title'),
                'notes'     => $request->get('notes')
            ];

            $todos  = $this->toDoRepository->create($data);

            if($todos && count($todos))
            {
                $responseData = $this->masterTransformer->singleToDosTransform($todos);

                return $this->successResponse($responseData);
            }
        }

        $error = [
            'reason' => 'Unable to Create New ToDos!'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'Unable to Create New ToDos !');    
    }

    /**
     * Update Todos
     * 
     * @param  Request $request
     * @return json
     */
    public function updateTodos(Request $request)
    {
        if($request->get('toDoId') && $request->get('status'))
        {
            $user   = (object) $this->getApiUserInfo();
            $data   = [
                'status'   => $request->get('status')
            ];

            $status  = $this->toDoRepository->update($request->get('toDoId'), $data);

            if($status)
            {
                $todos = $this->toDoRepository->getById($request->get('toDoId'));

                if($todos && count($todos))
                {
                    $responseData = $this->masterTransformer->singleToDosTransform($todos);

                    return $this->successResponse($responseData);
                }
            }

        }

        $error = [
            'reason' => 'Unable to Update ToDo!'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'Unable to Update ToDos !');    
    }

    public function getAllTaxDocuments(Request $request)
    {
        $user   = (object) $this->getApiUserInfo();
        $todos  = $this->taxRepository->getAll($user->userId);

        if($todos && count($todos))
        {
            $responseData = $this->masterTransformer->allTaxDocumentsTransform($todos);

            return $this->successResponse($responseData);
        }

        $error = [
            'reason' => 'Unable to find Tax Documents !'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'No ToDo Found !');         
    }

    public function getAllFinancialStatments(Request $request)
    {
        $user   = (object) $this->getApiUserInfo();
        $todos  = $this->financialRepository->getAll($user->userId);

        if($todos && count($todos))
        {
            $responseData = $this->masterTransformer->allFinancialSummaryTransform($todos);

            return $this->successResponse($responseData);
        }

        $error = [
            'reason' => 'Unable to find ToDos!'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'No ToDo Found !');         
    }

    public function getAllUserCompanies(Request $request)
    {
        $user       = (object) $this->getApiUserInfo();
        $companies  = $this->companyRepository->getAllByUserId($user->userId);

        if($companies && count($companies))
        {
            $responseData = $this->masterTransformer->allCompaniesTransform($companies);

            return $this->successResponse($responseData);
        }

        $error = [
            'reason' => 'Unable to find Company!'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'No Company Found !'); 
    }

    public function getFinancialSummary(Request $request)
    {
        $user               = (object) $this->getApiUserInfo();
        $companies          = $this->companyRepository->getAllWithRelation();
        $financialStatments  = $this->financialRepository->getAll($user->userId);
        $taxDocuments       = $this->taxRepository->getAll($user->userId);

        $companiesRespone = $this->masterTransformer->allCompaniesTransform($companies);
        $financialsRespone = $this->masterTransformer->allFinancialSummaryTransform($financialStatments);
        $taxRespone = $this->masterTransformer->allTaxDocumentsTransform($taxDocuments);

        $responseData = [
            'cashSummary'       => $companiesRespone,
            'financialStatment' => $financialsRespone,
            'taxDocuments'      => $taxRespone
        ];

        return $this->successResponse($responseData);
    }

    public function getFundById(Request $request)
    {
        if($request->get('fundId'))
        {
            $user   = (object) $this->getApiUserInfo();
            $fund   = $this->entityRepository->getFundById($user->userId, $request->get('fundId'));

            if(isset($fund) && count($fund))
            {
                $responseData = $this->masterTransformer->fundDetailsTransform($fund);

                return $this->successResponse($responseData);
            }
        }

        $error = [
            'reason' => 'Unable to find Fund or Invalid Input !'
        ];

        return $this->setStatusCode(400)->failureResponse($error, 'No Fund Found or Invalid Input !'); 
    }

    public function getGoogleNews(Request $request)
    {
        $url        = 'https://news.google.com/news/rss/?gl=US&ned=us';
        $keyword    = $request->get('keyword');

        if(isset($keyword) && !empty($keyword))
        {
            $url = 'https://news.google.com/news/rss/search/section/q/' .$keyword. '/' .$keyword. '?hl=en&gl=US&ned=us'; 
        }
        
        $news   = simplexml_load_file(urlencode($url));
        $feeds  = [];
        $i      = 0;

        foreach ($news->channel->item as $item) 
        {
            if($i > 15)
                break;

            $feeds[] = [
                'title'         => (string) $item->title,
                'link'          => (string) $item->link,
                'categoryTitle' => (string) $item->category,
                'description'   => strip_tags($item->description)
            ];

            $i++;
        }

        return $this->successResponse($feeds);
    }
}
