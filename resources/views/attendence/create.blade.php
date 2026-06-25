@extends('dashboard.body.main')

@section('container')
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
        </div>
        <div class="col-lg-4">
            <div class="card card-transparent card-block card-stretch card-height border-none">
                <div class="card-body p-0 mt-lg-2 mt-0">
                    <h4 class="mb-3"><br><br> Bulan   <span class="clock__month" id="date-month"></span> Tahun <span class="clock__year" id="date-year"></span> </h4>
                    <br> 
                    <br>
                    <label style="font-size:25px;" >Modul absen {{ auth()->user()->name }} 
                    <p class="mb-0 mr-4"> </p>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">

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
                     <span class="clock__year" id="date-year_"></span>
                       <span class="clock__year" id="date-tahun_" hidden></span>
                  </div>
               </div>

               <div class="clock__text">
                  <span class="clock__text-hour" id="text-hour"></span>
                   <span class="clock__text-hour" id="text-hour_" hidden></span>
                  <span class="clock__text-minutes" id="text-minutes"></span>
                  <span class="clock__text-minutes" id="text-minutes_" hidden></span>
                  <span class="clock__text-ampm" id="text-ampm"></span>
                  <span class="clock__text-ampm" id="text-ampm_" hidden></span>
                 
               </div>
            </div>
         </div>
          
                </div>

           
                     

        <br>
        <br>
        <br>

           
            <div id="coordinate-box">Waiting for GPS signal...</div>
            <div id="map"></div>


        <br>
        <br>
        <br>

        



            
        </div>

        <div id="camera_div" >

       
         <div class="col-lg-6" >

                <h5>Ambil Foto dengan Kamera</h5>
                
                <!-- Video Stream dari Kamera -->
                <video id="kamera" autoplay playsinline></video>

                <div>
                    <button class="btn btn-primary" id="btn-ambil">Ambil Foto</button>
                    <button class="btn btn-success" id="btn-simpan" disabled>Simpan Foto</button>
                </div>

               

        </div>

         <div class="col-lg-6" >
        
         <!-- Hasil Screenshot -->
                <div class="canvas-container" id="hasil-container">
                    <h5>Hasil Foto:</h5>
                    <canvas id="canvas"></canvas>
                </div>

         </div>

