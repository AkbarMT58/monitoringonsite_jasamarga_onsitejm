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
                        <h4 class="card-title">Cetak Onsite Attendance</h4>
                    </div>

            </div>

            <div>

                  
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
                </div>

           

                <div class="card-body" >
                <form action="{{ route('attendence.store') }}" method="POST"  enctype="multipart/form-data">
                    @csrf 
                        <!-- begin: Input Data -->
                        <div class="row align-items-center">

                        <div hidden>
                            <div class="form-group col-md-6">
                                <label for="datepicker_create">Date <span class="text-danger">*</span></label>
                                
							 <input type="text" class="form-control" id="datepicker_create" name="date" value="">
							 <span class="input-group-addon">
								  <i class="glyphicon glyphicon-calendar"></i>
							 </span>
						
                                <br>
                                <label for="datepicker">Pukul<span class="text-danger">*</span></label>
                                <div class="input-group-text">
                               
                                <div id="time_ID"></div>

                              </div>
                                @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>

                      
                           

                            <div class="col-lg-12">
                                <div class="table-responsive rounded mb-3">

                                  <br>
                        <br>
                                    <table class="table mb-0">
                                        <thead class="bg-white text-uppercase">
                                            <tr class="ligth ligth-data">
                                               
                                              
                                               
                                            </tr>
                                        </thead>
                                        <tbody class="ligth-body">
                                            @foreach ($employees as $employee)
                                            <tr>
                                                <th scope="row" hidden>{{ $key = $loop->iteration  }}</th>
                                                
                                                <td>
                                                    <input type="hidden" name="employee_id[{{ $key }}]" value="{{ $employee->id }}">
                                                    <div class="input-group">
                                                        <div class="input-group justify-content-center">
                                                        <div class="input-group-text"  hidden>
                                                            <input type="text" class="form-control" name="jam_masuk{{$key}}" id="waktu{{$key}}"  />
                                                            <input type="text" class="form-control" name="id_karyawan{{$key}}" value="{{$employee->id}}" />
                                                        </div>
                                                        <div class="input-group-text" hidden >
                                                        <input type="text" class="form-control" id="late{{$key}}" name="jam_terlambat{{$key}}" readonly/>
                                                        </div>
                                                            <div class="input-group-text" style="background-color:green;" >
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="present{{ $key }}" name="status{{ $key }}" onclick="Clock_In({{$employee->id}},{{$key}})" class="custom-control-input position-relative" style="height: 20px" value="present">
                                                                    <label class="custom-control-label" for="present{{ $key }}" style="color:white;" > {{ $employee->name }} <br>Masuk </label>
                                                                </div>
                                                            </div>
                                                            <div class="input-group-text mx-2" hidden>
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="leave{{ $key }}" name="status{{ $key }}"  class="custom-control-input position-relative" style="height: 20px" value="leave">
                                                                    <label class="custom-control-label" for="leave{{ $key }}" style="color:black;" > <br>Keluar </label>
                                                                </div>Absent
                                                            </div>
                                                            <div class="input-group-text" style="background-color:yellow;" >
                                                                <div class="custom-radio">
                                                                    <input type="radio" id="absent{{ $key }}" name="status{{ $key }}"onclick="Absent({{$employee->id}},{{$key}})" class="custom-control-input position-relative" style="height: 20px" value="absent">
                                                                    <label class="custom-control-label" for="absent{{ $key }}">{{ $employee->name }}  <br>Ijin </label>
                                                                </div>
                                                               
                                                            </div>
                                                            <br>
                                                            <br>
                                                            <div class="custom-radio">
                                                               
                                                                    <div id="absent_reason{{$key }}"></div>

                                                               
                                                                </div>
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

                        <div id="tombol_save">

                        </div>
                        <!-- <div class="mt-2" >
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('attendence.index') }}" class="btn btn-danger">Cancel</a>
                        </div> -->
                     </form> 
                </div>
            </div>
            
        </div>
    </div>
    <!-- Page end  -->
</div>


<script src="{{  asset('assets/js/clock.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/clock.css') }}">




