@extends('layouts.admin')

@section('page-title')
    {{__('Crear consulta')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Consultas')}}</li>
@endsection


@section('content')
    {{ Form::open(array('url' => 'consultation','enctype' => "multipart/form-data")) }}
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
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
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
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_consutations_types">{{ __('Tipo de consulta') }}</label>

                                    <select name="id_consutations_types" class="form-control">
                                        <option value=""></option>

                                        @foreach($consultationTypes as $type)
                                            <option {{ request()->consultation_type == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
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
                            @if($fields)
                                @foreach($fields as $field)
                                    @if($field->type == 'text')
                                        <div class="col-md-6">
                                            <label for="{{ $field->name }}">{{ $field->name }}</label>
                                            <input class="form-control" type="text" name="fields[{{ $field->name }}]">
                                        </div>
                                    @endif

                                    @if($field->type == 'date')
                                        <div class="col-md-6">
                                            <label for="{{ $field->name }}">{{ $field->name }}</label>
                                            <input class="form-control" type="date" name="fields[{{ $field->name }}]">
                                        </div>
                                    @endif

                                    @if($field->type == 'email')
                                        <div class="col-md-6">
                                            <label for="{{ $field->name }}">{{ $field->name }}</label>
                                            <input class="form-control" type="email" name="fields[{{ $field->name }}]">
                                        </div>
                                    @endif

                                    @if($field->type == 'number')
                                        <div class="col-md-6">
                                            <label for="{{ $field->name }}">{{ $field->name }}</label>
                                            <input class="form-control" type="number" name="fields[{{ $field->name }}]">
                                        </div>
                                    @endif

                                    @if($field->type == 'textarea')
                                        <div class="col-md-6">
                                            <label for="{{ $field->name }}">{{ $field->name }}</label>
                                            <textarea class="form-control" name="fields[{{ $field->name }}]"></textarea>
                                        </div>
                                    @endif

                                    @if($field->type == 'title')
                                        <h4 class="{{ $loop->iteration != '1' ? 'mt-5' : '' }}">{{ $field->name }}</h4>
                                    @endif

                                    @if($field->type == 'select')
                                        <div class="col-md-6">
                                            <label for="{{ $field->name }}">{{ $field->name }}</label>
                                            <select name="fields[{{ $field->name }}]" class="form-control">
                                                <option value=""></option>

                                                @foreach(explode(',', $field->options) as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                @endforeach      
                            @endif                      
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Imagenes</div>

                    <div class="card-body">
                        <input type="file" name="images[]" multiple>
                    </div>
                </div>
            </div>
        </div>

        <input type="submit" value="Guardar cambios" class="btn btn-primary">
    {{ Form::close() }}
@endsection


@section('js')
    <script>
        $(document).ready(function () {
            $('[name=id_consutations_types]').change(function () {
                consutation_type = $(this).val();
                window.location.href = window.location.href + '?consultation_type=' + consutation_type;
            })
        });
    </script>
@endsection