@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Employee</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                        <!-- begin: Input Image -->
                        <div class="form-group row align-items-center">
                            <div class="col-md-12">
                                <div class="profile-img-edit">
                                    <div class="crm-profile-img-edit">
                                        <img class="crm-profile-pic rounded-circle avatar-100" id="image-preview" src="{{ $employee->photo ? asset('storage/employees/'.$employee->photo) : asset('assets/images/user/1.png') }}" alt="profile-pic">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-4 col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="image" name="photo" accept="image/*" onchange="previewImage();">
                                    <label class="custom-file-label" for="photo">Choose file</label>
                                </div>
                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Image -->
                        <!-- begin: Input Data -->
                        <div class=" row align-items-center">
                            <div class="form-group col-md-12">
                                <label for="name">Employee Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $employee->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Employee Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $employee->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Employee Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}" required>
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                             <div class="form-group col-md-6">
                                <label for="phone">Total Cuti <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('annual_leave_total') is-invalid @enderror" id="annual_leave_total" name="annual_leave_total"  value="{{ old('annual_leave_total', $employee->annual_leave_total) }}" required>
                                @error('annual_leave_total')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="experience">Employee Experience</label>
                                <select class="form-control" name="experience">
                                    <option value="">Select Year..</option>
                                    <option value="1 Year" @if(old('experience', $employee->experience) == '1 Year')selected="selected"@endif>1 Year</option>
                                    <option value="2 Year" @if(old('experience', $employee->experience) == '2 Year')selected="selected"@endif>2 Year</option>
                                    <option value="3 Year" @if(old('experience', $employee->experience) == '3 Year')selected="selected"@endif>3 Year</option>
                                    <option value="4 Year" @if(old('experience', $employee->experience) == '4 Year')selected="selected"@endif>4 Year</option>
                                    <option value="5 Year" @if(old('experience', $employee->experience) == '5 Year')selected="selected"@endif>5 Year</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="salary">Employee Salary <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary" value="{{ old('salary', $employee->salary) }}" required>
                                @error('salary')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="vacation">Employee Vacation</label>
                                <input type="text" class="form-control @error('vacation') is-invalid @enderror" id="vacation" name="vacation" value="{{ old('vacation') }}">
                                @error('vacation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city">Employee City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $employee->city) }}" required>
                                @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="address">Employee Address <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" required>{{ old('address',$employee->address) }}</textarea>
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                              <div class="form-group col-md-12">
                                <label for="address">NIK <span class="text-danger">*</span></label>
                               <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $employee->nik) }}" required>
                                @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="address">Nama Jabatan <span class="text-danger">*</span></label>
                               <select type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan"  required>

                               @if($employee->jabatan =='1')

                                <option value="1">Web Functional Support</option>

                                @elseif($employee->jabatan =='2')

                                <option value="2">Support</option>

                                @elseif($employee->jabatan =='3')

                                <option value="3">Admin Complaint</option>

                                 @elseif($employee->jabatan =='4')

                                <option value="4">Supervisor Onsite Kuantum</option>

                                 @elseif($employee->jabatan =='5')

                                <option value="5">Manajer/Direktur Onsite Kuantum</option>

                                 @elseif($employee->jabatan =='6')

                                <option value="6">Supervisor ITE JM</option>

                                @elseif($employee->jabatan =='7')

                                <option value="7">Manajer/Direktur ITE JM</option>
                              

                                @endif

                                  <option value="1">Web Functional Support</option>
                                  <option value="2">Support</option>
                                  <option value="3">Admin Compliance</option>
                                  <option value="4">Supervisor Onsite Kuantum</option>
                                  <option value="5">Manajer/Direktur Onsite Kuantum</option>

                                  <option value="6">Supervisor ITE JM</option>
                                  <option value="7">Manajer/Direktur ITE JM</option>
                                 


                               </select>
                                @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                            <a class="btn bg-danger" href="{{ route('employees.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>

@include('components.preview-img-form')
@endsection
