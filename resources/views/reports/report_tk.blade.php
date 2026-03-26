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
<label style="font-size:18px;font-weight:bold;" >Laporan TK Web SELIA,CSIRT,JMGUEST,JMLINK,JMINNOV & JIMMS</label>
<br>
<br>
<label style="font-size:14px;">Dari Tanggal: Ke:</label>

<br>
<br>


<table class="table_style">
  <tr class="bg-success">
    <th>No.</th>
    <th style="width:100px;" > Nama Aplikasi</th>
    <th>Bahasa Pemograman</th>
    <th>Framework</th>
    <th style="width:250px;">Catatan</th>
    <th style="width:120px;">Keterangan</th>
    <th>Status TK</th>
    
  </tr>
  <tbody>
  @foreach ($data_ as $app)
  <tr>
    <td>{{ $loop->iteration  }}</td>
    <td>@if($app->kategori_aplikasi=='1'){{'SELIA'}}@elseif($app->kategori_aplikasi=='2'){{'CSIRT'}}@elseif($app->kategori_aplikasi=='3'){{'JMGUEST'}}@elseif($app->kategori_aplikasi=='4'){{'JMLINK'}}@elseif($app->kategori_aplikasi=='5'){{'JM INNOV'}}@elseif($app->kategori_aplikasi=='6'){{'JIMMS'}}@else {{'belum terdaftar'}} @endif <br><br> <br><br> <a style="font-size:9px;" > Date : <a></td>
    
    <td style="text-align: center;">{{ $app->bahasa_pemograman }}</td>
    <td style="text-align: center;">{{ $app->framework }}</td>
    <td style="text-align: center;">{{ $app->catatan }}</td>
    <td style="text-align: center;">{{ $app->keterangan }}</td>
     <td style="text-align: center;">{{ $app->status_tk }}</td>


    
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
      
    Mirotus Sholekhah</td>
  

    
  </tr>

</tbody>
  
</table>







</body>





</html>
