@extends('layouts.admin')

@section('page-title')
    Calendario
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Calendario')}}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Calendar') }}</h5>
                </div>
                <div class="card-body">
                    <div id='calendar' class='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    @include('calendar.create')
    @include('calendar.edit')
@endsection


@push('script-page')

    <script type="text/javascript">

        function createAddProductService() {
            productService = $('.productServicesCreate').val();

            name = $('.productServicesCreate option:selected').html();

            if (!productService != '') {
                alert('Debe seleccionar algún producto/servicio');
                return false;
            }

            $('.productsServicesCreateTr').append(`
                <tr>
                    <td>
                        <input type="hidden" name="productsServices[]" value="${productService}">
                        ${name}
                    <td>
                </tr>
            `);

            $('.productServicesCreate').val('').change();
        }

        function createEditProductService() {
            productService = $('.productServicesEdit').val();

            name = $('.productServicesEdit option:selected').html();

            if (!productService != '') {
                alert('Debe seleccionar algún producto/servicio');
                return false;
            }

            $('.productsServicesEditTr').append(`
                <tr>
                    <td>
                        <input type="hidden" name="productsServices[]" value="${productService}">
                        ${name}
                    <td>
                </tr>
            `);

            $('.productServicesEdit').val('').change();
        }

        (function () {
            var etitle;
            var etype;
            var etypeclass;
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridDay,timeGridWeek,dayGridMonth'
                },
                buttonText: {
                    timeGridDay: "{{__('Day')}}",
                    timeGridWeek: "{{__('Week')}}",
                    dayGridMonth: "{{__('Month')}}"
                },
                themeSystem: 'bootstrap',
                initialDate: '{{ $initialDate }}',
                slotDuration: '00:10:00',
                navLinks: true,
                disableDragging: false,
                eventStartEditable: false,
                selectable: false,
                selectMirror: true,
                editable: true,
                dayMaxEvents: true,
                handleWindowResize: true,
                events:{!! json_encode($calendar) !!},
                dateClick: function (info) {
                    $('#calendarCreate').modal('show')
                },
                eventClick: function (info) {
                    $('#calendarEditModal').find('[name=id]').val(info.event._def.extendedProps.id);
                    $('#calendarEditModal').find('[name=title]').val(info.event._def.title);
                    $('#calendarEditModal').find('[name=id_customer]').val(info.event._def.extendedProps.id_customer).change();
                    $('#calendarEditModal').find('[name=id_user]').val(info.event._def.extendedProps.id_user).change();
                    $('#calendarEditModal').find('[name=datetime]').val(info.event._def.extendedProps.datetime).change();

                    for (var i = info.event._def.extendedProps.productsServices.length - 1; i >= 0; i--) {
                        $('#calendarEditModal').find('.productsServicesEditTr').html(`
                            <tr>
                                <td>
                                    <input type="hidden" name="productsServices[]" value="${info.event._def.extendedProps.productsServices[i].id}">
                                    ${info.event._def.extendedProps.productsServices[i].name}
                                <td>
                            </tr>
                        `);
                    }

                    $('#calendarEditModal').modal('show');
                }
            });
            calendar.render();
        })();
    </script>
@endpush