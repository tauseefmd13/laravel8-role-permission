<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permissions\StoreRequest;
use App\Http\Requests\Permissions\UpdateRequest;
use App\Http\Requests\Permissions\MassDestroyRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('permission_access'), 403);

        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('permission_create'), 403);

        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        abort_unless(\Gate::allows('permission_create'), 403);

        Permission::create($request->validated());

        return redirect()->route('admin.permissions.index')->with('success','Permission added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        abort_unless(\Gate::allows('permission_show'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        abort_unless(\Gate::allows('permission_edit'), 403);

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Permission $permission)
    {
        abort_unless(\Gate::allows('permission_edit'), 403);

        $permission->update($request->validated());

        return redirect()->route('admin.permissions.index')->with('success','Permission updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        abort_unless(\Gate::allows('permission_edit'), 403);

        $permission = Permission::findOrFail($request->id);
        $permission->status = $request->status;
        $permission->save();

        return response()->json(['message' => 'Permission status updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        abort_unless(\Gate::allows('permission_delete'), 403);

        $permission->delete();

        return redirect()->route('admin.permissions.index')->with('success','Permission deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(MassDestroyRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response()->json(['message' => 'Permission deleted successfully.']);
    }
}