<script >


     const time_ = document.getElementById('time_ID').innerHTML;

     console.log("lihat jangka waktu:",time_);

    // var startTime=time_live_;
    // var endTime = "08:00:00";

    // let jangka_waktu=timeToDecimal(secondsToHMS(hmsToSeconds(startTime) - hmsToSeconds(endTime)));

   
    // if(jangka_waktu > "4"){

    //     // document.getElementById('late'+key_).value+= '0';

        
    //     toastr.error('Data Permintaan Masuk Gagal Diproses, Melebihi toleransi 15 menit waktu absen masuk yang diberikan!.Informasikan kedatangan masuk ke onsite untuk approval absen masuk.Terima Kasih',{ fadeAway: 5000 });


    //     var set_tombolsave_terkunci="<div class='mt-2' ><button type='submit' class='btn btn-primary'>Save</button><a href='{{ route('attendence.index') }}' class='btn btn-danger' hidden>Cancel</a></div>";
       
    //     $('#tombol_save').append(set_tombolsave_terkunci);

    // }else{

       
    //     // document.getElementById('late'+key_).value+= (timeToDecimal(secondsToHMS(hmsToSeconds(startTime) - hmsToSeconds(endTime))));

    //     var set_tombolsave_terkunci="<div class='mt-2' ><button type='submit' class='btn btn-primary'>Save</button><a href='{{ route('attendence.index') }}' class='btn btn-danger' >Cancel</a></div>";
        
    //     $('#tombol_save').append(set_tombolsave_terkunci);

       

       

        


    // }



function Clock_In(id_karyawan,key_){

     $('#tombol_save').html('');

    var time_live=document.getElementById('time_ID').innerHTML;

    var startTime=time_live;

   
    var endTime = "08:00:00";
    let jangka_waktu=timeToDecimal(secondsToHMS(hmsToSeconds(startTime) - hmsToSeconds(endTime)));


    document.getElementById('waktu'+key_).value = "";
    document.getElementById('waktu'+key_).value+= time_live;
    document.getElementById('late'+key_).value = "";

    // console.log("lihat jangka waktu:",(24-jangka_waktu));
    console.log("lihat jangka waktu saja:",(jangka_waktu));
    console.log("lihat konversi detik:",secondsToHMS(hmsToSeconds(startTime)));



    if(jangka_waktu < "0.5" ){

    
        document.getElementById('late'+key_).value+= (timeToDecimal(secondsToHMS(hmsToSeconds(startTime) - hmsToSeconds(endTime))));
        var set_tombolsave_terkunci="<div class='mt-2' ><button type='submit' class='btn btn-primary'>Save</button><a href='{{ route('attendence.index') }}' class='btn btn-danger' >Cancel</a></div>";
        $('#tombol_save').append(set_tombolsave_terkunci);

    

    }

    
    if(startTime < "08:00:00" ){

    
    document.getElementById('late'+key_).value+= (timeToDecimal(secondsToHMS(hmsToSeconds(startTime) - hmsToSeconds(endTime))));
    var set_tombolsave_terkunci="<div class='mt-2' ><button type='submit' class='btn btn-primary'>Save</button><a href='{{ route('attendence.index') }}' class='btn btn-danger' >Cancel</a></div>";
    $('#tombol_save').append(set_tombolsave_terkunci);



    }


    if((jangka_waktu) > "0.5"){

        
    toastr.error('Data Permintaan Masuk Gagal Diproses, Melebihi toleransi 15 menit waktu absen masuk yang diberikan!.Informasikan kedatangan masuk ke onsite untuk approval absen masuk.Terima Kasih',{ fadeAway: 5000 });
    var set_tombolsave_terkunci="";

    $('#tombol_save').append(set_tombolsave_terkunci);



    }

   





 }



// function Clock_In(id_karyawan,key_){

// var time_live=document.getElementById('time').innerHTML;
// document.getElementById('waktu'+key_).value = ""
// document.getElementById('waktu'+key_).value+= time_live;
// var status_=document.getElementById('present'+key_).value;

// //fungsi ajax update clock out keluar kantor
// // var id_attendance=id_attendance_;
// var kode_karyawan=id_karyawan;
// var jam_masuk=time_live;
// var url_current=document.URL;

// var tgl_id = url_current.split('/')[5];

// var tgl_now=tgl_id ;

// // console.log("lihat url:",tgl_now);


//         var startTime = "08:00:00";
//         var endTime =jam_masuk ;

//         let jam_terlambat=timeToDecimal(secondsToHMS(hmsToSeconds(endTime) - hmsToSeconds(startTime)));
//         console.log("lihat jam terlambat:",jam_terlambat);

//         if(jam_terlambat > "2"){


//             toastr.error('Data Permintaan Masuk Gagal Diproses, Melebihi toleransi 15 menit waktu absen masuk yang diberikan!.Informasikan kedatangan masuk ke onsite untuk approval absen masuk.Terima Kasih',{ fadeAway: 5000 });


//         }else{

//             $.ajax({
// url: `/employee/attendence/`+tgl_now +'/' + id_attendance + '/' + 'create_attendance_masuk',

// dataType:"JSON",
// type: "POST",
// data:{
//         "id_karyawan": kode_karyawan,
//         'jam_masuk':jam_masuk,
//         'jamterlambat':jam_terlambat,
//         // 'id_att':id_attendance,
//         'status':status_,
    
//         "_token":"{{ csrf_token()}}",

//     },

// success: function(response){


//         if(response.status=='200'){

                        
//         toastr.success('Data Permintaan Masuk Sukses!.Terima Kasih',{ fadeAway: 3000 });

//         $("#absenedit").load(location.href + " #absenedit");


//         }else{

//             toastr.error('Data Permintaan Masuk Gagal Diproses, Melebihi toleransi waktu diberikan!.Terima Kasih',{ fadeAway: 3000 });



//         }


// }



// });



//         }









// let total_datatabel_absen="{{count($employees)}}";

// console.log("lihat data total absen:",total_datatabel_absen);


// let currentDate_ = new Date().toJSON().slice(0, 10);

// for(var j=1;j < total_datatabel_absen+1;j++){


// let waktu_clock_in=document.getElementById('clockin'+j).textContent;
// let waktu_clock_out=document.getElementById('clockout'+j).textContent;




// if(waktu_clock_in===''){

// waktu_clock_in_='00:00:00'
// waktu_clock_out_='00:00:00'






// }else{

// waktu_clock_in_=waktu_clock_in  
// waktu_clock_out_=waktu_clock_out



// }

// var startTime = waktu_clock_in_;
// var endTime = waktu_clock_out_;

// console.log("lihat starttime:",startTime);
// console.log("lihat endtime:",endTime);




// console.log("lihat data total waktu kerja:",secondsToHMS(hmsToSeconds(endTime) - hmsToSectimeToDecimalonds(startTime))); //10:39:18

// console.log("lihat convert ke jam:"+j,(secondsToHMS(hmsToSeconds(endTime) - hmsToSeconds(startTime))));

// document.getElementById('late'+key_).innerHTML =timeToDecimal(secondsToHMS(hmsToSeconds(endTime) - hmsToSeconds(startTime)));




// }



// //batas clock in



// }



var span = document.getElementById('time_ID');

function time() {
  var d = new Date();
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = d.getHours();
  span.textContent = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
}

setInterval(time, 1000);


function Clock_Out(id_karyawan,key_){

    var time_live=document.getElementById('time').innerHTML;

    
    document.getElementById('waktu'+key_).value = ""



    document.getElementById('waktu'+key_).value+= time_live;;



    // console.log("lihat waktu live on click out:",time_live);

    
}

function Absent(id_karyawan,key_){

$('#absent_reason'+key_).html('');

$('#tombol_save').html('');


var time_live=document.getElementById('time_ID').innerHTML;
document.getElementById('waktu'+key_).value = "";
document.getElementById('waktu'+key_).value+= time_live;

 var tampilkan_texbox='<input type="text" placeholder="Isi Alasan Absen" class="form-control"  name="reason'+key_+'"/><input type="file"  name="file_alasan'+key_+'"'+' class="form-control" /><a onclick="Create_Reason('+id_karyawan+','+key_+')" class="btn btn-primary" id="simpan" hidden >Simpan</a>';

 document.getElementById('absent_reason'+key_).insertAdjacentHTML("beforeend",tampilkan_texbox);


 var set_tombolsave_terkunci="<div class='mt-2' ><button type='submit' class='btn btn-primary' >Save</button><a href='{{ route('attendence.index') }}' class='btn btn-danger' hidden>Cancel</a></div>";
       
$('#tombol_save').append(set_tombolsave_terkunci);



    
}

function Create_Reason(id_karyawan,key_){

    
    var time_live=document.getElementById('time_ID').innerHTML;
    var date_reason=$('#datepicker_create').val();
 
    const files = document.querySelector('[type=file]').files;
    const image_upload = new FormData();

    let file = files;
    
        image_upload.append('id_karyawan', id_karyawan);
        image_upload.append('file_alasan', file[0]);
        image_upload.append('date_event', date_reason);
        image_upload.append('reason', document.getElementById('reason').value);
        image_upload.append('_token', "{{csrf_token()}}");
       
    var object = {};
    image_upload.forEach(function(value, key){
        object[key] = value;
    });
    var json = JSON.stringify(object);

    console.log("file alasan data:",file[0]);

    
    //fungsi ajax update clock out keluar kantor
    // var id_attendance=id_attendance_;
    var kode_karyawan=id_karyawan;
    var jam_keluar=time_live;
    var url_current=document.URL;
    var tgl_id = url_current.split('/')[5];
    var tgl_now=tgl_id ;

    
    $.ajax({
                    url: `/employee/attendence/`+tgl_now  + '/' + 'create_reason_absen',

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

                
                
                    location.href="/employee/attendence";

                }

                  



    }



    });










}




       

let currentDate = new Date().toJSON().slice(0, 10);

$('#datepicker_create').val(currentDate);
console.log("lihat current date:",currentDate); 


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




  </script>
@endsection
