<?php namespace App\Models\Company\Traits\Attribute;

/**
 * Trait Attribute
 *
 * @author Anuj Jaha
 */

use App\Repositories\Company\EloquentCompanyRepository;

trait Attribute
{
	/**
	 * @return string
	 */
	public function getEditButtonAttribute($routes, $prefix = 'admin', $isAdmin = false)
	{
		if($isAdmin)
		{
			$id = $this->id;	
		}
		else
		{
			$id = hasher()->encode($this->id);
		}
		return '<a href="'.route($prefix .'.'. $routes->editRoute, $id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> ';
	}

	/**
	 * @return string
	 */
	public function getDeleteButtonAttribute($routes, $prefix = 'admin')
	{
	    return '<a href="'.route($prefix .'.'. $routes->deleteRoute, $this).'"
	            data-method="delete"
	            data-trans-button-cancel="Cancel"
	            data-trans-button-confirm="Delete"
	            data-trans-title="Do you want to Delete this Item ?"
	            class="btn btn-xs btn-danger"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>';
	}

	/**
	 * @return string
	 */
	public function getActionButtonsAttribute()
	{
		$repository = new EloquentCompanyRepository;

		$routes = $repository->getModuleRoutes();

		return $this->getEditButtonAttribute($routes, $repository->clientRoutePrefix) . $this->getDeleteButtonAttribute($routes, $repository->clientRoutePrefix);
	}   

	/**
	 * @return string
	 */
	public function getAdminActionButtonsAttribute()
	{
		$repository = new EloquentCompanyRepository;

		$routes = $repository->getModuleRoutes();

		return $this->getEditButtonAttribute($routes, $repository->adminRoutePrefix, true) . $this->getDeleteButtonAttribute($routes, $repository->adminRoutePrefix);
	}   
}