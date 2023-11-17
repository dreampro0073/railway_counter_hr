<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use DB;

class Entry extends Model
{

    protected $table = 'sitting_entries';

    public static function payTypes(){
        $ar = [];
        $ar[] = ['value'=>1,'label'=>'Cash'];
        $ar[] = ['value'=>2,'label'=>'UPI'];

        return $ar;
    }

    public static function getAvailLockers(){
        return DB::table('lockers')->where('status',0)->get();
    }

    public static function showPayTypes(){
        return [1=>'Cash',2=>"UPI"];
    }

    public static function hours(){
        $ar = [];
        for ($i=1; $i <= 24; $i++) { 
           $ar[] = ['value'=>$i,'label'=>$i];
        }
        return $ar;
    }

    public static function days(){
        $ar = [];
        for ($i=1; $i <= 15; $i++) { 
           $ar[] = ['value'=>$i,'label'=>$i];
        }
        return $ar;
    }

    public static function checkShift(){
        // $a_shift = "06:00:00-13:59:59";
        //$b_shift = "14:00:00-21:59:59";
        //$c_shift = "22:00:00-05:59:59";

        $a_shift = strtotime("06:00:00");
        $b_shift =strtotime("14:00:00");
        $c_shift =strtotime("22:00:00");


        $current_time = strtotime(date("H:i:s"));

        if($current_time > $a_shift && $current_time < $b_shift){
            return "A";
        }else if($current_time > $b_shift && $current_time < $c_shift){
            return "B";
        }else{
            return "C";
        }
    }

    public static function totalShiftData(){
        $check_shift = Entry::checkShift();
        
        $total_shift_cash = 0;
        $total_shift_upi = 0;       

        $last_hour_cash_total = 0;
        $last_hour_upi_total = 0;

        $from_time = date('h:00:00 A');
        $to_time = date('h:59:59 A');

        if($check_shift != "C"){
            $total_shift_upi = Entry::where('date',date("Y-m-d"))->where('pay_type',2)->where('shift', $check_shift)->sum("paid_amount");

            $total_shift_cash = Entry::where('date',date("Y-m-d"))->where('pay_type',1)->where('shift', $check_shift)->sum("paid_amount");  

            $last_hour_upi_total = Entry::where('date',date("Y-m-d"))->where('pay_type',2)->where('shift', $check_shift)->whereBetween('check_in', [$from_time, $to_time])->sum("paid_amount");

            $last_hour_cash_total = Entry::where('date',date("Y-m-d"))->where('pay_type',1)->where('shift', $check_shift)->whereBetween('check_in', [$from_time, $to_time])->sum("paid_amount"); 
            $shift_date = date("d-m-Y");   

        }
        
        if($check_shift == "C"){

            $total_shift_upi = Entry::whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('pay_type',2)->sum("paid_amount");

            $total_shift_cash = Entry::whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('pay_type',1)->sum("paid_amount");
            $last_hour_upi_total = Entry::whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('pay_type',2)->whereBetween('check_in', [$from_time, $to_time])->sum("paid_amount"); 
            $last_hour_cash_total = Entry::whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('pay_type',1)->whereBetween('check_in', [$from_time, $to_time])->sum("paid_amount");

            $shift_date = date("d-m-Y",strtotime("-1 day"));
            
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

}