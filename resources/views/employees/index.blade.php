@extends('dashboard.body.main')

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
                    <h4 class="mb-3">Employee List</h4>
                    <p class="mb-0">Dasbor karyawan memudahkan Anda mengumpulkan dan memvisualisasikan data karyawan untuk mengoptimalkan
                    <br>
                    pengalaman karyawan, sehingga memastikan retensi karyawan. </p>
                </div>
                <div>
                <a href="{{ route('employees.create') }}" class="btn btn-primary add-list"><i class="fa-solid fa-plus mr-3"></i>Add Employee</a>
                <a href="{{ route('employees.index') }}" class="btn btn-danger add-list"><i class="fa-solid fa-trash mr-3"></i>Clear Search</a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <form action="{{ route('employees.index') }}" method="get">
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

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="search">Search:</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control" name="search" placeholder="Search employee" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-magnifying-glass font-size-20"></i></button>
                                </div>
                            </div>
                            {{-- <input id="search" type="text" class="form-control" name="search" placeholder="Search employee"> --}}
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Photo</th>
                            <th>@sortablelink('name')</th>
                            <th>@sortablelink('email')</th>
                            <th>@sortablelink('phone')</th>
                            <th>@sortablelink('salary')</th>
                            <th>@sortablelink('city')</th>
                            <th>@sortablelink('late absen')</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @forelse ($employees as $employee)

                        
                      <div hidden> {{ $key = $loop->iteration  }} </div>

                        <tr>
                            <td>{{ (($employees->currentPage() * 10) - 10) + $loop->iteration  }}</td>
                            <td>
                                <img class="avatar-60 rounded" src="{{ $employee->photo ? asset('assets/images/employees/'.$employee->photo) : asset('assets/images/user/1.png') }}">
                            </td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>${{ $employee->salary }}</td>
                            <td>{{ $employee->city }}</td>
                            <td>
                                <div class="round">
                                        <input type="checkbox"  id="myBtn_acc_absent{{$key}}" name="approved_late_absen"  @if($employee->acc_lead == 1){{'Checked'}}@else {{''}} @endif  />
                                        <input type="text" id="id_emp{{$employee->id}}" value="{{$employee->id}}" hidden/>
                                        <label for="checkbox"></label>
                                    </div></td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                        href="{{ route('employees.show', $employee->id) }}"><i class="ri-eye-line mr-0"></i>
                                    </a>
                                    <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                        href="{{ route('employees.edit', $employee->id) }}""><i class="ri-pencil-line mr-0"></i>
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="margin-bottom: 5px">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge bg-warning mr-2 border-none" onclick="return confirm('Are you sure you want to delete this record?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="ri-delete-bin-line mr-0"></i></button>
                                    </form>
                                </div>
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
            {{ $employees->links() }}
        </div>
    </div>
    <!-- Page end  -->
</div>

<script>

const tot_employ='{{count($employees)}}';

console.log("lihat data all:",tot_employ);


for(var i=1; i <= tot_employ; i++){


let isClicked = false;

const btn = document.getElementById("myBtn_acc_absent"+i);
//var url_current=document.URL;

let id_=document.getElementById("id_emp"+i).value; 

btn.onclick = function() {
   isClicked = !isClicked; // Toggle the true/false 

console.log("lihat id no:",id_);
  
   if (isClicked) {

     btn.style.backgroundColor = "blue";
     btn.value='0';

     let input_acc_absen={
        "acc_absen":'1',
        "_token":"{{ csrf_token()}}",
     };
   

    //ubah data acc lead ke 1
    $.ajax({
                    url: `/employees/`+ id_ +'/'+ 'update_late_absen',
                    type: 'POST',
                    data:input_acc_absen,
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                 
                
    success: function(response){
                if(response.status=='200'){

                    toastr.success('Data permintaan pengajuan atau absen terlambat sukses tersimpan!.Terima Kasih',{ fadeAway: 3000 });

                   //location.href="/employees";

                }

                

    }

    });




   } 
  
   else{

    // let id_=document.getElementById("id_emp"+i).value; 

   

    let input_acc_absen={
        "acc_absen":'0',
         "_token":"{{ csrf_token()}}",
      };

    //var url_current=document.URL;

      
    // var tgl_id = url_current.split('/')[5];

    // var tgl_now=tgl_id ;

     btn.style.backgroundColor = "";
     btn.value='1';
     
    //ubah data acc lead ke 1
    
    $.ajax({
                    url: `/employees/` + id_ +'/'+ 'update_late_absen',

                    type: 'POST',
                    data:input_acc_absen,
                     headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                   

  

    success: function(response){
                if(response.status=='200'){

                 
                    toastr.success('Data permintaan pengajuan atau absen terlambat sukses tersimpan!.Terima Kasih',{ fadeAway: 3000 });

                   // location.href="/employees";

                }
         

    }

    });

  }

};





}

// function update_acc_terlambat() {
//   alert("Hello! You clicked the button.");
// }


</script>

@endsection
