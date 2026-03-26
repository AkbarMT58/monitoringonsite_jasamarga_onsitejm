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

               
         <div class="clock">
            <div class="clock__circle">
               <div class="clock__rounder"></div>
               <div class="clock__hour" id="clock-hour"></div>
               <div class="clock__minutes" id="clock-minutes"></div>
            </div>

            <div>
               <div class="clock__date">
                  <span class="clock__day-week" id="date-day-week"></span>

                  <div>
                     <span class="clock__month" id="date-month"></span>
                     <span class="clock__day" id="date-day"></span>
                     <span class="clock__year" id="date-year"></span>
                  </div>
               </div>

               <div class="clock__text">
                  <span class="clock__text-hour" id="text-hour"></span>
                  <span class="clock__text-minutes" id="text-minutes"></span>
                  <span class="clock__text-ampm" id="text-ampm"></span>
               </div>
            </div>
         </div>
      

                <div class="card-body">
                    <form action="{{ route('attendence.store') }}" method="POST">
                    @csrf
                        <!-- begin: Input Data -->
                        <div class="row align-items-center">
                            <div class="form-group col-md-6">

                            <div hidden>
                                <label for="datepicker" >Tanggal <span class="text-danger">*</span></label>
                                <input id="datepicker" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', $date) }}" />
                            </div>
                                <br>
                                <label for="datepicker">Pukul<span class="text-danger">*</span></label>
                                <div class="input-group-text">
                               
                                <div id="time"></div>

                              </div>

                              <label for="datepicker">Tanggal Sekarang<span class="text-danger">*</span></label>
                                <div class="input-group-text">
                               
                                <div id="tanggal_sekarang"></div>

                              </div>
                                @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
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

                                                            <a href="{{asset('assets/images/dokumen')}}{{'/'}}{{'attendance/'}}{{$attendence->file_dokumen}}">
                                                           

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
                                                                    <label id="late{{$key}}"  style="color:white;" > <i class="ri-time-line"></i>  @if(empty($terlambat))

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


<script src="{{  asset('assets/js/clock.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/clock.css') }}">


<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
       
    });
</script>

<script >
var span = document.getElementById('time');

function time() {
  var d = new Date();
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = d.getHours();
  span.textContent = 
    ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);



//    if (span.textContent < "08:00:00"){

//      $('.tampilkan_absen').html('');

//     const tampilkan_clockin_now='<div class="input-group-text mx-2" style="background-color:green;"><input type="radio" id="clockin{{ $key }}" onclick="Clock_In({{$attendence->id}},{{$key}})" name="clock_in{{ $key }}" class="custom-control-input position-relative" style="height: 20px" value="masuk" {{ $attendence->status == "masuk" ? "checked" : "" }} ><br><label class="custom-control-label" for="present{{ $key }}" style="color:white;" > {{ $attendence->employee->name}} Masuk </label><br><br><label id="clockin{{$key}}" style="color:white;" >{{$attendence->clock_in}}</label></div>';
//     $('.tampilkan_absen').append(tampilkan_clockin_now);

    
//    }else{

//      $('.tampilkan_absen').html('');

//     const tampilkan_clockin_expired='<div class="input-group-text mx-2" style="background-color:green;"><input type="radio" id="clockin{{ $key }}" onclick="Clock_In({{$attendence->id}},{{$key}})" name="clock_in{{ $key }}" class="custom-control-input position-relative" style="height: 20px" value="masuk" {{ $attendence->status == "masuk" ? "checked" : "" }} ><br><label class="custom-control-label" for="present{{ $key }}" style="color:white;" > {{ $attendence->employee->name}} Masuk </label><br><br><label id="clockin{{$key}}" style="color:white;" >{{$attendence->clock_in}}</label></div>';
//     $('.tampilkan_absen').append(tampilkan_clockin_expired);


//    }

}

    


setInterval(time, 1000);

//akses clock in toleransi di bawah 1 jam 



