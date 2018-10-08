<?php

namespace App\Api\V1\Controllers\Masters;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use JWTAuth;
use Dingo\Api\Routing\Helpers;
use Dingo\Api\Exception\ValidationHttpException;

class MasterCallController extends Controller
{

	public function task_form()
	{
		$data['worktypes_list'] = $this->worktypes_list();
		$data['department_fulllist'] = $this->department_fulllist();
		return response()->json([
				'status' => true,
				'status_code' => 200,
				'message' => 'Task form master data',
				'data' => $data
				]);
	}

	public function select_company()
	{
		$data['companies'] = $this->companies();
		return response()->json([
				'status' => true,
				'status_code' => 200,
				'message' => 'Companies List',
				'data' => $data
				]);
	}

	public function companies()
	{
		$companies = app('App\Api\V1\Controllers\Masters\CompanyController')->companies_list();
		return $companies;
	}

	public function users_list()
	{
		$users_list = app('App\Api\V1\Controllers\Authentication\UserController')->users_list();
		$users_list = $users_list->original['data'];
		return $users_list;
	}

	public function worktypes_list()
	{
		$worktypes_list = app('App\Api\V1\Controllers\Masters\WorkTypeController')->full_list();
		$worktypes_list = $worktypes_list->original['data'];
		return $worktypes_list;
	}

	public function department_fulllist()
	{
		$department_fulllist = app('App\Api\V1\Controllers\Masters\DepartmentController')->full_list();
		$department_fulllist = $department_fulllist->original['data'];
		return $department_fulllist;
	}


}


?>