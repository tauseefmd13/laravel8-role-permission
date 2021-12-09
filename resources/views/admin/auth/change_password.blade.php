@extends('layouts.admin')

@section('title') {{ __('Change Password') }} @endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ __('Users') }}</h1>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Change Password') }}</h3>
                    </div>
                    <!-- /.card-header -->

                    <form action="{{ route('admin.change_password') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Old Password') }}</label>
                                        <input type="password" class="form-control" name="old_password" id="old_password" value="{{ old('old_password') }}" placeholder="{{ __('Old Password') }}">
                                    </div>
    
                                    <div class="form-group">
                                        <label>{{ __('New Password') }}</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="{{ __('New Password') }}">
                                    </div>
                                    
                                      <div class="form-group">
                                        <label>{{ __('Confirm Password') }}</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{ __('Confirm Password') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection