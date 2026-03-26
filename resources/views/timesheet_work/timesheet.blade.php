@extends('dashboard.body.main')

@section('container')

@php


 $kode_karyawan=auth()->user()->employee_id ;

@endphp



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


<style>


.notifications {
    background: transparent;
    box-shadow: 0 0 0 0.1em transparent;
    filter: brightness(1) grayscale(1);
    position: relative;
    width: 1.5em;
    height: 1.5em;
    transition: filter 0.15s 0.3s linear;
    -webkit-appearance: none;
    appearance: none;
    -webkit-tap-highlight-color: transparent;
}

.notifications:focus {
    outline: none;
}

.notifications:before,
.notifications:after,
.notifications__badge,
.notifications__waves,
.notifications__sr {
    position: absolute;
}

.notifications:before,
.notifications:after {
    content: "";
    display: block;
}

.notifications:before {
    background: radial-gradient(0.4em 0.4em at 50% 1.1em, hsl(38, 90%, 55%) 47%, hsla(38, 90%, 55%, 0) 50%);
    top: 0.2em;
    left: calc(50% - 0.2em);
    width: 0.4em;
    height: 1.3em;
    transform-origin: 50% 0.2em;
}

.notifications:after {
    background:
        /* rim */
        radial-gradient(0.4em 0.2em at 0.2em 1.2em, hsl(45, 90%, 55%) 46%, hsla(45, 90%, 55%, 0) 50%), linear-gradient(hsl(45, 90%, 55%), hsl(45, 90%, 55%)) 0.2em 1.1em / 1.1em 0.2em no-repeat, radial-gradient(0.4em 0.2em at 1.3em 1.2em, hsl(45, 90%, 55%) 46%, hsla(45, 90%, 55%, 0) 50%),
        /* middle */
        radial-gradient(1.2em 1.2em at 50% 0.75em, hsl(38, 90%, 55%) 49%, hsla(38, 90%, 55%, 0) 50%) 0 0 / 100% 75% no-repeat, linear-gradient(hsl(38, 90%, 55%), hsl(38, 90%, 55%)) 0.15em 0.75em / 1.2em 0.4em no-repeat,
        /* top */
        radial-gradient(0.3em 0.3em at 50% 0.15em, hsl(45, 90%, 55%) 48%, hsla(45, 90%, 55%, 0) 50%);
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transform-origin: 50% 0.15em;
}

.notifications__badge {
    background: hsl(3, 90%, 55%);
    border-radius: 0.9rem;
    color: hsl(0, 0%, 100%);
    font-size: 0.5em;
    font-weight: bold;
    padding: 0 0.125rem;
    top: -0.125rem;
    right: -0.125rem;
    min-width: 2rem;
    height: 2rem;
    text-align: center;
    transition: transform 0.3s 0.15s ease-out;
    z-index: 1;
}

.notifications__badge:empty {
    transform: scale(0);
    transition-delay: 0s;
}

.notifications__waves,
.notifications--active:before,
.notifications--active:after {
    animation-duration: 2s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}

.notifications__waves {
    animation-delay: 0.6s;
    border-top: 0.1em solid transparent;
    border-right: 0.1em solid hsla(var(--hue), 10%, 50%);
    border-bottom: 0.1em solid transparent;
    border-left: 0.1em solid hsla(var(--hue), 10%, 50%);
    border-radius: 50%;
    top: -50%;
    left: -50%;
    opacity: 0;
    pointer-events: none;
    width: 200%;
    height: 200%;
    transform: scale(0.3);
}

.notifications__waves:nth-child(2) {
    animation-delay: 0.75s;
}

.notifications__waves:nth-child(3) {
    animation-delay: 0.9s;
}

.notifications__waves:nth-child(4) {
    animation-delay: 1.05s;
}

.notifications--active {
    filter: brightness(1) grayscale(0);
    transition-delay: 0s;
}

.notifications--active:before,
.notifications--active:after {
    animation-delay: 0.3s;
}

.notifications--active:before {
    animation-name: ringBefore;
}

.notifications--active:after {
    animation-name: ringAfter;
}

.notifications--active .notifications__waves {
    animation-name: waves;
}

.notifications__sr {
    clip: rect(1px, 1px, 1px, 1px);
    overflow: hidden;
    width: 1px;
    height: 1px;
}

