@extends('dashboard.body.main')

@section('specificpagestyles')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Onsite Attendance</h4>
                    </div>
                </div>
                

                <div class="row">

                

                 <div class="col-lg-4">

                </div>

                  <div class="col-lg-4">

                </div>

                <div class="col-lg-4">

                <br>
                <br>

                  <a href="{{ route('attendence.create') }}" class="btn btn-primary add-list" id="create_absen"><i class="fas fa-plus mr-3"></i><i class="ri-time-line"></i> Absen Masuk</a>
                </div>
              </div>
                <div    >

                            <div hidden>
                                <label for="datepicker" >Tanggal <span class="text-danger">*</span></label>
                                <input id="datepicker" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', $date) }}" />
                            
                                <br>
                                <label for="datepicker">Pukul<span class="text-danger">*</span></label>
                                <div class="input-group-text">
                               
                                <div id="time_ID"></div>

                              </div>

                              <label for="datepicker">Tanggal Sekarang<span class="text-danger">*</span></label>
                                <div class="input-group-text">
                               
                                <div id="datepicker_create_"></div>

                              </div>
                                @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>




               
        
                <div class="card-body" >
                    <form action="{{ route('attendence.store') }}" method="POST">
                    @csrf
                        <!-- begin: Input Data -->

                        <br>
                        <br>
        <div class="row">
                    
        @foreach ($attendences as $attendence)

        
                                            @php
                                            
                                            $terlambat=$attendence->terlambat;
                                            $img_photo=$attendence->employee->photo;


                                            @endphp

                                          
                
          <div hidden> {{ $key = $loop->iteration  }} </div>

        <div class="col-lg-6">

            <div class="card card-block card-stretch card-height">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Absen</h4>
                    </div>
                    <div class="card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton001"
                                data-toggle="dropdown">
                                This Month<i class="ri-arrow-down-s-line ml-1"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right shadow-none"
                                aria-labelledby="dropdownMenuButton001">
                                <a class="dropdown-item" href="#">Year</a>
                                <a class="dropdown-item" href="#">Month</a>
                                <a class="dropdown-item" href="#">Week</a>
                            </div>
                        </div>
                    </div>
                </div>

               
                <div class="card-body">
                    <h3>{{$attendence->employee->name}}</h3>
                      <div class="card-img">
        <!-- Placeholder Image -->
        <!-- <i class="ri-image-line ri-3x" style="color: #888;"></i> -->
       
        <img src="{{$img_photo ? asset('assets/images/employees/'.$img_photo) : asset('assets/images/user/1.png')}}" class="avatar-100 rounded"  >
    </div>
    <div class="card-content">
        <!-- Button with Remix Icon -->
         <div class="row">
            <div class="col-lg-6">
                 <div class="input-group-text"  hidden>
                            <input type="text" class="form-control" name="jam_masuk{{$key}}" id="waktu{{$key}}"  />
                            <input type="text" class="form-control" name="id_karyawan{{$key}}" value="{{$attendence->id}}" />
                 </div>
                <div class="input-group-text" hidden >
                <input type="text" class="form-control" id="late{{$key}}" name="jam_terlambat{{$key}}" readonly/>
                </div>
               

        <a class="card-btn" style="font-weight:bold;color:black;"   >
        <i class="ri-arrow-down-line"  > <label id="present{{$key}}" style="color:white;" ><i class="ri-time-line"></i> @if(empty($attendence->clock_in)){{'00:00:00:00'}}@else {{$attendence->clock_in}}@endif</label>
        <br></i>
        Absen Masuk
        </a>
          </div>
           <div class="col-lg-6" >
        <a  class="card-btn-out" style="font-weight:bold;" onclick="Clock_Out({{$attendence->id}},{{$attendence->employee_id}},{{$key}})">
            <i class="ri-arrow-up-line" ><label id="present{{$key}}" style="color:white;" ><i class="ri-time-line"></i> @if(empty($attendence->clock_out)){{'00:00:00:00'}}@else {{$attendence->clock_out}}@endif</label></i>Absen Keluar
            
        </a>
          </div>
       </div>
    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">


         <input type="hidden" name="employee_id[{{ $key }}]" value="{{ $attendence->id }}">

           @if(!empty($attendence->keterangan))
            <div class="card card-block card-stretch card-height card-ijin" >

            @else

               <div class="card card-block card-stretch card-height" >



            @endif
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Ijin</h4>
                    </div>
                    <div class="card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton002"
                                data-toggle="dropdown">
                                This Month<i class="ri-arrow-down-s-line ml-1"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right shadow-none"
                                aria-labelledby="dropdownMenuButton002">
                                <a class="dropdown-item" href="#">Yearly</a>
                                <a class="dropdown-item" href="#">Monthly</a>
                                <a class="dropdown-item" href="#">Weekly</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                     <h3>{{$attendence->employee->name}}</h3>
                    <!-- <div id="layout1-chart-2" style="min-height: 360px;"></div> -->
                      <div class="card-img">
        <!-- Placeholder Image -->
        <!-- <i class="ri-image-line ri-3x" style="color: #888;"></i> -->
         <img class="avatar-100 rounded" src="{{ $img_photo ? asset('assets/images/employees/'.$img_photo) : asset('assets/images/user/1.png') }}" >

    </div>
    <div class="card-content">
        <h3 class="card-name"></h3>
        <!-- Button with Remix Icon -->
         <div class="row">
            <div class="col-lg-6">

            @if(empty($attendence->keterangan))

        <a  class="card-btn-sick" style="font-weight:bold;" >
            <i class="ri-arrow-down-line"><label id="present{{$key}}" style="color:black;" ><i class="ri-time-line"></i> @if(empty($attendence->terlambat)){{'00:00:00:00'}}@else {{$attendence->terlambat}}@endif</label> Jam  Terlambat</i>
        </a>

        @else

        {{''}}


        @endif
        
        <input type="file" id="realInput{{$key}}" style="display:none;">
      

          </div>
           <div class="col-lg-6">

           @if(empty($attendence->keterangan  ))

           <a  class="card-btn-ijin" id="btnIjin{{$key}}" style="font-weight:bold;" onclick="Buat_Alasan_Ijin({{$attendence->id}},{{$attendence->employee_id}},{{$key}})" >
            <i class="ri-arrow-down-line"><label id="ijin{{$key}}" style="color:black;" ><i class="ri-time-line"></i></label>Ijin/Sakit</i>
          </a>

           @elseif(!empty($attendence->keterangan && empty($attendence->file_dokumen)))

           <a  class="card-btn-sudah_ijin" id="btnIjin{{$key}}" style="font-weight:bold;"  >
           <i class="ri-arrow-down-line"><label id="ijin{{$key}}" style="color:black;" ><i class="ri-time-line"></i></label>Ijin/Sakit</i>
          </a>
          <label style="font-weight:bold;">Keterangan : {{$attendence->keterangan}}</label>
        
           @else

             <a class="card-btn-lampiran" href="{{asset('assets/images/dokumen')}}{{'/'}}{{'attendance/'}}{{$attendence->file_dokumen}}" target="blank_"  style="font-weight:bold;" onclick="Absent_Ijin({{$key}},{{$attendence->id}})" >
            
            <i class="ri-arrow-down-line"><label id="present{{$key}}" style="color:black;" ><i class="ri-time-line"></i> @if(empty($attendence->clock_out)){{$attendence->waktu_cetak}}@endif</label>Download Lampiran</i>
            </a>

           @endif
        <input type="file" id="realInput{{$key}}" style="display:none;">
        
            

      
          </div>
           

       </div>

        <div id="tampilkan_alasan_ijin{{$key}}"></div>
                </div>
            </div>
            
        </div>
        

