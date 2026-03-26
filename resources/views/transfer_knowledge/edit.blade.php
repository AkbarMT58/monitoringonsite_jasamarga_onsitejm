@extends('dashboard.body.main')

@section('container')

@php

$utc=$performatesting[0]['tanggal_cetak'];

$time = strtotime($utc .'UTC');
$dateInLocal = date("Y-m-d H:i:s", $time);

@endphp


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit TK</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('tk.update') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                        <!-- begin: Input Data -->


                        <div class=" row align-items-center">
                            <div class="form-group col-md-6">
                                <label for="name"> Nama Aplikasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$performatesting[0]['id']}}" name="id" hidden >
                                <select type="text" class="form-control @error('name') is-invalid @enderror" id="app_name" name="app_name" required autocomplete="off">
                                    
                                    @if($performatesting[0]['kategori_aplikasi']=='1')

                                    <option value="1">SELIA</option>

                                    @elseif($performatesting[0]['kategori_aplikasi']=='2')

                                    <option value="2">CSIRT</option>

                                    @elseif($performatesting[0]['kategori_aplikasi']=='3')

                                    <option value="3">JMGUEST</option>

                                    @elseif($performatesting[0]['kategori_aplikasi']=='4')

                                    <option value="4">JMLINK</option>

                                    @elseif($performatesting[0]['kategori_aplikasi']=='5')

                                    <option value="5">JMINNOV</option>

                                    @elseif($performatesting[0]['kategori_aplikasi']=='6')

                                    <option value="6">JIMMS</option>

                                    @else

                                    <option value="1">SELIA</option>
                                    <option value="2">CSIRT</option>
                                    <option value="3">JMGUEST</option>
                                    <option value="4">JMLINK</option>
                                    <option value="5">JMINNOV</option>
                                    <option value="6">JIMMS</option>
                                   

                                    @endif
                                                                    
                                  
                                    
                                    
                                </select>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="name"> Tanggal Cetak <span class="text-danger">*</span></label>

                                <input  type="text" class="form-control"  name="tanggal_cetak" id="tanggal_cetak" value="{{$dateInLocal}}" />
                                
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="name"> Tipe Aplikasi <span class="text-danger">*</span></label>
                                <select type="text" class="form-control @error('name') is-invalid @enderror" id="tipe_web" name="tipe_web" required autocomplete="off">
                                       
                                        @if($performatesting[0]['tipe_web']=='1')

                                         <option value="1">APK</option>

                                         @elseif($performatesting[0]['tipe_web']=='2')

                                        <option value="2">Web</option>

                                        @else

                                        <option value="1">APK</option>
                                        <option value="2">Web</option>
                                        <option value="0">-Tidak Terdaftar--</option>


                          
                                        
                                        @endif

                                   
                                  

                                </select>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                             <div class="form-group col-md-6">
                                <label for="name">Framework<span class="text-danger">*</span></label>

                                <div class="row">
                                    
                               
                               <div class="col-md-12">
                              
                                 <input type="text" class="form-control"  id="framework" name="framework" value="{{$performatesting[0]['framework']}}"></input>
                              
                                </div>
                                

                                </div>

                             <div class="form-group col-md-6">
                                <label for="name"> Bahasa Pemograman <span class="text-danger">*</span></label>

                                 <input type="text"  name="bahasa_pemograman" id="bahasa_pemograman" value="{{$performatesting[0]['bahasa_pemograman']}}" class="form-control" />

                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name"> Keterangan <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" name="keterangan" value="{{$performatesting[0]['keterangan']}}" style="height:200px;">{{$performatesting[0]['keterangan']}}</textarea>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                           
                            
                           

                            <div class="form-group col-md-6">

                                
                                    <div class="row">

                                  
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

                           


                                
                               
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group col-md-6">
                                <label for="name">Catatan<span class="text-danger">*</span></label>

                                <div class="row">
                                    
                               
                               <div class="col-md-12">
                              
                                 <textarea type="text" class="form-control" style="height:200px;" id="catatan" name="catatan">{{$performatesting[0]['catatan']}}</textarea>
                              
                                </div>
                                

                                

                               
                                </div>

                                <div class="col-md-12">
                                <label>Dokumen TK 1</label>
                                <input type="file"  name="file_tk_1" id="file_1" class="form-control" />

                                </div>

                                  <div class="col-md-12">
                                <label>Dokumen TK 2</label>
                                <input type="file"  name="file_tk_2" id="file_2" class="form-control" />

                                </div>
                              
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">

                           
                                <div class="row">

                               
                                </div>

                                <div class="form-group col-md-12">

                                <label for="name"> Status Case Transfer Knowledge <span class="text-danger">*</span></label>
                                    <div class="row">

                                    <div class="col-md-12">

                                    <select name="status_tk" id="status_tk" class="form-control">


                                    @if(($performatesting[0]['status_tk'])=='1')

                                     <option value="1" >Open</option>

                                    @elseif(($performatesting[0]['status_tk'])=='2')

                                     <option value="2" >Closed</option>

                                    @elseif(($performatesting[0]['status_tk'])=='3')

                                      <option value="3" >False Positive</option>


                                      @else

                                    
                                     

                                    @endif

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

                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                            <a class="btn bg-danger" href="{{ route('tk_index') }}">Cancel</a>
                        </div>

                       
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
@endsection
