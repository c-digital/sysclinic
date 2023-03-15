@extends('layouts.admin')

@section('page-title')
    {{__('Editar consulta')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Consultas')}}</li>
@endsection


@section('content')
    {{ Form::open(array('url' => 'consultation/update','enctype' => "multipart/form-data")) }}
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Información general') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_customer">{{ __('Paciente') }}</label>

                                    <select name="id_customer" class="form-control">
                                        <option value=""></option>

                                        @foreach($customers as $customer)
                                            <option {{ $customer->id == $consultation->id_customer ? 'selected' : '' }} value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_professional">{{ __('Profesional') }}</label>

                                    <select name="id_professional" class="form-control">
                                        <option value=""></option>

                                        @foreach($users as $user)
                                            <option {{ $user->id == $consultation->id_user ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>                 
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">{{ __('Información médica') }}</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($fields as $field)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="{{ $field->name }}">{{ $field->name }}</label>

                                        @if($field->type == 'text')
                                            <input class="form-control" type="text" name="fields[{{ $field->name }}]" value="{{ json_decode($consultation->fields, true)[$field->name] }}">
                                        @endif

                                        @if($field->type == 'date')
                                            <input class="form-control" type="date" name="fields[{{ $field->name }}]" value="{{ json_decode($consultation->fields, true)[$field->name] }}">
                                        @endif

                                        @if($field->type == 'email')
                                            <input class="form-control" type="email" name="fields[{{ $field->name }}]" value="{{ json_decode($consultation->fields, true)[$field->name] }}">
                                        @endif

                                        @if($field->type == 'number')
                                            <input class="form-control" type="number" name="fields[{{ $field->name }}]" value="{{ json_decode($consultation->fields, true)[$field->name] }}">
                                        @endif

                                        @if($field->type == 'textarea')
                                            <textarea class="form-control" name="fields[{{ $field->name }}]">
                                                {{ json_decode($consultation->fields, true)[$field->name] }}
                                            </textarea>
                                        @endif
                                    </div>
                                </div>
                            @endforeach                            
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Imagenes</div>

                    <div class="card-body">
                        <input type="file" name="images[]" multiple>

                        <hr>

                        @foreach(json_decode($consultation->images) as $img)
                            <div class="col-md-3">
                                <img src="{{ $img }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <input type="submit" value="Guardar cambios" class="btn btn-primary">
    {{ Form::close() }}
@endsection
