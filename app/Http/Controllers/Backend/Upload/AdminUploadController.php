<?php

namespace App\Http\Controllers\Backend\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Upload\EloquentUploadRepository;
use App\Repositories\DocumentCategory\EloquentDocumentCategoryRepository;
use URL;

/**
 * Class AdminUploadController
 */
class AdminUploadController extends Controller
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
    protected $createSuccessMessage = "New File Created Successfully!";

    /**
     * Edit Success Message
     * 
     * @var string
     */
    protected $editSuccessMessage = "New File Successfully!";

    /**
     * Delete Success Message
     * 
     * @var string
     */
    protected $deleteSuccessMessage = "New File Successfully";

	/**
	 * __construct
	 * 
	 */
	public function __construct()
	{
        $this->repository       = new EloquentUploadRepository;
        $this->documentCategory = new EloquentDocumentCategoryRepository;
	}

    /**
     * Event Listing 
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->repository->setAdmin(true)->getModuleView('listView'))->with([
            'repository'        => $this->repository,
            
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
        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository'        => $this->repository,
            'documentCategory'  => $this->documentCategory
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

        if($request->file('upload_file'))
        {
            $imageName  = rand(11111, 99999) . '_uploads.' . $request->file('upload_file')->getClientOriginalExtension();
            $request->file('upload_file')->move(base_path() . '/public/uploads/media/', $imageName);
            $input = array_merge($request->all(), ['upload_file' => $imageName]);
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
        $status = $this->repository->update($id, $request->all());
        
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
            ->escapeColumns(['category_title', 'sort'])
            ->escapeColumns(['doc_type', 'sort'])
            ->addColumn('doc_type', function ($item) 
            {
                return ( $item->doc_type == 1 ) ? 'Internal' : 'External';
            })
            ->addColumn('external_link', function ($item) 
            {
                return ( $item->doc_type != 1 ) ? '<a target="_blank" href="'.$item->external_link.'">Download</a>' : '<a href="'.URL::to('/').'/uploads/media/'.$item->upload_file.'"  target="_blank">Download</a>' ;
            })
            
            ->addColumn('status', function ($event) 
            {
                return ($event->status == 1) ? 'Active' : 'InActive';
            })
            ->addColumn('actions', function ($event) {
                return $event->admin_action_buttons;
            })
		    ->make(true);
    }
}
