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

table, th, td {
  border: 1px solid black;
}

p{

  text-align: justify;
  text-justify: inter-word;
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

    
 <?php
    
    $imagePath_ = 'assets\images\kuantumlogo.jpg';
    $imageData_ = file_get_contents($imagePath_);
    $base64Image_ = base64_encode($imageData_);
    $imageUrl_ = 'data:image/png;base64,' . $base64Image_;
  
    ?>


    <table>

     <tbody>

     <tr>


    <td >

    <img src="{{$imagePath_}}" width="150" />

    </td>
     <td style="width:400px;">

      <p>Menara 165, Lt. 2 Platinum No. 9</p>
      <p>Jl. TB Simatupang Kav. 1 Kel. Cilandak Timur</p>
      <p>Kec. Pasar Minggu, Jakarta Selatan - 12560</p>
      <p>Telp : (021) 5081 2002209 Email : info@kuantumsolusi.com</p>
      <p>Web : www.kuantumsolusi.com</p>

  
     <td>

    <img src="{{$imagePath}}" width="140" />

    </td>

   </tr>

</tbody>

</table>
  

  <div style="background-color:blue;width:713px;height:35px;">

  <center>

  <label style="font-size:18px;font-weight:bold;color:white;" >Laporan Timesheet JM Onsite</label>

</center>
<!-- 
  <br>
  <br>
 Tanggal 	:  <label style="font-size:14px;">{{$tanggal_dari}} - {{$tanggal_ke}}</label>   -->

</div>

  {{''}}

  
<table>


     <tbody>

     <th></th>
     <th></th>
    
@foreach($data_employee as $row_)
     <tr>
     <td >Nama Karyawan:</td>
     <td style="width:348px;">{{$row_->name}}</td>
    </tr>
     <tr>
     <td >Posisi:</td>
     <td style="width:348px;">@if($row_->jabatan==1){{'Web Functional Support'}}@elseif($row_->jabatan==2){{'Support'}}@elseif($row_->jabatan==3){{'Admin Compliance'}}@else {{'--posisi belum terdaftar--'}}@endif</td>
    </tr>
     <tr>
     <td >Nama Klien:</td>
    <td style="width:348px;">PT. JasaMarga Persero Tbk</td>
    </tr>
    <tr>
     <td style="width:348px;">Bulan/Tahun:</td>
     <td style="width:348px;">2025</td>
    </tr>

@endforeach
   

    </tbody>


</table>

  


<table class="table_style">
  <tr class="bg-success">
    <th>No.</th>
    <th style="width:150px;" > Nama Karyawan</th>
    <th style="width:100px;">Tanggal</th>
    <th style="width:100px;">Jam Kerja</th>
    <th style="width:200px;">Deskripsi</th>
    <th style="width:120px;">Remarks</th>

    
  </tr>
  <tbody>
  @foreach ($data as $app)
  <tr>
    <td>{{ $loop->iteration  }}</td>
                            <td>{{$app->employee->name}}</td>
                            <td style="text-align: center;" >{{$app->tanggal_timesheet}}</td>
                            <td style="text-align: center;" >08:00 - 17:00</td>
                            <td style="text-align: center;"><p>{!!$app->description!!}</p></td>
                            <td style="text-align: center;"></td>
    
  </tr>

  @endforeach
</tbody>
  
</table>


<br>
<br>



<table >
  <tr >
    <th style="width:140px;" >Karyawan Onsite</th>
    <th  style="width:0px;"></th>
    <th style="width:180px;" >Direview Oleh</th>
    <th  style="width:0px;"></th>
   
    <th style="width:180px;">Direview Oleh</th>
   
     <th  style="width:0px;"></th>
    
    <th style="width:160px;">Approve Oleh</th>
   
  
  </tr>
  <tbody>

  <tr>

  @foreach ($data_signatures as $app)

    @php
    
    
    $imagePath_employee = 'assets/images/dokumen/signatures/'.$app->ttd_employee ?? '';
    $imageData_ = file_get_contents($imagePath_employee);
    $base64Image_ = base64_encode($imageData_);
    $imageUrl_karyawan = 'data:image/jpg;base64,' . $base64Image_;

    $imagePath_spv_kuantum = 'assets/images/dokumen/signatures/'.$app->ttd_leader ?? '';
    $imageData_kuantum = file_get_contents($imagePath_spv_kuantum);
    $base64Image_kuantum = base64_encode($imageData_kuantum);
    $imageUrl_spv_kuantum = 'data:image/jpg;base64,' . $base64Image_kuantum;

     
    $imagePath_spv_onsite = 'assets/images/dokumen/signatures/'.$app->ttd_spv ??'';
    $imageData_spv_onsite= file_get_contents($imagePath_spv_onsite);
    $base64Image_spv_onsite = base64_encode($imageData_spv_onsite);
    $imageUrl_spv_onsite= 'data:image/jpg;base64,' . $base64Image_spv_onsite;


    if($app->ttd_mnj==null){

    $imagePath_mnj_onsite = 'assets/images/icon/pen.jpg';
    $imageData_mnj_onsite= file_get_contents($imagePath_mnj_onsite);
    $base64Image_mnj_onsite = base64_encode($imageData_mnj_onsite);
    $imageUrl_mnj_onsite= 'data:image/jpg;base64,' . $base64Image_mnj_onsite;

    }else{

      
    $imagePath_mnj_onsite = 'assets/images/dokumen/signatures/'.$app->ttd_mnj;
    $imageData_mnj_onsite= file_get_contents($imagePath_mnj_onsite);
    $base64Image_mnj_onsite = base64_encode($imageData_mnj_onsite);
    $imageUrl_mnj_onsite= 'data:image/jpg;base64,' . $base64Image_mnj_onsite;



    }


    



  @endphp
    
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

 <img src="{{$imagePath_spv_onsite}}"  width="150px"/>
       Mirotus Solekhah
  </td>
     <td style="text-align: center;width:0px;"></td>
 
    <td style="text-align: center;">

    <br>
    <br>
    <br>

       <img src="{{$imagePath_spv_onsite}}"  width="150px"/>
   Ayu
  </td>
 
     
    <td style="text-align: center;"><br><br><br></td>


    <td style="text-align: center;"><br><br><br>

     <img src="{{$imagePath_mnj_onsite}}"  width="150px"/>
    
    
   Nasir Ahmad</td>

  

    
  </tr>

</tbody>
  
</table>

 





</body>





</html>
