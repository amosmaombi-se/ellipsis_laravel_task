@extends('layout')
  
@section('content')
<div class="container" style="margin-top:30px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"> 
              <div class="card-header">{{ __('Update profile') }}</div>
                <div class="card-body">
                  <form action="{{ route('user.edit') }}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="name" value="{{$user->name}}" class="form-control" name="name" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" value="{{$user->email}}" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Update
                              </button>
                          </div>
                      </form>
                   </div>
            </div>


              <div class="card" style="margin-top:50px"> 
                <div class="card-header">{{ __('Reset Password') }}</div>
                 <div class="card-body">
                  <form action="{{ route('user.resetpassword') }}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="name" class="col-md-3 col-form-label text-md-right">Current Password</label>
                              <div class="col-md-9">
                                  <input type="password"  class="form-control" name="password" required autofocus>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="name" class="col-md-3 col-form-label text-md-right">New Password</label>
                              <div class="col-md-9">
                                  <input type="password"  class="form-control" name="new_password" required autofocus>
                                  @if ($errors->has('new_password'))
                                      <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="name" class="col-md-3 col-form-label text-md-right">Confirm Password</label>
                              <div class="col-md-9">
                                  <input type="password"  class="form-control" name="confirm_password" required autofocus>
                                  @if ($errors->has('confirm_password'))
                                      <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                  @endif
                              </div>
                          </div>
  
                        
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Update
                              </button>
                          </div>
                      </form>
                   </div>
            </div>

        </div>
    </div>
</div>
@endsection