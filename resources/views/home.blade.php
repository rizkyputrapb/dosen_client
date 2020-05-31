@extends('layouts.app')

@section('title', 'Home')

@section('username', "{{ Auth::user()->code }}")

@section('content')
<div class="py-5" style="">
    <div class="container">
        <div class="row shadow">
            <div class="col-md-12" style="">
                <h1>{{ $dosen->Nama}} <span class="badge badge-primary text-light">{{ $dosen->KODE }}</span></h1>
                <h4 class="">NIP: {{ $dosen->NIP}}</h4>
                <h4 class="">NIDN: {{ $dosen->NIDN}}</h4>
                <h4 class="">Status: {{ $dosen->Status}}</h4>
                <h4 class="">Matkul: {{ $dosen->Matkul}}</h4>
                <h4 class="">No Telp: {{ $dosen->noTelp}}</h4>
            </div>
            <br>
            <div class="col-md-12">
                <table class="table table-sm table-hover table-striped">
                    <tbody>
                        <thead>
                            <th>Position</th>
                            <th>Year</th>
                            <th>Semester</th>
                        </thead>
                        @if(count($position) > 0)
                        @foreach($position as $pos)
                        <tr>
                            <td>{{ $pos->pos_Name}}</td>
                            <td>{{ $pos->jab_Year}}</td>
                            <td>{{ $pos->jab_Semester}}</td>
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                            <td> <strong>Lecturer</strong> in Information Technology Division </td>
                            <td colspan="2">2019</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row shadow">
            <div class="col-md-12" style="">
                <h2>Research Group</h2>
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th>Research Name</th>
                                <th>Priority</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($research) > 0)
                            @foreach($research as $res)
                            <tr>
                                <th>{{ $res->rg_Field}}</th>
                                <td>{{ $res->rs_Priority}}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="2">No Data Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row shadow">
            <div class="col-md-12" style="">
                <h3>DPA</h3>
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th>Kelas</th>
                                <th>Tahun</th>
                                <th>Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($dpa) > 0)
                            @foreach($dpa as $dpa)
                            <tr>
                                <th>{{ $dpa->cl_ID}}</th>
                                <td>{{ $dpa->dpa_Year}}</td>
                                <td>{{ $dpa->dpa_Semester}}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3">No Data Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row shadow">
            <div class="col-md-12" style="">
                <h3>Jadwal Kuliah</h3>
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th>Kelas</th>
                                <th>Mata Kuliah</th>
                                <th>Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($jadwal) > 0)
                            @foreach($jadwal as $jdw)
                            <tr>
                                <th>{{ $jdw->cl_ID}}</th>
                                <td>{{ $jdw->mk_Name}}</td>
                                <td>{{ $jdw->Jam}}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3">No Data Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <a class="btn btn-secondary" href="uploadkontrak/{{ $dosen->KODE}}" name="KODE" id="KODE">Upload Kontrak</a>
                    <a class="btn btn-secondary" href="uploadsap" name="KODE" id="KODE">Upload SAP</a>
                    <a class="btn btn-secondary" href="uploadrps" name="KODE" id="KODE">Upload RPS</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection