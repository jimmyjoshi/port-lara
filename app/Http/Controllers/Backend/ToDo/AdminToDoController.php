<?php

namespace App\Http\Controllers\Backend\ToDo;

use Html;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\ToDo\EloquentToDoRepository;
use App\Models\Access\User\User;
use App\Models\Company\Company;


/**
 * Class AdminToDoController
 */
class AdminToDoController extends Controller
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
    protected $createSuccessMessage = "Company ToDo Created Successfully!";

    /**
     * Edit Success Message
     * 
     * @var string
     */
    protected $editSuccessMessage = "Company ToDo Edited Successfully!";

    /**
     * Delete Success Message
     * 
     * @var string
     */
    protected $deleteSuccessMessage = "Company ToDo Deleted Successfully";

	/**
	 * __construct
	 * 
	 */
	public function __construct()
	{
        $this->repository   = new EloquentToDoRepository;
        $this->userModel    = new User;
        $this->companyModel = new Company;
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
        $companies  = $this->companyModel->all()->pluck('title', 'id')->toArray();

        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository' => $this->repository,
            'users'      => $users,
            'companies'  => $companies
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

        if($request->file('profile_picture'))
        {
            $imageName  = rand(11111, 99999) . '_team_member.' . $request->file('profile_picture')->getClientOriginalExtension();
            $request->file('profile_picture')->move(base_path() . '/public/uploads/team/', $imageName);
            $input = array_merge($request->all(), ['profile_picture' => $imageName]);
        }

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
        $event = $this->repository->findOrThrowException($id);
        $users = $this->userModel->all()->pluck('name', 'id')->toArray();
        $companies  = $this->companyModel->all()->pluck('title', 'id')->toArray();

        return view($this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'          => $event,
            'repository'    => $this->repository,
            'users'         => $users,
            'companies'     => $companies
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
