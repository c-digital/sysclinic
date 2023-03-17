@extends('layouts.admin')

@section('page-title')
    {{__('Editar recipe')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Recipes')}}</li>
@endsection


@section('content')
    {{ Form::open(array('url' => 'recipes/update','enctype' => "multipart/form-data")) }}

        <input type="hidden" name="id" value="{{ $recipe->id }}">

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_customer">{{ __('Paciente') }}</label>

                                    <select name="id_customer" class="form-control">
                                        <option value=""></option>

                                        @foreach($customers as $customer)
                                            <option {{ $customer->id == $recipe->id_customer ? 'selected' : '' }} value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_user">{{ __('Profesional') }}</label>

                                    <select name="id_user" class="form-control">
                                        <option value=""></option>

                                        @foreach($users as $user)
                                            <option {{ $user->id == $recipe->id_user ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">{{ __('Descripcion') }}</label>

                                    <textarea name="description" class="form-control" required>{{ $recipe->description }}</textarea>
                                </div>
                            </div>
                        </div>                 
                    </div>
                </div>
            </div>
        </div>

        <input type="submit" value="Guardar cambios" class="btn btn-primary">
    {{ Form::close() }}
@endsection
