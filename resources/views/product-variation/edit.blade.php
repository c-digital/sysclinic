{{ Form::model($variation, array('route' => array('product-variation.update', $variation->id), 'method' => 'PUT','enctype' => "multipart/form-data")) }}
    <div class="modal-body">

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name">{{ __("Variant name") }}</label>
                    <input type="text" class="form-control" name="name" value="{{ $variation->name }}">
                </div>
            </div>
        </div>

        <hr>

        <div class="paramters-container">
            <div class="row mb-3">
                <div class="col">
                    <b>{{ __('Options:') }}</b>
                </div>
            </div>

            @foreach($variation->options as $parameter)
                @if($loop->index == 0)
                    <div class="row">
                        <div class="col-5">
                            <label for="name">{{ __('Name') }}</label>
                        </div>

                        <div class="col-5">
                            <label for="name">{{ __('Price') }}</label>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-5">
                        <div class="form-group">                        
                            <input type="text" class="form-control" name="options[{{$loop->index}}][name]" value="{{ $parameter['name'] }}">
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="form-group">
                            <input type="text" class="form-control" name="options[{{$loop->index}}][price]" value="{{ $parameter['price'] }}">
                        </div>
                    </div>

                    @if($loop->index == 0)
                        <div class="col-2">
                            <button class="btn btn-info btn-block add-new-parameter" type="button">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    @else
                        <div class="col-2">
                            <button class="btn btn-danger btn-block" onclick="removeParameter(this)" type="button">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal-footer">
        <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
        <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
    </div>
{{ Form::close() }}

<script>
    $(document).ready(function () {
        i = {{ count($variation->options) }};

        $('.add-new-parameter').click(function () {
            html = `
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <input type="text" class="form-control" name="options[${i}][name]">
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="form-group">
                            <input type="text" class="form-control" name="options[${i}][price]">
                        </div>
                    </div>

                    <div class="col-2">
                        <button class="btn btn-danger btn-block" onclick="removeParameter(this)" type="button">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;

            i++;

            $('.paramters-container').append(html);
        });
    });

    function removeParameter(element) {
        $(element).parent().parent().remove();
    }
</script>
