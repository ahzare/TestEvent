<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('panel.admin.roles.index', compact(['roles', 'permissions']))
            ->with(['nav_item' => 'roles', 'nav_link' => 'roles']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = Validator::make($request->all(), [
            'name' => ['required', 'unique:roles,name'],
            'permissions' => 'required',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        $role = Role::query()->find($id);
        $permissions = Permission::all();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('panel.admin.roles.edit', compact(['role', 'permissions', 'rolePermissions']))
            ->with(['nav_item' => 'roles', 'nav_link' => 'roles']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = Validator::make($request->all(), [
            'name' => ['required' , Rule::unique('roles', 'name')->ignore($id)],
            'permissions' => 'required',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $role = Role::query()->find($id);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')
            ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        Role::destroy($id);
        return redirect()->route('admin.roles.index')
            ->with('success','Role deleted successfully');
    }
}
