@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.edit'))

@section('page-header')
    <h1>
        {{ trans('编辑用户') }}
    </h1>
@endsection

@section('content')
    {{ Form::model($user, ['route' => ['admin.access.user.update', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('编辑用户') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.access.includes.partials.user-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('first_name', trans('用户姓'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('first_name', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.access.users.first_name')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('last_name', trans('用户名'),
                    ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('last_name', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.access.users.last_name')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('email', trans('邮箱'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::email('email', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.access.users.email')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                @if ($user->id != 1)
                    <div class="form-group">
                        {{ Form::label('status', trans('激活'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-1">
                            {{ Form::checkbox('status', '1', $user->status == 1) }}
                        </div><!--col-lg-1-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('associated_roles', trans('角色'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-3">
                            @if (count($roles) > 0)
                                @foreach($roles as $role)
                                    <input type="checkbox" value="{{$role->id}}" name="assignees_roles[{{ $role->id }}]" {{ is_array(old('assignees_roles')) ? (in_array($role->id, old('assignees_roles')) ? 'checked' : '') : (in_array($role->id, $user_roles) ? 'checked' : '') }} id="role-{{$role->id}}" /> <label for="role-{{$role->id}}">{{ $role->name }}</label>
                                        <a href="#" data-role="role_{{$role->id}}" class="show-permissions small">
                                            (
                                                <span class="show-text">{{ trans('labels.general.show') }}</span>
                                                <span class="hide-text hidden">{{ trans('labels.general.hide') }}</span>
                                                {{ trans('labels.backend.access.users.permissions') }}
                                            )
                                        </a>
                                    <br/>
                                    <div class="permission-list hidden" data-role="role_{{$role->id}}">
                                        @if ($role->all)
                                            {{ trans('labels.backend.access.users.all_permissions') }}<br/><br/>
                                        @else
                                            @if (count($role->permissions) > 0)
                                                <blockquote class="small">{{--
                                            --}}@foreach ($role->permissions as $perm){{--
                                            --}}{{$perm->display_name}}<br/>
                                                    @endforeach
                                                </blockquote>
                                            @else
                                                {{ trans('labels.backend.access.users.no_permissions') }}<br/><br/>
                                            @endif
                                        @endif
                                    </div><!--permission list-->
                                @endforeach
                            @else
                                {{ trans('labels.backend.access.users.no_roles') }}
                            @endif
                        </div><!--col-lg-3-->
                    </div><!--form control-->
                @endif
                <div class="form-group">
                    {{ Form::label('last_name', '门店',['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-10">
                        <select class="form-control" name="contro" id="" required="required">
                            <option value="">请选择</option>
                            <option value="0">全部门店</option>
                            @foreach($store as $k=>$v)
                                <option value="{{$v->id}}"  @if($v['id']==$user['contro']) selected="selected"  @endif >{{$v->st_name}}</option>
                            @endforeach
                        </select>
                    </div><!--col-lg-10-->
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.access.user.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

        @if ($user->id == 1)
            {{ Form::hidden('status', 1) }}
            {{ Form::hidden('assignees_roles[0]', 1) }}
        @endif

    {{ Form::close() }}
@endsection

@section('after-scripts')
    {{ Html::script('js/backend/access/users/script.js') }}
@endsection
