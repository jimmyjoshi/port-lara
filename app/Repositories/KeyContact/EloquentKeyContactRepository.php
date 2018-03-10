<?php namespace App\Repositories\KeyContact;

use App\Models\KeyContact\KeyContact;
use App\Models\Access\User\User;
use App\Models\Entity\Entity;
use App\Models\Company\Company;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentKeyContactRepository extends DbRepository
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
	public $moduleTitle = 'Key Contact';

	/**
	 * Table Headers
	 *
	 * @var array
	 */
	public $tableHeaders = [
		'title' 			=> 'Title',
		'company_title'		=> 'Company Name',
		'designation' 		=> 'Designation',
		'contact_number' 	=> 'Contact Number',
		'email_id' 			=> 'Email Id',
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
		'company_title' => [
			'data' 			=> 'company_title',
			'name' 			=> 'company_title',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'designation' => [
			'data' 			=> 'designation',
			'name' 			=> 'designation',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'contact_number' => [
			'data' 			=> 'contact_number',
			'name' 			=> 'contact_number',
			'searchable' 	=> false, 
			'sortable'		=> false
		],
		'email_id' => [
			'data' 			=> 'email_id',
			'name' 			=> 'email_id',
			'searchable' 	=> false, 
			'sortable'		=> false
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
		'listRoute' 	=> 'key-contacts.index',
		'createRoute' 	=> 'key-contacts.create',
		'storeRoute' 	=> 'key-contacts.store',
		'editRoute' 	=> 'key-contacts.edit',
		'updateRoute' 	=> 'key-contacts.update',
		'deleteRoute' 	=> 'key-contacts.destroy',
		'dataRoute' 	=> 'key-contacts.get-list-data'
	];

	/**
	 * Module Views
	 * 
	 * @var array
	 */
	public $moduleViews = [
		'listView' 		=> 'key-contact.index',
		'createView' 	=> 'key-contact.create',
		'editView' 		=> 'key-contact.edit',
		'deleteView' 	=> 'key-contact.destroy',
	];

	/**
	 * Construct
	 *
	 */
	public function __construct()
	{
		$this->model 		= new KeyContact;
		$this->entityModel 	= new Entity;
		$this->companyModel = new Company;
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
			$this->model->getTable().'.designation',
			$this->model->getTable().'.contact_number',
			$this->model->getTable().'.email_id',
			$this->model->getTable().'.description',
			$this->model->getTable().'.status',
			$this->companyModel->getTable().'.title as company_title',
		];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
    	return  $this->model->select($this->getTableFields())
    			->leftjoin($this->companyModel->getTable(), $this->companyModel->getTable().'.id', '=', $this->model->getTable().'.company_id')->get();
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
}