@extends('layouts.admin')

@section('page-title')
    {{__('Consultas')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Consultas')}}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        <a href="#" data-size="lg" data-url="{{ route('customer.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create Customer')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
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
                                    <th> {{__('Paciente')}}</th>
                                    <th> {{__('Profesional')}}</th>
                                    <th> {{__('Fecha')}}</th>
                                    <th>{{__('Estado')}}</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($consultations as $consultation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $consultation->customer->name }}</td>
                                        <td>{{ $consultation->user->name }}</td>
                                        <td>{{ $consultation->date }}</td>
                                        <td>{{ $consultation->status }}</td>
                                        <td>
                                            <a href="{{ '/consultation/print/' . $consultation->id }}" class="btn btn-secondary">
                                                <i class="fa fa-print"></i> Imprimir
                                            </a>

                                            <a href="" class="btn btn-secondary">
                                                <i class="fa fa-print"></i> Cambiar estado
                                            </a>

                                            <a href="{{ '/consultation/edit/' . $consultation->id }}" class="btn btn-secondary">
                                                <i class="fa fa-print"></i> Editar
                                            </a>

                                            <a href="{{ '/consultation/delete/' . $consultation->id }}" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </a>
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
