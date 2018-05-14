@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.create'))

@section('page-header')
    <h1>
        服务项目管理
        <small>添加服务项目</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.project.create', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">添加服务项目</h3>

                <div class="box-tools pull-right">

                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('first_name', '服务项目名称', ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-10">
                        {{ Form::text('project_name', null, ['class' => 'form-control', 'maxlength' => '10', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('first_name', '服务项目类型', ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-10">
                        <select class="form-control" name="project_type" id="">
                            <option value="服务项目">服务项目</option>
                            <option value="特色服务">特色服务</option>
                        </select>
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('last_name', '服务项目简介',['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <script name="project_intro" id="editor" cols="30" rows="10"></script>
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <!--form control-->
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.project.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
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
    <script>
        var ue = UE.getEditor('editor');
    </script>
@endsection
