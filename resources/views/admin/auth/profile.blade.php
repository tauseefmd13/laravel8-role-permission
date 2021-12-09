@extends('layouts.admin')

@section('title') {{ __('Edit Profile') }} @endsection

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
                        <h3 class="card-title">{{ __('Edit Profile') }}</h3>
                    </div>
                    <!-- /.card-header -->

                    <form action="{{ route('admin.profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Name') }}</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" placeholder="{{ __('Name') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Email') }}</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" placeholder="{{ __('Email') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Status') }}</label>
                                        <select name="status" id="status" class="form-control" style="width: 100%;">
                                            <option value="1" {{ old('status',auth()->user()->status) == '1' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                            <option value="0" {{ old('status',auth()->user()->status) == '0' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                        </select>
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