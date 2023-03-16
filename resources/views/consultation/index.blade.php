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
        <a href="/consultation/create" title="{{__('Create')}}" data-title="{{__('Create Customer')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style table-border-style">
                    <form action="" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="status">Estado</label>
                                <select name="status" class="form-control">
                                    <option value=""></option>
                                    <option {{ request()->status == 'Pendiente' ? 'selected' : '' }} value="Pendiente">Pendiente</option>
                                    <option {{ request()->status == 'En atención' ? 'selected' : '' }} value="En atención">En atención</option>
                                    <option {{ request()->status == 'Finalizada' ? 'selected' : '' }} value="Finalizada">Finalizada</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="inicio">{{ __('Fecha desde') }}</label>
                                <input type="date" name="inicio" class="form-control" value="{{ request()->inicio ?? null }}">
                            </div>

                            <div class="col-md-4">
                                <label for="fin">{{ __('Fecha hasta') }}</label>
                                <input type="date" name="fin" class="form-control" value="{{ request()->fin ?? null }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="paciente">{{ __('Paciente') }}</label>
                                <input type="text" name="paciente" class="form-control" value="{{ request()->paciente ?? null }}">
                            </div>

                            <div class="col-md-4">
                                <label for="type">Tipo de consulta</label>
                                <select name="type" class="form-control">
                                    <option value=""></option>
                                    @foreach($types as $type)
                                        <option {{ $type->id == request()->type ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" style="width: 100%" class="btn btn-primary mt-3">
                                    <i class="fa fa-eye"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{__('Paciente')}}</th>
                                    <th> {{__('Profesional')}}</th>
                                    <th> {{__('Fecha')}}</th>
                                    <th> {{__('Tipo de consulta')}}</th>
                                    <th>{{__('Estado')}}</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($consultations as $consultation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $consultation->customer->name ?? null }}</td>
                                        <td>{{ $consultation->user->name ?? null }}</td>
                                        <td>{{ $consultation->date }}</td>
                                        <td>{{ $consultation->type->name }}</td>
                                        <td>{{ $consultation->status }}</td>
                                        <td>
                                            <a href="{{ '/consultation/print/' . $consultation->id }}" class="btn btn-sm btn-secondary">
                                                <i class="fa fa-print"></i> Imprimir
                                            </a>

                                            <a href="{{ '/consultation/edit/' . $consultation->id }}?consultation_type={{ $consultation->id_consultations_types }}" class="btn btn-sm btn-secondary">
                                                <i class="fa fa-edit"></i> Editar
                                            </a>

                                            <a href="{{ '/consultation/delete/' . $consultation->id }}" class="btn btn-sm btn-danger">
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
