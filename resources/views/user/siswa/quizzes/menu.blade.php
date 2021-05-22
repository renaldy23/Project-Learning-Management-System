<div class="row">
    @foreach ($quiz->question as $key=>$value)
        <div class="col-2">
            <p class="bg-light text-center">
                <a href="#q{{ $key+1 }}">{{ $key+1 }}</a>
            </p>
        </div>
    @endforeach
</div>