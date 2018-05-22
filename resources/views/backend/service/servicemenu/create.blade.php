@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.create'))

@section('page-header')
    <h1>
        服务项目-菜单管理
        <small>菜单管理</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.service_menu.create', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">菜单管理</h3>
                <div class="box-tools pull-right">
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->
            <div class="form-group">
                {{ Form::label('last_name', '上级菜单',['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    <select class="form-control" name="parnt" id="" required="required">
                        <option value="0">请选择(不选默认顶级)</option>
                        @foreach($menu as $k=>$v)
                            <option value="{{$v->id}}">{{$v->name}}</option>
                        @endforeach
                    </select>
                </div><!--col-lg-10-->
            </div>
            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('first_name', '标题', ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => '200', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '请输入标题']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.news.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@endsection

@section('after-scripts')
    {{ Html::script('js/backend/access/users/script.js') }}
    <script type="text/javascript" charset="utf-8" src="/utf8-php/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/utf8-php/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/utf8-php/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" src="/layDate-v5.0.7/laydate/laydate.js"></script>
    <script>
        var ue = UE.getEditor('editor');
        //常规用法
        laydate.render({
            elem: '#test1'
        });
    </script>

@endsection
