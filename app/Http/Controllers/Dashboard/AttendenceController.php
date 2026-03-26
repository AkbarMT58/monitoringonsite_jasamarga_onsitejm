<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Employee;
use App\Models\Attendence;
use App\Models\List_Absent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        $read_data_attendance=  List_Absent::selectRaw('date as tanggal_aktif,waktu_cetak')->get();

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('attendence.index', [
            'attendences' => List_Absent::sortable()
                ->select('date','waktu_cetak')
                // ->groupBy('date')
               
                ->orderBy('date', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
                'readdata_attendance'=>$read_data_attendance
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attendence.create', [
            'employees' => Employee::whereIn('jabatan',['1','2','3'])->get()->sortBy('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $countEmployee = count($request->employee_id);

        $rules = [
            'date' => 'required|date_format:Y-m-d|max:10',
        ];

        date_default_timezone_set("Asia/Jakarta");
        $waktu = date("d-m-Y-H:i:s");
  

        $validatedData = $request->validate($rules);
       

        Attendence::where('date', $validatedData['date'])->delete();

    
        for ($i=1; $i <= $countEmployee; $i++) {

    
            $status = 'status'.$i;
            $id_karyawan = 'id_karyawan'.$i;
            $jam_masuk='jam_masuk'.$i;
            $jam_terlambat='jam_terlambat'.$i;
            $reason='reason'.$i;
            $filealasan='file_alasan'.$i;

            if($request->file($filealasan)){

                $file_dokumen_=$request->file($filealasan);
                $fileName_ = md5(rand(0,9999)).'.'.$file_dokumen_->getClientOriginalExtension();
                $path_ = public_path() . '/assets/images/dokumen/attendance/ijin';
                $file_dokumen_->move($path_, $fileName_);
               

              if($request->$reason){

                $ijin_status="1";

              }else{

                $ijin_status="";


              }

           
            $attend = new Attendence();

            $attend->date = $validatedData['date'];
            $attend->employee_id = $request->$id_karyawan;
            $attend->clock_in = $request->$jam_masuk;
            $attend->terlambat = $request->$jam_terlambat;
         
    
            $attend->status =  $request->$status;
            $attend->keterangan =  $request->$reason;
            $attend->absent=$ijin_status;
            $attend->file_dokumen=$fileName_;

            $attend->save();

            $data_kehadiran=[

                "employee_id"=>$request->$id_karyawan,
                "terlambat"=>$jam_terlambat,
                // 'keterangan'=>$reason,
                "status"=>$status,
                "updated_at"=>$waktu
            ];

           
            Attendence::where('id',$request->$id_karyawan)->update($data_kehadiran);

           //    dd($attend);

            }else{

                $fileName_ ='';

                if($request->$reason){

                    $ijin_status="1";
    
                  }else{
    
                    $ijin_status="";
    
    
                  }

                $attend = new Attendence();

                $attend->date = $validatedData['date'];
                $attend->employee_id = $request->$id_karyawan;
                $attend->clock_in = $request->$jam_masuk;
                $attend->terlambat = $request->$jam_terlambat;
             
        
                $attend->status =  $request->$status;
                $attend->keterangan =  $request->$reason;
                $attend->absent=$ijin_status;
                $attend->file_dokumen=$fileName_;
    
                $attend->save();
    
                $data_kehadiran=[
    
                    "employee_id"=>$request->$id_karyawan,
                    "terlambat"=>$jam_terlambat,
                    // 'keterangan'=>$reason,
                    "status"=>$status,
                    "updated_at"=>$waktu
                ];
    
               
                Attendence::where('id',$request->$id_karyawan)->update($data_kehadiran);
    



            }
    
        }


       

       return Redirect::route('attendence.index')->with('success', 'Attendence has been Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendence $attendence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendence $attendence)
    {
        return view('attendence.edit', [
            'attendences' => Attendence::with(['employee'])->where('date', $attendence->date)->get(),
            'date' => $attendence->date
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendence $attendence)
    {
        //
    }



    
    public function update_attendance_masuk(Request $request)
    {

        $karyawan_id=$request->input('id_karyawan');
        $jam_masuk=$request->input('jam_masuk');
        $jam_terlambat=$request->input('jamterlambat');
        $id_attendance=$request->input('id_att');
        $status=$request->input('status');
        $alasan_absen=$request->input('alasan_absen');
        $dokumen_file=$request->input('dokumen_file');

        date_default_timezone_set("Asia/Jakarta");
        $waktu = date("d-m-Y-H:i:s");
  
        

        $data_kehadiran=[

            "employee_id"=> $karyawan_id,
            "clock_in"=>$jam_masuk,
            "status"=>$status,
            "updated_at"=>$waktu
        ];

        Attendence::where('id',$id_attendance)->update($data_kehadiran);


        $data_kehadiran_=[

          
            "terlambat"=>$jam_terlambat,
          
            "status"=>$status,
            "updated_at"=>$waktu
        ];
        

       
        Attendence::where('id',$id_attendance)->update($data_kehadiran_);


    

        return response()->json(['data'=>$data_kehadiran,'status'=> 200], 200);

    }


    public function update_absent(Request $request){

           //jika absen terisi

          
           date_default_timezone_set("Asia/Jakarta");
           $waktu = date("d-m-Y-H:i:s");

           $id_attendance=$request->input('id_att');

            $data_kehadiran_absen=[
    

            "absent"=>"1",
            "keterangan"=>$request->input('reason'),
            "file_dokumen"=>$request->input('file_alasan'),
            "updated_at"=>$waktu
            ];

            if($request->file('file_alasan')){
      
            
                $file_dokumen=$request->file('file_alasan');
              
                $fileName = md5(rand(0,9999)).'.'.$file_dokumen->getClientOriginalExtension();
                 $path = public_path() . '/assets/images/dokumen/attendance';
                 $file_dokumen->move($path, $fileName);
                $data_kehadiran_absen['file_dokumen']  = $fileName;
               
             

                
              }
              
            //   else{

            //     $data_kehadiran_absen['file_dokumen'] = $request->buktipelaporan_old;

            
            //   }

            // dd($data_kehadiran_absen);
            
       
           Attendence::where('id',$id_attendance)->update($data_kehadiran_absen);

           return response()->json(['data'=>$data_kehadiran_absen,'status'=> 200], 200);

  
    }


    public function create_absent(Request $request){

        //jika absen terisi

        date_default_timezone_set("Asia/Jakarta");
        $waktu = date("d-m-Y-H:i:s");

      
      

         $data_kehadiran_absen=[
         "absent"=>"1",
         "date"=>$request->input('date_event'),
         "employee_id"=>$request->input('id_karyawan'),
         "keterangan"=>$request->input('reason'),
         "status"=>"Ijin",
         "file_dokumen"=>$request->input('file_alasan'),
         "created_at"=>$waktu
         ];

         if($request->file('file_alasan')){
   
         
             $file_dokumen=$request->file('file_alasan');
           
             $fileName = md5(rand(0,9999)).'.'.$file_dokumen->getClientOriginalExtension();
              $path = public_path() . '/assets/images/dokumen/attendance';
              $file_dokumen->move($path, $fileName);
             $data_kehadiran_absen['file_dokumen']  = $fileName;
            
          

             
           }
           
      
        Attendence::insert($data_kehadiran_absen);

        return response()->json(['data'=>$data_kehadiran_absen,'status'=> 200], 200);

 




       
       


 }


    public function update_attendance(Request $request)
    {

        $karyawan_id=$request->input('id_karyawan');
        $jam_keluar=$request->input('jam_keluar');
        $id_attendance=$request->input('id_att');
        $status=$request->input('status');

        date_default_timezone_set("Asia/Jakarta");
        $waktu = date("d-m-Y-H:i:s");
  
        

        $data_kehadiran=[

            "employee_id"=> $karyawan_id,
            "clock_out"=>$jam_keluar,
            "status"=>$status,
            "updated_at"=>$waktu
        ];

        Attendence::where('id',$id_attendance)->update($data_kehadiran);

        return response()->json(['data'=>$data_kehadiran,'status'=> 200], 200);

    }

    
    public function update_keterlambatan(Request $request)
    {

        $karyawan_id=$request->input('id_karyawan');
        $jam_terlambat=$request->input('terlambat');
        $id_attendance=$request->input('id_att');
        $status=$request->input('status');

        date_default_timezone_set("Asia/Jakarta");
        $waktu = date("d-m-Y-H:i:s");
  
        
        $data_kehadiran=[

            "employee_id"=> $karyawan_id,
            "terlambat"=>$jam_terlambat,
            "status"=>$status,
            "updated_at"=>$waktu
        ];

        Attendence::where('id',$id_attendance)->update($data_kehadiran);

        return response()->json(['data'=>$data_kehadiran,'status'=> 200], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendence $attendence)
    {
        //
    }
}
