@extends('layout')
  
@section('content')
<div class="container" style="margin-top:50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"> 
              <div class="card-header">{{ __('Shorten Url') }}</div>
                
                 <form method="POST" action="{{ route('create_url') }}">
                    @csrf
                    <div class="input-group mb-3">
                      <input type="text" name="url_link" class="form-control" placeholder="Enter URL">
                      @if ($errors->has('url_link'))
                        <span class="text-danger">{{ $errors->first('url_link') }}</span>
                     @endif

                     <div class="input-group-append">
                        <button class="btn btn-success " type="submit">Shorten Link</button>
                    </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection