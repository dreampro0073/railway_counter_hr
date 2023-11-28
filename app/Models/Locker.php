<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use DB;
use App\Models\Entry;

class Locker extends Model
{

    protected $table = 'locker_entries';

    public static function totalShiftData(){
        $check_shift = Entry::checkShift();
        
        $total_shift_cash = 0;
        $total_shift_upi = 0;       

        $last_hour_cash_total = 0;
        $last_hour_upi_total = 0;

        $from_time = date('H:00:00');
        $to_time = date('H:59:59');

        if($check_shift != "C"){

            $shift_date = date("Y-m-d");   


            $total_shift_upi = Locker::where('date',$shift_date)->where('pay_type',2)->where('shift', $check_shift)->where('deleted',0)->sum("paid_amount");

            $total_shift_upi += DB::table('locker_penalty')->where('date',date("Y-m-d"))->where('pay_type',2)->where('shift', $shift_date)->sum('penalty_amount');

            $total_shift_cash = Locker::where('date',$shift_date)->where('pay_type',1)->where('shift', $check_shift)->where('deleted',0)->sum("paid_amount"); 
            $total_shift_cash += DB::table('locker_penalty')->where('date',$shift_date)->where('pay_type',1)->sum('penalty_amount'); 

            $last_hour_upi_total = Locker::where('date',$shift_date)->where('pay_type',2)->where('shift', $check_shift)->where('deleted',0)->whereBetween('check_in', [$from_time, $to_time])->sum("paid_amount");

            $last_hour_upi_total += DB::table('locker_penalty')->where('date',$shift_date)->where('pay_type',2)->where('shift', $check_shift)->whereBetween('current_time', [$from_time, $to_time])->sum('penalty_amount'); 

            $last_hour_cash_total = Locker::where('date',$shift_date)->where('pay_type',1)->where('shift', $check_shift)->where('deleted',0)->whereBetween('check_in', [$from_time, $to_time])->sum("paid_amount"); 
            $last_hour_cash_total += DB::table('locker_penalty')->where('date',$shift_date)->where('pay_type',1)->where('shift', $check_shift)->whereBetween('current_time', [$from_time, $to_time])->sum('penalty_amount'); 

            $shift_date = date("d-m-Y");   

        }
        
        if($check_shift == "C"){

            $p_date = Entry::getPDate();
            // dd($p_date);
            $shift_date = date("d-m-Y",strtotime($p_date));

            $total_shift_upi = Locker::where('date',$p_date)->where('shift', $check_shift)->where('deleted',0)->where('pay_type',2)->sum("paid_amount");

            $total_shift_upi += DB::table('locker_penalty')->where('date',$p_date)->where('shift', $check_shift)->where('pay_type',2)->sum("penalty_amount");

            $total_shift_cash = Locker::where('date',$p_date)->where('shift', $check_shift)->where('deleted',0)->where('pay_type',1)->sum("paid_amount");
            $total_shift_cash += DB::table('locker_penalty')->where('date',$p_date)->where('shift', $check_shift)->where('pay_type',1)->sum("penalty_amount");

            $last_hour_upi_total = Locker::where('date',$p_date)->where('shift', $check_shift)->where('deleted',0)->where('pay_type',2)->whereBetween('check_in', [$from_time, $to_time])->sum("paid_amount"); 
            $last_hour_upi_total += DB::table('locker_penalty')->where('date',$p_date)->where('shift', $check_shift)->where('pay_type',2)->whereBetween('current_time', [$from_time, $to_time])->sum("penalty_amount"); 
            
            $last_hour_cash_total = Locker::where('date',$p_date)->where('shift', $check_shift)->where('deleted',0)->where('pay_type',1)->whereBetween('check_in', [$from_time, $to_time])->sum("paid_amount");
            $last_hour_cash_total += DB::table('locker_penalty')->where('date',$p_date)->where('shift', $check_shift)->where('pay_type',1)->whereBetween('current_time', [$from_time, $to_time])->sum("penalty_amount");            
        }

        $total_collection = $total_shift_upi + $total_shift_cash;
        $last_hour_total = $last_hour_upi_total + $last_hour_cash_total;

        $data['total_shift_upi'] = $total_shift_upi;
        $data['total_shift_cash'] = $total_shift_cash;
        $data['total_collection'] = $total_collection;

        $data['last_hour_upi_total'] = $last_hour_upi_total;
        $data['last_hour_cash_total'] = $last_hour_cash_total;
        $data['last_hour_total'] = $last_hour_total;
        $data['check_shift'] = $check_shift;
        $data['shift_date'] = $shift_date;

        return $data;
    }    

    public static function totalPrevShiftData(){
        $check_shift = Entry::checkShift(2);
        
        $total_shift_cash = 0;
        $total_shift_upi = 0;  

        if($check_shift == "B"){
            if(date('H') > 6) {
                $shift_date = date("Y-m-d"); 
            } else {
                $shift_date = date("Y-m-d",strtotime("-1 day"));   
            }
        }else{
            $shift_date = date("Y-m-d");
        }       

        if($check_shift != "C"){
            $total_shift_upi = Locker::where('date',date("Y-m-d"))->where('pay_type',2)->where('shift', $check_shift)->where('deleted',0)->sum("paid_amount");

            $total_shift_upi += DB::table('locker_penalty')->where('date',date("Y-m-d"))->where('pay_type',2)->where('shift', $check_shift)->where('deleted',0)->sum('penalty_amount');

            $total_shift_cash = Locker::where('date',date("Y-m-d"))->where('pay_type',1)->where('shift', $check_shift)->where('deleted',0)->sum("paid_amount"); 
            $total_shift_cash += DB::table('locker_penalty')->where('date',date("Y-m-d"))->where('pay_type',1)->where('shift', $check_shift)->where('deleted',0)->sum('penalty_amount'); 
        }
        
        if($check_shift == "C"){

            $shift_date = date("d-m-Y",strtotime("-1 day"));

            $total_shift_upi = Locker::whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('deleted',0)->where('pay_type',2)->sum("paid_amount");

            $total_shift_upi += DB::table('locker_penalty')->whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('pay_type',2)->sum("penalty_amount");

            $total_shift_cash = Locker::whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('deleted',0)->where('pay_type',1)->sum("paid_amount");
            $total_shift_cash += DB::table('locker_penalty')->whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('pay_type',1)->sum("penalty_amount");
            
        }

        $total_collection = $total_shift_upi + $total_shift_cash;
        $data['total_shift_upi'] = $total_shift_upi;
        $data['total_shift_cash'] = $total_shift_cash;
        $data['total_collection'] = $total_collection;

        $data['check_shift'] = $check_shift;
        $data['shift_date'] = date('d-m-Y', strtotime($shift_date));

        return $data;
    }

}