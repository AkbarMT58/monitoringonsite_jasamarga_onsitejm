@extends('dashboard.body.main')

@section('specificpagestyles')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('container')

<style>
/* Basic styling */

[type=checkbox] {
  width: 2rem;
  height: 2rem;
  color: dodgerblue;
  vertical-align: middle;
  -webkit-appearance: none;
  background: none;
  border: 0;
  outline: 0;
  flex-grow: 0;
  border-radius: 50%;
  background-color: #FFFFFF;
  transition: background 300ms;
  cursor: pointer;
}


/* Pseudo element for check styling */

[type=checkbox]::before {
  content: "";
  color: transparent;
  display: block;
  width: inherit;
  height: inherit;
  border-radius: inherit;
  border: 0;
  background-color: transparent;
  background-size: contain;
  box-shadow: inset 0 0 0 1px #CCD3D8;
}


/* Checked */

[type=checkbox]:checked {
  background-color: currentcolor;
}

[type=checkbox]:checked::before {
  box-shadow: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}


/* Disabled */

[type=checkbox]:disabled {
  background-color: #CCD3D8;
  opacity: 0.84;
  cursor: not-allowed;
}


/* IE */

[type=checkbox]::-ms-check {
  content: "";
  color: transparent;
  display: block;
  width: inherit;
  height: inherit;
  border-radius: inherit;
  border: 0;
  background-color: transparent;
  background-size: contain;
  box-shadow: inset 0 0 0 1px #CCD3D8;
}

[type=checkbox]:checked::-ms-check {
  box-shadow: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}





