<?php

namespace App\Http\Controllers\Backend\FundNote;

use Html;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Entity\Entity;
use App\Repositories\FundNote\EloquentFundNoteRepository;

/**
 * Class AdminFundNoteController
 */
class AdminFundNoteController extends Controller
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
    protected $createSuccessMessage = "Entity Note Created Successfully!";

    /**
     * Edit Success Message
     * 
     * @var string
     */
    protected $editSuccessMessage = "Entity Note Edited Successfully!";

    /**
     * Delete Success Message
     * 
     * @var string
     */
    protected $deleteSuccessMessage = "Entity Note Deleted Successfully";

	/**
	 * __construct
	 * 
	 */
	public function __construct()
	{
        $this->repository       = new EloquentFundNoteRepository;
        $this->entityRepository = new Entity;
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
        $entities = $this->entityRepository->all()->pluck('title', 'id')->toArray();

        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository'    => $this->repository,
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
        $entities   = $this->entityRepository->all()->pluck('title', 'id')->toArray();

        return view($this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'          => $event,
            'repository'    => $this->repository,
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
            ->escapeColumns(['notes', 'sort'])
            ->addColumn('additional_link', function ($item) {
                return strlen($item->additional_link ) > 2 ? '<a target="_blank" href="' . $item->additional_link . '">View Details</a>' : '-';
            })
            ->addColumn('status', function ($item) {
                return $item->status == 1 ? 'Active' : 'InActive';
            })
            ->addColumn('actions', function ($event) {
                return $event->admin_action_buttons;
            })
            ->make(true);
    }
}