</div>





@endforeach







                            <div class="col-lg-12" hidden>
                                <div class="table-responsive rounded mb-3" >
                                    <table class="table mb-0" id="absenedit">
                                        <thead class="bg-white text-uppercase">
                                            <tr class="ligth ligth-data">
                                               
                                             
                                               
                                            </tr>
                                        </thead>
                                        <tbody class="ligth-body">
                                            @foreach ($attendences as $attendence)

                                            @php
                                            
                                            $terlambat=$attendence->terlambat;

                                            @endphp

                                          
                                            <tr>
                                                <th scope="row">{{ $key = $loop->iteration  }}</th>
                                               
                                                <td>
                                                    <input type="hidden" name="employee_id[{{ $key }}]" value="{{ $attendence->employee_id }}">
                                                    <div class="input-group">
                                                        <div class="input-group justify-content-center">
                                                        <div class="input-group-text" hidden>
                                                            <input type="text" class="form-control" id="waktu{{$key}}" readonly/>
                                                            <div class="tampilkan_absen"></div>
                                                        </div>
                                                           
                                                              
                                                        @if($attendence->absent=='1')
                                                         <div id="block_div_ijin{{$key}}" class="input-group-text" style="background-color:#09143C">


                                                        <div class="input-group-text mx-2" style="background-color:green;">
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="present{{ $key }}" onclick="Clock_In({{$attendence->id}},{{$attendence->employee->id}},{{$key}})" name="clock_in{{ $key }}"  class="custom-control-input position-relative" style="height: 20px" value="keluar" {{ $attendence->status == 'masuk' ? 'checked' : '' }} disabled>
                                                                    <label class="custom-control-label" for="present{{ $key }}" style="color:white;" > {{ $attendence->employee->name}} Masuk </label>
                                                                    <br>
                                                                    <label id="present{{$key}}" style="color:white;" ><i class="ri-time-line"></i> {{$attendence->clock_in}}</label>
                                                                </div>
                                                            </div>
                                                                    
                                                                  
                                                            <div class="input-group-text mx-2" style="background-color:yellow;">
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="clock_out{{ $key }}" onclick="Clock_Out({{$attendence->id}},{{$attendence->employee->id}},{{$key}})" name="clock_out{{ $key }}" class="custom-control-input position-relative" style="height: 20px" value="keluar" {{ $attendence->status == 'keluar' ? 'checked' : '' }} disabled>
                                                                    <label class="custom-control-label" for="clock_out{{ $key }}" style="color:black;" > {{ $attendence->employee->name}} Keluar </label>
                                                                    <br>
                                                                    <label id="clockout{{$key}}"  ><i class="ri-time-line"></i> {{$attendence->clock_out}}</label>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="input-group-text mx-2" style="background-color:red;">
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="leave{{ $key }}"   class="custom-control-input position-relative" style="height: 20px" value="keluar" disabled >
                                                                    <label class="custom-control-label" for="leave{{ $key }}" style="color:white;" >Terlambat </label>
                                                                    <br>
                                                                    <label id="late{{$key}}"  style="color:white;" > <i class="ri-time-line"></i> {{$attendence->terlambat}} jam</label>
                                                                </div>
                                                            </div>

                                                            <div class="input-group-text mx-2">

                                                            <i class="ri-file-pdf-line"></i>

                                                            <a href="{{asset('assets/images/dokumen')}}{{'/'}}{{'attendance/'}}{{$attendence->file_dokumen}}" target="blank_">
                                                           

                                                            Lampiran Ijin/Absen

                                                            </a>

                                                            </div>

                                                            @if($attendence->absent=="1")
                                                            
                                                            <div class="input-group-text" style="background-color:#5F9EA0;" hidden>
                                                                
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="absent{{ $key }}"  name="absen{{ $key }}" class="custom-control-input position-relative" style="height: 20px" value="absen" {{ $attendence->status == 'absent' ? 'checked' : '' }} >
                                                                    <label class="custom-control-label" for="absent{{ $key }}" style="color:white;" > {{ $attendence->employee->name}} Absen </label>
                                                                    

                                                                </div>
                                                               
                                                                <div class="custom-radio" hidden>
                                                                    <div id="absent_reason{{$key }}"></div>
                                                                </div>

                                                                
                                                            </div>

                                                            @else

                                                            
                                                            <div class="input-group-text" style="background-color:#5F9EA0;" >
                                                                
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="absent{{ $key }}" onclick="Absent({{$attendence->id}},{{$attendence->employee->id}},{{$key}})" name="absen{{ $key }}" class="custom-control-input position-relative" style="height: 20px" value="absen" {{ $attendence->status == 'absent' ? 'checked' : '' }} >
                                                                    <label class="custom-control-label" for="absent{{ $key }}" style="color:white;" > {{ $attendence->employee->name}} <br><br>Ijin </label>

                                                                </div>
                                                               
                                                                <div class="custom-radio">
                                                                <form id="form_data_ijin" method="POST"   enctype="multipart/form-data">
                                                                @csrf

                                                                    <div id="absent_reason{{$key }}"></div>

                                                                </form>
                                                                </div>
                                                            </div>
                                                           


                                                            @endif

                                                            </div>

                                                            @else

                                                            <div id="block_div_ijin{{$key}}" >


                                                        <div class="input-group-text " style="background-color:green;width:200px:">
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="present{{ $key }}" onclick="Clock_In({{$attendence->id}},{{$attendence->employee->id}},{{$key}})" name="clock_in{{ $key }}"  class="custom-control-input position-relative" style="height: 20px" value="keluar" {{ $attendence->status == 'masuk' ? 'checked' : '' }} >
                                                                    <label class="custom-control-label" for="present{{ $key }}" style="color:white;" > {{ $attendence->employee->name}} Masuk </label>
                                                                    <br>
                                                                    <label id="present{{$key}}" style="color:white;" ><i class="ri-time-line"></i> {{$attendence->clock_in}}</label>
                                                                </div>
                                                            </div>
                                                                    
                                                                  
                                                            <div class="input-group-text " style="background-color:yellow;">
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="clock_out{{ $key }}" onclick="Clock_Out({{$attendence->id}},{{$attendence->employee->id}},{{$key}})" name="clock_out{{ $key }}" class="custom-control-input position-relative" style="height: 20px" value="keluar" {{ $attendence->status == 'keluar' ? 'checked' : '' }}  >
                                                                    <label class="custom-control-label" for="clock_out{{ $key }}" style="color:black;" > {{ $attendence->employee->name}} Keluar </label>
                                                                    <br>
                                                                    <label id="clockout{{$key}}"  ><i class="ri-time-line"></i> {{$attendence->clock_out}}</label>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="input-group-text " style="background-color:red;"  >
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="leave{{ $key }}"   class="custom-control-input position-relative" style="height: 20px" value="keluar" disabled >
                                                                    <label class="custom-control-label" for="leave{{ $key }}" style="color:white;" >Terlambat </label>
                                                                    <br>
                                                                    <label id="late{{$key}}"  style="color:white;" > <i class="ri-time-line"></i>  
                                                                    
                                                                    @if(empty($terlambat))

                                                                    {{'-'}}

                                                                    @else

                                                                    {{$attendence->terlambat}}

                                                                    @endif jam
                                        
                                        </label>
                                                                </div>
                                                            </div>

                                                            @if($attendence->absent=="1")
                                                            
                                                            <div class="input-group-text" style="background-color:#5F9EA0;" hidden>
                                                                
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="absent{{ $key }}"  name="absen{{ $key }}" class="custom-control-input position-relative" style="height: 20px" value="absen" {{ $attendence->status == 'absent' ? 'checked' : '' }} >
                                                                    <label class="custom-control-label" for="absent{{ $key }}" style="color:white;" > {{ $attendence->employee->name}} Absen </label>
                                                                    

                                                                </div>
                                                               
                                                                <div class="custom-radio" hidden>
                                                                    <div id="absent_reason{{$key }}"></div>
                                                                </div>

                                                                
                                                            </div>

                                                            @else

                                                            
                                                            <div class="input-group-text" style="background-color:#5F9EA0;" >
                                                                
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="absent{{ $key }}" onclick="Absent({{$attendence->id}},{{$attendence->employee->id}},{{$key}})" name="absen{{ $key }}" class="custom-control-input position-relative" style="height: 20px" value="absen" {{ $attendence->status == 'absent' ? 'checked' : '' }}  >
                                                                    <label class="custom-control-label" for="absent{{ $key }}" style="color:white;" > {{ $attendence->employee->name}} <br><br>Ijin </label>

                                                                </div>
                                                               
                                                                <div class="custom-radio">
                                                                <form id="form_data_ijin" method="POST"   enctype="multipart/form-data">
                                                                @csrf

                                                                    <div id="absent_reason{{$key }}"></div>

                                                                </form>
                                                                </div>
                                                            </div>
                                                           


                                                            @endif

                                                            </div>


                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-2"  >
                            <button type="submit" class="btn btn-primary" hidden>Update</button>
                            <a href="{{ route('attendence.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>


