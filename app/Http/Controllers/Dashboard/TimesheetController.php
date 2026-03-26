<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Timesheet;
use App\Models\TimeSheet_Signatures;
use App\Models\TotalTimesheet;
use App\Models\ReportTimeSheet;
use App\Models\Employee;
use App\Models\PerformaAksesLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use Auth;

class TimesheetController extends Controller
{
    public function index(){

        return view('timesheet_work.index', ['total_paid' => Order::sum('pay'),
            'total_due' => Order::sum('due'),
            'complete_orders' => Order::where('order_status', 'complete')->get(),
            'products' => Product::orderBy('product_store')->take(5)->get(),
            'new_products' => Product::orderBy('buying_date')->take(2)->get(),
        ]);
    }

    public function create()
    {
       

     
        $kode_karyawan=auth()->user()->employee_id ;

        date_default_timezone_set("Asia/Jakarta");
            
        $waktu_= date("d-m-Y");

        $data_users=User::filter(request(['search']))->where('employee_id',$kode_karyawan)->get();
          $row = (int) request('row', 31);

           $timesheet_back=[
                
                Timesheet::where('tanggal_timesheet',$waktu_)
                ->selectRaw('MONTH(DATE_FORMAT(STR_TO_DATE(created_at, "%d-%m-%Y"), "%Y-%m-%d")) as BULAN')
                ->limit('1')
                ->get(),
                'tgl_now'=>$waktu_,
                'timesheet_signatures'=>TimeSheet_Signatures::all()
            
            ];

          

        foreach($data_users as $item){

        foreach ($item->roles as $role){
        
            $role_name=$role->name;

            if( $role_name=="SuperAdmin"){


            if ($row < 1 || $row > 100) {
                abort(400, 'The per-page parameter must be an integer between 1 and 100.');
            }

            return view('timesheet_work.timesheet', [

                'timesheet' => Timesheet::sortable()
                ->select('*')
                ->orderBy('created_at', 'asc')
                ->paginate($row)
                ->appends(request()->query()),


                'check_datatimesheet'=>TotalTimesheet::where('employee_id',$kode_karyawan)->get()
    
                ,

                'timesheet_back' =>  $timesheet_back,
                'timesheet_signatures'=>TimeSheet_Signatures::all()
        ]);

    
        }else{

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

     
       

                  
        return view('timesheet_work.timesheet', [
            'timesheet' => Timesheet::select('*')
                ->where('employee_id',$kode_karyawan)
                ->orderBy('created_at', 'asc')
                ->paginate($row)
                ->appends(request()->query()),

                'check_datatimesheet'=>Timesheet::selectRaw("case when past_activity!='' then count(past_activity) else '0' end as count_past_activity ,
                case when plan_activity!='' then count(plan_activity) else '0' end as count_plant_activity,
                case when obstacle !='' then count(obstacle) else '0' end as count_obstacle,
                case when today_goal !='' then count(today_goal) else '0' end as today_goal")
                ->groupBy('past_activity','plan_activity','obstacle','today_goal')
                ->limit("1")
                ->get(),

                'timesheet_back' => Timesheet::where('tanggal_timesheet',$waktu_)
                ->selectRaw('MONTH(DATE_FORMAT(STR_TO_DATE(created_at, "%d-%m-%Y"), "%Y-%m-%d")) as BULAN')
                ->groupBy('created_at')
                ->get(),
                'tgl_now'=>$waktu_,
                'timesheet_signatures'=>TimeSheet_Signatures::all()
               
        ]);



        }



    

               
       
            
       }


        }



    }

    public function edit(Int $id)
    {
    
        $timesheet = Timesheet::select('*')->where('id',$id)->get();

        return view('timesheet.edit', [
            'timesheet' => $timesheet,
        ]);

      
    }

    public function create_timesheet(){

        $row = (int) request('row', 10);


        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('timesheet_work.create', [
            'timesheet' => Timesheet::sortable()
                ->select('*')
               
                ->orderBy('created_at', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
               
        ]);



    }



    function timesheet_simpan(Request $request){

          
            try{
                

            date_default_timezone_set("Asia/Jakarta");
            $waktu = date("d-m-Y-H:i:s");
            $waktu_= date("d-m-Y");
            $bulan_=$request->bulan;

           

            $kode_karyawan=auth()->user()->employee_id ;

            $tahun_=$request->tahun;

            $read_data_back=Timesheet::where('tanggal_timesheet',$waktu_)
                ->where('employee_id',$kode_karyawan)
                ->selectRaw('*')
                ->get();
               
           


               $i=0;

               while($i < 31){

                 if( strlen($bulan_) > 1){

                $bulan_digit=$bulan_;

              

                }

              
                else{

                $bulan_digit='0'.$bulan_;

               


                }

             
                    $set_tgl=($i+1).'-'.$bulan_digit.'-'.$tahun_;


                 $timesheet=[

                    "employee_id"=>$kode_karyawan,
                    "past_activity"=>'',
                    "plan_activity"=>'',
                    "obstacle"=>'',
                    "today_goal"=>'',
                    "from_date"=>'',
                    "to_date"=>'',
                    "tanggal_cetak"=>$waktu,
                    "created_at"=>$waktu_,
                    "updated_tanggal"=>$waktu,
                    "tanggal_timesheet"=>$set_tgl,      
                ];


                //fungsi read back data

                if($read_data_back!=''){

                   return response()->json(['data'=>$timesheet,'read_databack'=>$read_data_back,"waktu"=>$waktu_,'status'=> 200], 200);

                }
                
              
            
                   $i++;


              
                   
              

                }



        }catch(\Exception $e){
           
            return Redirect::route('timesheet')->with('error', 'Timesheet Created failed to save!');
           
        }


  

            

    }


    function timesheet_report(Request $request){

        $tanggal_dari="date("."'".$request->from_date."'".")";
        $tanggal_ke="date("."'".$request->to_date."'".")";
       
        $jenis_pt=$request->jenis_pt;
        $kode_karyawan=auth()->user()->employee_id ;

        if($jenis_pt=='1'){

            $nama_pt="JM";


        }
        
        
        if($jenis_pt=='2'){


            $nama_pt="Kuantum";

        }

        $row = (int) request('row', 10);

        $data_=Timesheet::selectRaw(" id,employee_id,tanggal_timesheet,plan_activity as description")
        ->whereRaw("STR_TO_DATE(tanggal_timesheet, '%d-%m-%Y') >=  ".$tanggal_dari." and "."STR_TO_DATE(tanggal_timesheet, '%d-%m-%Y') <= ".$tanggal_ke)
    
       
        ->get();

     
        $data_signature=ReportTimeSheet::where('employee_id',$kode_karyawan)->get();
                        
    
        $data_employee=Employee::selectRaw('*')
        ->where('id',$kode_karyawan)
        ->get();

        $data = [

            'data'  =>$data_, 
            'kode_pt_'=>$jenis_pt,
            'tanggal_dari'=> $request->from_date,
            'tanggal_ke'=> $request->to_date,
            'data_employee'=>$data_employee,
            'data_signatures'=>$data_signature

        ];


        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }


         if($jenis_pt=='1'){
            

            $pdf = PDF::loadView('reports.report_timesheet_jm', $data);

            
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

       
    
        $pdf = $pdf->download('laporan_timesheet_'. $tanggal_dari.'-'. $tanggal_ke.'-'.$nama_pt.'.pdf');

         return $pdf;


        
            
        }
        
       if($jenis_pt=='2'){

            $pdf = PDF::loadView('reports.report_timesheet_kuantum', $data);

            
        $pdf=  $pdf->set_option('isRemoteEnabled', true);
        $pdf=  $pdf->setPaper('A4', 'landscape');
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

       
    
        $pdf = $pdf->download('laporan_timesheet_'. $tanggal_dari.'-'. $tanggal_ke.'-'.$nama_pt.'.pdf');

         return $pdf;


    
        }

        // dd($data);


        

        


      

        
    }




    function timesheet_simpan_direct(Request $request){

        
            try{

            date_default_timezone_set("Asia/Jakarta");
            $waktu = date("d-m-Y-H:i:s");
            $waktu_= date("d-m-Y");
            $bulan_sign= date("m");
            $tahun_sign= date("Y");
            $bulan_=$request->bulan;
            $kode_karyawan=auth()->user()->employee_id ;
            $tahun_=$request->tahun;

            $read_data_signatures= TimeSheet_Signatures::where('employee_id',$kode_karyawan)->where('bulan',$bulan_sign)->where('tahun',$tahun_sign)->get();


                    //insert timesheet signatures

                
               $total_day=31;

          
               $i=0;

               while($i < 31){

                $tgl_i=$i;

              

                 if( strlen($bulan_) > 1){
                $bulan_digit=$bulan_;
               
                }
                
                else{

                $bulan_digit='0'.$bulan_;
              

                }

                if(strlen($tgl_i)>1){

                   $tgl_="";


                }

                else if($tgl_i=='9'){

                   $tgl_="";


                }
                
                
                else{

                     $tgl_="0";


                }


                // if(strlen($tgl_i)< 2 ){

                //      $tgl_="0";



                // }
                
               
                 $set_tgl=$tgl_.($i+1).'-'.$bulan_digit.'-'.$tahun_;

                 


                 $timesheet=[
                    "employee_id"=>$kode_karyawan,
                    "past_activity"=>'',
                    "plan_activity"=>'',
                    "obstacle"=>'',
                    "today_goal"=>'',
                    "from_date"=>'',
                    "to_date"=>'',
                    "tanggal_cetak"=>$waktu,
                    "created_at"=>$waktu_,
                    "updated_tanggal"=>$waktu,
                    "tanggal_timesheet"=>$set_tgl,      
                ];


                //fungsi read back data

                 Timesheet::insert($timesheet);

          
                   $i++;


              
                   
              

                }


                    $timesheet_signatures=[
                        "employee_id"=>$kode_karyawan,
                        "bulan"=>$bulan_sign,
                        "tahun"=>$tahun_sign,
                        "staff"=>0,
                        "leader"=>0,
                        "spv_onsite"=>0,
                        "created_at"=>$waktu,
                        "updated_at"=>$waktu
                      
                    ];

                    if(empty($read_data_signatures)){

                           return response()->json(['data'=>$timesheet,'data_sign'=> $timesheet_signatures,'status'=> 200], 200);


                    }else{

                        TimeSheet_Signatures::insert($timesheet_signatures);

                    }

                   

                


                return response()->json(['data'=>$timesheet,'data_sign'=> $timesheet_signatures,'status'=> 200], 200);


                   



        }catch(\Exception $e){
           
            return Redirect::route('timesheet')->with('error', 'Timesheet Created failed to save!');
           
        }



    }


    

    function timesheet_update(Request $request){

          date_default_timezone_set("Asia/Jakarta");
          $waktu = date("d-m-Y-H:i:s");


        try{

            $idtimesheet=$request->id_timesheet;

            $timesheet=[

                    
                    "past_activity"=>$request->past_activity,
                    "plan_activity"=>$request->plan_activity,
                    "obstacle"=>$request->obstacle,
                    "today_goal"=>$request->today_goal,
                    "updated_tanggal"=>$waktu
                  
       
                ];


               Timesheet::where('id', $idtimesheet)->update($timesheet);

          return response()->json(['data'=>$timesheet,'status'=> 200], 200);


    }catch(\Exception $e){
       
        return Redirect::route('timesheet')->with('error', 'Timesheet failed to update!');
       
    }






    }


    function zap_report(Request $request){

        $row = (int) request('row', 10);

        $data_=Zap::sortable()->select('*')->orderBy('id', 'asc')->get();

        $data = [

            'data'  =>$data_,
           

        ];


        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }



        $pdf = PDF::loadView('reports.report_zap', $data);
        $pdf=  $pdf->set_option('isRemoteEnabled', true);
        $pdf=  $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        // Parameters
        $x          = 400;
        $y          = 550;
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

       
    
        $pdf = $pdf->download('laporan_zap.pdf');

       

    
        


         return $pdf;

    }


