@extends('layouts.app')

@section('title', "Upload Kontrak")

@section('username', "{{ Auth::user()->code }}")

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="">Upload Kontrak&nbsp;<span class="badge badge-primary">{{Auth::user()->code}}</span></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th>Kelas</th>
                                <th colspan="2">Mata Kuliah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($jadwal) > 0)
                            @foreach($jadwal as $jdw)
                            <tr>
                                <th>{{ $jdw->cl_ID}}</th>
                                <td>{{ $jdw->mk_Name}}</td>
                                <td style=" width:1%; white-space:nowrap;">
                                    <form action="/upload/kontrakfile" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="dosen_Code" id="dosen_Code" value="{{ $jdw->dosen_Code }}">
                                        <input type="hidden" name="mk_Code" id="mk_Code" value="{{ $jdw->mk_Code }}">
                                        <input type="hidden" name="mk_Name" id="mk_Name" value="{{ $jdw->mk_Name }}">
                                        <input type="file" name="file" id="file">
                                        <input type="submit" value="Upload" class="btn btn-primary">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            <tr></tr>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection