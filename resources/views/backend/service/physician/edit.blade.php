@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.physician.edit', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.access.users.create') }}</h3>

                <div class="box-tools pull-right">

                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('first_name', '姓名', ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-6">
                        {{ Form::text('phy_name', $phy->phy_name, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '请输入姓名']) }}
                        {{ Form::hidden('id', $phy->id, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '请输入姓名']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('last_name', '职称',['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-6">
                        <select class='form-control' name="phy_type" required='required'>
                            <option value="{{$phy->phy_type}}" class="check1">{{$phy->pt_name}}</option>
                            @foreach($pt as $k=>$v)
                                <option value="{{$v->id}}" class="forcheck1">{{$v->pt_name}}</option>
                            @endforeach
                        </select>
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group" style="margin-bottom: 10px;">
                    {{ Form::label('goods_pic', '照片', ['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-6">
                        <img src="{{$phy->phy_picture}}" alt="" style="width:100px;height:100px" id="img">
                        <div id="container1">
                            <a class="btn btn-default btn-lg " id="pickfiles" href="#" >
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>选择文件</span>
                            </a>
                        </div>
                        {{ Form::text('phy_picture', $phy->phy_picture, ['id' => 'phy_picture','class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => '' ,'readonly' => 'readonly']) }}
                    </div>
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('last_name', '工作年限',['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-6">
                        {{ Form::number('phy_life', $phy->phy_life, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => '请输入工作年限']) }}
                    </div><!--col-lg-10-->
                </div>
                <div class="form-group">
                    {{ Form::label('last_name', '所属门店',['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-6">
                        <select class='form-control' name="phy_store" required='required'>
                            <option value="{{$phy->phy_store}}" class="check">{{$phy->store_name}}</option>
                            @foreach($store as $k=>$v)
                                <option value="{{$v->id}}" class="forcheck">{{$v->store_name}}</option>
                            @endforeach
                        </select>
                    </div><!--col-lg-10-->
                </div>
                <div class="form-group">
                    {{ Form::label('last_name', '擅长',['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-6">
                        {{ Form::text('phy_good_at', $phy->phy_good_at, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => '请输入擅长领域']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('last_name', '简介',['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-6">
                        {{ Form::text('phy_intro', $phy->phy_intro, ['class' => 'form-control', 'maxlength' => '', 'required' => 'required', 'placeholder' => '请输入简介']) }}
                        {{ Form::hidden('id', $phy->id, ['class' => 'form-control', 'maxlength' => '', 'required' => 'required', 'placeholder' => '请输入简介']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('news_content', '详细信息',['class' => 'col-lg-2 control-label']) }}
                    <div class="col-lg-6">
                        <script name="phy_content" id="editor" cols="30" rows="5">{!! $phy->phy_content !!}</script>
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <!--form control-->
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.physician.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit('修改', ['class' => 'btn btn-success btn-xs']) }}
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
    <script src="http://ouvegnn6u.bkt.clouddn.com/qiniu.js"></script>
    <script src="http://ouvegnn6u.bkt.clouddn.com/moxie.js"></script>
    <script src="http://ouvegnn6u.bkt.clouddn.com/plupload.dev.js"></script>
    <script >
        var ue = UE.getEditor('editor');

        var check = $('.check').val();
        $('.forcheck').each(function(index,element){
            if($(this).val() == check){
                $('.forcheck').eq(index).remove();
            }
        });
        var check1 = $('.check1').val();
        $('.forcheck1').each(function(index,element){
            if($(this).val() == check1){
                $('.forcheck1').eq(index).remove();
            }
        });
        $(function(){
            $.post('{{route('admin.upToken')}}',{},function(data){
                //照片
                var uploader = Qiniu.uploader({
                    runtimes: 'html5,flash,html4',      // 上传模式，依次退化
                    browse_button: 'pickfiles',         // 上传选择的点选按钮，必需
                    // 在初始化时，uptoken，uptoken_url，uptoken_func三个参数中必须有一个被设置
                    // 切如果提供了多个，其优先级为uptoken > uptoken_url > uptoken_func
                    // 其中uptoken是直接提供上传凭证，uptoken_url是提供了获取上传凭证的地址，如果需要定制获取uptoken的过程则可以设置uptoken_func
                    uptoken : data, // uptoken是上传凭证，由其他程序生成
                    //uptoken_url: '',         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
                    /*uptoken_func: function(){    // 在需要获取uptoken时，该方法会被调用
                     // do something
                     $.post('',{},function(uptoken){
                     return uptoken;
                     })

                     },*/
                    get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
                    // downtoken_url: '/downtoken',
                    // Ajax请求downToken的Url，私有空间时使用，JS-SDK将向该地址POST文件的key和domain，服务端返回的JSON必须包含url字段，url值为该文件的下载地址
                    unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
                    save_key: false,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
                    domain: 'http://p4sncjd6h.bkt.clouddn.com',     // bucket域名，下载资源时用到，必需
                    container: 'container1',             // 上传区域DOM ID，默认是browser_button的父元素
                    max_file_size: '100mb',             // 最大文件体积限制
                    flash_swf_url: 'path/of/plupload/Moxie.swf',  //引入flash，相对路径
                    max_retries: 3,                     // 上传失败最大重试次数
                    dragdrop: true,                     // 开启可拖曳上传
                    drop_element: 'container1',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
                    chunk_size: '4mb',                  // 分块上传时，每块的体积
                    auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
                    init: {
                        'FilesAdded': function(up, files) {
                            plupload.each(files, function(file) {
                                // 文件添加进队列后，处理相关的事情
                            });
                        },
                        'BeforeUpload': function(up, file) {
                            // 每个文件上传前，处理相关的事情
                        },
                        'UploadProgress': function(up, file) {
                            // 每个文件上传时，处理相关的事情
                        },
                        'FileUploaded': function(up, file, info) {
                            // 每个文件上传成功后，处理相关的事情
                            // 其中info是文件上传成功后，服务端返回的json，形式如：
                            // {
                            //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                            //    "key": "gogopher.jpg"
                            //  }
                            // 查看简单反馈
                            var domain = up.getOption('domain');
                            //var res = parseJSON(info);
                            var res = eval('('+info.response+')');
                            var sourceLink = domain+'/'+res.key; //获取上传成功后的文件的Url
                            console.log(sourceLink);
                            $("#img").attr('src',sourceLink);
                            $("#phy_picture").val(sourceLink);

                        },
                        'Error': function(up, err, errTip) {
                            //上传出错时，处理相关的事情
                        },
                        'UploadComplete': function() {
                            //队列文件处理完毕后，处理相关的事情
                        },
                        'Key': function(up, file) {
                            // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                            // 该配置必须要在unique_names: false，save_key: false时才生效
                        }
                    }
                });

            })
        })
    </script>
@endsection