<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
       
    });
</script>

<script >

    

var span = document.getElementById('time_ID');

function time() {
  var d = new Date();
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = d.getHours();
  span.textContent = 
    ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);


    
    



}



    


setInterval(time, 1000);




function simpan_ijin(id_attendance,employee_id,key_){

 let alasan_absen=document.getElementById('reason'+key_).value;

var url_current=document.URL;

var tgl_id = url_current.split('/')[5];
var tgl_now=tgl_id ;


$.ajax({
                url: `/employee/attendence/`+tgl_now + '/' + 'update_alasan_sakit',
                dataType:"JSON",
                type: "POST",
                data:{
                        "id_karyawan": employee_id,
                        'id_att':id_attendance,
                        'alasan_absen':alasan_absen,
                        "_token":"{{ csrf_token()}}",

                    },

    success: function(response){
            if(response.status=='200'){

                            
            toastr.success('Data Permintaan Ijin  Sukses!.Terima Kasih',{ fadeAway: 3000 });

            // location.href="employees/attendence";

            }else{

                toastr.error('Data Permintaan Ijin Gagal Diproses, Melebihi toleransi waktu diberikan!.Terima Kasih',{ fadeAway: 3000 });



            }


    }



    });

//console.log("lihat data alasan absen:",alasan_absen);




}





