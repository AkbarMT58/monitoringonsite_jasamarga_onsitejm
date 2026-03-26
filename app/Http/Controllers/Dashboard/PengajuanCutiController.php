<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Employee;
use App\Models\Cuti;
use App\Models\Order;
use App\Models\Product;
use App\Models\DataSignatures;

use App\Models\List_Absent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class PengajuanCutiController extends Controller
{
  
    public function index()
    {
        $row = (int) request('row', 10);

     

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

          return view('annual_leave.index', ['total_paid' => Order::sum('pay'),
            'total_due' => Order::sum('due'),
            'complete_orders' => Order::where('order_status', 'complete')->get(),
            'products' => Product::orderBy('product_store')->take(5)->get(),
            'new_products' => Product::orderBy('buying_date')->take(2)->get(),
        ]);
    }

  
    public function create_cuti()
    {

          $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('annual_leave.cuti', [
              'cuti_all' => Cuti::sortable()
                ->select('*')
               
                ->orderBy('created_at', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
        ]);
    }

   
       
        
    public function create(){

        $row = (int) request('row', 10);


        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('annual_leave.create', [
            'cuti_all' => Cuti::sortable()
                ->select('*')
               
                ->orderBy('created_at', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
               
        ]);



    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    
        date_default_timezone_set("Asia/Jakarta");
        $waktu = date("d-m-Y-H:i:s");
  

            $cuti = new Cuti();
            $stok_cuti= Employee::selectRaw('annual_leave_total')->where('id',$request->id_karyawan)->get();
           

            if(empty( $stok_cuti)){

                 $stok_cuti_=0;


            }else{

                 $stok_cuti_=$stok_cuti;


            }

           
            $cuti->dateFrom = $request->dateFrom;
            $cuti->dateTo = $request->dateTo;
            $cuti->employee_id = $request->id_karyawan;
            $cuti->jumlah_pengajuan_cuti= $request->jumlah_pengajuan_cuti;
            $cuti->sisa_cuti = ($stok_cuti_[0]['annual_leave_total']- $request->jumlah_pengajuan_cuti);
            $cuti->alasan_cuti= $request->alasan_cuti;
            $cuti->status_cuti = $request->status_cuti;
            $cuti->keterangan =  $request->keterangan;
            $cuti->tanggal_cetak=$waktu;
            
            // $cuti->mengetahui_leader = $request->mengetahui_leader;
            // $cuti->mengetahui_spv_vendor =  $request->mengetahui_spv_vendor;
            // $cuti->mengetahui_spv_onsite =  $request->$mengetahui_spv_onsite;
            // $cuti->mengetahui_manajer_onsite =  $request->$mengetahui_manajer_onsite;
            // $cuti->keterangan =  $request->$reason;


            if($stok_cuti_[0]['annual_leave_total']=='0'){

                
            return response()->json(['data'=>$cuti,'status'=> 400], 400);


            }else{

                   $cuti->save();

            $data_employee_update_cuti=[

                 "id"=>$request->id_karyawan,
                 "annual_leave_total"=>($stok_cuti_[0]['annual_leave_total']- $request->jumlah_pengajuan_cuti),
                 "updated_at"=>$waktu
             ];

           
             Employee::where('id',$request->id_karyawan)->update($data_employee_update_cuti);
 
    
    
            return response()->json(['data'=>$cuti,'status'=> 200], 200);



            }

         
 

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
    public function edit(Int $id)
    {
        return view('annual_leave.edit', [
            'cuti' => Cuti::select('*')->where('id', $id)->get(),
           
        ]);

       

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendence $attendence)
    {
       
    }



    

    public function cuti_update(Request $request){

           //jika cuti terisi

          
           date_default_timezone_set("Asia/Jakarta");
           $waktu = date("d-m-Y-H:i:s");

           $id_cuti=$request->input('id_cuti');

            $stok_cuti= Employee::selectRaw('annual_leave_total')->where('id',$request->id_karyawan)->get();
           

            if(empty( $stok_cuti)){

                 $stok_cuti_=0;


            }else{

                 $stok_cuti_=$stok_cuti;


            }


            $data_cuti=[

            "employee_id" =>$request->id_karyawan,
            "dateFrom"=>$request->dateFrom,
            "dateTo"=>$request->dateTo,
            "jumlah_pengajuan_cuti"=> $request->jumlah_pengajuan_cuti,
            "sisa_cuti" =>  ($stok_cuti_[0]['annual_leave_total']- $request->jumlah_pengajuan_cuti),
            "alasan_cuti" => $request->alasan_cuti,
            "status_cuti" => $request->status_cuti,
            "keterangan" =>  $request->keterangan,
          
            "mengetahui_karyawan" => $request->acc_karyawan,
            "mengetahui_leader" => $request->approved_cuti_spv_kuantum,
            "mengetahui_spv_vendor" =>  $request->approved_cuti_manajer_kuantum,
            "mengetahui_spv_onsite" =>  $request->approved_cuti_spv_jm,
            "mengetahui_manajer_onsite" =>  $request->approved_cuti_mnj_jm,
            "keterangan" =>  $request->keterangan,

            "updated_at"=>$waktu

            ];

           
       

            // dd($data_kehadiran_absen);
            
       
           Cuti::where('id',$id_cuti)->update($data_cuti);

           return response()->json(['data'=>$data_cuti,'status'=> 200], 200);

         

  
    }


    public function destroy(Attendence $attendence)
    {
        //
    }

    
    function hapus_cuti($id){

        $kode_id=$id;

        Cuti::where('id',$kode_id)->delete();

        return Redirect::route('cuti')->with('success', 'Cuti dengan id '.$kode_id.' has been deleted!');

    }

    function cuti_report(Request $request){

        $jenis_pt=$request->kode_pt;

        if($jenis_pt=='1'){

            $nama_pt="JM";


        }else{

              $nama_pt="Kuantum";

        }

        $row = (int) request('row', 10);

        $data_=Cuti::selectRaw("

         pengajuan_cuti_onsite.id,pengajuan_cuti_onsite.employee_id,pengajuan_cuti_onsite.jumlah_pengajuan_cuti,pengajuan_cuti_onsite.sisa_cuti,pengajuan_cuti_onsite.alasan_cuti,pengajuan_cuti_onsite.keterangan,pengajuan_cuti_onsite.dateFrom,pengajuan_cuti_onsite.dateTo,pengajuan_cuti_onsite.mengetahui_karyawan,pengajuan_cuti_onsite.mengetahui_leader,pengajuan_cuti_onsite.mengetahui_spv_vendor,pengajuan_cuti_onsite.mengetahui_spv_onsite,pengajuan_cuti_onsite.mengetahui_manajer_onsite
        ,

        case 
        
        when (pengajuan_cuti_onsite.mengetahui_karyawan='2' and pengajuan_cuti_onsite.employee_id='3' )

        then (select ttd_link from data_signatures  where kategori_jabatan='2' limit 1  )
        
        when (pengajuan_cuti_onsite.mengetahui_karyawan='2' and pengajuan_cuti_onsite.employee_id='3' )

        then (select ttd_link from data_signatures  where kategori_jabatan='2' limit 1  )
        
		when (pengajuan_cuti_onsite.mengetahui_karyawan='1' and pengajuan_cuti_onsite.employee_id='1' )

        then (select ttd_link from data_signatures  where kategori_jabatan='1' limit 1  )

      
        else '0'

   

        end as ttd_karyawan,

        case when pengajuan_cuti_onsite.mengetahui_leader!=''

        then (select ttd_link from data_signatures  where kategori_jabatan=pengajuan_cuti_onsite.mengetahui_leader limit 1  )
        else '0'
        end as ttd_leader,


        case when pengajuan_cuti_onsite.mengetahui_spv_vendor!=''

        then (select ttd_link from data_signatures  where kategori_jabatan=pengajuan_cuti_onsite.mengetahui_spv_vendor limit 1  )
        else '0'
        end as ttd_spv_vendor,

        case when pengajuan_cuti_onsite.mengetahui_spv_onsite!=''

        then (select ttd_link from data_signatures  where kategori_jabatan=pengajuan_cuti_onsite.mengetahui_spv_onsite limit 1  )
        else '0'
        end as ttd_spv_onsite,

        case when pengajuan_cuti_onsite.mengetahui_manajer_onsite!=''

        then (select ttd_link from data_signatures  where kategori_jabatan=pengajuan_cuti_onsite.mengetahui_manajer_onsite limit 1  )
        else '0'
        end as ttd_manajer_onsite
        
                
        ")->orderBy('pengajuan_cuti_onsite.id', 'asc')->where('pengajuan_cuti_onsite.id',$request->id)

      

        ->leftJoin('data_signatures as b','b.employee_id','=','pengajuan_cuti_onsite.employee_id')
        
        ->get();

        $data = [

            'kode_pt_'=>$jenis_pt,
           

        ];


        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }


         if($jenis_pt=='1'){

            $pdf = PDF::loadView('reports.report_pengajuancuti_jm', $data);

        }else{

              $pdf = PDF::loadView('reports.report_pengajuancuti_kuantum', $data);



        }


      

        
        $pdf=  $pdf->set_option('isRemoteEnabled', true);
        $pdf=  $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        // Parameters
        $x          = 300;
        $y          = 800;
        $text       = "{PAGE_NUM} of {PAGE_COUNT}";     
        $font       = $pdf->getFontMetrics()->get_font('Helvetica', 'normal');   
        $size       = 10;    
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;

        $pdf->getCanvas()->page_text(
        $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
        );

       
    
        $pdf = $pdf->download('laporan_cuti_onsite_'.$nama_pt.'.pdf');

       
         return $pdf;

    }


     public function sendEmailPDF($id,$id_cuti,$kode_pt)
    {
        try {
          
         
                $pdf1 = app()->make('dompdf.wrapper');
                // $pdf2 = app()->make('dompdf.wrapper');
                $id=$id;
                $id_cuti=$id_cuti;

               

               
               
              
                    $employeeEmail = Employee::where('id', $id)->get();

                    $jenis_pt=$kode_pt;

                    // if($jenis_pt=='1'){


                    //      $gambar_logo="";
                   


                    // }else{

                    //       $gambar_logo="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";
                   


                    // }

                     $data_=Cuti::selectRaw("

         pengajuan_cuti_onsite.id,pengajuan_cuti_onsite.employee_id,pengajuan_cuti_onsite.jumlah_pengajuan_cuti,pengajuan_cuti_onsite.sisa_cuti,pengajuan_cuti_onsite.alasan_cuti,pengajuan_cuti_onsite.keterangan,pengajuan_cuti_onsite.dateFrom,pengajuan_cuti_onsite.dateTo,pengajuan_cuti_onsite.mengetahui_karyawan,pengajuan_cuti_onsite.mengetahui_leader,pengajuan_cuti_onsite.mengetahui_spv_vendor,pengajuan_cuti_onsite.mengetahui_spv_onsite,pengajuan_cuti_onsite.mengetahui_manajer_onsite
        ,

        case 
        
        when (pengajuan_cuti_onsite.mengetahui_karyawan='2' and pengajuan_cuti_onsite.employee_id='3' )

        then (select ttd_link from data_signatures  where kategori_jabatan='2' limit 1  )
        
        when (pengajuan_cuti_onsite.mengetahui_karyawan='2' and pengajuan_cuti_onsite.employee_id='3' )

        then (select ttd_link from data_signatures  where kategori_jabatan='2' limit 1  )
        
		when (pengajuan_cuti_onsite.mengetahui_karyawan='1' and pengajuan_cuti_onsite.employee_id='1' )

        then (select ttd_link from data_signatures  where kategori_jabatan='1' limit 1  )

      
        else '0'

   

        end as ttd_karyawan,

        case when pengajuan_cuti_onsite.mengetahui_leader!=''

        then (select ttd_link from data_signatures  where kategori_jabatan=pengajuan_cuti_onsite.mengetahui_leader limit 1  )
        else '0'
        end as ttd_leader,


        case when pengajuan_cuti_onsite.mengetahui_spv_vendor!=''

        then (select ttd_link from data_signatures  where kategori_jabatan=pengajuan_cuti_onsite.mengetahui_spv_vendor limit 1  )
        else '0'
        end as ttd_spv_vendor,

        case when pengajuan_cuti_onsite.mengetahui_spv_onsite!=''

        then (select ttd_link from data_signatures  where kategori_jabatan=pengajuan_cuti_onsite.mengetahui_spv_onsite limit 1  )
        else '0'
        end as ttd_spv_onsite,

        case when pengajuan_cuti_onsite.mengetahui_manajer_onsite!=''

        then (select ttd_link from data_signatures  where kategori_jabatan=pengajuan_cuti_onsite.mengetahui_manajer_onsite limit 1  )
        else '0'
        end as ttd_manajer_onsite
        
                
        ")->orderBy('pengajuan_cuti_onsite.id', 'asc')->where('pengajuan_cuti_onsite.id',$id_cuti)

      

        ->leftJoin('data_signatures as b','b.employee_id','=','pengajuan_cuti_onsite.employee_id')
        
        ->get();


                  

                    if ($employeeEmail[0]['email'] != null) {

                        

                        $data = [
                            'id'                  => $id,
                            'email'               => $employeeEmail[0]['email'],
                            'title'               => "Pengajuan Cuti Online Onsite JM - " . $id,
                            'nama_karyawan'       => $employeeEmail[0]['name'],
                            'nik'                 => $employeeEmail[0]['nik'],
                            'data'                => $data_,
                            'kode_pt_'            => $jenis_pt,
                            // 'gambar_logo'         => $gambar_logo,                           
                        ];

                        if($jenis_pt=='1'){

                             $pdf1->loadView('reports.report_pengajuancuti_jm', $data);

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
                             $pdf1->loadView('reports.report_pengajuancuti_kuantum', $data);

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
