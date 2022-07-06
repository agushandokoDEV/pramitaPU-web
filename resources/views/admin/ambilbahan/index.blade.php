@extends('layouts.base')
@section('title', 'Ambil Bahan / Kunjungan')
@section('assets')
{{-- <link rel="stylesheet" type="text/css" href="/assets/js/plugin/datatables-1.12.1/src/css/jquery.dataTables.min.css"> --}}
{{-- <link rel="stylesheet" type="text/css" href="/assets/js/plugin/datatables-1.12.1/src/css/dataTables.bootstrap4.min.css"> --}}
<link rel="stylesheet" type="text/css" href="/assets/js/plugin/datatables-1.12.1/src/css/dataTables.bootstrap.min.css">
{{-- <link rel="stylesheet" type="text/css" href="/assets/js/plugin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"> --}}

{{-- <script src="/assets/js/plugin/datatables-1.12.1/datatables.min.js"></script> --}}
<script src="/assets/js/plugin/datatables-1.12.1/src/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugin/datatables-1.12.1/src/js/dataTables.bootstrap4.min.js"></script>
{{-- <script src="/assets/js/plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script> --}}

<!-- Datatables -->
{{-- <script src="/assets/js/plugin/datatables/datatables.min.js"></script> --}}
@endsection
@section('content')
<div class="card">
	<div class="card-header">
		<h4 class="card-title">Ambil Bahan / Kunjungan</h4>
	</div>
	<div class="card-body">
		<div class="d-flex gap-4 justify-content-around bd-highlight">
			<div class="input-group">
		        <div class="input-group-prepend">
		          <span class="input-group-text"><i class="fa fa-calendar"></i></span>
		        </div>
		        <input type="date" class="form-control form-control-sm" placeholder="Tanggal" id="tgl-dari">
	      	</div>
	      	&nbsp;
	      	<div class="input-group">
	      		<div class="input-group-prepend">
		      		<span class="input-group-text"><i class="fa fa-calendar"></i></span>
		      	</div>
		      	<input type="date" class="form-control form-control-sm" placeholder="Tanggal" id="tgl-sampai" />
		    </div>
		    &nbsp;
		    <div class="input-group">
		    	<button title="Cari" class="btn btn-primary btn-sm" onclick="get_list_data()"><i class="fa fa-search" style="font-size: 14px;"></i></button>
		    	&nbsp;
		    	<button title="Refresh" class="btn btn-primary btn-border btn-sm" onclick="get_list_data()"><i class="fa fa-history" style="font-size: 14px;"></i></button>
		    </div>
		</div>
		<hr/>
		<div class="table-responsive">
			<table id="basic-datatables" class="display table table-bordered table-striped table-hover" style="width: 100%;">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Nama Petugas</th>
						<th>Tujuan Lab</th>
						<th>Nama Pasien</th>
						<th>Yang Menyerahkan</th>
						<th>Yang Menerima</th>
						<th>Jam</th>
						<th style="width:5%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="mdl-form-approved-bahan">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mdl-title">-</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-sm">
    		<tr>
    			<td style="height: 25px;">Tangggal </td>
    			<td style="height: 25px;" id="text-tanggal"></td>
    		</tr>
    		<tr>
    			<td style="height: 15px;">Petugas </td>
    			<td style="height: 15px;" id="text-petugas"></td>
    		</tr>
    		<tr>
    			<td style="height: 15px;">Pasien </td>
    			<td style="height: 15px;" id="text-pasien"></td>
    		</tr>
    		<tr>
    			<td style="height: 15px;">Yang Menyerahkan </td>
    			<td style="height: 15px;" id="text-menyerahkan"></td>
    		</tr>
    		<tr>
    			<td>Yang Menerima </td>
    			<td>
    				 <div class="form-group">
					    <input type="text" id="txt-approved_by" class="form-control" placeholder="Masukan nama penerima">
					 </div>
    			</td>
    		</tr>
    	</table>
    	<table class="table table-dark table-hover table-striped table-sm">
		  <thead>
		    <tr>
		      <th scope="col" class="text-center">No</th>
		      <th scope="col" class="text-left">Tabung</th>
		      <th scope="col" class="text-center">Jumlah</th>
		    </tr>
		  </thead>
		  <tbody id="list-data-ambil-bahan">
		    
		  </tbody>
		</table>
      </div>
      <div class="modal-footer" style="padding:10px">
        <button type="button" class="btn btn-light btn-md" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary btn-md" id="btn-approved" onclick="approved_by()">Terima</button>
      </div>
    </div>
  </div>
</div>


<div class="hide">    
	<div class="dt_index_actions">
		
	</div>
</div>

@section('script')
<script type="text/javascript">
var table;
var data_selected=null;
var pk_selected=null;

$(document).ready(function(){
	// $('#birth').datetimepicker({
	// 	format: 'MM/DD/YYYY'
	// });
	// $('#basic-datatables').DataTable();
	//$.fn.dataTableExt.sErrMode = 'throw';
    $.fn.dataTable.ext.errMode = 'none';
    table = $('#basic-datatables').DataTable({
	    "processing": true, //Feature control the processing indicator.
	    "serverSide": true, //Feature control DataTables' server-side processing mode.
	    // Load data for the table's content from an Ajax source
	    "ajax": {
	        "url": "{{url('ambilbahan/all')}}",
	        "type": "GET"
	    },
	    columns: [
	        {
	            searchable: false,
	            render: function (data, type, row, meta) {
	                return meta.row + meta.settings._iDisplayStart + 1;
	            }
	        },
	        {
	        	data: "created_at",
	        	searchable:false,
	            render: function (data, type, row, meta) {
	                return moment(row.created_at).locale('id').format('LLL');
	            }
	        },
	        {
	        	data: "user_id",
	        	searchable:false,
	            render: function (data, type, row, meta) {
	                return row?.user?.namalengkap
	            }
	        },
	        {
	        	data: "lab_id",
	        	searchable:false,
	            render: function (data, type, row, meta) {
	                return row?.lab?.nama
	            }
	        },
	        {data: "nama_pasien"},
	        {data: "yg_menyerahkan"},
	        {data: "yg_menerima"},
	        {
	        	data: "approved_at",
	        	searchable:false,
	            render: function (data, type, row, meta) {
	            	if(row.approved_at != null){
	            		return moment(row.approved_at).locale('id').format('LT');
	            	}
	                return '-'
	            }
	        },
	        
	    ],
	    "columnDefs": [
	    	{
            "targets": 8,
            "render": function(data, type, row, meta){
            	console.log(row.approved_at)
               var str='';

               if(row.approved_at === null){
               		str += ' <button onclick="get_detail('+"'"+row.id+"'"+')" title="Terima Bahan?" class="btn btn-sm btn-warning"><i class="fa fa-clipboard-list" style="font-size:20px"></i></button>';
               }else{
               		str += ' <button onclick="get_detail('+"'"+row.id+"'"+')" title="Sudah diterima" class="btn btn-sm btn-info"><i class="fa fa-clipboard-list" style="font-size:20px"></i></button>';
               }
               
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
  	// $('#basic-datatables tbody').on( 'click', 'tr', function(){
	  //   if ($(this).hasClass('selected')) {
	  //       $(this).removeClass('selected');
	  //   }
	  //   else {
	  //       table.$('tr.selected').removeClass('selected');
	  //       $(this).addClass('selected');
	  //   }
	  //   // data_selected = table.row( this ).data();
	  //   // console.log(data_selected)
  	// });
  	// $('.dt_actions').html($('.dt_index_actions').html());
  	$('#basic-datatables tbody').on('dblclick', 'tr', function () {
		var data = table.row( this ).data();
		set_data(data)
	});
});


function get_detail(id) {
	$.get('/ambilbahan/byid/'+id,function(res,status){
		set_data(res)
	})
}

function set_data(data) {
	pk_selected=data.id
		$('#mdl-title').text('Tujuan : '+data?.lab?.nama)
		$('#text-tanggal').text(': '+moment(data?.created_at).locale('id').format('LLL'))
		$('#text-petugas').text(': '+data?.user?.namalengkap)
		$('#text-tujuan').text(': '+data?.lab?.nama)
		$('#text-pasien').text(': '+data?.nama_pasien)
		$('#text-menyerahkan').text(': '+data?.yg_menyerahkan)
		$('#mdl-form-approved-bahan').modal('show');
		if(data.yg_menerima != null){
			$('#btn-approved')
			.text('Sudah Diterima')
			.attr('disabled','true');

			$('#txt-approved_by')
			.val(data.yg_menerima)
			.attr('readonly','true')
		}else{
			$('#btn-approved')
			.text('Terima')
			.removeAttr('disabled');

			$('#txt-approved_by')
			.val(data.yg_menerima)
			.removeAttr('readonly')
		}

		$('#list-data-ambil-bahan').html('<tr><td class="text-center" colspan="3">Loading...</td></tr>');
		$.get('/ambilbahan/tabung/'+data.id,function(res,status){

			var list_data='';
			var no=1;
			if(res.length > 0){
				for (var i = 0; i < res.length; i++) {
					list_data +='<tr>';
					list_data +='<th scope="row" class="text-center">'+ no++ +'</th>';
					list_data +='<td class="text-left">'+res[i]?.tabung?.nama+'</td>';
					list_data +='<td class="text-center">'+res[i].jumlah+'</td>';
					list_data +='</tr>';
				}
				$('#list-data-ambil-bahan').html(list_data)
			}else{
				$('#list-data-ambil-bahan').html('<tr><td class="text-center" colspan="3">Tidak ada data</td></tr>');
			}
			
		});
}

function convert_date(tgl) {
	var date = new Date(tgl);
	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear();
	return year+'-'+month+'-'+day;
}

function get_list_data(){
	var tgl_dr = $('#tgl-dari').val()
	console.log(tgl_dr)
    table.ajax.url('{{url('ambilbahan/all')}}?tgl-dari='+$('#tgl-dari').val()+'&tgl-sampai='+$('#tgl-sampai').val()).load();
    //table.ajax.reload(null,false);
}

function approved_by() {
	if($('#txt-approved_by').val() !=''){
		$('#btn-approved')
		.text('Loading...')
		.attr('disabled','true')
		$.post('/ambilbahan/approved/'+pk_selected,{
			"_token": "{{ csrf_token() }}",
			"approved_by":$('#txt-approved_by').val()
		},function(res,status){
			$('#btn-approved')
			.text('Sudah Diterima')
			.removeAttr('disabled')
			$('#mdl-form-approved-bahan').modal('hide');
			get_list_data()
		});
	}
	
}

</script>
@endsection
@endsection