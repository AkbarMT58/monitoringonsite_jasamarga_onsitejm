<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Employee;
use App\Models\DataSignatures;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Validator;

class SignaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('signatures.index', [

              'signatures' => DataSignatures::sortable()
                ->select('*')
                ->orderBy('created_at', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_signatures()
    {
       
         return view('signatures.create', [
            'employees' => Employee::all()->sortBy('name'),
        ]);
    }

      public function create()
    {
       
         return view('signatures.create', [
            'employees' => Employee::all()->sortBy('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   
        $rules = [

           
            'employee_id' => 'numeric',
            'kategori_jabatan' => 'numeric',
             'ttd_link' => 'image|file|max:10000'
           
        ];

       
        $validatedData = $request->validate($rules);

         $file_ttd='ttd_link';

       
        if ($request->file($file_ttd)) {

    
                $file_dokumen_=$request->file($file_ttd);
                $fileName_ = md5(rand(0,9999)).'.'.$file_dokumen_->getClientOriginalExtension();
                $path_ = public_path() . '/assets/images/dokumen/signatures/';
                $file_dokumen_->move($path_, $fileName_);

            $validatedData['ttd_link'] = $fileName_;
        }

      

        DataSignatures::insert($validatedData);

       

        return Redirect::route('signatures')->with('success', 'Signatures has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', [
            'employee' => $employee,
        ]);
    }

   
    public function edit($id)
    {
       

          return view('signatures.edit', [
            'employees' => Employee::all()->sortBy('name'),
            'signatures'=> DataSignatures::where('id',$id)->get()
        ]);
    }

   
    public function signatures_update(Request $request, DataSignatures $signs)
    {
         $rules = [

           
            'employee_id' => 'numeric',
            'kategori_jabatan' => 'numeric',
             'ttd_link' => 'image|file|max:10000'
           
        ];

        $validatedData = $request->validate($rules);

       

         $file_ttd='ttd_link';

       
        if ($request->file($file_ttd)) {

    
                $file_dokumen_=$request->file($file_ttd);
                $fileName_ = md5(rand(0,9999)).'.'.$file_dokumen_->getClientOriginalExtension();
                $path_ = public_path() . '/assets/images/dokumen/signatures/';
                $file_dokumen_->move($path_, $fileName_);

            $validatedData['ttd_link'] = $fileName_;
        }

        DataSignatures::where('id', $request->id)->update($validatedData);

       
        return Redirect::route('signatures')->with('success', 'Signatures has been updated!');
    }

  
    public function destroy(Employee $employee)
    {
       
        if($employee->photo){
            Storage::delete('public/employees/' . $employee->photo);
        }

        Employee::destroy($employee->id);

        return Redirect::route('employees.index')->with('success', 'Employee has been deleted!');
    }
}
