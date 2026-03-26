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
                        <h4 class="card-title">Create ZAP</h4>
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
                                <label for="name">Tingkat Level<span class="text-danger">*</span></label>

                                <div class="row">
                                    
                               
                               <div class="col-md-3">
                               <label>High</label>
                                <input class="form-control" type="text" name="high" id="high" />
                                </div>
                                
                                <div class="col-md-3">
                                <label>Medium</label>
                                <input class="form-control" type="text" name="medium" id="medium"/>
                                </div>
                               
                                <div class="col-md-3">
                                <label>Low</label>
                                <input class="form-control" type="text" name="low" id="low" />
                                </div>
                                <div class="col-md-3">
                                <label>Informational</label>
                                <input class="form-control" type="text" name="informational" id="informational" />
                                </div>

                                

                               
                                </div>

                                <div class="col-md-12">
                                <label>Dokumen ZAP</label>
                                <input type="file"  name="file_zap" id="file_zap" class="form-control" />

                                </div>
                              
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">

                            <label for="name"> Trouble Shoot/ Solusi <span class="text-danger">*</span></label>
                                <div class="row">

                                <div class="col-md-12">

                                <textarea type="text" class="form-control" style="height:200px;" id="troubleshoot" name="troubleshoot"></textarea>
                              
                                
                                </select>
                                </div>
                                </div>

                                <div class="form-group col-md-12">

                                <label for="name"> Status Case ZAP <span class="text-danger">*</span></label>
                                    <div class="row">

                                    <div class="col-md-12">

                                    <select name="status_zap" class="form-control">

                                    <option value="1" >Open</option>
                                    <option value="2" >Closed</option>
                                    <option value="3" >False Positive</option>

                                    
                                    </select>
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
                            <a type="submit" onclick="Simpan_ZAP()" class="btn btn-primary mr-2">Save</a>
                            <a class="btn bg-danger" href="{{ route('zap_index') }}">Cancel</a>
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


    function Simpan_ZAP(){

       let jam_realtime= $('#digital-clock')[0].innerHTML;

       const files = document.querySelector('[type=file]').files;
       const data_input = new FormData();

       let file_zap_ = files;

        data_input.append('tanggal_cetak',jam_realtime );
        data_input.append('', file_zap_[0]);
        data_input.append('nama_app', document.getElementById('app_name').value);
        data_input.append('tipe_web', document.getElementById('tipe_web').value);
        data_input.append('link_capture',document.getElementById('link_capture').value);
        data_input.append('keterangan',document.getElementById('keterangan').value);
        data_input.append('high',document.getElementById('high').value);
        data_input.append('medium',document.getElementById('medium').value);
        data_input.append('low',document.getElementById('low').value);
        data_input.append('informational',document.getElementById('informational').value);
        data_input.append('akses',document.getElementById('akses').value);
        data_input.append('_token', "{{csrf_token()}}");
       
        var object = {};
        data_input.forEach(function(value, key){
            object[key] = value;
        });
        var json = JSON.stringify(object);


       
    $.ajax({
                    url: `create_zap/save`,
                    type: 'POST',
                    data:data_input,
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,


        success: function(response){

                if(response.status=='200'){

                    toastr.success('Data ZAP  Sukses Tersimpan!.Terima Kasih',{ fadeAway: 3000 });

                    location.href="index";

                    console.log("lihat data zap:",response);


                }



    }



    });




        // console.log("lihat data input:",data_input);



    }



</script>

@endsection
