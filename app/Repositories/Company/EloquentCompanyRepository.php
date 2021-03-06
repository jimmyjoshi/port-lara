<?php namespace App\Repositories\Company;

use App\Models\Company\Company;
use App\Models\Access\User\User;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentCompanyRepository extends DbRepository
{
	/**
	 * Event Model
	 * 
	 * @var Object
	 */
	public $model;

	/**
	 * Module Title
	 * 
	 * @var string
	 */
	public $moduleTitle = 'Company';

	/**
	 * Table Headers
	 *
	 * @var array
	 */
	public $tableHeaders = [
		'title' 			=> 'Title',
		'username' 			=> 'User Name',
		'amount' 			=> 'Amount',
		'percentage' 		=> 'Percentage',
		'notes' 			=> 'Note',
		'status' 			=> 'Status',
		'actions' 			=> 'Actions'
	];

	/**
	 * Table Columns
	 *
	 * @var array
	 */
	public $tableColumns = [
		'title' => [
			'data' 			=> 'title',
			'name' 			=> 'title',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'username' => [
			'data' 			=> 'username',
			'name' 			=> 'username',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'amount' => [
			'data' 			=> 'amount',
			'name' 			=> 'amount',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'percentage' => [
			'data' 			=> 'percentage',
			'name' 			=> 'percentage',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'notes' => [
			'data' 			=> 'notes',
			'name' 			=> 'notes',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'status' => [
			'data' 			=> 'status',
			'name' 			=> 'status',
			'searchable' 	=> false, 
			'sortable'		=> false
		],
		'actions' => [
			'data' 			=> 'actions',
			'name' 			=> 'actions',
			'searchable' 	=> false, 
			'sortable'		=> false
		]
	];

	/**
	 * Is Admin
	 * 
	 * @var boolean
	 */
	protected $isAdmin = false;

	/**
	 * Admin Route Prefix
	 * 
	 * @var string
	 */
	public $adminRoutePrefix = 'admin';

	/**
	 * Client Route Prefix
	 * 
	 * @var string
	 */
	public $clientRoutePrefix = 'frontend';

	/**
	 * Admin View Prefix
	 * 
	 * @var string
	 */
	public $adminViewPrefix = 'backend';

	/**
	 * Client View Prefix
	 * 
	 * @var string
	 */
	public $clientViewPrefix = 'frontend';

	/**
	 * Module Routes
	 * 
	 * @var array
	 */
	public $moduleRoutes = [
		'listRoute' 	=> 'company.index',
		'createRoute' 	=> 'company.create',
		'storeRoute' 	=> 'company.store',
		'editRoute' 	=> 'company.edit',
		'updateRoute' 	=> 'company.update',
		'deleteRoute' 	=> 'company.destroy',
		'dataRoute' 	=> 'company.get-list-data'
	];

	/**
	 * Module Views
	 * 
	 * @var array
	 */
	public $moduleViews = [
		'listView' 		=> 'company.index',
		'createView' 	=> 'company.create',
		'editView' 		=> 'company.edit',
		'deleteView' 	=> 'company.destroy'
	];

	/**
	 * Construct
	 *
	 */
	public function __construct()
	{
		$this->model 		= new Company;
		$this->userModel 	= new User;
	}

	/**
	 * Create Event
	 *
	 * @param array $input
	 * @return mixed
	 */
	public function create($input)
	{
		$input = $this->prepareInputData($input, true);
		$model = $this->model->create($input);

		$fundPercentage = ($input['amount'] * 100 ) / $model->fund->fund_size ;

		$model->percentage = $fundPercentage;
		$model->save();

		if($model)
		{
			return $model;
		}

		return false;
	}	

	/**
	 * Update Event
	 *
	 * @param int $id
	 * @param array $input
	 * @return bool|int|mixed
	 */
	public function update($id, $input)
	{
		$model = $this->model->find($id);

		if($model)
		{
			$input = $this->prepareInputData($input);		
			
			return $model->update($input);
		}

		return false;
	}

	/**
	 * Destroy Event
	 *
	 * @param int $id
	 * @return mixed
	 * @throws GeneralException
	 */
	public function destroy($id)
	{
		$model = $this->model->find($id);
			
		if($model)
		{
			return $model->delete();
		}

		return  false;
	}

	/**
     * Get All
     *
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAll($orderBy = 'id', $sort = 'asc')
    {
    	return $this->model->all();
    }

	/**
     * Get by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id = null)
    {
    	if($id)
    	{
    		return $this->model->find($id);
    	}
        
        return false;
    }   

    /**
     * Get Table Fields
     * 
     * @return array
     */
    public function getTableFields()
    {
    	return [
			$this->model->getTable().'.id as id',
			$this->model->getTable().'.title',
			$this->model->getTable().'.amount',
			$this->model->getTable().'.percentage',
			$this->model->getTable().'.notes',
			$this->model->getTable().'.status',
			$this->userModel->getTable().'.name as username'
		];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
    	return  $this->model->select($this->getTableFields())
    			->leftjoin($this->userModel->getTable(), $this->userModel->getTable().'.id', '=', $this->model->getTable().'.user_id')->get();
    }

    /**
     * Set Admin
     *
     * @param boolean $isAdmin [description]
     */
    public function setAdmin($isAdmin = false)
    {
    	$this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Prepare Input Data
     * 
     * @param array $input
     * @param bool $isCreate
     * @return array
     */
    public function prepareInputData($input = array(), $isCreate = false)
    {
    	return $input;
    }

    /**
     * Get Table Headers
     * 
     * @return string
     */
    public function getTableHeaders()
    {
    	if($this->isAdmin)
    	{
    		return json_encode($this->setTableStructure($this->tableHeaders));
    	}

    	$clientHeaders = $this->tableHeaders;

    	return json_encode($this->setTableStructure($clientHeaders));
    }

	/**
     * Get Table Columns
     *
     * @return string
     */
    public function getTableColumns()
    {
    	if($this->isAdmin)
    	{
    		return json_encode($this->setTableStructure($this->tableColumns));
    	}

    	$clientColumns = $this->tableColumns;

    	return json_encode($this->setTableStructure($clientColumns));
    }

    /**
     * Get All By UserId
     * 
     * @param int $userId
     * @return object
     */
    public function getAllByUserId($userId = null)
    {
    	if($userId)
    	{
    		return $this->model->with(['fund', 'company_category'])->where('user_id', $userId)->get();
    	}

    	return false;
    }

    /* Get All By UserId
     * 
     * @param int $userId
     * @return object
     */
    public function getAllWithRelation()
    {
    	return $this->model->with(['fund', 'company_category'])->get();
    }

    public function getCompanyById($userId = null, $companyId = null)
    {
    	if($userId && $companyId)
    	{	
    		return $this->model->with(['fund', 'company_documents', 'company_contacts', 'company_notes', 'company_todos'])->where('id', $companyId)->first();
    	}
    }
}