    function hapus_removezap($id){

        $kode_id=$id;

        Zap::where('id',$kode_id)->delete();

        return Redirect::route('zap_index')->with('success', 'ZAP with id '.$kode_id.' has been deleted!');

    }

    function Approval_Employee(Request $request){

          date_default_timezone_set("Asia/Jakarta");
          $waktu = date("d-m-Y-H:i:s");


          try{

            $idtimesheet=$request->id_signature_ts;

            $timesheet=[

                    
                    "staff"=>$request->employee_sign,
                 
                    "updated_at"=>$waktu
                  
       
                ];


               TimeSheet_Signatures::where('id', $idtimesheet)->update($timesheet);

          return response()->json(['data'=>$timesheet,'status'=> 200], 200);


    }catch(\Exception $e){
       
        return Redirect::route('timesheet')->with('error', 'Approval signature staff failed to update!');
       
    }





    }

    function Approval_Leader(Request $request){

          date_default_timezone_set("Asia/Jakarta");
          $waktu = date("d-m-Y-H:i:s");


          try{

            $idtimesheet=$request->id_signature_ts;

            $timesheet=[

                    
                    "leader"=>$request->employee_sign,
                 
                    "updated_at"=>$waktu
                  
       
                ];


               TimeSheet_Signatures::where('id', $idtimesheet)->update($timesheet);

          return response()->json(['data'=>$timesheet,'status'=> 200], 200);


    }catch(\Exception $e){
       
        return Redirect::route('timesheet')->with('error', 'Approval signature leader failed to update!');
       
    }



    }


