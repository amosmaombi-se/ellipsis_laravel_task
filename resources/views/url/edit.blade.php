@extends('layout')
  
@section('content')
<div class="container" style="margin-top:50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Url') }}</div>
  
                
                <form method="POST" action="{{ route('link.edit', $urlLink->id) }}">
                    @csrf
                    <div class="input-group mb-3">
                      <input type="text" name="full_url" class="form-control" value="{{ $urlLink->full_url }}">
                      @if ($errors->has('full_url'))
                        <span class="text-danger">{{ $errors->first('full_url') }}</span>
                     @endif

                     <div class="input-group-append">
                        <button class="btn btn-success " type="submit">Edit Link</button>
                    </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection