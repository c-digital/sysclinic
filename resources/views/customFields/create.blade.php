{{ Form::open(array('url' => 'custom-field')) }}
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
                {{Form::label('name',__('Custom Field Name'),['class'=>'form-label'])}}
                {{Form::text('name',null,array('class'=>'form-control','required'=>'required'))}}
            </div>
            <div class="form-group col-md-12">
                {{ Form::label('type', __('Type'),['class'=>'form-label']) }}
                {{ Form::select('type',$types,null, array('class' => 'form-control select ','required'=>'required')) }}
            </div>
            <div class="form-group col-md-12">
                {{ Form::label('module', __('Module'),['class'=>'form-label']) }}
                {{ Form::select('module',$modules,null, array('class' => 'form-control select ','required'=>'required')) }}
            </div>
            <div class="form-group col-md-12 options-container">
                {{Form::label('options',__('Options (Comma separated values)'),['class'=>'form-label'])}}
                {{Form::text('options',null,array('class'=>'form-control','required'=>'required'))}}
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
        <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
    </div>
{{ Form::close() }}

<script>
    $('[name=type]').change(function () {
        value = $(this).val();

        $('.options-container').hide();

        if (value == 'select') {
            $('.options-container').show();
        }
    });

    $(document).ready(function () {
        $('.options-container').hide();
    });
</script>