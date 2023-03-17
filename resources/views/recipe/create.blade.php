@extends('layouts.admin')

@section('page-title')
    {{__('Crear receta')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Recetas')}}</li>
@endsection


@section('content')
    {{ Form::open(array('url' => 'recipes','enctype' => "multipart/form-data")) }}
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_customer">{{ __('Paciente') }}</label>

                                    <select name="id_customer" required class="form-control">
                                        <option value=""></option>

                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_user">{{ __('Profesional') }}</label>

                                    <select name="id_user" required class="form-control">
                                        <option value=""></option>

                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">{{ __('Descripcion') }}</label>

                                    <textarea name="description" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>                 
                    </div>
                </div>
            </div>
        </div>

        <input type="submit" value="Registrar" class="btn btn-primary">
    {{ Form::close() }}
@endsection
