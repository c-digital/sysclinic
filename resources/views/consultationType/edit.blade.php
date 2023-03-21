@extends('layouts.admin')

@section('page-title')
    {{__('Editar tipo de consulta')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Tipo de consulta')}}</li>
@endsection


@section('content')
    {{ Form::open(array('url' => 'consultationTypes/update','enctype' => "multipart/form-data")) }}

        <input type="hidden" name="id" value="{{ $consultationType->id }}">

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" name="name" required value="{{ $consultationType->name }}" class="form-control">
                                </div>
                            </div>
                        </div>                 
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Campos personalizados</div>

                <div class="card-body">
                    @foreach(json_decode($consultationType->fields) as $field)
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="names">{{ __('Name') }}</label>
                                <input type="text" name="names[]" required class="form-control" value="{{ $field->name }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="types">{{ __('Tipo') }}</label>
                                
                                <select required name="types[]" class="form-control">
                                    <option value=""></option>
                                    <option {{ $field->type == 'text' ? 'selected' : '' }} value="text">Text</option>
                                    <option {{ $field->type == 'textarea' ? 'selected' : '' }} value="textarea">Textarea</option>
                                    <option {{ $field->type == 'date' ? 'selected' : '' }} value="date">Date</option>
                                    <option {{ $field->type == 'number' ? 'selected' : '' }} value="number">Number</option>
                                    <option {{ $field->type == 'select' ? 'selected' : '' }} value="select">Select</option>
                                    <option {{ $field->type == 'title' ? 'selected' : '' }} value="title">Título</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="options">{{ __('Opciones (valores separados por coma)') }}</label>
                                <input type="text" name="options[]" class="form-control" value="{{ $field->options ?? null }}">
                            </div>
                        </div>
                        
                        <div class="col-md-2 mt-3">
                            @if($loop->iteration == 1)
                                <button type="button" class="add-field btn btn-success">
                                    <i class="fa fa-plus"></i> Agregar
                                </button>
                            @else
                                <button type="button" onclick="removeFild(this)" class="add-field btn btn-danger">
                                    <i class="fa fa-trash"></i> Eliminar
                                </button>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    <div class="items"></div>
                </div>
            </div>
        </div>

        <input type="submit" value="Guardar cambios" class="btn btn-primary">
    {{ Form::close() }}
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('.add-field').click(function () {
            $('.items').append(`
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="names">{{ __('Name') }}</label>
                            <input type="text" name="names[]" required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="types">{{ __('Tipo') }}</label>
                            
                            <select name="types[]" required class="form-control">
                                <option value=""></option>
                                <option value="text">Text</option>
                                <option value="textarea">Textarea</option>
                                <option value="date">Date</option>
                                <option value="number">Number</option>
                                <option value="select">Select</option>
                                <option value="title">Título</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="options">{{ __('Opciones (valores separados por coma)') }}</label>
                            <input type="text" name="options[]" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-2 mt-3">
                        <button type="button" onclick="removeFild(this)" class="add-field btn btn-danger">
                            <i class="fa fa-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
            `);
        });
    });

    function removeFild(that) {
        $(that).parent().parent().remove();
    }
</script>
@endsection
