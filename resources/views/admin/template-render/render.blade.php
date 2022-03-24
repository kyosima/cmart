@if($type == 'roles')
<tr class="replaywith-{{$role->id}}">
    <td><input type="checkbox" name="id[]" value="{{ $role->id }}"></td>
    <td>{{$role->name}}</td>
    <td>{!! permissionOfRole($permission) !!}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-warning ajax-edit ajax-get-roles" data-id="{{$role->id}}" data-name="{{$role->name}}"  data-url="{{route('roles.edit', $role->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
            <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('roles.destroy', $role->id)}}"><i class="fa fa-trash"></i></button>
        </div>
    </td>
</tr>
@endif

@if($type == 'permission')
<tr class="replaywith-{{$permission->id}}">
    <td><input type="checkbox" name="id[]" value="{{ $permission->id }}"></td>
    <td>{{$permission->name}}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-warning ajax-edit" data-id="{{$permission->id}}" data-name="{{$permission->name}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
            <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('permissions.destroy', $permission->id)}}"><i class="fa fa-trash"></i></button>
        </div>
    </td>
</tr>
@endif

@if($type == 'All Permissions')
    <option value="All Permissions" selected>Tất cả các quyền</option>
    @foreach($permissions as $value)
        <option value="{{$value->id}}">{{$value->name}}</option>
    @endforeach
@endif

@if($type == 'Permissions Role')
    <option value="All Permissions">Tất cả các quyền</option>
    @foreach($permissions as $value)
        <option value="{{$value->id}}" {{ checkRoleHasPermissions($role, $value->name) }}>{{$value->name}}</option>
    @endforeach
@endif

@if($type == 'adminRole')
    <option value="">Vui lòng chon</option>
    @foreach($roles as $value)
        <option value="{{$value}}" {{ checkAdminHasRole($admin, $value) }}>{{$value}}</option>
    @endforeach
@endif

@if($type == 'adminPermission')
    <option value="">Vui lòng chon</option>
    @foreach($permissions as $value)
        <option value="{{$value}}" {{ checkAdminHasPermissionTo($admin, $value) }}>{{$value}}</option>
    @endforeach
@endif

@if($type == 'admin')
<tr class="replaywith-{{$admin->id}}">
    <td>{{$admin->fullname}}</td>
    <td>{{$admin->email}}</td>
    <td>{{$admin->DVCQ}}</td>
    <td>{!! showAdminWithPermission($admin->permissions) !!}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-warning ajax-edit ajax-get-admin" data-id="{{$admin->id}}" data-fullname="{{$admin->fullname}}" data-DVCQ="{{$admin->DVCQ}}" data-url="{{route('manager-admin.edit', $admin->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
            <button type="button" class="btn btn-danger ajax-delete" data-url="{{route('manager-admin.destroy', $admin->id)}}"><i class="fa fa-trash"></i></button>
        </div>
    </td> 
</tr>
@endif
@if($type == 'banner')
    @foreach($banner as $value)
    <div class="col-xs-12 col-md-12 ui-sortable-handle mt-4">
        <div style="float:none;position: relative;" class="image_link">
            <div class="form-group mb-3">
                <label for="">Liên kết</label>
                <input type="text" name="link[]" class="form-control" placeholder="Liên hết" value="{{$value->link}}">
            </div>
            <img class="img-thumbnail show_img" src="{{asset($value->image)}}" alt="">
            <i class="fas fa-trash-alt"></i>
        </div>
        <input type="hidden" name="image[]" value="{{ $value->image }}">
        <input type="hidden" name="id[]" value=" {{ $value->id }}">
    </div>
    @endforeach
@endif