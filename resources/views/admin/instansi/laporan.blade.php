<table>
	<thead>
		<th style="font-size: 20px;" height="30" colspan="5" align="center"><b>LAPORAN INTANSI</b></th>
	</thead>
</table>

<table>
	<thead>
		<th style="font-size: 14px;" height="20" colspan="5" align="center">Tanggal {{$data->filter->from}} - {{$data->filter->to}}</th>
	</thead>
</table>
<table>
	<thead>
		<th colspan="5">&nbsp;</th>
	</thead>
</table>

<table>
    <thead>
    <tr>
        <th height="20"><b>Tanggal</b></th>
        <th height="20"><b>Nama Petugas</b></th>
        <th height="20"><b>Kegiatan</b></th>
        <th height="20"><b>Tujuan</b></th>
        <th height="20"><b>Keterangan</b></th>
    </tr>
    </thead>
    <tbody>
	    @foreach($data->list as $item)
	        <tr>
	            <td>{{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}</td>
	            <td>{{ $item->user->namalengkap }}</td>
	            {{-- <td>{{ $item->jenis_keg }}</td> --}}
	            <td>
	            	@if($item->uraianterpilih != null && count($item->uraianterpilih) > 0)
		            	@foreach ($item->jenis_keg as $keg)
						     <p>- {{ $keg['keg'] }}</p>
						@endforeach
					@endif
	            </td>
	            <td>{{ $item->tujuan }}</td>
	            <td>{{ $item->ket }}</td>
	        </tr>
	    @endforeach
    </tbody>
</table>