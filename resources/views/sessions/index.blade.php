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
                            <div class="col-md-6">
                                <label for="treatment">Tratamiento</label>
                                <select name="treatment" class="form-control">
                                    <option value=""></option>

                                    @foreach($products as $product)
                                        <option {{ $product->id == request()->treatment ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="customer">{{ __('Paciente') }}</label>
                                <input type="text" name="customer" class="form-control" value="{{ request()->paciente ?? null }}">
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
                                    <th> {{__('Paciente')}}</th>
                                    <th> {{__('Tratamiento')}}</th>
                                    <th> {{__('Estado')}}</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($sessions as $session)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $session->customer->name ?? null }}</td>
                                        <td>{{ $session->product->name ?? null }}</td>
                                        <td>{{ $session->status }}</td>
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#info_{{ $session->id }}" href="#" class="btn btn-sm btn-secondary">
                                                <i class="fa fa-list"></i> Información
                                            </a>

                                            @if($session->count < $session->quantity)
                                                <a data-bs-toggle="modal" data-bs-target="#comment_{{ $session->id }}" href="#" class="btn btn-sm btn-secondary realized-session">
                                                    <i class="fa fa-check"></i> Realizar sesión
                                                </a>
                                            @endif

                                            @include('sessions.info', compact('session'))
                                            @include('sessions.comment', compact('session'))
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
