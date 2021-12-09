@extends('layouts.admin')

@section('title') {{ __('View User') }} @endsection

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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('View User') }}</h3>
                        <div class="card-tools">
                            @can('user_access')
                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary">
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
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Email') }}</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Roles') }}</th>
                                    <td>
                                        @if($user->roles->count() > 0)
                                            @foreach($user->roles as $key => $role)
                                                <span class="badge badge-info">{{ $role->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Status') }}</th>
                                    <td>
                                        <input type="checkbox" name="status" data-url="{{ route('admin.users.update.status') }}" data-id="{{ $user->id }}" class="js-switch" {{ $user->status == 1 ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Created Date') }}</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Action') }}</th>
                                    <td>
                                        @can('user_edit')
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.users.edit',$user->id) }}" title="Edit"><i class="fas fa-edit"></i></a>
                                        @endcan

                                        @can('user_delete')
                                        <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST" style="display:inline-block;">
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