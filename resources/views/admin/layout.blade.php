<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>M/s New Nabaratna Hospitality Pvt. Ltd.</title>

    <link rel="stylesheet" type="text/css" href="{{url('bootstrap3/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('date/bootstrap-time.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/custom.css')}}">
</head>
<body  ng-app="app">
	<div id="wrapper">
        <div class="container-fluid">
            <div id="content" style="display: flex;">
                <div class="ul" style="width:250px;background-color: #ececec59;position: fixed;top: 0;left: 0;height: 100vh;overflow-y: scroll;padding:0;">
                    <div style="padding:16px;">
                        <span style="font-size: 18px;font-weight: bold">M/s New Nabaratna Hospitality Pvt. Ltd.</span> 
                        <div style="font-size: 12px; padding-top: 5px;">Haridwar Railway Station | GSTIN : 18AAICN4763E1ZA</div>
                    </div>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="@if(isset($sidebar)) @if($sidebar == 'sitting') active @endif @endif">
                            <a href="{{url('/admin/sitting')}}"><i class="fa fa-users"></i>Sitting</a>
                        </li>
                        <li class="@if(isset($sidebar)) @if($sidebar == 'locker') active @endif @endif">
                            <a href="{{url('/admin/locker')}}"><i class="fa fa-lock"></i>Locker</a>
                        </li>
                        <li class="@if(isset($sidebar)) @if($sidebar == 'massage') active @endif @endif">
                            <a href="{{url('/admin/massage')}}"><i class="fa fa-medkit" aria-hidden="true"></i>Massage</a>
                        </li>
                        
                        <li class="@if(isset($sidebar)) @if($sidebar == 'shift') active @endif @endif">
                            <a href="{{url('/admin/shift/current')}}"><i class="fa fa-industry" aria-hidden="true"></i>Shift Status</a>
                        </li>
                        <li class="@if(isset($sidebar)) @if($sidebar == 'pshift') active @endif @endif">
                            <a href="{{url('/admin/shift/prev')}}"><i class="fa fa-industry" aria-hidden="true"></i>Previous Shift</a>
                        </li>
                        <li>
                            <a href="{{url('/logout')}}"><i class="fa fa-sign-out"></i>Logout</a>
                        </li>
                     
                    </ul>
                    
                </div>
                <div class="" style="padding-left:250px;width: 100%;">
                    <div style="padding:0 20px;"> 
                        @yield('main')
                    </div>
                </div>
             
            </div>
        </div>
		
    </div>
    <script type="text/javascript">
        var base_url = "{{url('/')}}";
        var CSRF_TOKEN = "{{ csrf_token() }}";
    </script>
    <script type="text/javascript" src="{{url('assets/scripts/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('bootstrap3/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('date/bootstrapp-time.min.js')}}"></script>

    <script type="text/javascript" src="{{url('assets/scripts/angular.min.js')}}" ></script>
    <script type="text/javascript" src="{{url('assets/scripts/jcs-auto-validate.js')}}" ></script>
    <script type="text/javascript" src="{{url('assets/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/scripts/core/app.js')}}" ></script>
    <script type="text/javascript" src="{{url('assets/scripts/core/services.js')}}" ></script>
    <script type="text/javascript" type="text/javascript" src="{{url('assets/scripts/core/controller.js')}}"></script>
    <script>
      angular.module("app").constant("CSRF_TOKEN", "{{ csrf_token() }}");
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#timePicker').timepicker({
                minuteStep: 1,
            });
            $('#timePicker2').timepicker({
                minuteStep:1,
            });
        });
    </script>

</body>
</html>