@extends('layouts.admin')

@section('title') {{ __('View Role') }} @endsection

@section('styles')
<!-- switchery -->
<link rel="stylesheet" href="{{ asset('backend/plugins/switchery/switchery.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ __('Roles') }}</h1>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('View Role') }}</h3>
                        <div class="card-tools">
                            @can('role_access')
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-angle-double-left"></i>
                            {{ __('Back') }}
                            </a>
                            @endcan
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <td>{{ $role->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Permissions') }}</th>
                                    <td>
                                        @if($role->permissions->count() > 0)
                                            @foreach($role->permissions as $key => $permission)
                                                <span class="badge badge-info">{{ $permission->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Status') }}</th>
                                    <td>
                                        <input type="checkbox" name="status" data-url="{{ route('admin.roles.update.status') }}" data-id="{{ $role->id }}" class="js-switch" {{ $role->status == 1 ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Created Date') }}</th>
                                    <td>{{ $role->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Action') }}</th>
                                    <td>
                                        @can('role_edit')
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.roles.edit',$role->id) }}" title="Edit"><i class="fas fa-edit"></i></a>
                                        @endcan

                                        @can('role_delete')
                                        <form action="{{ route('admin.roles.destroy',$role->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-confirmation" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@section('scripts')
<!-- switchery -->
<script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
<!-- toastr -->
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<!-- sweetalert -->
<script src="{{ asset('backend/plugins/sweetalert/sweetalert.min.js') }}"></script>
<!-- custom -->
<script src="{{ asset('backend/dist/js/custom.js') }}"></script>
@endsection