</div>

    
        

   

        



        
                      
         @foreach ($employees as $employee)

        
          <div hidden> {{ $key = $loop->iteration  }} </div>
                    
        <div class="col-lg-6">
           
                     <div class="row" >
                            <div class="form-group col-md-12" >
                                <label for="datepicker_create">Date <span class="text-danger">*</span></label>
                                
							 <input type="text" class="form-control" id="datepicker_create_{{$key}}" name="date" >
							 <span class="input-group-addon">
								  <i class="glyphicon glyphicon-calendar"></i>
							 </span>
						
                                <br>
                                <label for="datepicker">Pukul<span class="text-danger">*</span></label>
                                <div class="input-group-text">
                               
                               <div id="time_ID{{$key}}">Loading time...</div>
                              </div>

                               <label for="datepicker">Location GPS<span class="text-danger">*</span></label>
                                <div class="input-group-text">
                               
                               <div id="location_now{{$key}}">Loading gps...</div>
                              </div>
                               
                            </div>

                        </div>


                    
        
                       

                      

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
                      <div class="card-img">
        <!-- Placeholder Image -->
        <!-- <i class="ri-image-line ri-3x" style="color: #888;"></i> -->
        <img class="avatar-100 rounded" src="{{ $employee->photo ? asset('assets/images/employees/'.$employee->photo) : asset('assets/images/user/1.png') }}" >
    </div>
    <div class="card-content">
        <h3 class="card-name">{{ $employee->name }} </h3>
        <!-- Button with Remix Icon -->
         <div class="row">
            <div class="col-lg-6">
                 <div class="input-group-text" hidden >
                            <input type="text" class="form-control" name="jam_masuk{{$key}}" id="waktu{{$key}}"  />
                            <input type="text" class="form-control" name="id_karyawan{{$key}}" value="{{$employee->id}}" />
                 </div>
                <div class="input-group-text" hidden >
                <input type="text" class="form-control" id="late{{$key}}" name="jam_terlambat{{$key}}" readonly/>
                </div>
               

        <a class="card-btn" style="font-weight:bold;"  onclick="Clock_In({{$employee->id}},{{$key}},{{$employee->acc_lead}})" >
        <i class="ri-arrow-down-line"  > <label id="present{{$key}}" style="color:white;" ><i class="ri-time-line"></i> @if(empty($attendence->clock_in)){{'00:00:00:00'}}@endif</label>
        <br></i>
        Absen Masuk
        </a>
          </div>
           <div class="col-lg-6">

            <div  id="tombol_save_terlambat{{$key}}"></div>

        </div>
          <div>

        </div>
           <div class="col-lg-6" hidden>

        <a  class="card-btn-out" style="font-weight:bold;" onclick="Clock_Out({{$employee->id}},{{$key}},{{$employee->acc_lead}})">
            <i class="ri-arrow-up-line" ><label id="present{{$key}}" style="color:white;" ><i class="ri-time-line"></i> @if(empty($attendence->clock_out)){{'00:00:00:00'}}@endif</label></i>Absen Keluar
            
        </a>
          </div>
       </div>
    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">


         <input type="hidden" name="employee_id[]" value="{{ $employee->id }}">

            <div class="card card-block card-stretch card-height">
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
                    <!-- <div id="layout1-chart-2" style="min-height: 360px;"></div> -->
                      <div class="card-img">
        <!-- Placeholder Image -->
        <!-- <i class="ri-image-line ri-3x" style="color: #888;"></i> -->
         <img class="avatar-100 rounded" src="{{ $employee->photo ? asset('assets/images/employees/'.$employee->photo) : asset('assets/images/user/1.png') }}" >

    </div>

    <div class="card-content">
        <h3 class="card-name">{{ $employee->name }} </h3>
        <!-- Button with Remix Icon -->
         <div class="row">
            <div class="col-lg-6">
        <a  class="card-btn-sick" style="font-weight:bold;" onclick="Absent_Ijin({{$key}},{{$employee->id}})" >
            <i class="ri-arrow-down-line"><label id="present{{$key}}" style="color:black;" ><i class="ri-time-line"></i> @if(empty($attendence->clock_out)){{'00:00:00:00'}}@endif</label></i>Ijin / Sakit
        </a>
        <input type="file" id="realInput{{$key}}" style="display:none;">
         <div id="absent_reason{{$key}}"></div>
        <span id="file-name{{$key}}">No file chosen</span>

          </div>
           <div class="col-lg-6">

           <div id="tombol_save{{$key}}"></div>

              <!-- <a  class="card-btn-save" style="font-weight:bold;color:white;" onclick="Absent_Ijin({{$key}},{{$employee->id}})" >
            <i class="ri-arrow-down-line"><label id="present{{$key}}" style="color:black;"  ><i class="ri-save-line"></i>  </label></i>Simpan
        </a> -->

      
          </div>
       </div>
                </div>
            </div>
            
        </div>
        


</div>



@endforeach



</div>



@endsection




<script >


window.addEventListener('DOMContentLoaded', (event) => {

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

}






 


const total_employee="{{count($employees)}}";

Periode(total_employee);


function Periode(total_data){

  for(var a=1; a <= total_data;a++){

  
let currentDate = new Date().toJSON().slice(0, 10);

//document.getElementById('datepicker_create_'+a).value = currentDate;

var elemen="datepicker_create_"+ a;

document.getElementById(elemen).value = currentDate;

console.log("lihat data:",a);




  }
}



function time() {
  var d = new Date();
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = d.getHours();
  const timeString = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);

  for(var a=1; a <= total_employee;a++){

  document.getElementById('time_ID'+a).innerHTML = timeString;

   }
}


setInterval(time, 1000);

  // 1. Inisialisasi Peta (koordinat awal di Jakarta sebagai default)
        var map = L.map('map').setView([-6.2900151,106.8736116], 16);

        // 2. Tambahkan Tile Layer (Peta Dasar OpenStreetMap)

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© maps location office'
        }).addTo(map);

        // 3. Variabel untuk Marker dan Radius
        var userMarker;
        var userCircle;

        // 4. Fungsi untuk menangani update lokasi
        function onLocationFound(e) {

        
            const total_employee="{{count($employees)}}";

            var lat = e.coords.latitude;
            var lng = e.coords.longitude;
            var radius = 100; // Radius 100 meter
            const accuracy = e.coords.accuracy;


            // Hapus marker dan lingkaran sebelumnya agar tidak menumpuk
            if (userMarker) {
                map.removeLayer(userMarker);
                map.removeLayer(userCircle);
            }

            // Tambahkan Marker di lokasi baru
            userMarker = L.marker([lat, lng]).addTo(map)
                .bindPopup("Lokasi Anda Saat Ini").openPopup();

            // Tambahkan Lingkaran radius 100m
            userCircle = L.circle([lat, lng], {
                radius: radius,
                color: 'blue',
                fillColor: '#30a3ec',
                fillOpacity: 0.2
            }).addTo(map);

            // Geser peta (pan) ke lokasi GPS dengan zoom otomatis
            map.setView([lat, lng], 17);

            for(var a=1; a <= total_employee;a++){

            document.getElementById('location_now'+a).innerHTML = lat.toFixed(6) + ',' + lng.toFixed(6);

            }

               document.getElementById('coordinate-box').innerHTML = `
                <strong>Coordinates:</strong> ${lat.toFixed(6)}, ${lng.toFixed(6)} <br>
                <strong>Accuracy:</strong> ~${Math.round(accuracy)} meters
            `;

           

        }

        // 5. Fungsi jika terjadi error atau GPS dimatikan
        function onLocationError(e) {
           
            console.error("GPS Tracking Error:", e);
            document.getElementById('coordinate-box').innerText = `Error: ${e.message}`;
        }

      

      

        // 7. Fire up continuous background watch tracking
        if ("geolocation" in navigator) {
            // navigator.geolocation.watchPosition(handleLocationUpdate, handleLocationError, {
              navigator.geolocation.watchPosition(onLocationFound, onLocationError, {
                enableHighAccuracy: true,  // Forces the engine to use GPS hardware over Wi-Fi triage
                timeout: 5000,            // Give the sensor a maximum of 10 seconds to respond
                maximumAge: 0              // Prevent the engine from pulling cached locations
            });
        } else {
            document.getElementById('coordinate-box').innerText = "Geolocation is not supported by your browser.";
        }

        const video = document.getElementById('kamera');
        const canvas = document.getElementById('canvas');
        const btnAmbil = document.getElementById('btn-ambil');
        const btnSimpan = document.getElementById('btn-simpan');
        const hasilContainer = document.getElementById('hasil-container');
        var hide_camera=document.getElementById('camera_div');
        hide_camera.style.display="none";

        // Meminta izin dan mengakses kamera
        async function mulaiKamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { facingMode: "user" }, // "user" untuk kamera depan, "environment" untuk kamera belakang
                    audio: false 
                });
                video.srcObject = stream;
            } catch (error) {
                alert("Akses kamera ditolak atau perangkat tidak mendukung. Pastikan Anda telah memberikan izin.");
                console.error("Error:", error);
            }
        }

        // Mengambil screenshot dari video
        btnAmbil.addEventListener('click', () => {
            // Menyesuaikan ukuran canvas dengan video agar hasil sama persis
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Menggambar frame video ke dalam canvas
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Menampilkan container hasil dan mengaktifkan tombol simpan
            hasilContainer.classList.add('show');
            btnSimpan.disabled = false;
        });

        // Menyimpan hasil screenshot
        btnSimpan.addEventListener('click', () => {
            // Mengubah canvas menjadi URL gambar (format PNG default)
            const dataURL = canvas.toDataURL('image/png');
            
            // Membuat elemen link untuk mendownload gambar secara otomatis
            const link = document.createElement('a');
            link.href = dataURL;
            link.download = 'hasil-foto.png';
            link.click();
        });

        // Menjalankan kamera saat halaman dimuat
        mulaiKamera();


});




function submitToRoute() {
   
    window.location.href = `{{ route('attendence.store') }}`;
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



function Absent_Ijin(key,id_karyawan){

const total_data="{{Count($employees)}}";
const realFileBtn = document.getElementById('realInput'+key);
const fileNameTxt = document.getElementById("file-name"+key);

console.log("total_emp",total_data);


realFileBtn.click();


  var set_tombol_terkunci="<button onclick='Create_Reason("+id_karyawan+","+key+")'  type='submit' class='card-btn-save' style='font-weight:bold;color:white;'  ><i class='ri-arrow-down-line'><label id='present{{$key}}' style='color:black;'  ><i class='ri-save-line'></i></label></i>Simpan</button>";
  $('#tombol_save'+key).append(set_tombol_terkunci);

 realFileBtn.addEventListener("change", function() {



console.log("lihat file",realFileBtn.value);

    if (realFileBtn.value) {
      // Show only the filename, not the full path (security reasons)
      fileNameTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
      
 var tampilkan_texbox='<textarea type="text" placeholder="Isi Alasan Absen" class="form-control"  id="reason'+key+'"></textarea><a class="btn btn-primary" id="simpan" hidden >Simpan</a>';

 document.getElementById('absent_reason'+key).insertAdjacentHTML("beforeend",tampilkan_texbox);


    } else {
      fileNameTxt.innerHTML = "No file chosen";
    }
  });

}
       


function Create_Reason(id_karyawan,key_){

    
    var time_live=document.getElementById('time_ID'+key_).innerHTML;
    var date_reason=$('#datepicker_create_'+key_).val();
 
    const files = document.querySelector("#realInput"+key_).files;
    const image_upload = new FormData();

    let file = files;
    
        image_upload.append('id_karyawan', id_karyawan);
        image_upload.append('file_alasan', file[0]);
        image_upload.append('date_event', date_reason);
        image_upload.append('reason', document.getElementById('reason'+key_).value);
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

 
      
function Simpan_Absen_perUser(id_karyawan,key_,acc_lead){

    var time_live=document.getElementById('time_ID'+key_).innerHTML ;
    var startTime=time_live;
    var jam_terlambat=document.getElementById('late'+key_).value;
    var tanggal_berlaku=document.getElementById('datepicker_create_'+key_).value;
    var location_gps=document.getElementById('location_now'+key_).innerText ;

    var endTime = "08:00:00";
    let jangka_waktu=timeToDecimal(secondsToHMS(hmsToSeconds(startTime) - hmsToSeconds(endTime)));
    let acc_lead_absen_telat=acc_lead;

   // console.log("lihat acc lead:",acc_lead_absen_telat);

    document.getElementById('waktu'+key_).value = "";
    document.getElementById('waktu'+key_).value+= time_live;
    document.getElementById('late'+key_).value = "";

    // console.log("lihat jangka waktu saja:",(jangka_waktu));
    // console.log("lihat konversi detik:",secondsToHMS(hmsToSeconds(startTime)));

     $.ajax({
    url: `/employee/attendence/` + 'create_attendance_masuk_ontime',

    dataType:"JSON",
    type: "POST",
    data:{
            "date":tanggal_berlaku,
            "id_karyawan": id_karyawan,
            'jam_masuk':startTime,
            'jam_terlambat':jam_terlambat,
            'location_maps':location_gps,
            "_token":"{{ csrf_token()}}",

        },

    success: function(response){

    console.log("lihat response:",response);


        if(response.status='200'){

                                    
        toastr.success('Data Permintaan Absen Masuk Sukses!.Terima Kasih',{ fadeAway: 3000 });


        }

    } ,
    
    error: function(jqXHR, textStatus, errorThrown) {
       
        console.log("XHR: " + jqXHR.status );
        console.log("Status: " + textStatus);
        console.log("Error: " + errorThrown);

        if(jqXHR.status=='409'){

                                      
        toastr.error('Data Permintaan Absen Tidak Masuk Karena Duplikat Atau Data Sudah Ada!.Terima Kasih',{ fadeAway: 3000 });



        }
        
    }


    });



}




     
      
function Clock_In(id_karyawan,key_,acc_lead){

const total_employee="{{count($employees)}}";

for(var a=1; a <= total_employee;a++){

    var time_live=document.getElementById('time_ID'+a).innerHTML ;
    var startTime=time_live;
    var endTime = "08:00:00";
    let jangka_waktu=timeToDecimal(secondsToHMS(hmsToSeconds(startTime) - hmsToSeconds(endTime)));
    let acc_lead_absen_telat=acc_lead;

    // console.log("lihat acc lead:",acc_lead_absen_telat);

    document.getElementById('waktu'+key_).value = "";
    document.getElementById('waktu'+key_).value+= time_live;
    document.getElementById('late'+key_).value = "";

    
    // console.log("lihat jangka waktu saja:",(jangka_waktu));
    // console.log("lihat konversi detik:",secondsToHMS(hmsToSeconds(startTime)));


    if(jangka_waktu < "0.5"  ){

    
        document.getElementById('late'+key_).value+= (timeToDecimal(secondsToHMS(hmsToSeconds(startTime) - hmsToSeconds(endTime))));
        //var set_tombolsave_terkunci="<div class='mt-2' ><button type='submit' class='btn btn-primary'>Save</button><a href='{{ route('attendence.index') }}' class='btn btn-danger' >Cancel</a></div>";
        var set_tombol_terkunci="<a  class='card-btn-save'  onclick='Simpan_Absen_perUser("+id_karyawan+','+key_+','+acc_lead+")' style='font-weight:bold;color:white;'  ><i class='ri-arrow-down-line'><label id='present{{$key}}' style='color:black;'  ><i class='ri-save-line'></i></label></i>Simpan</a>";
        
        $('#tombol_save_terlambat'+key_).html('');

        $('#tombol_save_terlambat'+key_).append(set_tombol_terkunci);

    

    }



    
    if(startTime < "08:00:00" ){

        
    document.getElementById('late'+key_).value+= (timeToDecimal(secondsToHMS(hmsToSeconds(startTime) - hmsToSeconds(endTime))));
    //var set_tombolsave_terkunci="<div class='mt-2' ><button type='submit' class='btn btn-primary'>Save</button><a href='{{ route('attendence.index') }}' class='btn btn-danger' >Cancel</a></div>";
    // $('#tombol_save').append(set_tombolsave_terkunci);
     var set_tombol_terkunci="<a  class='card-btn-save'  onclick='Simpan_Absen_perUser("+id_karyawan+','+key_+','+acc_lead+")' style='font-weight:bold;color:white;'  ><i class='ri-arrow-down-line'><label id='present{{$key}}' style='color:black;'  ><i class='ri-save-line'></i></label></i>Simpan</a>";
     $('#tombol_save').append(set_tombol_terkunci);


    //  submitToRoute();

    }


    if( acc_lead_absen_telat == '0' && (jangka_waktu) > "0.5" ){

    toastr.error('Data Permintaan Masuk Gagal Diproses, Melebihi toleransi 15 menit waktu absen masuk yang diberikan!.Informasikan kedatangan masuk ke onsite untuk approval absen masuk.Terima Kasih',{ fadeAway: 5000 });
    var set_tombolsave_terkunci="";

    $('#tombol_save').append(set_tombolsave_terkunci);

    }


    if( acc_lead_absen_telat == '1' && (jangka_waktu) > "0.5" )
    {

   
    var set_tombolsave_terkunci="";

     document.getElementById('late'+key_).value+= (timeToDecimal(secondsToHMS(hmsToSeconds(startTime) - hmsToSeconds(endTime))));
        //var set_tombolsave_terkunci="<div class='mt-2' ><button type='submit' class='btn btn-primary'>Save</button><a href='{{ route('attendence.index') }}' class='btn btn-danger' >Cancel</a></div>";
    var set_tombol_terkunci="<button  class='card-btn-save' type='submit' style='font-weight:bold;color:white;' onclick='Simpan_Absen_perUser("+id_karyawan+','+key_+','+acc_lead+")'  ><i class='ri-arrow-down-line'><label id='present{{$key}}' style='color:black;' ><i class='ri-save-line'></i></label></i>Simpan</button>";

        $('#tombol_save_terlambat'+key_).html('');

        $('#tombol_save_terlambat'+key_).append(set_tombol_terkunci);

       toastr.options = {
      "preventDuplicates": true
        };

         toastr.success('Data Permintaan Absen Masuk Berhasil Diproses, dan sudah diketahui lead vendor.Terima Kasih',{ fadeAway: 5000 });


    }

   

}



 }



    


  </script>





@section('specificpagescripts')
<!-- Table Treeview JavaScript -->
<script src="{{ asset('assets/js/table-treeview.js') }}"></script> 
<!-- Chart Custom JavaScript -->
 <script src="{{ asset('assets/js/customizer.js') }}"></script> 
<!-- Chart Custom JavaScript -->
<script async src="{{ asset('assets/js/chart-custom.js') }}"></script>


<script src="{{  asset('assets/js/clock.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/clock.css') }}">


@endsection
