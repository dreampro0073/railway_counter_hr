<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\Massage, App\Models\User;
use App\Models\Entry;


use Crypt;

use Dompdf\Dompdf;
use Dompdf\Options;

class MassageController extends Controller {
	
	public function massage(){
		return view('admin.massage.index', [
            "sidebar" => "massage",
            "subsidebar" => "massage",
        ]);
	}

	public function initMassage(Request $request){
		$m_entries = DB::table('massage_entries')->orderBy('id','DESC')->get();

		$show_pay_types = Entry::showPayTypes();
		if(sizeof($m_entries) > 0){
			foreach ($m_entries as $item) {
				$item->pay_by = isset($item->pay_type)?$show_pay_types[$item->pay_type]:'';
			}

		}

		$pay_types = Entry::payTypes();
		$data['success'] = true;
		$data['m_entries'] = $m_entries;
		$data['pay_types'] = $pay_types;

		return Response::json($data,200,array());
	}
	public function editMassage(Request $request){
		$m_entry = Massage::where('id', $request->m_id)->first();

		if($m_entry){
			$m_entry->paid_amount = $m_entry->paid_amount*1;
		}

		$data['success'] = true;
		$data['m_entry'] = $m_entry;
		return Response::json($data, 200, []);
	}
	public function changeTime(Request $request){
		
		$in_time = $request->in_time;
		$time_period = $request->time_period;

		$ss_time = strtotime(date("h:i A",strtotime($in_time)));

		$new_time = date("h:i A", strtotime('+'.$time_period.' minutes', $ss_time));

		$data['success'] = true;
		$data['out_time'] = $new_time;
		return Response::json($data, 200, []);
	}
	public function checkMC(Request $request){
			
		$in_time  = date("h:i A",strtotime("+10 minutes"));


		$check = DB::table('massage_entries')->where('')->first();

		$data['success'] = true;
		$data['in_time'] = $in_time;
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
				$entry = Massage::find($request->id);
				$message = "Updated Successfully!";
			} else {
				$entry = new Massage;
				$message = "Stored Successfully!";
				$entry->unique_id = strtotime('now');
				
			}

			$entry->name = $request->name;
			$entry->in_time = date("h:i A",strtotime($request->in_time));
			$entry->out_time = date("h:i A",strtotime($request->out_time));
			$entry->paid_amount = $request->paid_amount;
			$entry->pay_type = $request->pay_type;
			$entry->remarks = $request->remarks;
			$entry->time_period = $request->time_period;
			$entry->chair_no = $request->char_no;
			$entry->save();

			
			$data['id'] = $entry->id;
			$data['success'] = true;
		} else {
			$data['success'] = false;
			$message = $validator->errors()->first();
		}

		return Response::json($data, 200, []);

	}

	public function printPost($id = 0){

        $print_data = DB::table('massage_entries')->where('id', $id)->first();
        return view('admin.print_page_massage', compact('print_data'));

		
		// $this->printFinal($print_data);
	}

	// public function printFinal($print_data){

 //        $options = new Options();
 //        $options->set('isRemoteEnabled', true);

 //        $dompdf = new Dompdf($options);

 //        define("DOMPDF_UNICODE_ENABLED", true);

 //        $html = view('admin.print_page_massage', compact('print_data'));

 //        $dompdf->loadHtml($html);
 //        $dompdf->setPaper([0,0,230,280]);
 //        $dompdf->render();
 //        $dompdf->stream(date("dmY",strtotime("now")).'.pdf',array("Attachment" => false));
 //    }


}
