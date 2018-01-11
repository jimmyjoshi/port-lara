<?php

namespace App\Http\Controllers\Backend\TeamMember;

use Html;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\TeamMember\EloquentTeamMemberRepository;
use App\Models\Team\Team;

/**
 * Class AdminTeamMemberController
 */
class AdminTeamMemberController extends Controller
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
    protected $createSuccessMessage = "Team Member Created Successfully!";

    /**
     * Edit Success Message
     * 
     * @var string
     */
    protected $editSuccessMessage = "Team Member Edited Successfully!";

    /**
     * Delete Success Message
     * 
     * @var string
     */
    protected $deleteSuccessMessage = "Team Member Deleted Successfully";

	/**
	 * __construct
	 * 
	 */
	public function __construct()
	{
        $this->repository       = new EloquentTeamMemberRepository;
        $this->teamRepository   = new Team;
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
        $teams = $this->teamRepository->all()->pluck('title', 'id')->toArray();

        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository'    => $this->repository,
            'teams'         => $teams
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

        return view($this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'          => $event,
            'repository'    => $this->repository
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

        if($request->file('profile_picture'))
        {
            $imageName  = rand(11111, 99999) . '_team_member.' . $request->file('profile_picture')->getClientOriginalExtension();
            $request->file('profile_picture')->move(base_path() . '/public/uploads/team/', $imageName);
            $input = array_merge($request->all(), ['profile_picture' => $imageName]);
        }

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
            ->escapeColumns(['company', 'sort'])
            ->escapeColumns(['designation', 'sort'])
            ->escapeColumns(['contact_number', 'sort'])
            ->escapeColumns(['profile_picture'])
            ->escapeColumns(['description', 'sort'])
            ->addColumn('status', function ($event) 
            {
                return ($event->status == 1) ? 'Active' : 'InActive';
            })
            ->addColumn('profile_picture', function ($item) 
            {
                $image = isset($item->profile_picture) ? $item->profile_picture : 'default.png';
                return  Html::image('/uploads/team/'.$image, $image, ['width' => 60, 'height' => 60]);
            })
            ->addColumn('category', function ($event) 
            {
                return ($event->category == 1) ? 'Inside' : 'Outside';
            })
            ->addColumn('actions', function ($event) {
                return $event->admin_action_buttons;
            })
		    ->make(true);
    }
}
