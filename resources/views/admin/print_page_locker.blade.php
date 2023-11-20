<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		@page { margin: 5px; }
		body { margin: 5px; }
		.main{
			/*width: 200px;*/
		}
		h4{
			
			font-size: 14px;
		}
		h4,h5,p{
			text-align: center;
			margin: 0;
		}
		.m-space{
			margin: 4px 0;
		}
		.table-div{
			display: table;
			width: 100%;
		}
		.table-div > div{
			display: table-cell;
			vertical-align: middle;
			padding: 2px;
		}
		.w-50{
			width: 50%;
		}
		.w-16{
			width: 16.66%;
		}
		td,span,p{
			font-size: 12px;
		}
		.text-right{
			text-align: right;
		}
		.name{
			text-align: left;
		}
	</style>
</head>
<body>
	<div class="main" id="printableArea">
		<h4>
			M/s New Nabaratna Hospitality Pvt. Ltd.
		</h4>
		<p class="m-space">
			AC Executive Lounge, Guwahati Railway Station, PF No. 1
		</p>
		<h5>
			GSTIN: 18AAICN4763E1ZA
		</h5>
		<div class="table-div">
			<div class="w-50">
				<span class="text">Bill No: <b>{{ $print_data->unique_id }}</b></span>
			</div>
			<div class="w-50">
				<span class="text">Date: <b><?php echo date("d-m-Y"); ?></b></span>
			</div>
		</div>
		<div class="table-div">
			<div class="w-50">
				<span class="text">Locker No: <b>{{ $print_data->locker_id }}</b></span>
			</div>
			<div class="w-50">
				
			</div>
		</div>
		<div class="table-div">
			<div class="w-50">
				<span class="text">Name: <b>{{ $print_data->name }}</b></span>
			</div>
			<div class="w-50">
				<span class="text">Amount: <b>{{ $print_data->paid_amount }}</b></span>
			</div>
		</div>
		<div class="table-div">
			<div class="w-50">
				<span class="text">PNR/ID No.: <b>{{$print_data->pnr_uid}}</b></span>
			</div>
			<div class="w-50">
				<span class="text">Mobile:<b>{{$print_data->mobile_no}}</b></span>
			</div>
		</div>
		<div class="table-div" style="margin-bottom: 20px;">
			<div class="w-50">
				<span class="text">In Time: <b>{{$print_data->check_in}}</b></span>
			</div>
			<div class="w-50">
				<span class="text">Out Time: <b>{{$print_data->check_out}}</b></span>
			</div>
		</div>
		<div style="margin-top: 20px;text-align: right;">
			<span style="text-align:right;font-weight: bold;">E.&.O.E</span>
		</div>
		<div style="margin-top:10px;text-align:center;">

			<p>
				<b>*Note : Passengers must protect their own Mobile and luggage.</b>
			</p>
			<p style="margin-top:10px;font-size: 16px;">
				<strong>Thanks Visit Again</strong>
			</p>
		</div>
		
	</div>
	<script type="text/javascript">
		window.onload = function(e){ 
		    var printContents = document.getElementById("printableArea").innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents; 
		}
	</script>
</body>
</html>