function Clock_In(id_attendance_,id_karyawan,key_){

    var time_live=document.getElementById('time_ID').innerHTML;
    document.getElementById('waktu'+key_).value = ""
    document.getElementById('waktu'+key_).value+= time_live;
    var status_=document.getElementById('present'+key_).value;

    //fungsi ajax update clock out keluar kantoClock_In
    var id_attendance=id_attendance_;
    var kode_karyawan=id_karyawan;
    var jam_masuk=time_live;
    var url_current=document.URL;

    var tgl_id = url_current.split('/')[5];

    var tgl_now=tgl_id ;

    // console.log("lihat url:",tgl_now);


            var startTime = "08:00:00";
            var endTime =jam_masuk ;

            let jam_terlambat=timeToDecimal(secondsToHMS(hmsToSeconds(endTime) - hmsToSeconds(startTime)));
            console.log("lihat jam terlambat:",jam_terlambat);

            if(jam_terlambat > "0.5"){


                toastr.error('Data Permintaan Masuk Gagal Diproses, Melebihi toleransi 30 menit waktu absen masuk yang diberikan!.Terima Kasih',{ fadeAway: 3000 });


            }else{

                $.ajax({
                url: `/employee/attendence/`+tgl_now +'/' + id_attendance + '/' + 'update_attendance_masuk',

                dataType:"JSON",
                type: "POST",
                data:{
                        "id_karyawan": kode_karyawan,
                        'jam_masuk':jam_masuk,
                        'jamterlambat':jam_terlambat,
                        'id_att':id_attendance,
                        'status':status_,
                    
                        "_token":"{{ csrf_token()}}",

                    },

    success: function(response){


            if(response.status=='200'){

                            
            toastr.success('Data Permintaan Masuk Sukses!.Terima Kasih',{ fadeAway: 3000 });

            $("#absenedit").load(location.href + " #absenedit");


            }else{

                toastr.error('Data Permintaan Masuk Gagal Diproses, Melebihi toleransi waktu diberikan!.Terima Kasih',{ fadeAway: 3000 });



            }


    }



    });



            }

   

         }



         
