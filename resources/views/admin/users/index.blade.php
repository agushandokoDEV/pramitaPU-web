@extends('layouts.base')
@section('title', 'Kelola Pengguna')
@section('assets')
<link rel="stylesheet" type="text/css" href="/assets/js/plugin/datatables-1.12.1/src/css/dataTables.bootstrap.min.css">

<script src="/assets/js/plugin/datatables-1.12.1/src/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugin/datatables-1.12.1/src/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/js/plugin/ajaxform/dist/jquery.form.min.js"></script>

@endsection
@section('content')
<div class="card">
	<div class="card-header">
		<div class="d-flex justify-content-between bd-highlight">
			<div><h4 class="card-title">Pengguna</h4></div>
			<div>
				<button onclick="addUser('Tambah Pengguna')" class="btn btn-danger btn-sm btn-border btn-round">
					<span class="btn-label">
						<i class="fa fa-plus"></i>
					</span>
					Tambah Pengguna
				</button>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="basic-datatables" class="display table table-bordered table-striped table-hover" style="width: 100%;">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Pengguna</th>
						<th>Username / NIP</th>
						{{-- <th>Email</th> --}}
						<th>Grup</th>
						<th>Status</th>
						<th style="width:5%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="mdl-form-user">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">-</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/users/add" id="form-users" autocomplete="off">
        	@csrf
        	<input type="hidden" name="id" id="inp-id"/>
        	<div class="form-group">
					  <label for="Inputnama">NIP :</label>
				    <input type="text" name="username" class="form-control" id="inp-username" placeholder="Masukan NIP" required/>
					</div>
					<div class="form-group">
					  <label for="Inputnama">Nama Lengkap :</label>
				    <input type="text" name="namalengkap" class="form-control" id="inp-namalengkap" placeholder="Masukan nama lengkap" required/>
					</div>
        	{{-- <div class="form-group">
				    <label for="InputEmail">Email :</label>
				    <input type="email" name="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="Enter email">
			 		</div> --}}
			 
				 <div class="form-group">
				    <label for="InputEmail">Grup Pengguna :</label>
				    <select class="form-control" name="role_id" id="inp-role" required>
				    	<option value="">Pilih</option>
				    	@foreach($roles as $role)
				    	<option value="{{$role->id}}">{{$role->name}}</option>
				    	@endforeach
				    </select>
				 </div>
				 <div class="form-group">
				 		<div id="msg-form"></div>
				 </div>
				 <div class="form-group">
				 	<button type="submit" id="btn-submit" class="btn btn-primary">Tambahkan Pengguna Baru</button>
				 	<button type="button" class="btn btn-default" onclick="batal()">Tutup</button>
				 </div>
		</form>
      </div>
      
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
		        "url": "{{url('users/all')}}",
		        "type": "GET"
		    },
		    // "iDisplayLength": 100,
		    columns: [
		        {
		            searchable: false,
		            render: function (data, type, row, meta) {
		                return meta.row + meta.settings._iDisplayStart + 1;
		            }
		        },
		        {data: "namalengkap"},
		        {data: "username"},
		        // {data: "email"},
		        {
		        	data: "role_id",
		        	searchable:false,
		            render: function (data, type, row, meta) {
		                return row?.roles?.name
		            }
		        },
		        {
		            data: "status",
		            searchable:false,
		            render: function (data, type, row, meta) {
		                var s=[];
		                s['0']='Tidak Aktif';
		                s['1']='Aktif';
		                s['2']='Blokir';
		                return s[row.status];
		            }
		        }
		    ],
		    "columnDefs": [
		    	{
	            "targets": 5,
	            "render": function(data, type, row, meta){

	               	var str='';
	               	str += ' <button onclick="get_detail('+"'"+row.id+"'"+')" title="Edit '+row.namalengkap+'" class="btn btn-sm btn-info"><i class="fa fa-pencil-alt" style="font-size:15px"></i></button>';
	               	return str;
	            }
	        },
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

		// $('#btn-mdl-form-user').click(function(){
		// 	$('#mdl-form-user').modal('show')
		// });

		$('#form-users').ajaxForm({
	        beforeSend: function() {
	        	$('#msg-form').html('')
	          $('#btn-submit')
	          .attr('disabled','true')
	          .text('Loading...');
	        },
	        success: function(res) {
	        	var btn_text='Tambahkan Pengguna Baru';
	        	if($('#inp-id').val() !=''){
	        		btn_text='Edit Pengguna'
	        	}
	        	$('#btn-submit')
	        	.removeAttr('disabled')
	        	.text(btn_text);
	        	
	        	// var res=jQuery.parseJSON(response);
	        	// console.log(res)
	          if(res.success){
	            $('#msg-form').html('<div class="alert alert-success">'+res.message+'</div>')
	            if($('#inp-id').val() ===''){
					  		$('#form-users')[0].reset();
					  	}
					  	table.ajax.url('/users/all').load();
	          }
	        },
	        error:function(err,res){
	        	var btn_text='Tambahkan Pengguna Baru';
	        	if($('#inp-id').val() !=''){
	        		btn_text='Edit Pengguna'
	        	}
	        	$('#btn-submit')
	        	.removeAttr('disabled')
	        	.text(btn_text);
	        	$('#msg-form').html('<div class="alert alert-danger">'+err.responseJSON.message+'</div>')
	        }
	    });
	});

	function addUser(str) {
		$('#msg-form').html('')
		$('#form-users').attr('action','/users/add')
		$('#inp-id').val('')
		$('#btn-submit').text('Tambahkan Pengguna');
		$('#mdl-form-user').modal('show')
		$('#modal-title').text(str)
	}

	function get_detail(id) {
		$.get('/users/row/'+id,function(res){
				if(res.success){
					$('#inp-id').val(res.data.id);
					$('#inp-username').val(res.data.username);
					$('#inp-namalengkap').val(res.data.namalengkap);
					$('#inp-role').val(res.data.role_id);
					$('#form-users').attr('action','/users/edit')
					$('#btn-submit').text('Edit Pengguna');
					$('#mdl-form-user').modal('show')
					$('#modal-title').text('Edit Pengguna')
				}else{
					alert(res.message)
				}
		});
	}

	function batal() {
		$('#msg-form').html('')
		$('#form-users')[0].reset();
		
		$('#mdl-form-user').modal('hide')
	}
</script>
@endsection
@endsection