@extends('admin.layout')

@section('main')
    <div class="main" ng-controller="shiftCtrl" ng-init="prevInit();"> 
        <div class="card shadow mb-4 p-4">    
            <h2 class="">Total Shift Collection (@{{shift_date}} - @{{check_shift}})</h2>
            <hr>
             <table class="table table-bordered table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th></th>
                        <th>UPI</th>
                        <th>Cash</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                       <td>
                           Sitting
                       </td> 
                        <td>
                            @{{shitting_data.total_shift_upi}}
                        </td>
                        <td>
                            @{{shitting_data.total_shift_cash}}
                        </td>
                        <td>
                            @{{shitting_data.total_collection}}
                        </td>
                    </tr>
                    <tr>
                       <td>
                           Massage
                       </td> 
                        <td>
                            @{{massage_data.total_shift_upi}}
                        </td>
                        <td>
                            @{{massage_data.total_shift_cash}}
                        </td>
                        <td>
                            @{{massage_data.total_collection}}
                        </td>
                    </tr>
                    <tr>
                       <td>
                           Locker
                       </td> 
                        <td>
                            @{{locker_data.total_shift_upi}}
                        </td>
                        <td>
                            @{{locker_data.total_shift_cash}}
                        </td>
                        <td>
                            @{{locker_data.total_collection}}
                        </td>
                    </tr>
                    <tr>
                       <td>
                           <b>Grand Total</b>
                       </td> 
                        <td>
                            <b>@{{total_shift_upi}}</b>
                        </td>
                        <td>
                            <b>@{{total_shift_cash}}</b>
                        </td>
                        <td>
                            <b>@{{total_collection}}</b>
                        </td>
                    </tr>
                </tbody>
            </table>  
            
        </div>
    </div>
@endsection
    
    