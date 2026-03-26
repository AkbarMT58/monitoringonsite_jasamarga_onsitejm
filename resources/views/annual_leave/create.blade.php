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
                        <h4 class="card-title">Create Pengajuan Cuti</h4>
                    </div>
                </div>

                <div class="card-body">
                    <!-- <form action="{{ route('create_performa.save') }}" method="POST"> -->
                    @csrf
                        <!-- begin: Input Data -->
                        <div class=" row align-items-center">
                           
                          
                            <div class=" row align-items-center">

                              <div class="form-group col-md-6">
                                <label for="name"> Nama Karyawan <span class="text-danger">*</span></label>
                                <select  class="form-control" id="id_karyawan"  placeholder="Nama Karyawan">

                                <option value="1">M. Taufik Akbar</option>
                                <option value="2">Rizky Sugiarti</option>
                                <option value="3">Surya</option>
                                <option value="4">Feby</option>


                                </select>


                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                           
                            <div class="form-group col-md-6">
                                <label for="name"> Dari Tanggal <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="dateFrom"  placeholder="Tanggal Dari"/>

                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                              <div class="form-group col-md-6">
                                <label for="name"> Ke Tanggal <span class="text-danger">*</span></label>
                                 <input type="date" class="form-control" id="dateTo"  placeholder="Tanggal Dari"/>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                             <div class="form-group col-md-6">
                                <label for="name"> Jumlah Cuti <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="jumlah_pengajuan_cuti" name="jumlah_pengajuan_cuti"  placeholder="Jumlah Pengajuan Cuti" required/>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name"> Alasan Cuti <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" style="height:200px;" id="alasan_cuti" name="alasan_cuti"></textarea>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" >
                                <label for="name"> Keterangan <span class="text-danger">*</span></label>
                                
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Isi dengan data link mobile dan desktop" style="height:200px;" > </textarea>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" >
                                <label for="name"><span class="text-danger">*</span></label>

                                <div class="row">
                                    
                               
                                

                               
                                </div>

                                <div class="col-md-12" hidden>
                                <label></label>
                                <input type="file"  name="file_cuti" id="file_cuti" class="form-control" />

                                </div>
                              
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6" hidden>

                            <label for="name"> Trouble Shoot/ Solusi <span class="text-danger">*</span></label>
                                <div class="row">

                                <div class="col-md-12">

                                <textarea type="text" class="form-control" style="height:200px;" id="troubleshoot" name="troubleshoot"></textarea>
                              
                                
                                </select>
                                </div>
                                </div>

                                <div class="form-group col-md-12">

                                <label for="name"> Status Cuti <span class="text-danger">*</span></label>
                                    <div class="row">

                                    <div class="col-md-12">

                                    <select name="status_cuti" id="status_cuti" class="form-control">

                                    <option value="1" >Draft</option>
                                    <option value="2" >Waiting Approval</option>
                                    <option value="3" >Pending</option>
                                    <option value="4" >Approved</option>

                                    
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

                           
                      <br>
                      <br>

                        <!-- end: Input Data -->
                        <div class="mt-2 ">
                            <a type="submit" onclick="Simpan_CUTI()" class="btn btn-primary mr-2">Save</a>
                            <a class="btn bg-danger" href="{{ route('zap_index') }}">Cancel</a>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
</div>




<script >


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
    // setInterval(function(){
    //     currentTime = getDateTime();
    //     document.getElementById("digital-clock").innerHTML = currentTime;
    // }, 1000);


    function Simpan_CUTI(){

      // let jam_realtime= $('#digital-clock')[0].innerHTML;

       const files = document.querySelector('[type=file]').files;
       const data_input = new FormData();

    //    let file_zap_ = files;

        // data_input.append('tanggal_cetak',jam_realtime );
        // data_input.append('', file_zap_[0]);
        data_input.append('id_karyawan', document.getElementById('id_karyawan').value);
        data_input.append('dateFrom', document.getElementById('dateFrom').value);
        data_input.append('dateTo', document.getElementById('dateTo').value);
        data_input.append('jumlah_pengajuan_cuti', document.getElementById('jumlah_pengajuan_cuti').value);
      
        data_input.append('alasan_cuti',document.getElementById('alasan_cuti').value);
        data_input.append('status_cuti',document.getElementById('status_cuti').value);
        data_input.append('keterangan',document.getElementById('keterangan').value);
       
        // data_input.append('mengetahui_leader',document.getElementById('mengetahui_leader').value);
        // data_input.append('mengetahui_spv_vendor',document.getElementById('mengetahui_spv_vendor').value);

        // data_input.append('mengetahui_spv_onsite',document.getElementById('mengetahui_spv_onsite').value);
        // data_input.append('mengetahui_manajer_onsite',document.getElementById('mengetahui_manajer_onsite').value);
       
        // data_input.append('akses',document.getElementById('akses').value);

        data_input.append('_token', "{{csrf_token()}}");
       
        var object = {};
        data_input.forEach(function(value, key){
            object[key] = value;
        });
        var json = JSON.stringify(object);


       
    $.ajax({
                    url: `create_cuti/save`,
                    type: 'POST',
                    data:data_input,
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,


        success: function(response){

            


               


                 if(response.status=='200'){

                    toastr.success('Data Cuti Tahunan  Sukses Tersimpan!.Terima Kasih',{ fadeAway: 3000 });

                    location.href="create_cuti";

                    console.log("lihat data cuti:",response);


                }




    },
    
  error: function(e) {

       toastr.error('Sisa Cuti Anda Adalah 0   Dan Sudah Habis!.Anda Tidak Bisa Mengajukan Cuti.Terima Kasih',{ fadeAway: 2000 });
   
  }



    });




        // console.log("lihat data input:",data_input);



    }



</script>


@endsection
