@extends('layouts.admin')

@section('title') {{ __('Edit Permission') }} @endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ __('Permissions') }}</h1>
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
                        <h3 class="card-title">{{ __('Edit Permission') }}</h3>
                        <div class="card-tools">
                            @can('permission_access')
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-angle-double-left"></i>
                            {{ __('Back') }}
                            </a>
                            @endcan
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <form action="{{ route('admin.permissions.update',$permission->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Name') }}</label>
                                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" value="{{ old('name', $permission->name) }}" placeholder="{{ __('Name') }}">

                                        @if($errors->has('name'))
                                            <p class="text-danger">
                                                {{ $errors->first('name') }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Status') }}</label>
                                        <select name="status" id="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" style="width: 100%;">
                                            <option value="1" {{ old('status',$permission->status) == '1' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                            <option value="0" {{ old('status',$permission->status) == '0' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                        </select>

                                        @if($errors->has('status'))
                                            <p class="text-danger">
                                                {{ $errors->first('status') }}
                                            </p>
                                        @endif
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