@extends('layouts.admin')

@section('title') {{ __('Add User') }} @endsection

@section('styles')
<!-- select2 -->
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/select2.min.css') }}">
@endsection

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
                        <h3 class="card-title">{{ __('Add User') }}</h3>
                        <div class="card-tools">
                            @can('role_access')
                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-angle-double-left"></i>
                            {{ __('Back') }}
                            </a>
                            @endcan
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Name') }}</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Email') }}</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Password') }}</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="{{ __('Password') }}">
                                    </div>

                                    <div class="form-group">
                                        <label> {{ __('Roles') }}
                                            <span class="btn btn-info btn-xs select-all">{{ __('Select all') }}</span>
                                            <span class="btn btn-info btn-xs deselect-all">{{ __('Deselect all') }}</span>
                                        </label>
                                        <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" data-placeholder="Select Roles" style="width:100%;">
                                            @foreach($roles as $id => $role)
                                                <option value="{{ $id }}" {{ (in_array($id, old('roles', []))) ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Status') }}</label>
                                        <select name="status" id="status" class="form-control" style="width: 100%;">
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
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

@section('scripts')
<!-- select2 -->
<script src="{{ asset('backend/plugins/select2/select2.full.min.js') }}"></script>
<script>
	$(function () {
		$('.select-all').click(function () {
            var select2 = $(this).parent().siblings('.select2');
            select2.find('option').prop('selected', 'selected');
            select2.trigger('change');
        });
        $('.deselect-all').click(function () {
            var select2 = $(this).parent().siblings('.select2');
            select2.find('option').prop('selected', '');
            select2.trigger('change');
        });

        $('.select2').select2();
	});
</script>
@endsection