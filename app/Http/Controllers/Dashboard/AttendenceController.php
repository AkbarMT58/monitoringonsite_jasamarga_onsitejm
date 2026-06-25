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

        $read_data_attendance=  List_Absent::selectRaw('date as tanggal_aktif')->get();

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('attendence.index', [
            'attendences' => List_Absent::sortable()
                ->select('date')
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
    public function create(Attendence $attendence)
    {
        $data_attendance=[];
        $data_attendance=Attendence::with(['employee'])->where('date', $attendence->date)->get();

        return view('attendence.create', [
            'attendence' =>$data_attendance ,
            'employees' => Employee::whereIn('jabatan',['1','2','3'])->get()->sortBy('name'),
        ]);
    }


     public function simpan_absen(Request $request)
    {

        $rules = [
            'date' => 'required|date_format:Y-m-d|max:10',
        ];

        date_default_timezone_set("Asia/Jakarta");
        $waktu = date("d-m-Y-H:i:s");
  
        $validatedData = $request->validate($rules);
       

            $status = 'status';
            $id_karyawan = 'id_karyawan';
            $jam_masuk='jam_masuk';
            $jam_terlambat='jam_terlambat';
            $reason='reason';
            $filealasan='file_alasan';

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
                $attend->location_office_real = $request->$location_maps;
    
                // $attend->status =  $request->$status;
                // $attend->keterangan =  $request->$reason;
                // $attend->absent=$ijin_status;
                // $attend->file_dokumen=$fileName_;

            
            $cek_absen_exist=Attendence::where('date', $validatedData['date'])->where('employee_id',$request->$id_karyawan)->get();


            if( $cek_absen_exist === [] ){

                  $attend->save();

                 $data_kehadiran=[
            
                            "employee_id"=>$request->$id_karyawan,
                            "date"=> $validatedData['date'],
                            "terlambat"=>$request->$jam_terlambat,
                            "location_office_real"=>$request->location_maps,
                            "status"=>$status,
                            "updated_at"=>$waktu
                        ];
    
               
                Attendence::where('id',$request->$id_karyawan)->update($data_kehadiran);

                

               return response()->json(['data'=>$attend,'status'=> 200], 200);

                

                }
                
           
            $data_kehadiran=[

                "employee_id"=>$request->$id_karyawan,
                "date"=> $validatedData['date'],
                "terlambat"=>$jam_terlambat,
                "location_office_real"=>$request->location_maps,
                "status"=>$status,
                "updated_at"=>$waktu
            ];

           
            Attendence::where('id',$request->$id_karyawan)->update($data_kehadiran);

           //    dd($attend);

            }else{

              $cek_absen_exist=Attendence::where('date', $validatedData['date'])->where('employee_id',$request->$id_karyawan)->get();


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
                $attend->location_office_real = $request->location_maps;
             
        
                // $attend->status =  $request->$status;
                // $attend->keterangan =  $request->$reason;
                // $attend->absent=$ijin_status;
                // $attend->file_dokumen=$fileName_;


              
                // $id_karyawan=$cek_absen_exist[0]['employee_id'];
                // $tanggal_now=$cek_absen_exist[0]['date'];

                if( count($cek_absen_exist) != 0 ){

            
                //  return response()->json(['data'=>'Duplicate','data_duplicate:'=>$cek_absen_exist,'status'=> 200], 200);
                abort(409, 'This resource already exists.');


                 }
                
                if( count($cek_absen_exist) == 0 ){

        
                 $attend->save();

                 $data_kehadiran=[
            
                            "employee_id"=>$request->$id_karyawan,
                            "date"=> $validatedData['date'],
                            "terlambat"=>$request->$jam_terlambat,
                        
                             "location_office_real"=>$request->location_maps,
                            "status"=>$status,
                            "updated_at"=>$waktu
                        ];
    
               
                Attendence::where('id',$request->$id_karyawan)->update($data_kehadiran);

                

               return response()->json(['data'=>$attend,'status'=> 200], 200);

                

               
                }


                

              

            }

            



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

        // dd($request->date);

    
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
            $attend->clock_in = $request->jam_masuk;
            $attend->terlambat = $request->jam_terlambat;
         
    
            $attend->status =  $request->$status;
            $attend->keterangan =  $request->$reason;
            $attend->absent=$ijin_status;
            $attend->file_dokumen=$fileName_;

            $attend->save();

            $data_kehadiran=[

                "employee_id"=>$request->$id_karyawan,
                "date"=> $validatedData['date'],
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

               //  dd($attend);
    
                $attend->save();
    
                $data_kehadiran=[
    
                    "employee_id"=>$request->$id_karyawan,
                    "date"=> $validatedData['date'],
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
            // 'attendences' => Employee::select('employees.id','b.employee_id','b.clock_in','b.clock_out')
            // ->leftJoin('attendences as b','b.employee_id','=','employees.id')
            // // ->whereIn('jabatan',['1','2','3'])->where('date', 'null')->whereOr('date', $attendence->date)->get(),
            //  ->whereIn('jabatan',['1','2','3'])->get(),
            // //  'employees' => Employee::whereIn('jabatan',['1','2','3'])->get()->sortBy('name'),
            // 'date' => $attendence->date
              'attendences' => Attendence::with(['employee'])->where('date', $attendence->date)->get(),
            'date' => $attendence->date
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_alasan_sakit(Request $request, Attendence $attendence)
    {

        $karyawan_id=$request->input('id_karyawan');
        $id_attendance=$request->input('id_att');
        $alasan_absen=$request->input('alasan_absen');
       
        date_default_timezone_set("Asia/Jakarta");
        $waktu = date("d-m-Y-H:i:s");
  
        $data_kehadiran=[
            "keterangan"=>$alasan_absen,
            "updated_at"=>$waktu
        ];

        Attendence::where('id',$id_attendance)->update($data_kehadiran);

        return response()->json(['data'=>$data_kehadiran,'status'=> 200], 200);
        
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
         "waktu_cetak"=>$waktu,
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


    public function sendEmailPDF($id,$id_cuti,$kode_pt)
    {
        try {
          
         
                $pdf1 = app()->make('dompdf.wrapper');
              
                $id=$id;
                $id_cuti=$id_cuti;

                    $employeeEmail = Employee::where('id', $id)->get();

                    $jenis_pt=$kode_pt;

        //              $data=Cuti::selectRaw("

        //  pengajuan_cuti_onsite.id,pengajuan_cuti_onsite.employee_id,pengajuan_cuti_onsite.jumlah_pengajuan_cuti,pengajuan_cuti_onsite.sisa_cuti,pengajuan_cuti_onsite.alasan_cuti,pengajuan_cuti_onsite.keterangan,pengajuan_cuti_onsite.dateFrom,pengajuan_cuti_onsite.dateTo,pengajuan_cuti_onsite.mengetahui_karyawan,pengajuan_cuti_onsite.mengetahui_leader,pengajuan_cuti_onsite.mengetahui_spv_vendor,pengajuan_cuti_onsite.mengetahui_spv_onsite,pengajuan_cuti_onsite.mengetahui_manajer_onsite
        // ,

        // case 
        
        // when (pengajuan_cuti_onsite.mengetahui_karyawan='2' and pengajuan_cuti_onsite.employee_id='3' )

        // then (select ttd_link from data_signatures  where kategori_jabatan='2' limit 1  )
        
        // when (pengajuan_cuti_onsite.mengetahui_karyawan='2' and pengajuan_cuti_onsite.employee_id='3' )

        // then (select ttd_link from data_signatures  where kategori_jabatan='2' limit 1  )
        
		// when (pengajuan_cuti_onsite.mengetahui_karyawan='1' and pengajuan_cuti_onsite.employee_id='1' )

        // then (select ttd_link from data_signatures  where kategori_jabatan='1' limit 1  )

      
        // else '0'

        // end as ttd_karyawan,

        // case when pengajuan_cuti_onsite.mengetahui_leader!=''

        // then (select ttd_link from data_signatures  where kategori_jabatan=pengajuan_cuti_onsite.mengetahui_leader limit 1  )
        // else '0'
        // end as ttd_leader,


        // case when pengajuan_cuti_onsite.mengetahui_spv_vendor!=''

        // then (select ttd_link from data_signatures  where kategori_jabatan=pengajuan_cuti_onsite.mengetahui_spv_vendor limit 1  )
        // else '0'
        // end as ttd_spv_vendor,

        // case when pengajuan_cuti_onsite.mengetahui_spv_onsite!=''

        // then (select ttd_link from data_signatures  where kategori_jabatan=pengajuan_cuti_onsite.mengetahui_spv_onsite limit 1  )
        // else '0'
        // end as ttd_spv_onsite,

        // case when pengajuan_cuti_onsite.mengetahui_manajer_onsite!=''

        // then (select ttd_link from data_signatures  where kategori_jabatan=pengajuan_cuti_onsite.mengetahui_manajer_onsite limit 1  )
        // else '0'
        // end as ttd_manajer_onsite
        
                
        // ")->orderBy('pengajuan_cuti_onsite.id', 'asc')->where('pengajuan_cuti_onsite.id',$id_cuti)

      

        // ->leftJoin('data_signatures as b','b.employee_id','=','pengajuan_cuti_onsite.employee_id')
        
        // ->get();

         if ($employeeEmail[0]['email'] != null) {

                    
                        $data = [
                            'id'                  => $id,
                            'email'               => $employeeEmail[0]['email'],
                            'title'               => "Pengajuan Cuti Online Onsite JM - " . $id,
                            'nama_karyawan'       => $employeeEmail[0]['name'],
                            'nik'                 => $employeeEmail[0]['nik'],
                            'data'                => $data,
                            'kode_pt_'            => $jenis_pt,
                                                    
                        ];

                        if($jenis_pt=='1'){

                             $pdf1->loadView('reports.report_absen_daily_jm', $data);

                              // $pdf2->loadView('admin.pickinglistpdf', $data);

                        // load view for render to pdf
                        Mail::send('bgemail.bodycuti_jm', $data, function ($message) use ($data, $pdf1) {
                            $message->to($data["email"])
                                ->subject($data["title"] . " : " ."Pengajuan Cuti Online Onsite JM - " )
                                ->attachData($pdf1->output(),  "Pengajuan Cuti Online Onsite JM - "  . "_.pdf");
                                // ->attachData($pdf2->output(),  $data["picking_no"] . "_Picking List.pdf");
                        });

                        }


                       else{
                             $pdf1->loadView('reports.report_absen_daily_kuantum', $data);

                              // $pdf2->loadView('admin.pickinglistpdf', $data);

                        // load view for render to pdf
                        Mail::send('bgemail.bodycuti', $data, function ($message) use ($data, $pdf1) {
                            $message->to($data["email"])
                                ->subject($data["title"] . " : " ."Pengajuan Cuti Online Onsite JM - Kuantum " )
                                ->attachData($pdf1->output(),  "Pengajuan Cuti Online Onsite JM - Kuantum "  . "_.pdf");
                                // ->attachData($pdf2->output(),  $data["picking_no"] . "_Picking List.pdf");
                        });


                        }


                        // $pdf2->loadView('admin.pickinglistpdf', $data);

                        // load view for render to pdf
                        // Mail::send('bgemail.bodycuti', $data, function ($message) use ($data, $pdf1) {
                        //     $message->to($data["email"])
                        //         ->subject($data["title"] . " : " ."Pengajuan Cuti Online Onsite JM - " )
                        //         ->attachData($pdf1->output(),  "Pengajuan Cuti Online Onsite JM - "  . "_.pdf");
                        //         // ->attachData($pdf2->output(),  $data["picking_no"] . "_Picking List.pdf");
                        // });
                    }
                

                // dd($commercial);
            
           
              return Redirect::route('create_cuti')->with('success', 'Email Success Sent!.Thank You');


        } catch (\Throwable $th) {
            dd($th);
        }
    }





}
