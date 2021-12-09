@extends('layouts.admin')

@section('title') {{ __('User List') }} @endsection

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
                        <h3 class="card-title">{{ __('User List') }}</h3>
                        <div class="card-tools">
                            @can('user_create')
                            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus-circle"></i>
                                {{ __('Add User') }}
                            </a>
                            @endcan

                            @can('user_delete')
                            <button class="btn btn-sm btn-danger delete-all" data-url="{{ route('admin.users.massDestroy') }}">
                                <i class="fas fa-trash"></i>
                                {{ __('Delete Selected') }}
                            </button>
                            @endcan
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="checkAll" id="checkAll"></th>
                                    <th>{{ __('S.No.') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Roles') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Created Date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $key => $user)
                                <tr id="tr_{{ $user->id }}">
                                    <td><input type="checkbox" class="sub-check" data-id="{{ $user->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        {{ $user->email }}
                                        @if (!empty($user->email_verified_at))
                                            <i class="far fa-check-circle text-success"></i>
                                        @else
                                            <i class="far fa-times-circle text-danger"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->roles->count() > 0)
                                            @foreach($user->roles as $key => $role)
                                                <span class="badge badge-info">{{ $role->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" name="status" data-url="{{ route('admin.users.update.status') }}" data-id="{{ $user->id }}" class="js-switch" {{ $user->status == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        @can('user_show')
                                        <a class="btn btn-sm btn-info" href="{{ route('admin.users.show',$user->id) }}" title="View"><i class="fas fa-eye"></i></a>
                                        @endcan

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
                                @empty
                                    <tr>
                                        <td colspan="8">{{ __('No data found.') }}</td>
                                    </tr>
                                </tr>
                                @endforelse
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
<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- switchery -->
<script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
<!-- toastr -->
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<!-- sweetalert -->
<script src="{{ asset('backend/plugins/sweetalert/sweetalert.min.js') }}"></script>
<!-- custom -->
<script src="{{ asset('backend/dist/js/custom.js') }}"></script>

<script>
	$(function () {
		$("#example1").DataTable({
			"responsive": true, 
			"lengthChange": true, 
			"autoWidth": false,
            'columnDefs': [{
                'targets': [0], /* column index for disable sorting */
                'orderable': false, /* true or false */
            }],
            order: [[1, 'asc']],
		});
	});
</script>
@endsection