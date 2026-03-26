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
                        <h4 class="card-title">Create Performa Testing</h4>
                    </div>
                </div>

                <div class="card-body">
                    <!-- <form action="{{ route('create_performa.save') }}" method="POST"> -->
                    @csrf
                        <!-- begin: Input Data -->
                        <div class=" row align-items-center">
                            <div class="form-group col-md-6">
                                <label for="name"> Nama Aplikasi <span class="text-danger">*</span></label>
                                <select type="text" class="form-control @error('name') is-invalid @enderror" id="app_name" name="app_name" required autocomplete="off">
                                    <option value="1">SELIA</option>
                                    <option value="2">CSIRT</option>
                                    <option value="3">JMGUEST</option>
                                    <option value="4">JMLINK</option>
                                    <option value="5">JMINNOV</option>
                                    <option value="6">JIMSS</option>


                                </select>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name"> Tanggal Cetak <span class="text-danger">*</span></label>

                                <div id="digital-clock" ></div>
                                
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class=" row align-items-center">
                        
                            <div class="form-group col-md-6">
                                <label for="name"> Tipe Aplikasi <span class="text-danger">*</span></label>
                                <select type="text" class="form-control @error('name') is-invalid @enderror" id="tipe_web" name="tipe_web" required autocomplete="off">
                                    <option value="1">APK</option>
                                    <option value="2">Web App</option>
                                  

                                </select>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name"> Akses <span class="text-danger">*</span></label>
                                <select type="text" class="form-control @error('name') is-invalid @enderror" id="akses" name="akses" required autocomplete="off">
                                    <option value="1">Bisa</option>
                                    <option value="0">Tidak Bisa</option>
                                   


                                </select>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name"> Keterangan <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" style="height:200px;" id="keterangan" name="keterangan"></textarea>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name"> Link Capture <span class="text-danger">*</span></label>
                                
                                <textarea class="form-control" id="link_capture" name="link_capture" placeholder="Isi dengan data link mobile dan desktop" style="height:200px;" > </textarea>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name"> Jam Pengecekan <span class="text-danger">*</span></label>
                                <select type="text" class="form-control @error('name') is-invalid @enderror" id="jam_pengecekan" name="jam_pengecekan" required autocomplete="off">
                                    <option value="1">08:00</option>
                                    <option value="2">13:00</option>
                                    <option value="3">16:00</option>
                                  


                                </select>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">

                            <label for="name"> Performa <span class="text-danger">*</span></label>
                                <div class="row">

                                <div class="col-md-3">
                                <select type="text" class="form-control @error('name') is-invalid @enderror" id="mobile_type" name="mobile_type" required autocomplete="off">
                                    <option value="1">Mobile:</option>
                           
                                </select>
                                </div>
                                <div class="col-md-3">
                                <input type="text" class="form-control" id="nilai_mobile" name="nilai_mobile">
                                </div>
                                <div class="col-md-3">
                                <select type="text" class="form-control @error('name') is-invalid @enderror" id="desktop_type" name="desktop_type" required autocomplete="off">
                                    <option value="1">Desktop:</option>
                           
                                </select>
                                </div>
                                <div class="col-md-3">
                                <input type="text" class="form-control" id="nilai_desktop" name="nilai_desktop">
                                </div>
                                </div>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">

                        <label for="name"> Tools <span class="text-danger">*</span></label>
                            <div class="row">

                            <div class="col-md-3">
                            <select type="text" class="form-control @error('name') is-invalid @enderror" id="desktop_type" name="desktop_type" required autocomplete="off">
                                <option value="1">Web:</option>

                            </select>
                            </div>
                            <div class="col-md-9">
                            <input type="text" class="form-control" id="web_name" name="web_name" value="https://pagespeed.web.dev/analysis?url=https%3A%2F%2Fjm-guest.jasamarga.co.id%2F">
                            </div>
                            </div>
                        
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        </div>

                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <a type="submit" onclick="Simpan()" class="btn btn-primary mr-2">Save</a>
                            <a class="btn bg-danger" href="{{ route('performa_index') }}">Cancel</a>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>

<script type="text/javascript" >



function getDateTime() {
        var now     = new Date(); 
        var year    = now.getFullYear();
        var month   = now.getMonth()+1; 
        var day     = now.getDate();
        var hour    = now.getHours();
        var minute  = now.getMinutes();
        var second  = now.getSeconds(); 
        if(month.toString().length == 1) {
             month = '0'+month;
        }
        if(day.toString().length == 1) {
             day = '0'+day;
        }   
        if(hour.toString().length == 1) {
             hour = '0'+hour;
        }
        if(minute.toString().length == 1) {
             minute = '0'+minute;
        }
        if(second.toString().length == 1) {
             second = '0'+second;
        }   
        var dateTime = year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second;   
         return dateTime;
    }

    // example usage: realtime clock
    setInterval(function(){
        currentTime = getDateTime();
        document.getElementById("digital-clock").innerHTML = currentTime;
    }, 1000);


    function Simpan(){

       let jam_realtime= $('#digital-clock')[0].innerHTML;

    //    const files = document.querySelector('[type=file]').files;
       const data_input = new FormData();


        data_input.append('tanggal_cetak',jam_realtime );
        // image_upload.append('file_alasan', file[0]);
        data_input.append('nama_app', document.getElementById('app_name').value);
        data_input.append('tipe_web', document.getElementById('tipe_web').value);
        data_input.append('link_capture',document.getElementById('link_capture').value);
        data_input.append('keterangan',document.getElementById('keterangan').value);
        data_input.append('jam_pengecekan',document.getElementById('jam_pengecekan').value);
        data_input.append('akses',document.getElementById('akses').value);
        data_input.append('performa_mobile',document.getElementById('nilai_mobile').value);
        data_input.append('performa_desktop',document.getElementById('nilai_desktop').value);
        data_input.append('tools',document.getElementById('web_name').value);
        
        data_input.append('_token', "{{csrf_token()}}");
        
        var object = {};
        data_input.forEach(function(value, key){
            object[key] = value;
        });
        var json = JSON.stringify(object);


       
    $.ajax({
                    url: `create/save`,
                    type: 'POST',
                    data:data_input,
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,


        success: function(response){

                if(response.status=='200'){

                 
                    toastr.success('Data Permintaan Performa Testing Sukses Tersimpan!.Terima Kasih',{ fadeAway: 3000 });

                
                
                    location.href="index";

                }



    }



    });




        console.log("lihat data input:",data_input);



    }



</script>

@endsection
