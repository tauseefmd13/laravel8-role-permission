@extends('layouts.admin')

@section('title') {{ __('Permission List') }} @endsection

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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Permission List') }}</h3>
                        <div class="card-tools">
                            @can('permission_create')
                            <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus-circle"></i>
                                {{ __('Add Permission') }}
                            </a>
                            @endcan

                            @can('permission_delete')
                            <button class="btn btn-sm btn-danger delete-all" data-url="{{ route('admin.permissions.massDestroy') }}">
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
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Created Date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permissions as $key => $permission)
                                <tr id="tr_{{ $permission->id }}">
                                    <td><input type="checkbox" class="sub-check" data-id="{{ $permission->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <input type="checkbox" name="status" data-url="{{ route('admin.permissions.update.status') }}" data-id="{{ $permission->id }}" class="js-switch" {{ $permission->status == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $permission->created_at }}</td>
                                    <td>
                                        @can('permission_edit')
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.permissions.edit',$permission->id) }}" title="Edit"><i class="fas fa-edit"></i></a>
                                        @endcan

                                        @can('permission_delete')
                                        <form action="{{ route('admin.permissions.destroy',$permission->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-confirmation" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                        @endcan
                                    </td>
                                @empty
                                    <tr>
                                        <td colspan="6">{{ __('No data found.') }}</td>
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