/* Dark theme */
@media (prefers-color-scheme: dark) {
    :root {
        --bg: hsl(var(--hue), 10%, 10%);
        --fg: hsl(var(--hue), 10%, 90%);
    }
}

/* Animations */
@keyframes ringBefore {
    from {
        transform: rotate(0);
    }

    15% {
        transform: rotate(-3deg);
    }

    20% {
        transform: rotate(6deg);
    }

    25% {
        transform: rotate(-6deg);
    }

    30% {
        transform: rotate(18deg);
    }

    35% {
        transform: rotate(-18deg);
    }

    40% {
        transform: rotate(22deg);
    }

    45% {
        transform: rotate(-20deg);
    }

    50% {
        transform: rotate(18deg);
    }

    55% {
        transform: rotate(-16deg);
    }

    60% {
        transform: rotate(14deg);
    }

    65% {
        transform: rotate(-12deg);
    }

    70% {
        transform: rotate(10deg);
    }

    75% {
        transform: rotate(-8deg);
    }

    80% {
        transform: rotate(6deg);
    }

    85% {
        transform: rotate(-4deg);
    }

    90% {
        transform: rotate(2deg);
    }

    95% {
        transform: rotate(-1deg);
    }
}

@keyframes ringAfter {

    from,
    40%,
    to {
        transform: rotate(0);
    }

    5%,
    35% {
        transform: rotate(10deg);
    }

    10%,
    30% {
        transform: rotate(-10deg);
    }

    15%,
    25% {
        transform: rotate(20deg);
    }

    20% {
        transform: rotate(-20deg);
    }
}

@keyframes waves {
    from {
        opacity: 1;
        transform: scale(0.3);
    }

    20%,
    to {
        opacity: 0;
        transform: scale(1);
    }
}




.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
.btn-circle.btn-lg {
  width: 50px;
  height: 50px;
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.33;
  border-radius: 25px;
}
.btn-circle.btn-xl {
  width: 55px;
  height: 70px;
  padding: 10px 16px;
  font-size: 24px;
  line-height: 1.33;
  border-radius: 35px;
}


    textarea{
        width:480px;
        height:150px;
    }

    @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

.container {
  max-width: 1440px;
  width: 100%;
  background: #fff;
  box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.5);
}
.container h2 {
  padding: 2rem 1rem;
  text-align: center;
  /* background: #e74c3c; */
  /* color: #fff; */
  font-size: 2.5rem;
}
.tbl {
  width: 100%;
  border-collapse: collapse;
}
.tbl thead {
  background: #424949;
  color: #fff;
}
.tbl thead tr th {
  font-size: 0.9rem;
  padding: 0.8rem;
  letter-spacing: 0.2rem;
  vertical-align: top;
  border: 1px solid #aab7b8;
}
.tbl tbody tr td {
  font-size: 1rem;
  letter-spacing: 0.2rem;
  font-weight: normal;
  text-align: center;
  border: 1px solid #aab7b8;
  padding: 0.8rem;
}
.tbl tr:nth-child(even) {
  background: #ccc;
  transition: all 0.3s ease-in;
  cursor: pointer;
}
.tbl tr:hover td {
  background: #839192;
  color: #000;
  transition: all 0.3s ease-in;
  cursor: pointer;
}
.tbl button {
  display: inline-block;
  border: none;
  margin: 0 auto;
  padding: 0.4rem;
  border-radius: 1px;
  outline: none;
  cursor: pointer;
}
.btn_trash {
  background: #e74c3c;
  color: #fff;
}
.btn_edit {
  color: #fff;
  background: #1e8449;
}
@media (max-width: 768px) {
  .tbl thead {
    display: none;
  }
  .tbl tr,
  .tbl td {
    display: block;
    width: 100%;
  }
  .tbl tr {
    margin-bottom: 1rem;
  }
  .tbl tbody tr td {
    text-align: right;
    position: relative;
    transition: all 0.2s ease-in;
  }
  .tbl td::before {
    content: attr(data-label);
    position: absolute;
    left: 0;
    width: 50%;
    padding-left: 1.2rem;
    text-align: left;
  }
  .tbl tbody tr td:hover {
    background: #ccc;
    color: #000;
  }
  .tbl_content {
    padding: 1rem;
  }
}
    
  
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 60%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  margin-left:930px;
}



