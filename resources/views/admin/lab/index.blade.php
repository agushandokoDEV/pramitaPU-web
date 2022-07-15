@extends('layouts.base')
@section('title', 'Kelola Lab')
@section('assets')
<link rel="stylesheet" type="text/css" href="/assets/js/plugin/datatables-1.12.1/src/css/dataTables.bootstrap.min.css">

<script src="/assets/js/plugin/datatables-1.12.1/src/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugin/datatables-1.12.1/src/js/dataTables.bootstrap4.min.js"></script>

@endsection
@section('content')
<div class="card">
	<div class="card-header">
		<h4 class="card-title">Lab</h4>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="basic-datatables" class="display table table-bordered table-striped table-hover" style="width: 100%;">
				<thead>
					<tr>
						<th style="width:3%">No</th>
						<th>Nama Lab</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>

@section('script')
<script type="text/javascript">
	var table
	$(document).ready(function(){
		// $('#basic-datatables').DataTable();
		//$.fn.dataTableExt.sErrMode = 'throw';
	    $.fn.dataTable.ext.errMode = 'none';
	    table = $('#basic-datatables').DataTable({
		    "processing": true, //Feature control the processing indicator.
		    "serverSide": true, //Feature control DataTables' server-side processing mode.
		    // Load data for the table's content from an Ajax source
		    "ajax": {
		        "url": "{{url('lab/all')}}",
		        "type": "GET"
		    },
		    columns: [
		        {
		            searchable: false,
		            render: function (data, type, row, meta) {
		                return meta.row + meta.settings._iDisplayStart + 1;
		            }
		        },
		        {data: "nama"},
		    ],
		    
		    "language": {
	            "lengthMenu": "_MENU_",
	            // "processing": "<img src='/img/loading.gif' />"
	            'paginate': {
	            	'first':'',
	            	'last':'',
			      	'previous': '<i class="fa fa-arrow-left"></i>',
			      	'next': '<i class="fa fa-arrow-right"></i>'
			    },
			    "decimal":        "",
			    "emptyTable":     "Data tidak tersedia",
			    "info":           "_START_ / _END_ Total _TOTAL_ ",
			    "infoEmpty":      "0 / 0 Total 0",
			    "infoFiltered":   "(filtered from _MAX_ total entries)",
			    "infoPostFix":    "",
			    "thousands":      ",",
			    "loadingRecords": "Loading...",
			    "processing":     "",
			    "search":         "Cari:",
			    "zeroRecords":    "Tidak ada kecocokan data",
			    "aria": {
			        "sortAscending":  ": activate to sort column ascending",
			        "sortDescending": ": activate to sort column descending"
			    }
		    },
		    "order": [[ 1, 'desc' ]],
		    "sDom": "<'row'<'col-sm-1'l><'col-sm-8'<'dt_actions'>><'col-sm-3'f>r>t<'row'<'col-sm-5'i><'col-sm-7'p>>",
	  	});
	  	//$("div.toolbar").html(' <select class="form-control input-sm"><option value="">a</option></select>');
	  	$('#dt_tbl tbody').on( 'click', 'tr', function(){
		    if ($(this).hasClass('selected')) {
		        $(this).removeClass('selected');
		    }
		    else {
		        table.$('tr.selected').removeClass('selected');
		        $(this).addClass('selected');
		    }
	  	});
	  	$('.dt_actions').html($('.dt_index_actions').html());
	  	$('#basic-datatables tbody').on('dblclick', 'tr', function () {
			var data = table.row( this ).data();
			console.log(data);
		});
	});
</script>
@endsection
@endsection