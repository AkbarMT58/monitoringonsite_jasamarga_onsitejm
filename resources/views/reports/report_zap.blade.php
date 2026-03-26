<html>

<head>

<style>

.table_style {
        border: solid 1px #aaa999;
      }
      .table_style tr th {
        border: solid 1px#009879;
        height:30px;
      }
      .table_style tr td {
        border: solid 1px #009879;
      }
      .table_style {
  border-collapse: collapse;
  border-spacing: 0;
}

.bg-success{

  background-color:#009879;


}



</style>

</head>


<body>

<img src="https://media.licdn.com/dms/image/v2/C511BAQHELQJ2AJwdoQ/company-background_10000/company-background_10000/0/1583948192494/jasamarga_cover?e=2147483647&v=beta&t=XMeuTUMJ3HO8Y5S9FpYKUuKL7RenTiatQbbBj3G86lw" width="200px"/>


<br>
<br>
<label style="font-size:18px;font-weight:bold;" >Laporan ZAP Web SELIA,CSIRT,JMGUEST,JMLINK,JMINNOV & JIMMS</label>
<br>
<br>
<label style="font-size:14px;">Dari Tanggal: Ke:</label>

<br>
<br>


<table class="table_style">
  <tr class="bg-success">
    <th>No.</th>
    <th style="width:80px;" >Aplikasi</th>
    <th>Akses</th>
    <th>High</th>
    <th>Medium</th>
    <th>Low</th>
    <th>Inform.</th>
    
    <th style="width:120px;">Keterangan</th>
    <th >Link Capture</th>
  </tr>
  <tbody>
  @foreach ($data as $testing)
  <tr>
    <td>{{ $loop->iteration  }}</td>
    <td>@if($testing->kategori_aplikasi=='1'){{'SELIA'}}@elseif($testing->kategori_aplikasi=='2'){{'CSIRT'}}@elseif($testing->kategori_aplikasi=='3'){{'JMGUEST'}}@elseif($testing->kategori_aplikasi=='4'){{'JMLINK'}}@elseif($testing->kategori_aplikasi=='5'){{'JM INNOV'}}@elseif($testing->kategori_aplikasi=='6'){{'JIMMS'}}@else {{'belum terdaftar'}} @endif <br><br> <br><br> <a style="font-size:9px;" > Date : {{ $testing->tanggal_cetak }}<a></td>
    <td>@if($testing->akses=='1') <a class="btn btn-success">{{'Bisa'}}</a> @else <a class="btn btn-danger">{{'Tidak'}}</a> @endif </td>
    <td style="text-align: center;">{{ $testing->high }}</td>
    <td style="text-align: center;">{{ $testing->medium }}</td>
    <td style="text-align: center;">{{ $testing->low }}</td>
    <td style="text-align: center;">{{ $testing->informational }}</td>
    <td style="text-align: center;">{{ $testing->keterangan }}</td>
    <td>{{ $testing->link_capture }}</td>
    
  </tr>

  @endforeach
</tbody>
  
</table>

<br>
<br>


<table class="table_style">
  <tr class="bg-success">
    <th>No.</th>
    <th style="width:80px;" >Aplikasi</th>
    <th  style="width:300px;">Solusi/Penyelesaian</th>
    <th style="width:100px;">Status</th>
    <th style="width:250px;">Keterangan</th>
  
  </tr>
  <tbody>
  @foreach ($data as $testing)
  <tr>
    <td>{{ $loop->iteration  }}</td>
    <td>@if($testing->kategori_aplikasi=='1'){{'SELIA'}}@elseif($testing->kategori_aplikasi=='2'){{'CSIRT'}}@elseif($testing->kategori_aplikasi=='3'){{'JMGUEST'}}@elseif($testing->kategori_aplikasi=='4'){{'JMLINK'}}@elseif($testing->kategori_aplikasi=='5'){{'JM INNOV'}}@elseif($testing->kategori_aplikasi=='6'){{'JIMMS'}}@else {{'belum terdaftar'}} @endif <br><br> <br><br> <a style="font-size:9px;" > Date : {{ $testing->tanggal_cetak }}<a></td>
    <td>{{$testing->solusi_troubleshoot}}</td>
    <td style="text-align: center;">@if($testing->status_zap=='1'){{'Open'}} @elseif($testing->status_zap=='2'){{'closed'}}@elseif($testing->status_zap=='3'){{'false positive'}}@endif</td>
    <td style="text-align: center;">{{ $testing->keterangan }}</td>
  

    
  </tr>

  @endforeach
</tbody>
  
</table>

<br>
<br>



<table >
  <tr >
   
    <th style="width:140px;" >Mengetahui</th>
    <th  style="width:300px;"></th>
    <th  style="width:300px;"></th>
    <th style="width:100px;"></th>
    <th style="width:200px;">Mengetahui JM</th>
  
  </tr>
  <tbody>

  <tr>
 
    <td style="text-align: center;">

    <br>
    <br>
    <br>
      
    Ade Supriyatna
  </td>
    <td></td>
    <td></td>

    <td style="text-align: center;"></td>
    <td style="text-align: center;">

    <br>
    <br>
    <br>
      
    Dara</td>
  

    
  </tr>

</tbody>
  
</table>







</body>





</html>
