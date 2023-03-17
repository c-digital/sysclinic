@extends('layouts.admin')

@section('page-title')
    {{__('Recetas')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Recetas')}}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        <a href="/recipes/create" title="{{__('Crear')}}" data-title="{{__('Crear receta')}}" class="btn btn-sm btn-primary">
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
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($recipes as $recipe)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $recipe->customer->name ?? null }}</td>
                                        <td>{{ $recipe->user->name ?? null }}</td>
                                        <td>{{ $recipe->date }}</td>
                                        <td>
                                            <a href="{{ '/recipes/print/' . $recipe->id }}" target="_blank" class="btn btn-sm btn-secondary">
                                                <i class="fa fa-print"></i> Imprimir
                                            </a>

                                            <a href="{{ '/recipes/edit/' . $recipe->id }}" class="btn btn-sm btn-secondary">
                                                <i class="fa fa-edit"></i> Editar
                                            </a>

                                            <a href="{{ '/recipes/delete/' . $recipe->id }}" class="btn btn-sm btn-danger confirm-delete">
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


@section('js')
    <script>
        $(document).ready(function () {
            $('.confirm-delete').click(function (event) {
                if (!confirm('¿Está seguro que desea eliminar?')) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection