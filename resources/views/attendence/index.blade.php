@extends('dashboard.body.main')

@section('container')

@php

date_default_timezone_set("Asia/Jakarta");
$waktu = date("Y-m-d");

@endphp 

<style>

    @media screen and (min-width: 300px) {
  /* styles for screens smaller than 600px wide */

    #create_absen{
  margin-left:-250px;
  margin-top:80px;

    }

  

}

  

</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('success'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">List Absen Kehadiran OnSite JM</h4>

                    

                    <div hidden>

                    @foreach($readdata_attendance as $exist_attendance)

                    

                    <div id="tanggal_absen{{$loop->iteration}}">{{$exist_attendance->tanggal_aktif}}</div>

                
                    @endforeach

                    </div>


                    
                    <p class="mb-0">Silakan Absen Kehadiran </p>

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

                <br>
                <br>
                <div>

               

              


                    <a href="{{ route('attendence.create') }}" class="btn btn-primary add-list" id="create_absen"><i class="fas fa-plus mr-3"></i><i class="ri-time-line"></i> Absen Masuk</a>

                    <a href="{{ route('attendence.index') }}" class="btn btn-danger add-list" hidden ><i class="fa-solid fa-trash mr-3"></i>Clear Search</a>
                </div>
            </div>
        </div>

        <div class="col-lg-12" hidden>
            <form action="{{ route('attendence.index') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="form-group row">
                        <label for="row" class="col-sm-3 align-self-center">Row:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="row">
                                <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="input-group-text bg-primary" hidden><i class="fa-solid fa-magnifying-glass font-size-20"></i></button>
                </div>
            </form>

            <br>
            <br>

            <div class="form-group col-md-6">

                                <br>
                                <label for="datepicker">Pukul<span class="text-danger">*</span></label>
                                <div class="input-group-text">
                               
                                <div id="time"></div>

                              </div>

                              <label for="datepicker">Tanggal Sekarang<span class="text-danger">*</span></label>
                                <div class="input-group-text">
                               
                                <div id="tanggal_sekarang"></div>

                              </div>

</div>

        </div>

        
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">

             <br>
            <br>

                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>@sortablelink('date')</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @forelse ($attendences as $attendence)

                        
                        <tr>
                            <td>{{ (($attendences->currentPage() * 10) - 10) + $loop->iteration  }}</td>
                          
                            <td><i class="ri-time-line"></i><div id="date_today_{{$loop->iteration}}" >{{ $attendence->date }}</div> <br><br>waktu cetak: <div id="create_at_{{$loop->iteration}}" >{{$attendence->waktu_cetak}}</div></td>
                            <td id="status_{{$loop->iteration}}" ></td>
                          
                            <td>

                            @if($attendence->date == $waktu)
                                <div class="d-flex align-items-center list-action">
                                    <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Link Absen"
                                        href="{{ route('attendence.edit', $attendence->date) }}">Absen Disini <i class="ri-time-line"></i>
                                    </a>
                                  
                                </div>

                                @else

                                <div class="d-flex align-items-center list-action">
                                    <a class="btn btn-danger mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Link Absen"
                                        href="{{ route('attendence.edit', $attendence->date) }}" disabled >Expired Date <i class="ri-time-line"></i>
                                    </a>
                                  
                                </div>


                            @endif
                            </td>
                        </tr>
                        @empty
                        <div class="alert text-white bg-danger" role="alert">
                            <div class="iq-alert-text">Data not Found.</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ri-close-line"></i>
                            </button>
                        </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $attendences->links() }}
        </div>
    </div>
    <!-- Page end  -->
</div>

<script src="{{  asset('assets/js/clock.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/clock.css') }}">


<script>




var span = document.getElementById('time');

function time() {
  var d = new Date();
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = d.getHours();
  span.textContent = 
    ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);




}

    


setInterval(time, 1000);

let today_ = new Date().toISOString().slice(0, 10)

console.log("lihat today:",today_)

document.getElementById('tanggal_sekarang').innerHTML = today_;

//akses clock in toleransi di bawah 1 jam 





let currentDate_ = new Date().toJSON().slice(0, 10);

//  document.getElementById('datepicker_index').value+=currentDate_;

console.log("lihat tanggal sekarang:",currentDate_); 

var hitungdata_bytanggal="{{count($readdata_attendance)}}";

console.log("hitung data absen base tgl:",hitungdata_bytanggal); 

for(var a=1;a <= hitungdata_bytanggal;a++){

    let tgl_absen=document.getElementById('tanggal_absen'+a).innerHTML;

    console.log("data tgl absen:",tgl_absen); 


    if(tgl_absen == currentDate_){


      
        document.getElementById("create_absen").style.display = 'none';



    }
    
    else{

       
        document.getElementById("create_absen").style.display='hidden'


    }


}

function refresh_page_absen(){


    
let tampilkan_status_open="<div class='d-flex align-items-center list-action'><a class='btn btn-success mr-2' data-toggle='tooltip' data-placement='top' >Open<i class='ri-time-line'></i></a></div>";
let tampilkan_status_closed="<div class='d-flex align-items-center list-action'><a class='btn btn-danger mr-2' data-toggle='tooltip' data-placement='top' >Closed<i class='ri-time-line'></i></a></div>";
let totaldata_index="{{count($attendences)}}";




var time_live=document.getElementById('time').innerHTML;
localStorage.setItem("real_time", time_live);

var myRealTime = localStorage.getItem('real_time');


for(var a=1;a < totaldata_index;a++){

    if(myRealTime<="08:00:00" && myRealTime <="17:00:00"){

$('#status_'+a).append(tampilkan_status_open);


    }else{

        
$('#status_'+a).append(tampilkan_status_closed);



    }



}


// console.log("lihat waktu real:",myRealTime);





}

// for(var t=1;t < totaldata_index;t++ ){

   

    // if(gettime<'08:15:00' && gettime <='17:00:00' ){

    //     $('#status_'+t).append(tampilkan_status_open);


    // }
    
    // else{

    //     $('#status_'+t).append(tampilkan_status_closed);


    //}



// }



let tampilkan_status_open="<div class='d-flex align-items-center list-action'><a class='btn btn-success mr-2' data-toggle='tooltip' data-placement='top' >Open <i class='ri-time-line'></i></a></div>";
let tampilkan_status_closed="<div class='d-flex align-items-center list-action'><a class='btn btn-danger mr-2' data-toggle='tooltip' data-placement='top' >Closed <i class='ri-time-line'></i></a></div>";
let totaldata_index="{{count($attendences)}}";



var myRealTime = localStorage.getItem('real_time');

var startTime=myRealTime;

   
var endTime = "08:00:00";

let jangka_waktu=timeToDecimal(secondsToHMS(hmsToSeconds(startTime) - hmsToSeconds(endTime)));
let date_today=today_;



for(var b=1;b < totaldata_index;b++){

    let ambildata_timeby_i=document.getElementById('create_at_'+b).innerHTML;
    let ambildate_tabel_i=document.getElementById('date_today_'+b).innerHTML;
    

    console.log("lihat time i:",ambildata_timeby_i);

    console.log("lihat date i:",ambildate_tabel_i);

    if(ambildate_tabel_i== date_today && ambildata_timeby_i <= "17:00:00"){

        document.querySelector('#status_'+b).insertAdjacentHTML('beforeend',tampilkan_status_open);


    }else{


       document.querySelector('#status_'+b).insertAdjacentHTML('beforeend',tampilkan_status_closed);


     }
        
      



}


console.log("lihat waktu real:",myRealTime);

console.log("lihat total data real:",totaldata_index);


// console.log("lihat total data index:",data_index);




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