function Clock_In(id_attendance_,id_karyawan,key_){

    var time_live=document.getElementById('time').innerHTML;
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

   






    
let total_datatabel_absen="{{count($attendences)}}";

console.log("lihat data total absen:",total_datatabel_absen);


let currentDate_ = new Date().toJSON().slice(0, 10);

for(var j=1;j < total_datatabel_absen+1;j++){


 let waktu_clock_in=document.getElementById('clockin'+j).textContent;
 let waktu_clock_out=document.getElementById('clockout'+j).textContent;




if(waktu_clock_in===''){

    waktu_clock_in_='00:00:00'
    waktu_clock_out_='00:00:00'
    

   
  


}else{

    waktu_clock_in_=waktu_clock_in  
    waktu_clock_out_=waktu_clock_out

   

}

var startTime = waktu_clock_in_;
var endTime = waktu_clock_out_;

console.log("lihat starttime:",startTime);
console.log("lihat endtime:",endTime);


   

  console.log("lihat data total waktu kerja:",secondsToHMS(hmsToSeconds(endTime) - hmsToSectimeToDecimalonds(startTime))); //10:39:18

  console.log("lihat convert ke jam:"+j,(secondsToHMS(hmsToSeconds(endTime) - hmsToSeconds(startTime))));

  document.getElementById('late'+key_).innerHTML =timeToDecimal(secondsToHMS(hmsToSeconds(endTime) - hmsToSeconds(startTime)));




}



    //batas clock in



}

function Clock_Out(id_attendance_,id_karyawan,key_){

    var time_live=document.getElementById('time').innerHTML;
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

    
    var e = document.getElementById('tanggal_sekarang');
    var text_datenow = e.innerText;

    console.log("lihat tanggal sekarang_:",text_datenow);

  

if(text_datenow > tgl_now){

    toastr.error('Data Permintaan Keluar Gagal,Tidak bisa akses tanggal melebihi batas tanggal masuknya!.Terima Kasih',{ fadeAway: 3000 });



}

else if(jam_terlambat_keluar < "8.0"){

    
toastr.error('Data Permintaan Keluar Gagal,Jam Kerja < 8 Jam .Tidak dapat akses keluar!.Clock Out dapat dilakukan saat pukul 16:00 atau sudah mencapai 8 jam kerja.Terima Kasih',{ fadeAway: 3000 });



}


else{

    toastr.success('Data Permintaan Keluar Sukses!.Terima Kasih',{ fadeAway: 3000 });




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

        $("#absenedit").load(location.href + " #absenedit");


        }else{

            toastr.error('Data Permintaan Masuk Gagal Diproses, Melebihi toleransi waktu diberikan!.Terima Kasih',{ fadeAway: 3000 });



        }

                   


    }



    });

}




    
let total_datatabel_absen="{{count($attendences)}}";

console.log("lihat data total absen:",total_datatabel_absen);


let currentDate_ = new Date().toJSON().slice(0, 10);

for(var j=1;j < total_datatabel_absen+1;j++){


 let waktu_clock_in=document.getElementById('clockin'+j).textContent;
 let waktu_clock_out=document.getElementById('clockout'+j).textContent;




if(waktu_clock_in===''){

    waktu_clock_in_='00:00:00'
    waktu_clock_out_='00:00:00'
    

   
  


}else{

    waktu_clock_in_=waktu_clock_in  
    waktu_clock_out_=waktu_clock_out

   

}

var startTime = waktu_clock_in_;
var endTime = waktu_clock_out_;

console.log("lihat starttime:",startTime);
console.log("lihat endtime:",endTime);


   

  console.log("lihat data total waktu kerja:",secondsToHMS(hmsToSeconds(endTime) - hmsToSectimeToDecimalonds(startTime))); //10:39:18

  console.log("lihat convert ke jam:"+j,(secondsToHMS(hmsToSeconds(endTime) - hmsToSeconds(startTime))));

  document.getElementById('late'+key_).innerHTML =timeToDecimal(secondsToHMS(hmsToSeconds(endTime) - hmsToSeconds(startTime)));



}







    //batas clock out 



    
}



