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
    
    $imagePath = 'assets\images\kuantumlogo.jpg';
    $imageData = file_get_contents($imagePath);
    $base64Image = base64_encode($imageData);
    $imageUrl = 'data:image/png;base64,' . $base64Image;
  
    ?>


<img src="{{$imagePath}}" width="200" />
  

<br>
<br>

  <div style="align-text:center;">

  <label style="font-size:18px;font-weight:bold;" >Laporan Timesheet Kuantum</label>

  <br>
  <br>

  Tanggal 	:  <label style="font-size:14px;">{{$tanggal_dari}} - {{$tanggal_ke}}</label>  

  {{''}}

  
<br>
<br>






<br>
<br>

<table class="table_style">
  <tr class="bg-success">
    <th>No.</th>
    <th style="width:150px;" > Nama Karyawan</th>
    <th style="width:200px;">Tanggal</th>
    <th style="width:200px;">Jam Kerja</th>
    <th style="width:250px;">Deskripsi</th>
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
    <th style="width:140px;" >Yang Mengajukan</th>
    <th  style="width:0px;"></th>
    <th style="width:180px;" >Mengetahui Team Lead</th>
    <th  style="width:0px;"></th>
   
    <th style="width:180px;">Diperiksa Oleh</th>
   
     <th  style="width:0px;"></th>
    
  
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

     <img src="{{$imagePath_employee}}"  width="160px"/>
    
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
   
 
     
    <td style="text-align: center;"><br><br><br></td>


    <td style="text-align: center;"><br><br><br>

     <img src="{{$imagePath_mnj_onsite}}"  width="150px"/>
    
    
   R.Aditya Renaldi</td>

  

    
  </tr>

</tbody>
  
</table>

 





</body>





</html>
