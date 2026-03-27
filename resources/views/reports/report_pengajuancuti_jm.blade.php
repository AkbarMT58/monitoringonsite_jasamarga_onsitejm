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

 <?php
    
    $imagePath = 'assets\images\jasamarga.jpg';
    $imageData = file_get_contents($imagePath);
    $base64Image = base64_encode($imageData);
    $imageUrl = 'data:image/png;base64,' . $base64Image;
  
    ?>


<img src="{{$imagePath}}" width="200" />
  

<br>
<br>

  <div style="align-text:center;">

  <label style="font-size:18px;font-weight:bold;" >Laporan Pengajuan Cuti Karyawan Onsite JM</label>

  <br>
  <br>

  Tanggal 	:  @foreach ($data as $app) <label style="font-size:14px;">{{$app->dateFrom}} - {{$app->dateTo}}</label>  @endforeach

</div>

  {{''}}

  
<br>
<br>






<br>
<br>

<table class="table_style">
  <tr class="bg-success">
    <th>No.</th>
    <th style="width:150px;" > Nama Karyawan</th>
    <th>Jumlah Cuti</th>
    <th>Sisa Cuti</th>
    <th style="width:250px;">Alasan Cuti</th>
    <th style="width:120px;">Status Cuti</th>

    
  </tr>
  <tbody>
  @foreach ($data as $app)
  <tr>
    <td>{{ $loop->iteration  }}</td>
                            <td>{{$app->employee->name}}</td>
                            <td style="text-align: center;" >{{$app->jumlah_pengajuan_cuti}}</td>
                            <td style="text-align: center;" >{{$app->sisa_cuti}} </td>
                            <td style="text-align: center;">{{ $app->alasan_cuti }}</td>
                            <td style="text-align: center;">@if($app->status_cuti=='1'){{'Draft'}}@elseif($app->status_cuti=='2'){{'Waiting Approval'}} @elseif($app->status_cuti=='3'){{'Approved Kuantum'}}@elseif($app->status_cuti=='4'){{'Approved Manajer Kuantum'}}@elseif($app->status_cuti=='5'){{'Approved SPV Kuantum'}}@elseif($app->status_cuti=='6'){{'Approved SPV JM'}}@elseif($app->status_cuti=='7'){{'Approved Manajer JM'}}@else {{'Draft'}}@endif</td>

    
  </tr>

  @endforeach
</tbody>
  
</table>


<br>
<br>



<table >
  <tr >
    <th style="width:140px;" >Yang Mengajukan</th>
    <th  style="width:0px;"></th>
    <th style="width:180px;" >Mengetahui SPV Kuantum</th>
    <th  style="width:0px;"></th>
   
    <th style="width:180px;">Mengetahui SPV JM</th>
   
     <th  style="width:0px;"></th>
    
    <th style="width:160px;">Mengetahui Manajer JM</th>
   
  
  </tr>
  <tbody>

  <tr>
    
  @foreach ($data as $app)

  


    @if(isset($app->ttd_karyawan))

    
    @php

    
    
    $imagePath_employee = 'assets/images/dokumen/signatures/'.$app->ttd_karyawan;
    $imageData_ = file_get_contents($imagePath_employee);
    $base64Image_ = base64_encode($imageData_);
    $imageUrl_karyawan = 'data:image/jpg;base64,' . $base64Image_;

    
  @endphp


    @else 

    
    @php


    
    $imagePath_employee = "";

    
  @endphp

    
    
    @endif

    


    @if($app->ttd_leader==null)

    
    @php


    $imagePath_spv_kuantum==""

    @endphp



    @else 

    
    @php

    $imagePath_spv_kuantum = 'assets/images/dokumen/signatures/'.$app->ttd_leader;
    $imageData_kuantum = file_get_contents($imagePath_spv_kuantum);
    $base64Image_kuantum = base64_encode($imageData_kuantum);
    $imageUrl_spv_kuantum = 'data:image/jpg;base64,' . $base64Image_kuantum;

    @endphp

    @endif

     
    
    @if($app->ttd_spv_onsite==null)

    @php

    $imagePath_spv_onsite=="";

    @endphp

    @else 

    @php 

    $imagePath_spv_onsite = 'assets/images/dokumen/signatures/'.$app->ttd_spv_onsite;
    $imageData_spv_onsite= file_get_contents($imagePath_spv_onsite);
    $base64Image_spv_onsite = base64_encode($imageData_spv_onsite);
    $imageUrl_spv_onsite= 'data:image/jpg;base64,' . $base64Image_spv_onsite;

    @endphp

    @endif


@if($app->ttd_manajer_onsite==null)

@php

    $imagePath_mnj_onsite==""

@endphp

    @else 

    
@php
    $imagePath_mnj_onsite = 'assets/images/dokumen/signatures/'.$app->ttd_manajer_onsite;
    $imageData_mnj_onsite= file_get_contents($imagePath_mnj_onsite);
    $base64Image_mnj_onsite = base64_encode($imageData_mnj_onsite);
    $imageUrl_mnj_onsite= 'data:image/jpg;base64,' . $base64Image_mnj_onsite;

@endphp

    @endif


     <td style="text-align: center;">

     <br>
    <br>
    <br>

     <img src="{{$imagePath_employee}}"  width="150px"/>
    
      {{$app->employee->name}}

    
    
      
    
  </td>
  @endforeach
   <td style="text-align: center;width:0px;"></td>
 
    <td style="text-align: center;">

    <br>
    <br>
    <br>

 <img src="{{$imagePath_spv_kuantum}}"  width="150px"/>
      
    Ade Supriyatna
  </td>
     <td style="text-align: center;width:0px;"></td>
 
    <td style="text-align: center;">

    <br>
    <br>
    <br>

       <img src="{{$imagePath_spv_onsite}}"  width="150px"/>
    Dara Ramadhani
  </td>
 
     
    <td style="text-align: center;"><br><br><br></td>


    <td style="text-align: center;"><br><br><br>

     <img src="{{$imagePath_mnj_onsite}}"  width="150px"/>
    
    
    Hendra Saputra Yuriswanto</td>

  

    
  </tr>

</tbody>
  
</table>

 





</body>





</html>
