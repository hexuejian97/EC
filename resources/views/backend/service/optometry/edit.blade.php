@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.create'))

@section('page-header')
    <h1>
        视光检查
        <small>视光检查</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.optometry.edit', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">视光检查编辑</h3>
            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
                <input type="hidden" name="id" value="{{$optometry->id}}">
                {{ Form::label('first_name', '标题', ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    {{ Form::text('title', $optometry->title, ['class' => 'form-control', 'maxlength' => '200', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '请输入标题']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            {{--<div class="form-group">--}}
                {{--{{ Form::label('intro', '简介', ['class' => 'col-lg-2 control-label']) }}--}}
                {{--<div class="col-lg-10">--}}
                    {{--{{ Form::text('intro', $optometry->intro, ['class' => 'form-control', 'maxlength' => '500', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '请输入标题']) }}--}}
                {{--</div><!--col-lg-10-->--}}
            {{--</div><!--form control-->--}}
            <div class="form-group">
                {{ Form::label('news_content', '内容',['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    <textarea name="content" id="editor"  style="width: 100%;height: 300px" cols="30" rows="10">{!!$optometry->content !!}</textarea>
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
    <script type="text/javascript" charset="utf-8" src="/qiniu_ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/qiniu_ueditor/ueditor.all.min.js"> </script>
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
        var check = $('.check').val();
        $('.forcheck').each(function(index,element){
            if($(this).val() == check){
                $('.forcheck').eq(index).remove();
            }
        });
    </script>


@endsection
