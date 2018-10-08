<?php

namespace App\Api\V1\Controllers\Masters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Api\V1\Controllers\Authentication\TokenController;
use Illuminate\Support\Facades\DB;
use App\Model\FinishedProduct;


class FinishedProductController extends Controller
{
    public function form(Request $request)
    {
        $status = true;
        $id = $request->get('id');
        $current_company_id = TokenController::getCompanyId();
        if($id == 'new')
        {
            $count = FinishedProduct::where('product_name',$request->get('finished_product_name'))
                                ->where('company_id',$current_company_id)
                                ->count();
            if($count>0)
            {
                $status = false;
                $message = 'Please fill the form correctly!!!';
                $error['product_name'] = 'Raw Product with this name Already Exists';
            }
            else
            {
                $raw = new FinishedProduct();
                $raw->company_id = $current_company_id;
                $message = "Record added Successfully";
            }
            
        }
        else
        {
            $message = 'Record Updated Successfully';
            $raw = FinishedProduct::findOrFail($id);
        }
        if($status)
        {
            $raw->product_name = Input::get('finished_product_name');
            $raw->product_display_name = Input::get('finished_product_display_name');
            $raw->product_code = Input::get('finished_product_code');
            $raw->product_uom = Input::get('finished_product_uom');
            $raw->product_conv_uom = Input::get('finished_product_conv_uom');
            $raw->conv_factor = Input::get('finished_product_conv_factor');
            $raw->batch_type = Input::get('finished_product_batch_type');
            $raw->stock_ledger = Input::get('finished_product_maintain_stock_ledger');
            $raw->product_rate_pick = Input::get('finished_product_rate_pick_from');
            $raw->product_purchase_rate = Input::get('finished_product_purchase_rate');
            $raw->mrp_rate = Input::get('finished_product_mrp_rate');
            $raw->sales_rate = Input::get('finished_product_sales_rate');
            $raw->gst_rate = Input::get('finished_product_gst_slot');
            $raw->max_level = Input::get('finished_product_max_level');
            $raw->min_level = Input::get('finished_product_min_level');
            $raw->description = Input::get('finished_product_description');
            try
            {
                $raw->save();
            }
            catch(\Exception $e)
            {
                $status = false;
                $message = 'Something is wrong. Kindly Contact Admin';
            }
            $raw = $this->query()->where('fp.id',$raw->id)->first();
            return response()->json([
                'status' => $status,
                'data' => $raw,
                'message'=>$message
                ]);
        }
        else
        {
            return response()->json([
                'status' => $status,                
                'message'=>$message,
                'error' => $error,
                ]);
        }
       

    }

    public function query()
    {

        $current_company_id = TokenController::getCompanyId();
        $query = DB::table('finished_products as fp')
                ->leftJoin('unit_of_measurements as uom1','fp.product_uom','uom1.id')
                ->leftJoin('unit_of_measurements as uom2','fp.product_conv_uom','uom2.id')
                ->select(
                'fp.id','fp.product_name','fp.product_display_name','fp.product_code','fp.conv_factor','fp.batch_type','fp.stock_ledger','fp.product_rate_pick','fp.product_purchase_rate','fp.mrp_rate','fp.sales_rate','fp.gst_rate','fp.max_level','fp.min_level','fp.description'
                )
                ->addSelect('uom1.unit_name')
                ->addSelect('uom2.unit_name as conversion_uom')
                ->where('fp.company_id',$current_company_id);
        return $query;
    }

    public function TableColumn()
    {         
        $TableColumn = array(
                       "id"=>"fp.id",
                       "product_name"=>"fp.product_name",                       
                       "product_display_name"=>"fp.product_display_name",
                       "product_code"=>"fp.product_code",                       
                       "conv_factor"=>"fp.conv_factor",
                       "batch_type"=>"fp.batch_type",
                       "stock_ledger"=>"fp.stock_ledger",
                       "product_rate_pick"=>"fp.product_rate_pick",
                       "product_purchase_rate"=>"fp.product_purchase_rate",
                       "mrp_rate"=>"fp.mrp_rate",
                       "sales_rate"=>"fp.sales_rate",
                       "gst_rate"=>"fp.gst_rate",
                       "max_level"=>"fp.max_level",
                       "min_level"=>"fp.min_level",
                       "description"=>"fp.description",
                       );
        return $TableColumn;
    }

    public function sort($query)
    {
       $sort = \Request::get('sort');
       if(!empty($sort))
        {
            $TableColumn = $this->TableColumn();
            $query = $query->orderBy($TableColumn[key($sort)], $sort[key($sort)]);
        }
        else
           $query = $query->orderBy('product_display_name', 'ASC');
           
        return $query;      
    }

    public function search($query)
    {      
        $search = \Request::get('search');
        if(!empty($search))
        {
            $TableColumn = $this->TableColumn();
            foreach($search as $key=>$searchvalue)
            { 
                if($searchvalue !== '') 
                    $query =  $query->Where($TableColumn[$key], 'LIKE', '%'.$searchvalue.'%');
            }
        }

        return $query;
    }

    //use Helpers;
    public function index()
    {
        $limit = 10;
        $query = $this->query();
        $query = $this->search($query);
        $query = $this->sort($query);
        $result = $query->paginate($limit);
        return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => 'Finished Product List',
                'data' => $result
                ]);
    }

    public function full_list()
    {
        $query = $this->query();
        $query = $this->search($query);
        $query = $this->sort($query);
        $result = $query->get();
        return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => 'Finished Product Full List',
                'data' => $result
                ]);
    }
}
