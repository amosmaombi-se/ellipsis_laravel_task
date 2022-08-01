@extends('layout')
  
@section('content')
<div class="container"  style="margin-top:40px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
               
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full link</th>
                    <th scope="col">Shorten link</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                   
                    @foreach($urlLinks as $index =>  $value)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $value->full_url }}</td>
                            <td>{{ $value->short_url }}</a></td>
                            <td>
                              <a class="btn btn-danger btn-mini btn-round" href="{{ route('shorten.link.delete', $value->id) }}">delete</a>
                              <a class="btn btn-info btn-mini btn-round" href="{{ route('shorten.link.edit', $value->id) }}">edit</a>
                              <a class="btn btn-primary btn-mini btn-round" href="{{ route('shorten.link.disable', $value->id) }}">disable</a>
                            </td>
                        </tr>
                    @endforeach

                
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection