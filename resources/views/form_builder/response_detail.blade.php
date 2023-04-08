
<div class="modal-body">
    <div class="row">
        @foreach($response as $que => $ans)
            <div class="col-12 text-xs">
                <h6 class="text-small">{{$que}}</h6>
                <p class="text-sm">
                    @if(Storage::exists($ans))
                        <a target="_blank" href="/storage/{{ $ans }}">{{ $ans }}</a>
                    @else
                        {{$ans}}
                    @endif
                </p>
            </div>
        @endforeach
    </div>
</div>

