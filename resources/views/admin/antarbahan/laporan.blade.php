{{-- <p style="font-size: 20px;">Laporan</p>
<p></p> --}}
<table>
	<thead>
		<th style="font-size: 20px;" height="30" colspan="4" align="center"><b>LAPORAN ANTAR BAHAN / RUJUKAN</b></th>
	</thead>
</table>

<table>
	<thead>
		<th style="font-size: 14px;" height="20" colspan="4" align="center">Tanggal {{$data->filter->from}} - {{$data->filter->to}}</th>
	</thead>
</table>
@if($data->filter->user != null)
<table>
	<thead>
		<th style="font-size: 16px;" height="20" colspan="4" align="center">{{$data->filter->user->namalengkap}}</th>
	</thead>
</table>
@endif
<table>
	<thead>
		<th colspan="4">&nbsp;</th>
	</thead>
</table>

<table>
    <thead>
    <tr>
        <th height="20"><b>Tanggal</b></th>
        <th height="20"><b>Nama Petugas</b></th>
        <th height="20"><b>Tujuan Lab</b></th>
        <th height="20"><b>Nama Penerima</b></th>
    </tr>
    </thead>
    <tbody>
	    @foreach($data->list as $item)
	        <tr>
	            <td>{{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}</td>
	            <td>{{ $item->user->namalengkap }}</td>
	            <td>{{ $item->lab->nama }}</td>
	            <td>{{ $item->penerima }}</td>
	        </tr>
	    @endforeach
    </tbody>
</table>