function Clock_Out(id_attendance_,id_karyawan,key_){

    var time_live=document.getElementById('time_ID').innerHTML;
    document.getElementById('waktu'+key_).value = ""
    document.getElementById('waktu'+key_).value+= time_live;
    var status_=document.getElementById('leave'+key_).value;

    //fungsi ajax update clock out keluar kantor
    var id_attendance=id_attendance_;
    var kode_karyawan=id_karyawan;
    var jam_keluar=time_live;
    var url_current=document.URL;

    var tgl_id = url_current.split('/')[5];

    var tgl_now=tgl_id ;

    var startTime="08:00:00";
    var endTime=jam_keluar;

    let jam_terlambat_keluar=timeToDecimal(secondsToHMS(hmsToSeconds(endTime) - hmsToSeconds(startTime)));

    console.log("lihat jam total bekerja:",jam_terlambat_keluar);

    
    var e = document.getElementById('datepicker_create_');
    var text_datenow = e.innerText;

    console.log("lihat tanggal sekarang_:",text_datenow);

  

if(text_datenow > tgl_now){

    toastr.error('Data Permintaan Keluar Gagal,Tidak bisa akses tanggal melebihi batas tanggal masuknya!.Terima Kasih',{ fadeAway: 3000 });



}

else if(jam_terlambat_keluar < "8.0"){

    
toastr.error('Data Permintaan Keluar Gagal,Jam Kerja < 8 Jam .Tidak dapat akses keluar!.Clock Out dapat dilakukan saat pukul 16:00 atau sudah mencapai 8 jam kerja.Terima Kasih',{ fadeAway: 3000 });



}


else{

    // toastr.success('Data Permintaan Keluar Sukses!.Terima Kasih',{ fadeAway: 3000 });




    $.ajax({
    url: `/employee/attendence/`+tgl_now +'/' + id_attendance + '/' + 'update_attendance',

    dataType:"JSON",
    type: "POST",
    data:{
            "id_karyawan": kode_karyawan,
            'jam_keluar':jam_keluar,
            'id_att':id_attendance,
            'status':status_,
        
            "_token":"{{ csrf_token()}}",

        },

    success: function(response){


        if(response.status=='200'){

                                    
        toastr.success('Data Permintaan Keluar Sukses!.Terima Kasih',{ fadeAway: 3000 });
        
        location.href="/employee/attendence";


        $("#absenedit").load(location.href + " #absenedit");


        }else{

            toastr.error('Data Permintaan Masuk Gagal Diproses, Melebihi toleransi waktu diberikan!.Terima Kasih',{ fadeAway: 3000 });



        }

                   


    }



    });

}

}



