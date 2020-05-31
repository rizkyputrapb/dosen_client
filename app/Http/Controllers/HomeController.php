<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\KontrakModel;
use App\RPSModel;
use App\SAPModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $code = Auth::user()->code;
        $dosen = DB::table('tb_dosen')->where('KODE', $code)->get()->first();
        $position = DB::table('tb_jabatan')
            ->select('*')
            ->join('tb_position', 'tb_position.pos_ID', '=', 'tb_jabatan.pos_ID')
            ->where('dosen_Code', $code)
            ->get();
        $dpa = DB::table('tb_dpa')->where('dosen_Code', $code)->get();
        $research = DB::table('tb_researcher')
            ->select('*')
            ->join('tb_resgroup', 'tb_resgroup.rg_ID', '=', 'tb_researcher.rg_ID')
            ->where('dosen_Code', $code)
            ->get();
        $jadwal = DB::table('tb_jadwalkuliah')
            ->select('*')
            ->join('tb_kurikulum', 'tb_kurikulum.mk_Code', '=', 'tb_jadwalkuliah.mk_Code')
            ->where('dosen_Code', $code)
            ->get();
        return view('home', [
            'dosen' => $dosen,
            'position' => $position,
            'dpa' => $dpa,
            'research' => $research,
            'jadwal' => $jadwal,
        ]);
    }

    public function kontrakkuliah()
    {
        $code = Auth::user()->code;
        $kontrak = DB::table('tb_kontrakkuliah')
            ->select('*')
            ->join('tb_kurikulum', 'tb_kurikulum.mk_Code', '=', 'tb_kontrakkuliah.mk_Code')
            ->join('tb_jadwalkuliah', 'tb_jadwalkuliah.mk_Code', '=', 'tb_kurikulum.mk_Code')
            ->where('updated_by', $code)
            ->where('dosen_Code', $code)
            ->get();
        return view('kontrakkuliah', [
            'kontrak' => $kontrak
        ]);
    }

    public function rpskuliah()
    {
        $code = Auth::user()->code;
        $rps = DB::table('tb_rpsfiles')
            ->select('*')
            ->join('tb_kurikulum', 'tb_kurikulum.mk_Code', '=', 'tb_rpsfiles.mk_Code')
            ->join('tb_jadwalkuliah', 'tb_jadwalkuliah.mk_Code', '=', 'tb_kurikulum.mk_Code')
            ->where('dosen_Code', $code)
            ->get();
        return view('rpskuliah', [
            'rps' => $rps
        ]);
    }

    public function sapkuliah()
    {
        $code = Auth::user()->code;
        $sap = DB::table('tb_sapfiles')
            ->select('*')
            ->join('tb_kurikulum', 'tb_kurikulum.mk_Code', '=', 'tb_sapfiles.mk_Code')
            ->join('tb_jadwalkuliah', 'tb_jadwalkuliah.mk_Code', '=', 'tb_kurikulum.mk_Code')
            ->where('dosen_Code', $code)
            ->get();
        return view('sapkuliah', [
            'sap' => $sap
        ]);
    }

    public function uploadkontrak($KODE)
    {
        $dosen = DB::table('tb_dosen')->where('KODE', $KODE)->get()->first();
        $jadwal = DB::table('tb_jadwalkuliah')
            ->select('*')
            ->join('tb_kurikulum', 'tb_kurikulum.mk_Code', '=', 'tb_jadwalkuliah.mk_Code')
            ->where('dosen_Code', $KODE)
            ->get();
        return view('uploadkontrak', [
            'jadwal' => $jadwal,
            'dosen' => $dosen,
        ]);
    }

    public function uploadrps()
    {
        $KODE = Auth::user()->code;
        $jadwal = DB::table('tb_jadwalkuliah')
            ->select('*')
            ->join('tb_kurikulum', 'tb_kurikulum.mk_Code', '=', 'tb_jadwalkuliah.mk_Code')
            ->where('dosen_Code', $KODE)
            ->get();
        return view('uploadrps', [
            'jadwal' => $jadwal,
        ]);
    }

    public function uploadsap()
    {
        $KODE = Auth::user()->code;
        $jadwal = DB::table('tb_jadwalkuliah')
            ->select('*')
            ->join('tb_kurikulum', 'tb_kurikulum.mk_Code', '=', 'tb_jadwalkuliah.mk_Code')
            ->where('dosen_Code', $KODE)
            ->get();
        return view('uploadsap', [
            'jadwal' => $jadwal,
        ]);
    }

    public function kontrak_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:doc,pdf,docx,zip',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // nama file
        $filename = Auth::user()->code . '_' . $request->mk_Code . '-' . $request->mk_Name . '.'
            . $file->getClientOriginalExtension();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = storage_path('app/public/docs/Kontrak');


        // upload file
        $file->move($tujuan_upload, $filename);

        KontrakModel::create([
            'mk_Code' => $request->mk_Code,
            'file' => $filename,
            'updated_by' => $request->dosen_Code,
        ]);

        return redirect('/home');
    }

    public function rps_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:doc,pdf,docx,zip',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // nama file
        $filename = 'RPS-' .  $request->mk_Code . '-' . $request->mk_Name . '.'
            . $file->getClientOriginalExtension();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = storage_path('app/public/docs/RPS');

        // upload file
        $file->move($tujuan_upload, $filename);

        RPSModel::create([
            'mk_Code' => $request->mk_Code,
            'file' => $filename,
        ]);

        return redirect('/home');
    }

    public function sap_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:doc,pdf,docx,zip',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // nama file
        $filename = 'SAP-' . $request->mk_Code . '-' . $request->mk_Name . '.'
            . $file->getClientOriginalExtension();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = storage_path('app/public/docs/SAP');

        // upload file
        $file->move($tujuan_upload, $filename);

        SAPModel::create([
            'mk_Code' => $request->mk_Code,
            'file' => $filename,
        ]);

        return redirect('/home');
    }

    public function downloadkontrak($file)
    {
        return response()->download(storage_path("app\public\docs\Kontrak\\" . $file));
    }

    public function downloadrps($file)
    {
        return response()->download(storage_path("app\public\docs\RPS\\" . $file));
    }

    public function downloadSAP($file)
    {
        return response()->download(storage_path("app\public\docs\SAP\\" . $file));
    }
}
