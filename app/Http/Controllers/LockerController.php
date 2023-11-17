<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\Massage, App\Models\User;
use App\Models\Entry;
use App\Models\Locker;



class LockerController extends Controller {
	
	public function index(){
		return view('admin.locker.index', [
            "sidebar" => "locker",
            "subsidebar" => "locker",
        ]);
	}

	public function initLocker(Request $request){
		
		$l_entries = Locker::select('locker_entries.*');
		if($request->unique_id){
			$l_entries = $l_entries->where('locker_entries.unique_id', 'LIKE', '%'.$request->unique_id.'%');
		}		

		if($request->name){
			$l_entries = $l_entries->where('locker_entries.name', 'LIKE', '%'.$request->name.'%');
		}		
		if($request->mobile_no){
			$l_entries = $l_entries->where('locker_entries.mobile_no', 'LIKE', '%'.$request->mobile_no.'%');
		}		
		if($request->pnr_uid){
			$l_entries = $l_entries->where('locker_entries.pnr_uid', 'LIKE', '%'.$request->pnr_uid.'%');
		}		
		if($request->train_no){
			$l_entries = $l_entries->where('locker_entries.train_no', 'LIKE', '%'.$request->train_no.'%');
		}

		$date_ar = [date("Y-m-d",strtotime('-1 day')),date("Y-m-d",strtotime("now"))];
		$l_entries = $l_entries->orderBy('id', "DESC")->whereBetween('date',$date_ar)->get();


		$pay_types = Entry::payTypes();
		$days = Entry::days();
		$show_pay_types = Entry::showPayTypes();
		$avail_lockers = Entry::getAvailLockers();

		if(sizeof($l_entries) > 0){
			foreach ($l_entries as $item) {
				$item->pay_by = isset($item->pay_type)?$show_pay_types[$item->pay_type]:'';
			}

		}

		$data['success'] = true;
		$data['l_entries'] = $l_entries;
		$data['pay_types'] = $pay_types;
		$data['days'] = $days;
		$data['avail_lockers'] = $avail_lockers;

		return Response::json($data, 200, []);
	}
	public function editLocker(Request $request){
		$l_entry = Locker::where('id', $request->entry_id)->first();

		$data['success'] = true;
		$data['l_entry'] = $l_entry;
		return Response::json($data, 200, []);
	}
	public function calCheck(Request $request){
		
		$check_in = $request->check_in;
		$no_of_day = $request->no_of_day;

		$hours = 24*$no_of_day;

		$ss_time = strtotime(date("h:i A",strtotime($check_in)));

		$new_time = date("h:i A", strtotime('+'.$hours.' hours', $ss_time));

		$data['success'] = true;
		$data['check_out'] = $new_time;
		return Response::json($data, 200, []);
	}

	public function store(Request $request){

		$check_shift = Entry::checkShift();

		$cre = [
			'name'=>$request->name,
		];

		$rules = [
			'name'=>'required',
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){
			if($request->id){
				$group_id = $request->id;
				$entry = Locker::find($request->id);
				$message = "Updated Successfully!";
			} else {
				$entry = new Locker;
				$message = "Stored Successfully!";
				$entry->unique_id = strtotime('now');
				
			}

			
			$entry->name = $request->name;
			$entry->pnr_uid = $request->pnr_uid;
			$entry->mobile_no = $request->mobile_no;
			$entry->train_no = $request->train_no;
			$entry->address = $request->address;

			$entry->check_in = date("h:i A",strtotime($request->check_in));
			$entry->check_out = date("h:i A",strtotime($request->check_out));
			$entry->locker_id = $request->locker_id;
			$entry->no_of_day = $request->no_of_day;
			$entry->pay_type = $request->pay_type;
			$entry->remarks = $request->remarks;
			$entry->save();

			$date = date("Y-m-d");
			$checkout_date = date("Y-m-d",strtotime("+".$entry->no_of_day.' day',strtotime($date)));
	        $entry->date = $date;
	        $entry->checkout_date = $checkout_date;

			$entry->save();

			DB::table('lockers')->where('id',$request->locker_id)->update([
				'status' => 1,
			]);
			
			$data['id'] = $entry->id;
			$data['success'] = true;
		} else {
			$data['success'] = false;
			$message = $validator->errors()->first();
		}

		return Response::json($data, 200, []);

	}

	public function printPost($id = 0){

        $print_data = DB::table('locker_entries')->where('id', $id)->first();
        return view('admin.print_page_locker', compact('print_data'));
	}



}
