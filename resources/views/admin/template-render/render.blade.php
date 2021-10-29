@if($type == 'roles')
<tr class="replaywith-{{$role->id}}">
    <td>{{$role->name}}</td>
    <td>{!! permissionOfRole($permission) !!}</td>
    <td>
        <button type="button" class="btn btn-warning ajax-edit ajax-get-roles" data-id="{{$role->id}}" data-name="{{$role->name}}"  data-url="{{route('roles.edit', $role->id)}}">Edit</button>
        <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('roles.destroy', $role->id)}}">Delete</button>
    </td>
</tr>
@endif

@if($type == 'permission')
<tr class="replaywith-{{$permission->id}}">
    <td>{{$permission->name}}</td>
    <td>
        <button type="button" class="btn btn-warning ajax-edit" data-id="{{$permission->id}}" data-name="{{$permission->name}}">Edit</button>
        <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('permissions.destroy', $permission->id)}}">Delete</button>
    </td>
</tr>
@endif

@if($type == 'All Permissions')
    <option value="All Permissions" selected>All Permissions</option>
    @foreach($permissions as $value)
        <option value="{{$value->id}}">{{$value->name}}</option>
    @endforeach
@endif

@if($type == 'Permissions Role')
    <option value="All Permissions">All Permissions</option>
    @foreach($permissions as $value)
        <option value="{{$value->id}}" @if($role->hasPermissionTo($value->name)) selected @endif>{{$value->name}}</option>
    @endforeach
@endif

@if($type == 'addAdmin')
<tr class="replaywith-{{$admin->id}}">
    <td>{{$admin->name}}</td>
    <td>{{$admin->email}}</td>
    <td><span class="badge bg-primary">{{$role_name}}</span></td>
    <td>
        <button type="button" class="btn btn-warning ajax-edit ajax-get-roles" data-id="{{$admin->id}}" data-name="{{$admin->name}}" data-url="{{route('roles.edit', $admin->id)}}">Edit</button>
        <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('roles.destroy', $admin->id)}}">Delete</button>
        <option value="{{$value->id}}" {{ checkRoleHasPermissions($role, $value->name) }}>{{$value->name}}</option>
    @endforeach
@endif

@if($type == 'adminRole')
    <option value="">Vui lòng chon</option>
    @foreach($roles as $value)
        <option value="{{$value}}" {{ checkAdminHasRole($admin, $value) }}>{{$value}}</option>
    @endforeach
@endif

@if($type == 'admin')
<tr class="replaywith-{{$admin->id}}">
    <td>{{$admin->name}}</td>
    <td>{{$admin->email}}</td>
    <td>{!! showRolesOfAdmin($role_name) !!}</td>
    <td>
        <button type="button" class="btn btn-warning ajax-edit ajax-get-admin" data-id="{{$admin->id}}" data-name="{{$admin->name}}" data-email="{{$admin->email}}" data-url="{{route('manager-admin.edit', $admin->id)}}">Edit</button>
        <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('manager-admin.destroy', $admin->id)}}">Delete</button>
    </td> 
</tr>
@endif