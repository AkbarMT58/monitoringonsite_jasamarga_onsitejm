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

 @php
    
    $imagePath = 'assets\images\kuantumlogo.jpg"';
    $imageData = file_get_contents($imagePath);
    $base64Image = base64_encode($imageData);
    $imageUrl = 'data:image/png;base64,' . $base64Image;
  
  @endphp


<img src="{{$imagePath}}" width="200" />

   

      


<br>
<br>

  <div style="align-text:center;">

  <label style="font-size:18px;font-weight:bold;" >Laporan Pengajuan Cuti Karyawan Onsite Kuantum</label>

  <br>
  <br>

  Tanggal 	:  @foreach ($data as $app) <label style="font-size:14px;">{{$app->dateFrom}} - {{$app->dateTo}}</label>  @endforeach

</div>

   
</div>
<br>
<br>

Tanggal 	:  @foreach ($data as $app) {{$app->tanggal_cetak }}   @endforeach
<br>
Perihal	: Permohonan Cuti
<br>
Lampiran : -

<br>
<br>

Kepada Yth.
<br>
Direktur/Direktur Utama
<br>
Ditempat
<br>
<br>

Dengan Hormat,
<br>
<br>
Saya yang bertanda tangan di bawah ini:
<br>
<br>
 @foreach ($data as $app)
Nama		: {{$app->employee->name}}
<br>
NIK		: {{'-'}}
<br>
Jabatan	: Web Developer & Functional Support 

@endforeach
<br>
<br>
Bermaksud untuk mengajukan permohonan cuti:
<br>
<br>


	Tanggal	:  @foreach ($data as $app)
<label style="font-size:14px;">{{$app->dateFrom}} - {{$app->dateTo}}</label>
@endforeach
  <br>
  <br>
	Alasan		:  @foreach ($data as $app) {{$app->alasan_cuti }}   @endforeach
        <br>
        <br>
			  
Demikian surat permohonan cuti ini saya buat. Atas perhatian Bapak/Ibu saya sampaikan terima kasih.








<br>
<br>




<table >
  <tr >
    <th style="width:140px;" >Yang Mengajukan</th>
    <th  style="width:0px;"></th>
    <th style="width:180px;" >Mengetahui SPV Kuantum</th>

   
  
     <th  style="width:0px;"></th>
     
     <th style="width:0px;">Mengetahui Direktur/Manajer Kuantum</th>

  </tr>
  <tbody>

  <tr>
     @foreach ($data as $app)

    @php
    
    $imagePath_employee = 'assets/images/dokumen/signatures/'.$app->ttd_karyawan;
    $imageData_ = file_get_contents($imagePath_employee);
    $base64Image_ = base64_encode($imageData_);
    $imageUrl_karyawan = 'data:image/jpg;base64,' . $base64Image_;

    $imagePath_spv_kuantum = 'assets/images/dokumen/signatures/'.$app->ttd_leader;
    $imageData_kuantum = file_get_contents($imagePath_spv_kuantum);
    $base64Image_kuantum = base64_encode($imageData_kuantum);
    $imageUrl_spv_kuantum = 'data:image/jpg;base64,' . $base64Image_kuantum;

     
    $imagePath_mj_kuantum = 'assets/images/dokumen/signatures/'.$app->ttd_spv_vendor;
    $imageData_mj_kuantum = file_get_contents($imagePath_mj_kuantum);
    $base64Image_mj_kuantum = base64_encode($imageData_mj_kuantum);
    $imageUrl_mj_kuantum = 'data:image/jpg;base64,' . $base64Image_mj_kuantum


  
  
  @endphp

     <td style="text-align: center;">

     <br>
    
   

     <img src="{{$imagePath_employee}}"  width="150px"/>
    
      {{$app->employee->name}}

    
    
    
  </td>
 
  
   <td style="text-align: center;width:0px;"></td>
 
    <td style="text-align: center;">

    <br>
    <img src="{{$imagePath_spv_kuantum}}"  width="150px"/>

    

      
    Ade Supriyatna
  </td>
  
 
   <td style="text-align: center;width:0px;"></td>

<td style="text-align: center;">

    <br>
    
    <img src="{{$imagePath_mj_kuantum}}"  width="150px"/>
    
         R.Aditya Renaldi
  
  
  </td>


  

    
  </tr>

</tbody>

 @endforeach
  
</table>







</body>





</html>
