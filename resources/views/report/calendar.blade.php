@extends('layouts.admin')

@section('page-title')
    {{__('Sesiones')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Sesiones')}}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style table-border-style">
                    <form action="" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="patient">{{ __('Paciente') }}</label>
                                <input type="text" name="patient" class="form-control" value="{{ request()->patient ?? null }}">
                            </div>

                            <div class="col-md-4">
                                <label for="doctor">{{ __('Doctor') }}</label>
                                <input type="text" name="doctor" class="form-control" value="{{ request()->doctor ?? null }}">
                            </div>

                            <div class="col-md-4">
                                <label for="status">{{ __('Estado') }}</label>
                                <select name="status" class="form-control">
                                    <option value=""></option>
                                    <option {{ request()->status == 'Atendido' ? 'selected' : '' }} value="Atendido">Atendido</option>
                                    <option {{ request()->status == 'Reprogramado' ? 'selected' : '' }} value="Reprogramado">Reprogramado</option>
                                    <option {{ request()->status == 'Cancelado' ? 'selected' : '' }} value="Cancelado">Cancelado</option>
                                    <option {{ request()->status == 'En espera' ? 'selected' : '' }} value="En espera">En espera</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="start">{{ __('Fecha hasta') }}</label>
                                <input type="date" name="start" class="form-control" value="{{ request()->start ?? null }}">
                            </div>

                            <div class="col-md-4">
                                <label for="end">{{ __('Fecha desde') }}</label>
                                <input type="date" name="end" class="form-control" value="{{ request()->end ?? null }}">
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
                                    <th> {{__('Titulo')}}</th>
                                    <th> {{__('Fecha')}}</th>
                                    <th> {{__('Paciente')}}</th>
                                    <th> {{__('Medico')}}</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($calendar as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->customer->name }}</td>
                                        <td>{{ $item->user->name }}</td>
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
