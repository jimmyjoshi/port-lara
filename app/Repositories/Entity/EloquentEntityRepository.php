<?php namespace App\Repositories\Entity;

use App\Models\Entity\Entity;
use App\Models\Access\User\User;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentEntityRepository extends DbRepository
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
	public $moduleTitle = 'Entity';

	/**
	 * Table Headers
	 *
	 * @var array
	 */
	public $tableHeaders = [
		'title' 			=> 'Title',
		'inception_date' 	=> 'Inception Date',
		'asset_class' 		=> 'Asset Class',
		'fund_size' 		=> 'Fund Size',
		'status' 			=> 'Status',
		'description' 		=> 'Description',
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
		'inception_date' => [
			'data' 			=> 'inception_date',
			'name' 			=> 'inception_date',
			'searchable' 	=> false, 
			'sortable'		=> false
		],
		'asset_class' => [
			'data' 			=> 'asset_class',
			'name' 			=> 'asset_class',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'fund_size' => [
			'data' 			=> 'fund_size',
			'name' 			=> 'fund_size',
			'searchable' 	=> false, 
			'sortable'		=> false
		],
		'status' => [
			'data' 			=> 'status',
			'name' 			=> 'status',
			'searchable' 	=> false, 
			'sortable'		=> false
		],
		'description' =>	[
			'data' 			=> 'description',
			'name' 			=> 'description',
			'searchable' 	=> true, 
			'sortable'		=> true
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
		'listRoute' 	=> 'entities.index',
		'createRoute' 	=> 'entities.create',
		'storeRoute' 	=> 'entities.store',
		'editRoute' 	=> 'entities.edit',
		'updateRoute' 	=> 'entities.update',
		'deleteRoute' 	=> 'entities.destroy',
		'dataRoute' 	=> 'entities.get-list-data'
	];

	/**
	 * Module Views
	 * 
	 * @var array
	 */
	public $moduleViews = [
		'listView' 		=> 'entity.index',
		'createView' 	=> 'entity.create',
		'editView' 		=> 'entity.edit',
		'deleteView' 	=> 'entity.destroy',
	];

	/**
	 * Construct
	 *
	 */
	public function __construct()
	{
		$this->model 		= new Entity;
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
			$this->model->getTable().'.description',
			$this->model->getTable().'.inception_date',
			$this->model->getTable().'.fund_size',
			$this->model->getTable().'.asset_class',
			$this->model->getTable().'.status'
		];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
    	return  $this->model->select($this->getTableFields())->get();
        
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
    	if($isCreate)
    	{
    		$input = array_merge($input, ['user_id' => access()->user()->id]);
    	}


    	if(isset($input['ince']))
    	{
    		$input['start_date'] = date('Y-m-d', strtotime($input['start_date']));
    	}

    	if(isset($input['end_date']))
    	{
    		$input['end_date'] = date('Y-m-d', strtotime($input['end_date']));
    	}

    	if(! isset($input['start_date']))
    	{
    		$input['start_date'] = date('Y-m-d');
    	}

    	if(! isset($input['end_date']))
    	{
    		$input['end_date'] = date('Y-m-d');
    	}

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

    	unset($clientHeaders['username']);

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

    	unset($clientColumns['username']);
    	
    	return json_encode($this->setTableStructure($clientColumns));
    }

    /**
     * Get By UserId
     * 
     * @param int $userId
     * @return object
     */
    public function getByUserId($userId = null)
    {
    	if($userId)
    	{
    		return $this->model->where('user_id', $userId)->get();
    	}

    	return false;
    }

    public function getFundById($userId = null, $fundId = null)
    {
    	if($userId && $fundId)
    	{
    		return $this->model->with('fund_companies')->where(['user_id' => $userId, 'id' => $fundId])->first();
    	}
    }
}