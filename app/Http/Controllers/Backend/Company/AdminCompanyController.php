<?php

namespace App\Http\Controllers\Backend\Company;

use Html;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Company\EloquentCompanyRepository;
use App\Models\Access\User\User;
use App\Models\CompanyCategory\CompanyCategory;
use App\Models\Entity\Entity;

/**
 * Class AdminCompanyController
 */
class AdminCompanyController extends Controller
{
	/**
	 * Event Repository
	 * 
	 * @var object
	 */
	public $repository;

    /**
     * Create Success Message
     * 
     * @var string
     */
    protected $createSuccessMessage = "Company Created Successfully!";

    /**
     * Edit Success Message
     * 
     * @var string
     */
    protected $editSuccessMessage = "Company Edited Successfully!";

    /**
     * Delete Success Message
     * 
     * @var string
     */
    protected $deleteSuccessMessage = "Company Deleted Successfully";

	/**
	 * __construct
	 * 
	 */
	public function __construct()
	{
        $this->repository       = new EloquentCompanyRepository;
        $this->userModel        = new User;
        $this->companyCateogry  = new CompanyCategory;
        $this->entity           = new Entity;
	}

    /**
     * Event Listing 
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->repository->setAdmin(true)->getModuleView('listView'))->with([
            'repository' => $this->repository
        ]);
    }

    public function show()
    {

    }

    /**
     * Event View
     * 
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $users      = $this->userModel->all()->pluck('name', 'id')->toArray();
        $categories = $this->companyCateogry->all()->pluck('title', 'id')->toArray();
        $entities   = $this->entity->all()->pluck('title', 'id')->toArray();


        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository'    => $this->repository,
            'users'         => $users,
            'categories'    => $categories,
            'entities'      => $entities
        ]);
    }

    /**
     * Store View
     * 
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $this->repository->create($input);

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * Event View
     * 
     * @return \Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $event      = $this->repository->findOrThrowException($id);
        $users      = $this->userModel->all()->pluck('name', 'id')->toArray();
        $categories = $this->companyCateogry->all()->pluck('title', 'id')->toArray();
        $entities   = $this->entity->all()->pluck('title', 'id')->toArray();


        return view($this->repository->setAdmin(true)->getModuleView('editView'))->with([
             'item'         => $event,
            'repository'    => $this->repository,
            'users'         => $users,
            'categories'    => $categories,
            'entities'      => $entities
        ]);
    }

    /**
     * Event Update
     * 
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        $status = $this->repository->update($id, $input);
        
        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * Event Update
     * 
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        $status = $this->repository->destroy($id);
        
        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->deleteSuccessMessage);
    }

  	/**
     * Get Table Data
     *
     * @return json|mixed
     */
    public function getTableData()
    {
        return Datatables::of($this->repository->getForDataTable())
		    ->escapeColumns(['title', 'sort'])
            ->escapeColumns(['username', 'sort'])
            ->escapeColumns(['notes', 'sort'])
            ->addColumn('status', function ($item) {
                return $item->status == 1 ? 'Pending' : 'Completed';
            })
            ->addColumn('actions', function ($event) {
                return $event->admin_action_buttons;
            })
		    ->make(true);
    }
}