    function Approval_SPV_Onsite(Request $request){

          date_default_timezone_set("Asia/Jakarta");
          $waktu = date("d-m-Y-H:i:s");


          try{

            $idtimesheet=$request->id_signature_ts;

            $timesheet=[

                    
                    "spv_onsite"=>$request->employee_sign,
                 
                    "updated_at"=>$waktu
                  
       
                ];


               TimeSheet_Signatures::where('id', $idtimesheet)->update($timesheet);

          return response()->json(['data'=>$timesheet,'status'=> 200], 200);


    }catch(\Exception $e){
       
        return Redirect::route('timesheet')->with('error', 'Approval signature spv onsite failed to update!');
       
    }



    }


    
    function Approval_MNJ_Onsite(Request $request){

          date_default_timezone_set("Asia/Jakarta");
          $waktu = date("d-m-Y-H:i:s");


          try{

            $idtimesheet=$request->id_signature_ts;

            $timesheet=[

                    
                    "manajer_onsite"=>$request->employee_sign,
                 
                    "updated_at"=>$waktu
                  
       
                ];


               TimeSheet_Signatures::where('id', $idtimesheet)->update($timesheet);

          return response()->json(['data'=>$timesheet,'status'=> 200], 200);


    }catch(\Exception $e){
       
        return Redirect::route('timesheet')->with('error', 'Approval signature spv onsite failed to update!');
       
    }



    }





}
