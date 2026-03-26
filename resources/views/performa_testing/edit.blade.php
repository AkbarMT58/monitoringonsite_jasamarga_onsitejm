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
                        <h4 class="card-title">Edit Performa Testing</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('create_performa.update') }}" method="POST">
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

                                    <option value="0">--Tidak Terdaftar Data--</option>



 
                                   
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
                                <label for="name"> Akses <span class="text-danger">*</span></label>
                                <select type="text" class="form-control @error('name') is-invalid @enderror" id="akses" name="akses" required autocomplete="off">

                                @if($performatesting[0]['akses']=='1')

                                   
                                    <option value="1">Bisa</option>

                                @elseif($performatesting[0]['akses']=='2')
                                    <option value="0">Tidak Bisa</option>


                                @endif

                                <option value="1">Bisa</option>
                                <option value="2">Tidak</option>


                                   


                                </select>
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
                                <label for="name"> Link Capture <span class="text-danger">*</span></label>
                                
                                <textarea class="form-control" name="link_capture" placeholder="Isi dengan data link mobile dan desktop" style="height:200px;" >{{$performatesting[0]['link_capture'] }}</textarea>
                              
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name"> Jam Pengecekan <span class="text-danger">*</span></label>
                                <select type="text" class="form-control @error('name') is-invalid @enderror" id="jam_pengecekan" name="jam_pengecekan" required autocomplete="off">
                                   

                                    @if($performatesting[0]['jam_pengecekan']=='1')

                                        <option value="1">08:00</option>

                                        @elseif($performatesting[0]['jam_pengecekan']=='2')

                                        <option value="2">13:00</option>

                                        @elseif($performatesting[0]['jam_pengecekan']=='3')

                                        <option value="3">16:00</option>

                                        @else

                                        <option value="0">--Tidak Terdaftar Waktu--</option>


                                        @endif

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

                            <div class="form-group col-md-6">

                            <label for="name"> Performa <span class="text-danger">*</span></label>
                                <div class="row">

                                <div class="col-md-3">
                                <select type="text" class="form-control @error('name') is-invalid @enderror" id="mobile_type" name="mobile_type" required autocomplete="off">
                                    <option value="1">Mobile:</option>
                           
                                </select>
                                </div>
                                <div class="col-md-3">
                                <input type="text" class="form-control" name="nilai_mobile" value="{{$performatesting[0]['performa_mobile']}}">
                                </div>
                                <div class="col-md-3">
                                <select type="text" class="form-control @error('name') is-invalid @enderror" id="desktop_type" name="desktop_type" required autocomplete="off">
                                    <option value="1">Desktop:</option>
                           
                                </select>
                                </div>
                                <div class="col-md-3">
                                <input type="text" class="form-control" name="nilai_desktop" value="{{$performatesting[0]['performa_desktop']}}">
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
                            <a class="btn bg-danger" href="{{ route('performa_index') }}">Cancel</a>
                        </div>

                       
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
@endsection