let count = 0;

function Buat_Alasan_Ijin(id_attendance,id_karyawan,no_urut){


const display = document.getElementById("btnIjin"+no_urut);
  
var tampilan_text_area='<label for="name"> Alasan Ijin <span class="text-danger">*</span></label><textarea type="text" placeholder="Isi Alasan Absen" class="form-control"  id="reason'+no_urut+'" required></textarea><br><a class="btn btn-success" onclick="simpan_ijin('+id_attendance+',{{$attendence->employee_id}},'+no_urut+')" >Ajukan Ijin</a>';

document.getElementById('tampilkan_alasan_ijin'+no_urut).insertAdjacentHTML("beforeend",tampilan_text_area);


count = count === 0 ? 1 : 0;

    // display.innerHTML = `Clicks: ${count}`;

if(count == '0' ){

document.getElementById('tampilkan_alasan_ijin'+no_urut).textContent = "";

}


    
console.log(count);


}




//akses clock in toleransi di bawah 1 jam 





function hmsToSeconds(t) {
    const [hours, minutes, seconds] = t.split(':')
    return Number(hours) * 60 * 60 + Number(minutes) * 60 + Number(seconds)
  }

function secondsToHMS(secs) {
    return new Date(secs * 1000).toISOString().substr(11, 8)
  }

  function timeToDecimal(t) {
    var arr = t.split(':');
    var dec = parseInt((arr[1]/6)*10, 10);

    return parseFloat(parseInt(arr[0], 10) + '.' + (dec<10?'0':'') + dec);
}   


let today_ = new Date().toISOString().slice(0, 10)

console.log("lihat today:",today_)

document.getElementById('datepicker_create_').innerHTML = today_;



  </script>

  

@endsection
