<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="modal-title" id="exampleModalLongTitle">Locker</h5>
                    </div>
                    <div class="col-md-6" style="text-align:right;">
                        <button type="button" class="close" ng-click="hideModal();" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                
            </div>
            <div class="modal-body">
                <form name="myForm" novalidate="novalidate" ng-submit="onSubmit(myForm.$valid)">

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Name</label>
                            <input type="text" ng-model="formData.name" class="form-control" required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Mobile No.</label>
                            <input type="number" ng-model="formData.mobile_no" class="form-control" required />
                        </div>
                        <div class="col-md-3 form-group">
                            <label>NOS</label>
                            <input type="number" ng-model="formData.nos" class="form-control" />
                        </div>
                        
                    </div>
                    <div class="row">
                        
                        
                        <div class="col-md-3 form-group" ng-if="formData.id > 0">
                            <label>Check In</label>
                           
                            <input type="text" class="form-control" ng-model="formData.check_in" readonly>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>PNR/UID</label>
                            <input type="number" ng-model="formData.pnr_uid" class="form-control" />
                        </div>                        
                        <div class="col-md-3 form-group">
                            <label>No Of Days</label>
                            <select ng-model="formData.no_of_day" class="form-control" ng-change="changeAmount()" required convert-to-number >
                                <option value="">--select--</option>
                                <option ng-repeat="item in days" value="@{{item.value}}">@{{ item.label}}</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group" ng-if="entry_id == 0">
                            <label>Available Locker</label>
                            <select ng-model="formData.locker_id" class="form-control" required convert-to-number>
                                <option value="">--select--</option>
                                <option ng-repeat="item in avail_lockers" value="@{{item.id}}">@{{ item.locker_no}}</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group" ng-if="entry_id != 0">
                            <label>Locker</label>
                            <input type="text" ng-model="formData.locker_id" class="form-control" required readonly />

                        </div>
                        <div class="col-md-3 form-group">
                            <label>Pay Type</label>
                            <select ng-model="formData.pay_type" class="form-control" required  convert-to-number>
                                <option value="">--select--</option>
                                <option ng-repeat="item in pay_types" value="@{{item.value}}">@{{ item.label}}</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group" ng-if="formData.no_of_day !=''">
                            <label>Paid Amount</label>
                            <input type="number" ng-model="formData.paid_amount" class="form-control" readonly />
                        </div>                        
                        
                        <div class="col-md-4 form-group" ng-if="formData.id > 0">
                            <label>Check Out</label>
                            <input type="text" class="form-control" ng-model="formData.check_out" readonly>
                        </div>
                        
                        <div class="col-md-12 form-group">
                            <label>Remarks</label>
                            <textarea ng-model="formData.remarks" class="form-control"></textarea>
                        </div>
                        
                       
                    </div>
                  
                    <div class="row">  
                       
                        
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary" ng-disabled="loading">
                            <span ng-if="!loading">Submit</span>
                            <span ng-if="loading">Loading...</span>
                        </button> 
                    </div>  
                    
               </form>
            </div>
           
        </div>
    </div>
</div>

<div class="modal fade" id="checkoutLokerModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="modal-title" id="exampleModalLongTitle">Checkout Locker</h5>
                    </div>
                    <div class="col-md-6" style="text-align:right;">
                        <button type="button" class="close" ng-click="hideModal();" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                
            </div>
            <div class="modal-body">
                <form name="myForm" novalidate="novalidate" ng-submit="onCheckOut(myForm.$valid)">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Name</label>
                            <input type="text" ng-model="formData.name" class="form-control" readonly />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Mobile No.</label>
                            <input type="number" ng-model="formData.mobile_no" class="form-control" readonly />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Address</label>
                            <input type="text" ng-model="formData.address" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Check In</label>
                           
                            <input type="text" class="form-control" date-time-picker ng-model="formData.check_in" ng-change="calCheck()" dataobj="formData" dataitem="check_in" id="timePicker" readonly />
                        </div>
                        <div class="col-md-4 form-group">
                            <label>PNR/UID</label>
                            <input type="number" ng-model="formData.pnr_uid" class="form-control" readonly />
                        </div>
                        
                        <div class="col-md-4 form-group">
                            <label>Train No.</label>
                            <input type="number" ng-model="formData.train_no" class="form-control" readonly />
                        </div>
                    </div>
                  
                    <div class="row">  
                        <div class="col-md-3 form-group">
                            <label>No Of Days</label>
                            <select ng-model="formData.no_of_day" class="form-control" readonly convert-to-number ng-change="calCheck()" >
                                <option value="">--select--</option>
                                <option ng-repeat="item in days" value="@{{item.value}}">@{{ item.label}}</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group" ng-if="entry_id == 0">
                            <label>Available Locker</label>
                            <select ng-model="formData.locker_id" class="form-control" readonly convert-to-number>
                                <option value="">--select--</option>
                                <option ng-repeat="item in avail_lockers" value="@{{item.id}}">@{{ item.locker_no}}</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group" ng-if="entry_id != 0">
                            <label>Locker</label>
                            <input type="text" ng-model="formData.locker_id" class="form-control"  readonly />

                        </div>
                        <div class="col-md-3 form-group">
                            <label>Pay Type</label>
                            <select ng-model="formData.pay_type" class="form-control"   convert-to-number>
                                <option value="">--select--</option>
                                <option ng-repeat="item in pay_types" value="@{{item.value}}">@{{ item.label}}</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Total Amount</label>
                            <input type="number" ng-model="formData.total_balance" class="form-control" readonly />
                        </div> 

                        <div class="col-md-3 form-group" >
                            <label>Paid Amount</label>
                            <input type="number" ng-model="formData.paid_amount" class="form-control" readonly />
                        </div> 
                        <div class="col-md-3 form-group">
                            <label>Balance Amount</label>
                            <input type="number" ng-model="formData.balance" class="form-control" readonly />
                        </div>                        
                        
                        <div class="col-md-4 form-group">
                            <label>Check Out</label>
                            <input type="text" class="form-control" ng-model="formData.check_out" readonly>
                        </div>
                        
                        <div class="col-md-12 form-group">
                            <label>Remarks</label>
                            <textarea ng-model="formData.remarks" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary" ng-disabled="loading">
                            <span ng-if="!loading">Collect</span>
                            <span ng-if="loading">Loading...</span>
                        </button> 
                    </div>  
                    
               </form>
            </div>
           
        </div>
    </div>
</div>
