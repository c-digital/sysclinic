@php include 'app/functions.php'; @endphp

@extends('layouts.admin')

@section('page-title')
    {{__('Tipo de consulta')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Tipo de consulta')}}</li>
@endsection

@section('action-btn')
    @if(can(517))
    <div class="float-end">
        <a href="/consultationTypes/create" title="{{__('Crear')}}" data-title="{{__('Crear tipo de consulta')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{__('Name')}}</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($consultationType as $consultation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $consultation->name }}</td>
                                        <td>
                                            @if(can(516))
                                            <a href="{{ '/consultationTypes/edit/' . $consultation->id }}" class="btn btn-sm btn-secondary">
                                                <i class="fa fa-edit"></i> Editar
                                            </a>
                                            @endif

                                            @if(can(515))
                                            <a href="{{ '/consultationTypes/delete/' . $consultation->id }}" class="btn btn-sm btn-danger confirm-delete">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function () {
            $('.confirm-delete').click(function (event) {
                if (!confirm('¿Está seguro que desea eliminar?')) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection