<?php namespace App\Repositories\TeamMember;

use App\Models\TeamMember\TeamMember;
use App\Models\Team\Team;
use App\Models\Access\User\User;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentTeamMemberRepository extends DbRepository
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
	public $moduleTitle = 'Team Member';

	/**
	 * Table Headers
	 *
	 * @var array
	 */
	public $tableHeaders = [
		'title' 			=> 'Title',
		'team_name' 		=> 'Team',
		'category'			=> 'Category',
		'designation' 		=> 'Designation',
		'description' 		=> 'Description',
		'status' 			=> 'Status',
		'profile_picture' 	=> 'Image',
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
		'team_name' => [
			'data' 			=> 'team_name',
			'name' 			=> 'team_name',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'category' => [
			'data' 			=> 'category',
			'name' 			=> 'category',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'designation' => [
			'data' 			=> 'designation',
			'name' 			=> 'designation',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'description' => [
			'data' 			=> 'description',
			'name' 			=> 'description',
			'searchable' 	=> false, 
			'sortable'		=> false
		],
		'status' => [
			'data' 			=> 'status',
			'name' 			=> 'status',
			'searchable' 	=> false, 
			'sortable'		=> false
		],
		'profile_picture' => [
			'data' 			=> 'profile_picture',
			'name' 			=> 'profile_picture',
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
		'listRoute' 	=> 'team-members.index',
		'createRoute' 	=> 'team-members.create',
		'storeRoute' 	=> 'team-members.store',
		'editRoute' 	=> 'team-members.edit',
		'updateRoute' 	=> 'team-members.update',
		'deleteRoute' 	=> 'team-members.destroy',
		'dataRoute' 	=> 'team-members.get-list-data'
	];

	/**
	 * Module Views
	 * 
	 * @var array
	 */
	public $moduleViews = [
		'listView' 		=> 'team-member.index',
		'createView' 	=> 'team-member.create',
		'editView' 		=> 'team-member.edit',
		'deleteView' 	=> 'team-member.destroy',
	];

	/**
	 * Construct
	 *
	 */
	public function __construct()
	{
		$this->model 		= new TeamMember;
		$this->teamModel 	= new Team;
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
			$this->model->getTable().'.category',
			$this->model->getTable().'.contact_number',
			$this->model->getTable().'.profile_picture',
			$this->model->getTable().'.description',
			$this->model->getTable().'.status',
			$this->teamModel->getTable().'.title as team_name'
			
		];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
    	return  $this->model->select($this->getTableFields())->leftjoin($this->teamModel->getTable(), $this->teamModel->getTable().'.id', '=', $this->model->getTable().'.team_id')->get();
        
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
     * Get Members By TeamId
     * 
     * @param int $teamId
     * @return mixed
     */
    public function getMembersByTeamId($teamId = null)
    {
    	if($teamId)
    	{
    		return $this->model->where('team_id', $teamId)->get();
    	}

    	return false;
    }
}