<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Functions\PDF;
use\App\Models\Student;
use\App\Models\Serial;
use App\Models\Charges;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use mPDF;
use Redirect;
use Illuminate\Support\Facades\DB;


class ViewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      Cas::getCurrentUser();
      $user = session('cas_user');
      $std = student::where('studentNo','=',$user)->first();
      $charge=charges::where('students_studentNo','=',$user)->first();
      $serial = Serial::where('students_studentNo','=',$user)->first();
      if($charge->total==0)
          $html = PDF::make($std, $serial);
      else
          $html = PDF::create($std,$charge, $serial);
      $mpdf=new mpdf();
      $mpdf->WriteHTML($html);
      $mpdf->Output();
    }
    public function studentPdf(Request $request)
    {
      $post = $request->all();
      $user = $post['student'];
      $std = student::where('studentNo','=',$user)->first();
      $charge=charges::where('students_studentNo','=',$user)->first();
      $serial = Serial::where('students_studentNo','=',$user)->first();
      if($charge->total==0)
          $html = PDF::make($std, $serial);
      else
          $html = PDF::create($std,$charge, $serial);
      $mpdf=new mpdf();
      $mpdf->WriteHTML($html);
      $mpdf->Output();
    }

}
