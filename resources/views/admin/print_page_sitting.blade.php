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
	@if($print_data->type == 'silip')
		@include('admin.print_stru');
	@endif

	@if($print_data->type == 'shift')
		@include('admin.shift_print_stru');
	@endif
</body>
</html>