function Keterlambatan(){

    
    var time_live=document.getElementById('time').innerHTML;
    document.getElementById('waktu'+key_).value = ""
    document.getElementById('waktu'+key_).value+= time_live;
    var status_=document.getElementById('leave'+key_).value;

    //fungsi ajax update clock out keluar kantor
    var id_attendance=id_attendance_;
    var kode_karyawan=id_karyawan;
    var jam_terlambat=time_live;
    var url_current=document.URL;

    var tgl_id = url_current.split('/')[5];

    var tgl_now=tgl_id ;

    console.log("lihat url:",tgl_now);

    $.ajax({
    url: `/employee/attendence/`+tgl_now +'/' + id_attendance + '/' + 'update_terlambat',

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


                let type ="success";
                let title = `Notification ${type}.`;
                let description = `
                    This is ${type} notification.
                   
                    <a style="text-decoration:none; color:#fff; font-weight:bold;" </a>
                    `;
                
           
                if(response.status=='200'){

                    new Notify(title, description, type);

                    $("#absenedit").load(location.href + " #absenedit");


                }

                    // console.log("lihat response data:",response);




    }



    });


}

function Absent(id_attendance_,id_karyawan,key_){

$('#reason'+key_).remove();
$('#simpan'+key_).remove();

var time_live=document.getElementById('time').innerHTML;
document.getElementById('waktu'+key_).value = "";
document.getElementById('waktu'+key_).value+= time_live;

 var tampilkan_texbox='<input type="text" placeholder="Isi Alasan Absen" class="form-control" id="reason" name="reason" /><br><input type="file" id="file_alasan" name="file_alasan" class="form-control" /><br><a onclick="Batalkan_Ijin('+id_attendance_+','+id_karyawan+','+key_+')" class="btn btn-primary" id="simpan'+key_+'"'+' style="color:black;background-color:yellow;">Batal</a><a onclick="Update_Reason('+id_attendance_+','+id_karyawan+','+key_+')" class="btn btn-primary" id="simpan'+key_+'"'+' style="color:white;background-color:red;">Simpan</a>';

 document.getElementById('absent_reason'+key_).insertAdjacentHTML("beforeend",tampilkan_texbox);


console.log("lihat waktu live on absent:",time_live);

console.log("lihat waktu live on key:",key_);

    
}


function Update_Reason(id_attendance_,id_karyawan,id_urut){


    var time_live=document.getElementById('time').innerHTML;
 
    const files = document.querySelector('[type=file]').files;
    const image_upload = new FormData();

    let file = files;
    

    // var filename =file.name;
    //          filename = filename.replace(/^.*[\\\/]/, '');

    
        image_upload.append('id_att', id_attendance_);
        image_upload.append('file_alasan', file[0]);
        image_upload.append('reason', document.getElementById('reason').value);
        image_upload.append('_token', "{{csrf_token()}}");
       



    var object = {};
    image_upload.forEach(function(value, key){
        object[key] = value;
    });
    var json = JSON.stringify(object);

    console.log("file alasan data:",file[0]);

        

    //fungsi ajax update clock out keluar kantor
    var id_attendance=id_attendance_;
    var kode_karyawan=id_karyawan;
    var jam_keluar=time_live;
    var url_current=document.URL;
    var tgl_id = url_current.split('/')[5];
    var tgl_now=tgl_id ;

    // console.log("lihat url reason:",reason_);
    // console.log("lihat file dokumen:",file_alasan);

    $.ajax({
                    url: `/employee/attendence/`+tgl_now +'/' + id_attendance + '/' + 'update_reason_absen',

                    type: 'POST',
                     data:image_upload,
                     enctype: 'multipart/form-data',
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,

  

    success: function(response){

       

               
           
                if(response.status=='200'){

                 
                    toastr.success('Data Permintaan Absen atau Ijin Sukses Tersimpan!.Terima Kasih',{ fadeAway: 3000 });

                    $("#absenedit").load(location.href + " #absenedit");


                }

                  



    }



    });






}






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

document.getElementById('tanggal_sekarang').innerHTML = today_;


function Batalkan_Ijin(id_attendance_,id_karyawan,id_urut){

var tampilkan_texbox='<input type="radio" id="absent{{ $key }}" onclick="Absent('+id_attendance_+','+id_urut+')" name="absen{{ $key }}" class="custom-control-input position-relative" style="height: 20px" value="absen"   ><label class="custom-control-label"  style="color:white;" > <br><br>Ijin </label>';

document.getElementById('absent_reason'+key_).insertAdjacentHTML("beforeend",tampilkan_texbox);





}









  </script>
@endsection