.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}



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
            @if (session()->has('success'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert text-white bg-danger" role="alert">
                    <div class="iq-alert-text">{{ session('error') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Timesheet Web JM List</h4>
                    <p class="mb-0"><br>
                         </p>
                </div>

                  <div id="time_ID"></div>   

                  <br>
                  
                  <div id="Bulan" hidden ></div>
                  <div id="Tahun" hidden ></div>

                 

                
                
            </div>
        </div>


       
     
                <div class="col-md-3 mb-5">

                <label>Tanggal Dari :</label>

               <input type="text" class="form-control date_from" id="dateFrom"  placeholder="Tanggal Dari"/>

                </div>

                <div class="col-md-3 mb-5">

                <label>Tanggal Ke :</label>

                <input type="text" class="form-control date_to" id="dateTo"  placeholder="Tanggal Dari"/>

                </div>
                <div class="col-md-3 mb-5">

                <label>Nama PT :</label>

               <select class="form-control" id="jenispt" >
               <option value="0">--Pilih Nama Perusahaan--</option>
               <option value="1">Jasa Marga</option>
               <option value="2">Kuantum</option>



               </select>
                </div>
                <div class="col-md-3 mt-5">



                <a  class="btn btn-danger add-list"  onclick="call_report_timesheet()" ><i class="ri-file-pdf-fill" ></i> Print Timesheet</a>

                </div>
                
</div>


<div class="row float-right">

                <div class="col-md-4 mb-5">
       

                <a class="btn btn-warning add-list mb-5" onclick="call_signature({{$kode_karyawan}})" style="color:white;"><i class="fa-solid fa-plus mr-3"></i>Approve</a>
               
               
               

                </div>

                 <div class="col-md-4 mb-5">

                  <a class="btn btn-primary add-list" onclick="Cetak_TimeSheet()" style="color:white;"><i class="fa-solid fa-plus mr-3"></i>Add +</a>
              


                </div>

                 <div class="col-md-4 mb-5">

                  <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Link Time Sheet " href="{{route('timesheet')}}"><i class="ri-arrow-left-circle-fill"></i>Kembali 
                </a>

                </div>

               
       


                </div>





      
    <div id="my-container" class="cpb-progress-container"><div> 
<br>
<br>
<br>
<br>

@foreach($check_datatimesheet as $row_)




@if(($row_->tot_past== 31 ) and ($row_->tot_plant== 31 )) 

<div class="alert alert-success"><button type="button" id="notifications" class="btn btn-success btn-circle btn-xl"> <i class="ri-calendar-check-line"></i></button>&nbsp;&nbsp;Data Timesheet Sudah Diisi Lengkap</div>
<br> 
@endif 

 @if( (($row_->tot_past) > '0' and ($row_->tot_past) < '31') or (($row_->tot_today_goal) > '0' and ($row_->tot_today_goal) < '31') or (($row_->tot_obstacle) > '0' and ($row_->tot_obstacle) < '31') or (($row_->tot_plant) > '0' and ($row_->tot_plant) < '31')  ) 

<div class="alert alert-warning"><button type="button" class="btn btn-warning btn-circle btn-xl"><span class="notifications__sr">Notifications</span>
    <span class="notifications__badge" data-badge>{{$row_->tot_obstacle}}</span><i class="ri-file-warning-fill"></i></button>&nbsp;&nbsp;Data Timesheet Belum Diisi Lengkap<br>&nbsp;&nbsp;{{$row_->tot_obstacle}} Obstacle , {{$row_->tot_today_goal}} Today Goal </div>
<br>

@endif 


@if(($row_->tot_past == 0 and $row_->tot_plant == 0 and $row_->tot_obstacle == 0 and $row_->tot_today_goal == 0    )) 

<div class="alert alert-danger"><button type="button" class="btn btn-danger btn-circle btn-xl"><span class="notifications__sr">Notifications</span>
<span class="notifications__badge" data-badge>1</span><i class="ri-file-warning-line"></i></button>&nbsp;&nbsp;Data Timesheet Belum Diisi</i></div>


@endif 


@endforeach

<br>






        <div class="col-lg-12">

            <div class="table-responsive rounded mb-3">
                
     <table cellspacing="0" id="gvMain" style="width: 100%; border-collapse: collapse;">
        <tr class="GridViewScrollHeader">
            <td colspan="3" style="background-color: #F4F4F4;">Timesheet</td>
            <td colspan="2" style="background-color: #F4F4F4;">Activity</td>
            <th rowspan="2" scope="col">Obstacle</th>
            <th rowspan="2" scope="col">Today Goal</th>

            <!-- <th rowspan="2" scope="col">SafetyStockLevel</th>
            <th rowspan="2" scope="col">SellStartDate</th>
            <th rowspan="2" scope="col">SellEndDate</th> -->

            <th rowspan="2" scope="col">ModifiedDate</th>
        </tr>
        
        
        <tr class="GridViewScrollHeader">
            <th scope="col">No</th>
            <th scope="col">Tgl</th>
            <th scope="col">Nama Karyawan</th>
            <th scope="col">Past Activity</th>
            <th scope="col">Plant Activity</th>
        </tr>

       
        @foreach ($timesheet as $testing)
        <tr class="GridViewScrollItem">
            <td><div id="tgl_{{ $loop->iteration  }}"></div>{{ $loop->iteration  }}</td>
            <td>{{$testing->tanggal_timesheet}}</td>
            <td>{{$testing->employee->name}}</td>
             <td id="past_{{ $loop->iteration  }}">
            @if(empty($testing->past_activity))
             <button type="button" class="btn btn-danger" onclick="call_modal({{$testing->id}})">
                <i class="ri-chat-delete-fill"></i>
            Belum Diisi
            </button>

            @else
             <button type="button" class="btn btn-success" onclick="call_modal({{$testing->id}})">
                <i class="ri-chat-delete-fill"></i>
            Sudah Diisi
            </button>
            @endif
        </td>
            <td>
                
             @if(empty($testing->plan_activity))
             <button type="button" class="btn btn-danger" onclick="call_modal({{$testing->id}})">
                <i class="ri-chat-delete-fill"></i>
            Belum Diisi
            </button>

            @else
             <button type="button" class="btn btn-success" onclick="call_modal({{$testing->id}})">
                <i class="ri-chat-delete-fill"></i>
            Sudah Diisi
            </button>
            @endif
        </td>
          
            <td>

            @if(empty($testing->obstacle))
             <button type="button" class="btn btn-danger" onclick="call_modal({{$testing->id}})">
                <i class="ri-chat-delete-fill"></i>
            Belum Diisi
            </button>

            @else
             <button type="button" class="btn btn-success" onclick="call_modal({{$testing->id}})">
                <i class="ri-chat-delete-fill"></i>
            Sudah Diisi
            </button>
            @endif
        
        </td>
            <td>
               @if(empty($testing->today_goal))
             <button type="button" class="btn btn-danger" onclick="call_modal({{$testing->id}})">
                <i class="ri-chat-delete-fill"></i>
            Belum Diisi
            </button>

            @else
             <button type="button" class="btn btn-success" onclick="call_modal({{$testing->id}})">
                <i class="ri-chat-delete-fill"></i>
            Sudah Diisi
            </button>
            @endif
        
        </td>
            <td>{{$testing->updated_tanggal}}</td>
        </tr>

         @endforeach
         
         </table>
            </div>
            {{ $timesheet->links() }}
        </div>
    </div>

    <br>



    <!-- Page end  -->
</div>

 @foreach ($timesheet as $testing)
<div id="myModal{{$testing->id}}" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="title">

    Form Isian Timesheet

        </div>
    <br>
    <br>
    <div class="row">
      
    <div class="form-group col-md-6">
         <label for="name"> Past Activity <span class="text-danger">*</span></label>

    <textarea id="past_activity_{{$testing->id}}" type="text" name="company" form="my_form" >{{$testing->past_activity}}</textarea>


        </div>

    <div class="form-group col-md-6">
         <label for="name"> Obstacle <span class="text-danger">*</span></label>

    <textarea id="obstacle_{{$testing->id}}" type="text" name="company" form="my_form"  >{{$testing->obstacle}}</textarea>


        </div>

    <div class="form-group col-md-6">
    <label for="name"> Plan Activity <span class="text-danger">*</span></label>

    <textarea id="plan_activity_{{$testing->id}}" maxlength="21" type="text" name="company" form="my_form"  >{{$testing->plan_activity}}</textarea>


    <br>
    <br>
   <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik Simpan"  onclick="updateTimesheet_activity({{$testing->id}})" style="color:black" >Simpan <i class="ri-save-3-fill"></i>
  </a>


        </div>

         <div class="form-group col-md-6">
         <label for="name"> Today Goal <span class="text-danger">*</span></label>

    <textarea id="today_goal_{{$testing->id}}" type="text" name="company" form="my_form" >{{$testing->today_goal}}</textarea>


        </div>

    </div>
    
  </div>

</div>

@endforeach



@foreach ($timesheet as $testing)
<div id="myReport_Timesheet" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="title">

    Form Isian Timesheet

        </div>
    <br>
    <br>
    <div class="row">
      
    <div class="form-group col-md-6">
         <label for="name"> Past Activity <span class="text-danger">*</span></label>

    <textarea id="past_activity_{{$testing->id}}" type="text" name="company" form="my_form" >{{$testing->past_activity}}</textarea>


        </div>

    <div class="form-group col-md-6">
         <label for="name"> Obstacle <span class="text-danger">*</span></label>

    <textarea id="obstacle_{{$testing->id}}" type="text" name="company" form="my_form"  >{{$testing->obstacle}}</textarea>


        </div>

    <div class="form-group col-md-6">
    <label for="name"> Plan Activity <span class="text-danger">*</span></label>

   
    <textarea id="plan_activity_{{$testing->id}}"  type="text" name="company" form="my_form"  >{{($testing->plan_activity)}}</textarea>


    <br>
    <br>
   <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik Simpan"  onclick="updateTimesheet_activity({{$testing->id}})" style="color:black" >Simpan <i class="ri-save-3-fill"></i>
  </a>


        </div>

         <div class="form-group col-md-6">
         <label for="name"> Today Goal <span class="text-danger">*</span></label>

    <textarea id="today_goal_{{$testing->id}}" type="text" name="company" form="my_form" >{{$testing->today_goal}}</textarea>


        </div>

    </div>
    
  </div>

</div>

@endforeach






 @foreach ($timesheet as $testing)
<div id="myModal_Approval{{$testing->id}}" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="title">

    Tabel List Approval

        </div>
    <br>
    <br>
   <div class="container">
      <div class="tbl_content">
        <h2>Persetujuan Timesheet Onsite JM</h2>
        <table class="tbl">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Karyawan</th>
              <th>Bulan</th>
               <th>Tahun</th>
             
          
              <th>Status</th>
              <th colspan="4" style="align-text:center;">Action</th>
            </tr>
          </thead>
          <tbody>
            
 @foreach ($timesheet_signatures as $signatures)
            <tr>
              <td data-label="User Id">{{ $loop->iteration  }}</td>
              <td data-label="Name">{{$signatures->employee->name}}</td>
            
              
               
                <td >
                <div class="round">

                {{$signatures->bulan}}
               
               </div>
              </td>
               <td >
                <div class="round">

                {{$signatures->tahun}}
               
               </div>
              </td>
              <td data-label="Status">Active</td>

                <td >
                 <div class="round">
                <input type="checkbox"   name="approved_karyawan" id="approval_employee" onclick="Acc_Signature_Employee({{$signatures->id}},this)"  @if($signatures->staff!='0'){{'Checked'}}@else {{''}} @endif  />
                <label for="checkbox" style="font-size:10px;">Employee</label>
               </div>
              </td>
               
                 <td >
                <div class="round">
                <input type="checkbox"  name="approved_leader" id="approval_leader" onclick="Acc_Signature_Leader({{$signatures->id}},this)"   @if($signatures->leader!='0'){{'Checked'}}@else {{''}} @endif  />
                <label for="checkbox" style="font-size:10px;">Leader</label>
               </div>
              </td>
              <td>
                <div class="round">
                <input type="checkbox"   name="approved_spv_onsite" id="approval_spv" onclick="Acc_Signature_SPV_Onsite({{$signatures->id}},this)"  @if($signatures->spv_onsite!='0'){{'Checked'}}@else {{''}} @endif  />
                <label for="checkbox" style="font-size:10px;">SPV Onsite JM</label>
               </div>
              </td>
                 <td>
                <div class="round">
                <input type="checkbox"   name="approved_mnj_onsite" id="approval_mnj" onclick="Acc_Signature_MNJ_Onsite({{$signatures->id}},this)"  @if($signatures->manajer_onsite!='0'){{'Checked'}}@else {{''}} @endif  />
                <label for="checkbox" style="font-size:10px;">Manajer Onsite JM</label>
               </div>
              </td>
            
            </tr>

    @endforeach
           
          
           
          </tbody>
        </table>
      </div>
    </div>
    
  </div>

</div>
        </div>

@endforeach





<script>

    $( document ).ready(function() {

   
   $('.date_from').datetimepicker({ format: 'Y-m-d' });
   
   $('.date_to').datetimepicker({ format: 'Y-m-d' });



 new FroalaEditor('textarea');

  



        });









 function call_modal(id_){
var modal = document.getElementById("myModal"+id_);

var btn = document.getElementById("myBtn"+id_);

var span = document.getElementsByClassName("close")[0];

  modal.style.display = "block";


span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

 }



  function call_signature(id_){
var modal = document.getElementById("myModal_Approval"+id_);

var btn = document.getElementById("myBtn"+id_);

var span = document.getElementsByClassName("close")[0];

  modal.style.display = "block";


span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

 }
 function call_report_timesheet(){

    let tanggal_dari=$('#dateFrom').val();
    let tanggal_ke=$('#dateTo').val();
    let jenispt=$('#jenispt').val();

    

$.ajax({
url: `laporan_timesheet`,
data: {
    "from_date":tanggal_dari,
    "to_date":tanggal_ke,
    'jenis_pt':jenispt,
    "_token":"{{ csrf_token()}}",

},

type: "POST",
xhrFields: {
responseType: 'blob'
},
success:function(response, status, xhr){

    
     console.log("lihat data pdf:",response);


        var filename = "";
        var disposition = xhr.getResponseHeader('Content-Disposition');

        if (disposition) {
            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
            var matches = filenameRegex.exec(disposition);
            if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
        }
        var linkelem = document.createElement('a');
        try {
            var blob = new Blob([response], { type: 'application/octet-stream' });

            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                window.navigator.msSaveBlob(blob, filename);
            } else {
                var URL = window.URL || window.webkitURL;
                var downloadUrl = URL.createObjectURL(blob);

                if (filename) {
                    // use HTML5 a[download] attribute to specify filename
                    var a = document.createElement("a");

                    // safari doesn't support this yet
                    if (typeof a.download === 'undefined') {
                        window.location = downloadUrl;
                    } else {
                        a.href = downloadUrl;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.target = "_blank";
                        a.click();
                    }
                } else {
                    window.location = downloadUrl;
                }
            }

            

        } catch (ex) {
            console.log(ex);
        }

        

        toastr.success('Report Pengajuan Cuti Berhasil Didownload.Terima Kasih');




 }


});


    
 }



    

var span = document.getElementById('time_ID');
var span_ = document.getElementById('Bulan');
var span_th = document.getElementById('Tahun');


    // Scroolto_ID();

    function time() {

    var d = new Date();

    var p = d.getFullYear(),
    q = d.getMonth()+1,
    r = d.getDate(),
    s = d.getHours(),
    t = d.getMinutes(),
    u = d.getSeconds();

    var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
    monthName = months[d.getMonth()];

    var days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"],
        dayName = days[d.getDay()];

    var result = dayName + ", " + r+"/"+monthName+"/"+p+" "+s+":"+t+":"+u;
    
    span.textContent =result;

    span_.textContent =d.getMonth()+1;
    span_th.textContent=d.getFullYear();




  

   
    
  

}



setInterval(time, 1000);


    function laporan_performatesting(){

                $.ajax({
                url: `laporan_performa`,
                data: {
                    "tanggal_Dari": "",
                    "tanggal_Ke":"",
                    "_token":"{{ csrf_token()}}",

                },
                
                type: "POST",
              
                xhrFields: {
            responseType: 'blob'
        },
                success:function(response, status, xhr){


                    console.log("lihat data pdf:",response);

                        var filename = "";
                        var disposition = xhr.getResponseHeader('Content-Disposition');

                        if (disposition) {
                            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                            var matches = filenameRegex.exec(disposition);
                            if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                        }
                        var linkelem = document.createElement('a');
                        try {
                                                var blob = new Blob([response], { type: 'application/octet-stream' });

                            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                                //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                                window.navigator.msSaveBlob(blob, filename);
                            } else {
                                var URL = window.URL || window.webkitURL;
                                var downloadUrl = URL.createObjectURL(blob);

                                if (filename) {
                                    // use HTML5 a[download] attribute to specify filename
                                    var a = document.createElement("a");

                                    // safari doesn't support this yet
                                    if (typeof a.download === 'undefined') {
                                        window.location = downloadUrl;
                                    } else {
                                        a.href = downloadUrl;
                                        a.download = filename;
                                        document.body.appendChild(a);
                                        a.target = "_blank";
                                        a.click();
                                    }
                                } else {
                                    window.location = downloadUrl;
                                }
                            }

                        } catch (ex) {
                            console.log(ex);
                        }

                        toastr.success('Report Berhasil Didownload.Terima Kasih');




}


                });

}



function laporan_zap(){

$.ajax({
url: `laporan_zap`,
data: {
    "tanggal_Dari": "",
    "tanggal_Ke":"",
    "_token":"{{ csrf_token()}}",

},

type: "POST",
xhrFields: {
responseType: 'blob'
},
success:function(response, status, xhr){


    console.log("lihat data pdf:",response);

        var filename = "";
        var disposition = xhr.getResponseHeader('Content-Disposition');

        if (disposition) {
            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
            var matches = filenameRegex.exec(disposition);
            if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
        }
        var linkelem = document.createElement('a');
        try {
                                var blob = new Blob([response], { type: 'application/octet-stream' });

            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                window.navigator.msSaveBlob(blob, filename);
            } else {
                var URL = window.URL || window.webkitURL;
                var downloadUrl = URL.createObjectURL(blob);

                if (filename) {
                    // use HTML5 a[download] attribute to specify filename
                    var a = document.createElement("a");

                    // safari doesn't support this yet
                    if (typeof a.download === 'undefined') {
                        window.location = downloadUrl;
                    } else {
                        a.href = downloadUrl;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.target = "_blank";
                        a.click();
                    }
                } else {
                    window.location = downloadUrl;
                }
            }

        } catch (ex) {
            console.log(ex);
        }

        toastr.success('Report ZAP Berhasil Didownload.Terima Kasih');




}


});

}


//fungsi insert data Cetak_TimeSheet

function updateTimesheet_activity(id_) {


var id_timesheet=id_;
var past_activity=$("#past_activity_"+id_timesheet).val();
var plan_activity=$("#plan_activity_"+id_timesheet).val();
var obstacle=$("#obstacle_"+id_timesheet).val();
var today_goal=$("#today_goal_"+id_timesheet).val();
var employee_id_="{{$kode_karyawan}}";



 console.log(past_activity);


$.ajax({
url: `update_timesheet/update`,
 type: 'POST',
 
data: {
                    "employee_id":employee_id_,
                    "id_timesheet":id_timesheet,
                    "past_activity":past_activity,
                    "plan_activity":plan_activity,
                    "obstacle":obstacle,
                    "today_goal":today_goal,
                    "_token":"{{ csrf_token()}}",

},

success:function(response){

    console.log(response);

    if(response.status==200){

         toastr.success('Perbaruan data timesheet no. '+id_timesheet+' success tersimpan.Terima Kasih');
         location.reload();



    }else{

         toastr.error('Perbaruan data TimeSheet Failed.Terima Kasih');


    }
       
       




}


});




}






function Cetak_TimeSheet(){

//perintahkan ajax ke post ke create auto timesheet

var bln = $("#Bulan");
var thn=$('#Tahun');
var bulan_ = bln.text();
var tahun_=thn.text();




$.ajax({
url: `create_auto_timesheet`,
 type: 'POST',
data: {
    "bulan": bulan_,
    "tahun":tahun_,
   
    "_token":"{{ csrf_token()}}",

},

success:function(response){

      console.log("lihat status:",response.status);

      console.log("lihat read back :",response.read_databack);

       console.log("lihat data waktu:",response.waktu);


   
     if(response.read_databack.length==0){

        
        $.ajax({
        url: `create_auto_timesheet_direct`,
        type: 'POST',
        data: {
            "bulan": bulan_,
            "tahun":tahun_,
        
            "_token":"{{ csrf_token()}}",

        },

        success:function(response){

     

            if(response.status==200){

             toastr.success('Create TimeSheet Success.Terima Kasih');
             location.reload();



            }else{

              toastr.error('Create TimeSheet Failed.Terima Kasih');
             location.reload();




            }

            

        }

        });

      

      }else{

    
        
            toastr.warning('Data Sudah Ada Dalam Database,Tidak Dapat Mencetak Timesheet Rentang 1 Bulan.Terima Kasih');
            console.log("lihat data:",response.read_databack);
            console.log("lihat data waktu:",response.waktu);
            location.reload();



        }

   


       
       




}


});






}






  var gridViewScroll = null;
        window.onload = function () {
            gridViewScroll = new GridViewScroll({
                elementID: "gvMain",
                width: 1350,
                height: 2200,
                freezeColumn: true,
                freezeFooter: true,
                freezeColumnCssClass: "GridViewScrollItemFreeze",
                freezeFooterCssClass: "GridViewScrollFooterFreeze",
                freezeHeaderRowCount: 2,
                freezeColumnCount: 5,
                onscroll: function (scrollTop, scrollLeft) {
                    console.log(scrollTop + " - " + scrollLeft);
                }
            });
            gridViewScroll.enhance();
        }
        function getScrollPosition() {
            var position = gridViewScroll.scrollPosition;
            alert("scrollTop: " + position.scrollTop + ", scrollLeft: " + position.scrollLeft);
        }
        function setScrollPosition() {
            var scrollPosition = { scrollTop: 50, scrollLeft: 50};

            gridViewScroll.scrollPosition = scrollPosition;
        }



        function Acc_Signature_Employee(id_,cb){


            cb.value = cb.checked ? 1 : 0;
            console.log(cb.value);

          var id_timesheet_signature=id_;

          var approval_employee = cb.value;


           console.log("lihat data input signature :",approval_employee);
    
          $.ajax({
          url: `update_timesheet/approval_staff`,
          type: 'POST',
          
          data: {
                              "id_signature_ts":id_timesheet_signature,
                              "employee_sign":approval_employee,
                              "_token":"{{ csrf_token()}}",

          },

          success:function(response){

              console.log("lihat data balik:",response);

              if(response.status==200){

                  toastr.success('Perbaruan data timesheet signature no. '+id_timesheet_signature+' success tersimpan.Terima Kasih');
                  location.reload();



              }else{

                  toastr.error('Perbaruan data Timesheet Signature Failed.Terima Kasih');


              }
                
       




}


});


        }

        function Acc_Signature_Leader(id_,cb){

             cb.value = cb.checked ? 6 : 0;
            console.log(cb.value);

           var id_timesheet_signature=id_;

          var approval_leader= cb.value;

          $.ajax({
          url: `update_timesheet/approval_leader`,
          type: 'POST',
          
          data: {

                              "id_signature_ts":id_timesheet_signature,
                              "employee_sign":approval_leader,
                              "_token":"{{ csrf_token()}}",

          },

          success:function(response){

              console.log(response);

              if(response.status==200){

                  toastr.success('Perbaruan data timesheet signature no. '+id_timesheet_signature+' success tersimpan.Terima Kasih');
                  location.reload();



              }else{

                  toastr.error('Perbaruan data Timesheet Signature Failed.Terima Kasih');


              }
                
       




}


});



        }

        function Acc_Signature_SPV_Onsite(id_,cb){

            cb.value = cb.checked ? 3 : 0;
            console.log(cb.value);

          var id_timesheet_signature=id_;

          var approval_spv_onsite= cb.value;
    
          $.ajax({
          url: `update_timesheet/approval_spv_onsite`,
          type: 'POST',
          
          data: {

                              "id_signature_ts":id_timesheet_signature,
                              "employee_sign":approval_spv_onsite,
                              "_token":"{{ csrf_token()}}",

          },

          success:function(response){

              console.log(response);

              if(response.status==200){

                  toastr.success('Perbaruan data timesheet signature no. '+id_timesheet_signature+' success tersimpan.Terima Kasih');
                  location.reload();



              }else{

                  toastr.error('Perbaruan data Timesheet Signature Failed.Terima Kasih');


              }
                
    

}


});




        }

        function Acc_Signature_MNJ_Onsite(id_,cb){

            cb.value = cb.checked ? 8 : 0;
            console.log(cb.value);

          var id_timesheet_signature=id_;

          var approval_mnj_onsite= cb.value;       
          $.ajax({
          url: `update_timesheet/approval_mnj_onsite`,
          type: 'POST',
          
          data: {

                              "id_signature_ts":id_timesheet_signature,
                              "employee_sign":approval_mnj_onsite,
                              "_token":"{{ csrf_token()}}",

          },

          success:function(response){

              console.log(response);

              if(response.status==200){

                  toastr.success('Perbaruan data timesheet signature no. '+id_timesheet_signature+' success tersimpan.Terima Kasih');
                  location.reload();



              }else{

                  toastr.error('Perbaruan data Timesheet Signature Failed.Terima Kasih');


              }
                
       




}


});




        }


       





</script>

@endsection
