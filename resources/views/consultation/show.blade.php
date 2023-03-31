@extends('layouts.admin')

@section('page-title')
    {{__('Editar consulta')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Consultas')}}</li>
@endsection


@section('action-btn')
    <div class="float-end">
        <a href="/consultation" class="btn btn-sm btn-primary">
            <i class="ti ti-arrow-left"></i> Volver a listado de consultas
        </a>
    </div>
@endsection


@section('content')
    {{ Form::open(array('url' => 'consultation/update','enctype' => "multipart/form-data")) }}

        <input type="hidden" name="id" value="{{ $consultation->id }}">

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Información general') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img id="user-photo" class="img-fluid user-photo" style="width: 220px; cursor: pointer" src="{{ $consultation->photoWithRoute ?? 'http://sysclinic.net/storage/uploads/avatar/User_font_awesome.svg_1667932474.png' }}" alt="">
                                <input type="file" id="photo" name="photo" style="display: none">
                            </div>

                            <div class="col-md-8">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="id_customer">{{ __('Paciente') }}</label>
                                        <input readonly type="text" class="form-control" name="id_customer" value="{{ $consultation->customer->name }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="id_user">{{ __('Profesional') }}</label>
                                        <input readonly type="text" class="form-control" name="id_user" value="{{ $consultation->user->name }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="status">Estado</label>
                                        <input readonly type="text" class="form-control" name="status" value="{{ $consultation->status }}">
                                    </div>
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
                                            <input readonly class="form-control" type="text" name="fields[{{ $field->name }}]" value="{{ json_decode($consultation->fields, true)[$field->name] }}">
                                        </div>
                                    @endif

                                    @if($field->type == 'date')
                                        <div class="col-md-6">
                                            <label for="{{ $field->name }}">{{ $field->name }}</label>
                                            <input readonly class="form-control" type="date" name="fields[{{ $field->name }}]">
                                        </div>
                                    @endif

                                    @if($field->type == 'email')
                                        <div class="col-md-6">
                                            <label for="{{ $field->name }}">{{ $field->name }}</label>
                                            <input readonly class="form-control" type="email" name="fields[{{ $field->name }}]" value="{{ json_decode($consultation->fields, true)[$field->name] }}">
                                        </div>
                                    @endif

                                    @if($field->type == 'number')
                                        <div class="col-md-6">
                                            <label for="{{ $field->name }}">{{ $field->name }}</label>
                                            <input readonly class="form-control" type="number" name="fields[{{ $field->name }}]" value="{{ json_decode($consultation->fields, true)[$field->name] }}">
                                        </div>
                                    @endif

                                    @if($field->type == 'textarea')
                                        <div class="col-md-6">
                                            <label for="{{ $field->name }}">{{ $field->name }}</label>
                                            <textarea readonly class="form-control" name="fields[{{ $field->name }}]"></textarea>
                                        </div>
                                    @endif

                                    @if($field->type == 'title')
                                        <h4 class="{{ $loop->iteration != '1' ? 'mt-5' : '' }}">{{ $field->name }}</h4>
                                    @endif

                                    @if($field->type == 'select')
                                        <div class="col-md-6">
                                            <label for="{{ $field->name }}">{{ $field->name }}</label>
                                            <input readonly class="form-control" type="text" name="fields[{{ $field->name }}]" value="{{ json_decode($consultation->fields, true)[$field->name] }}">
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
                        <div class="row">
                            @foreach(json_decode($consultation->images) as $img)
                                <div class="col-md-4 p-1">
                                    <img class="img-fluid" src="{{ '/storage/' . $img }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
@endsection
