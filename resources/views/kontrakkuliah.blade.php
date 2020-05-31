@extends('layouts.app')

@section('title', "Kontrak Kuliah")

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
                <h3 class="">Kontrak Kuliah&nbsp;<span class="badge badge-primary">{{Auth::user()->code}}</span></h3>
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
                            @if(count($kontrak) > 0)
                            @foreach($kontrak as $kon)
                            <tr>
                                <th>{{ $kon->cl_ID}}</th>
                                <td>{{ $kon->mk_Name}}</td>
                                <td style=" width:1%; white-space:nowrap;">
                                    <a href="downloadkontrak/{{$kon->file}}">Download</a>
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