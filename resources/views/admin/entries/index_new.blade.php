@extends('admin.layout')

@section('main')
    <div class="main" ng-controller="sittingCtrl" ng-init="init();"> 
        @include('admin.entries.add')
        <div class="card shadow mb-4 p-4">
            
            <div class="filters" style="margin:24px 0;">
                <form name="filterForm"  novalidate>
                    <div class="row" style="font-size: 14px">

                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-2 form-group">
                                    <label class="label-control">Bill Number</label>
                                    <input type="text" class="form-control" ng-model="filter.unique_id" />
                                </div>                    
                                <div class="col-md-3 form-group">
                                    <label class="label-control">Name</label>
                                    <input type="text" class="form-control" ng-model="filter.name" />
                                </div>                    
                                <div class="col-md-3 form-group">
                                    <label class="label-control">Mobile</label>
                                    <input type="text" class="form-control" ng-model="filter.mobile_no" />
                                </div>
                                <div class="col-md-2 form-group">
                                    <label class="label-control">PNR</label>
                                    <input type="text" class="form-control" ng-model="filter.pnr_uid" />
                                </div>
                                <div class="col-md-2 form-group">
                                    <label class="label-control">Train</label>
                                    <input type="text" class="form-control" ng-model="filter.train_no" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 text-right" style="margin-top: 25px;" class="mb-2">
                            <button type="button" ng-click="init()" class="btn  btn-primary" style="width: 70px;">Search</button>
                            <button type="button" ng-click="filterClear()" class="btn  btn-warning" style="width: 70px;">Clear</button>
                            <button type="button" ng-click="add()" class="btn  btn-primary" style="width: 70px;">Add</button>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            <div>
                <table class="table table-bordered table-striped" >
                    <thead style="background-color: rgba(0,0,0,.075);">
                        <tr class="table-primary">
                            <th>S.no</th>
                            <th>Bill no</th>
                            <th>Name</th>
                            <th>Mobile No</th>
                            <th>PNR</th>
                            <th>Train</th>
                            <th>Pay Type</th>
                            <th>Total Amount</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody ng-if="entries.length > 0">
                        <tr ng-repeat="item in entries">
                            <td>@{{ $index+1 }}</td>
                            <td>@{{ item.unique_id }}</td>
                            <td>@{{ item.name }}</td>
                            <td>@{{ item.mobile_no }}</td>

                            <td>@{{ item.pnr_uid }}</td>
                            <td>@{{ item.train_no }}</td>
                            <td>@{{ item.pay_by }}</td>
                            <td>@{{ item.paid_amount }}</td>
                            <td>
                            <a href="javascript:;" ng-click="edit(item.id)" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{url('/admin/sitting/print')}}/@{{item.id}}" class="btn btn-success btn-sm" target="_blank">Print</a></td>
                        </tr>
                    </tbody>
                </table>
                <div ng-if="entries.length == 0" class="alert alert-danger">Data Not Found!</div>
            </div>  
            <div style="width:300px;">
                <table class="table table-bordered table-striped" style="width:100%;">
                    <tr>
                        <td>Shift UPI Collection</td>
                        <td><b>@{{ total_upi_collection }}</b></td>
                    </tr>
                    <tr>
                        <td>Shift Cash Collection</td>
                        <td><b>@{{ total_cash_collection }}</b></td>
                    </tr>
                    <tr>
                        <td>Shift Total Collection</td>
                        <td><b>@{{ total_collection }}</b></td>
                    </tr>
                    <tr>
                        <td>Last Hour UPI Collection</td>
                        <td><b>@{{ last_hour_upi_total }}</b></td>
                    </tr>
                    <tr>
                        <td>Last Hour Cash Collection</td>
                        <td><b>@{{ last_hour_cash_total }}</b></td>
                    </tr>
                    <tr>
                        <td>Last Hour Total Collection</td>
                        <td><b>@{{ last_hour_total }}</b></td>
                    </tr>
                    <!-- <tr>
                        <td colspan="2">
                            <a href="{{url('/admin/sitting/print-report')}}" class="btn btn-success btn-sm" target="_blank">Print Report</a>
                        </td>
                    </tr> -->
                </table>
            </div>
           
        </div>
    </div>
@endsection
    
    