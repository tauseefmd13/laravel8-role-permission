@extends('layouts.admin')

@section('title') {{ __('Role List') }} @endsection

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<!-- switchery -->
<link rel="stylesheet" href="{{ asset('backend/plugins/switchery/switchery.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">
<style>
    .showMore, .showLess {
        color:#3399ff;
        padding-left: 1%;
        cursor: pointer;
        font-weight: bold;
    }
    .showLess {
        display: none;
    }
</style>
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
                        <h3 class="card-title">{{ __('Role List') }}</h3>
                        <div class="card-tools">
                            @can('role_create')
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus-circle"></i>
                                {{ __('Add Role') }}
                            </a>
                            @endcan

                            @can('role_delete')
                            <button class="btn btn-sm btn-danger delete-all" data-url="{{ route('admin.roles.massDestroy') }}">
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
                                    <th>{{ __('Permissions') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Created Date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $key => $role)
                                <tr id="tr_{{ $role->id }}">
                                    <td><input type="checkbox" class="sub-check" data-id="{{ $role->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td style="width:400px;" class="permission-column">
                                        @if($role->permissions->count() > 0)
                                            @foreach($role->permissions as $key => $permission)
                                                @if($key < 6)    
                                                    <span class="badge badge-info lessText">{{ $permission->name }}</span>
                                                @endif
                                                <span class="badge badge-info fullText" style="display:none;">{{ $permission->name }}</span>
                                            @endforeach
                                            <sub class="showMore">{{ __('Show More') }} <i class="fas fa-angle-double-right"></i></sub>
                                            <sub class="showLess"><i class="fas fa-angle-double-left"></i> {{ __('Show Less') }}</sub>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" name="status" data-url="{{ route('admin.roles.update.status') }}" data-id="{{ $role->id }}" class="js-switch" {{ $role->status == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $role->created_at }}</td>
                                    <td>
                                        @can('role_show')
                                        <a class="btn btn-sm btn-info" href="{{ route('admin.roles.show',$role->id) }}" title="View"><i class="fas fa-eye"></i></a>
                                        @endcan

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
                                @empty
                                    <tr>
                                        <td colspan="7">{{ __('No data found.') }}</td>
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

    $(".showMore").on('click', function (e) {
        var permissionColumn = $(this).closest('.permission-column');
        $(".showMore, .lessText", permissionColumn).hide(); //permissionColumn.find('.showMore, .lessText').hide();
        $(".fullText, .showLess", permissionColumn).show();
    });

    $(".showLess").on('click', function (e) {
        var permissionColumn = $(this).closest('.permission-column');
        $(".showLess, .fullText", permissionColumn).hide();
        $(".lessText, .showMore", permissionColumn).show();
    });
</script>
@endsection