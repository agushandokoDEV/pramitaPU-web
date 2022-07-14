{{-- <p style="font-size: 20px;">Laporan</p>
<p></p> --}}
<table>
	<thead>
		<th style="font-size: 20px;" height="30" colspan="8" align="center"><b>LAPORAN AMBIL BAHAN / KUNJUNGAN</b></th>
	</thead>
</table>

<table>
	<thead>
		<th style="font-size: 14px;" height="20" colspan="8" align="center">Tanggal {{$data->filter->from}} - {{$data->filter->to}}</th>
	</thead>
</table>
<table>
	<thead>
		<th colspan="8">&nbsp;</th>
	</thead>
</table>

<table>
    <thead>
    <tr>
        <th height="20"><b>Tanggal</b></th>
        <th height="20"><b>Nama Petugas</b></th>
        <th height="20"><b>Tujuan Lab</b></th>
        <th height="20"><b>Nama Pasien</b></th>
        <th height="20"><b>Yang Menyerahkan</b></th>
        <th height="20"><b>Yang Menerima</b></th>
        <th height="20"><b>Jam</b></th>
        <th height="20"><b>Tabung dan Jumlah</b></th>
    </tr>
    </thead>
    <tbody>
	    @foreach($data->list as $item)
	        <tr>
	            <td>{{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}</td>
	            <td>{{ $item->user->namalengkap }}</td>
	            <td>{{ $item->lab->nama }}</td>
	            <td>{{ $item->nama_pasien }}</td>
	            <td>{{ $item->yg_menyerahkan }}</td>
	            <td>{{ $item->yg_menerima }}</td>
	            <td>{{ $item->approved_at != null?date('Y-m-d H:i:s', strtotime($item->approved_at)):'' }}</td>
	            <td>
	            	@foreach($item->listtabung as $tabung)
	            	<p>- {{$tabung->tabung->nama}}  ({{$tabung->jumlah}})</p>
			        @endforeach
	            </td>
	        </tr>
	        {{-- @foreach($item->listtabung as $tabung)
            <tr>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td></td>
            	<td>{{$tabung->tabung->nama}}</td>
            	<td>{{$tabung->jumlah}}</td>
            </tr>
            @endforeach --}}
	    @endforeach
    </tbody>
</table>