</style>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Pengajuan Cuti</h4>
                    </div>
                </div>

                <div class="card-body">
                 
                    <!-- <form action="{{ route('create_performa.save') }}" method="POST"> -->
                    @csrf
                        <!-- begin: Input Data -->
                        <div class=" row align-items-center">
                           
                          
                            <div class=" row align-items-center">

                            <input type="text" name="id_cuti" id="id_cuti" value="{{$cuti[0]['id']}}" hidden/>

                              <div class="form-group col-md-6">
                                <label for="name"> Nama Karyawan <span class="text-danger">*</span></label>
                                <select  class="form-control" id="id_karyawan"  placeholder="Nama Karyawan">

                                @if($cuti[0]['employee_id']=='1')

                                <option value="1">M. Taufik Akbar</option>

                                @elseif($cuti[0]['employee_id']=='2')
                                <option value="2">Rizky Sugiarti</option>

                                @elseif($cuti[0]['employee_id']=='3')
                                 <option value="3">Surya</option>

                                 @elseif($cuti[0]['employee_id']=='4')
                                  <option value="4">Feby</option>

                                 @else

                                 <option>--Belum Terdaftar--</option>

                               
                            
                                @endif

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
                                <input type="date" class="form-control" id="dateFrom"  placeholder="Tanggal Dari" value="{{$cuti[0]['dateFrom']}}"/>

                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            
                              <div class="form-group col-md-6">
                                <label for="name"> Ke Tanggal <span class="text-danger">*</span></label>
                                 <input type="date" class="form-control" id="dateTo"  placeholder="Tanggal Ke" value="{{$cuti[0]['dateTo']}}"/>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                           
                       
                             <div class="form-group col-md-6">
                                <label for="name"> Jumlah Cuti <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="jumlah_pengajuan_cuti" name="jumlah_pengajuan_cuti"  placeholder="Jumlah Pengajuan Cuti" value="{{$cuti[0]['jumlah_pengajuan_cuti']}}"  />
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name"> Alasan Cuti <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" style="height:200px;" id="alasan_cuti" name="alasan_cuti" >{{$cuti[0]['alasan_cuti']}}</textarea>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                             <div class="form-group col-md-6" >
                                <label for="name"> Keterangan <span class="text-danger">*</span></label>
                                
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Isi dengan data link mobile dan desktop" style="height:200px;" >{{$cuti[0]['keterangan']}} </textarea>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        
                           
                           
                                
                                    </div> 


                                    

                                    <div class="form-group col-md-12">

                                <label for="name"> Karyawan Onsite JM <span class="text-danger">*</span></label>
                                    <div class="row">

                                    <div class="col-md-12">

                                    <div class="round">
                                        <input type="checkbox"  id="approved_cuti_acc_karyawan" name="approved_cuti_acc_karyawan" value="2"  @if($cuti[0]['mengetahui_karyawan']!=''){{'Checked'}}@else {{''}} @endif />
                                        <label for="checkbox"></label>
                                    </div>
                                  
                                    </div>

                                      <div class="form-group col-md-12">

                                <label for="name"> Supervisor Onsite Kuantum <span class="text-danger">*</span></label>
                                    <div class="row">

                                    <div class="col-md-12">

                                    <div class="round">
                                        <input type="checkbox"  id="approved_cuti_spv_kuantum" name="approved_cuti_spv_kuantum" value="4"  @if($cuti[0]['mengetahui_leader']!=''){{'Checked'}}@else {{''}} @endif />
                                        <label for="checkbox"></label>
                                    </div>
                                  
                                    </div>
                                      <div class="form-group col-md-12">

                                <label for="name"> Manajer/Direktur Onsite Kuantum<span class="text-danger">*</span></label>
                                    <div class="row">

                                    <div class="col-md-12">

                                    <div class="round">
                                        <input type="checkbox"  id="approved_cuti_manajer_kuantum" name="approved_cuti_manajer_kuantum" value="5"  @if($cuti[0]['mengetahui_spv_vendor']!=''){{'Checked'}}@else {{''}} @endif  />
                                        <label for="checkbox"></label>
                                    </div>
                                  
                                    </div>

                                     <div class="form-group col-md-12">

                                <label for="name">Supervisor ITE JM<span class="text-danger">*</span></label>
                                    <div class="row">

                                    <div class="col-md-12">

                                    <div class="round">
                                        <input type="checkbox"  id="approved_cuti_spv_jm" name="approved_cuti_spv_jm"  value="5" @if($cuti[0]['mengetahui_spv_onsite']!=''){{'Checked'}}@else {{''}} @endif  />
                                        <label for="checkbox"></label>
                                    </div>
                                  
                                    </div>

                                     <div class="form-group col-md-12">

                                <label for="name">Manajer/Direktur ITE JM<span class="text-danger">*</span></label>
                                    <div class="row">

                                    <div class="col-md-12">

                                    <div class="round">
                                        <input type="checkbox"  id="approved_cuti_mnj_jm" name="approved_cuti_mnj_jm" value="6" @if($cuti[0]['mengetahui_manajer_onsite']!=''){{'Checked'}}@else {{''}} @endif  />
                                        <label for="checkbox"></label>
                                    </div>
                                  
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

                              
                                    </div>


                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                               <!-- end: Input Data -->
                        <div class="mt-2 ">
                            <a type="submit" onclick="Perbarui_CUTI()" class="btn btn-primary mr-2">Save</a>
                            <a class="btn bg-danger" href="{{ route('create_cuti') }}">Cancel</a>
                        </div>
                            </div>

                           
                      <br>
                      <br>
                              
                   

                     
                    <!-- </form> -->

                    
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
</div>

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


    function Perbarui_CUTI(){

      // let jam_realtime= $('#digital-clock')[0].innerHTML;

       const files = document.querySelector('[type=file]').files;
       const data_input = new FormData();

    //    let file_zap_ = files;

        // data_input.append('tanggal_cetak',jam_realtime );
        // data_input.append('', file_zap_[0]);
        data_input.append('id_cuti', document.getElementById('id_cuti').value);
        data_input.append('id_karyawan', document.getElementById('id_karyawan').value);
        data_input.append('dateFrom', document.getElementById('dateFrom').value);
        data_input.append('dateTo', document.getElementById('dateTo').value);
        data_input.append('jumlah_pengajuan_cuti', document.getElementById('jumlah_pengajuan_cuti').value);
      
        data_input.append('alasan_cuti',document.getElementById('alasan_cuti').value);
        data_input.append('keterangan',document.getElementById('keterangan').value);

        var acc_karyawan= $('#approved_cuti_acc_karyawan:checked').val() ;
        var spv_kuantum=$('#approved_cuti_spv_kuantum:checked').val() ;
        var mj_kuantum=$('#approved_cuti_manajer_kuantum:checked').val();
        var spv_jm=$('#approved_cuti_spv_jm:checked').val();
        var mj_jm=$('#approved_cuti_mnj_jm:checked').val();

        if(spv_kuantum> '1'){


            spv_kuantum ='4';

        }else{

            spv_kuantum='0';


        }
         if(mj_kuantum> '1'){


            mj_kuantum ='5';

        }else{

            mj_kuantum='0';


        }
         if(spv_jm> '1'){


            spv_jm ='6';

        }else{


             spv_jm ='0';

        }
         if(mj_jm> '1'){


            mj_jm ='5';

        }else{

           mj_jm ='0';

        }
        
         
        data_input.append('acc_karyawan',acc_karyawan);
        data_input.append('approved_cuti_spv_kuantum',spv_kuantum);
        data_input.append('approved_cuti_manajer_kuantum',mj_kuantum);

        data_input.append('approved_cuti_spv_jm',spv_jm);
        data_input.append('approved_cuti_mnj_jm',mj_jm);
       
        // data_input.append('akses',document.getElementById('akses').value);

        data_input.append('_token', "{{csrf_token()}}");
       
        var object = {};
        data_input.forEach(function(value, key){
            object[key] = value;
        });
        var json = JSON.stringify(object);


       
    $.ajax({
                    url: `create_cuti/update`,
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

                    window.location.href="{{route('create_cuti')}}";

             

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
