<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.access.role.index', trans('角色列表'), [], ['class' => 'btn btn-primary btn-xs']) }}
    {{ link_to_route('admin.access.role.create', trans('角色添加'), [], ['class' => 'btn btn-success btn-xs']) }}
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('menus.backend.access.roles.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li>{{ link_to_route('admin.access.role.index', trans('角色列表')) }}</li>
            <li>{{ link_to_route('admin.access.role.create', trans('角色添加')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>