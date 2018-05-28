@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.store.edit', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.create') }}</h3>
            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
                {{ Form::label('first_name', '门店名称', ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-7">
                    {{ Form::text('store_name', $store->store_name, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '请输入姓名']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('last_name', '门店地址',['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-7">
                    {{ Form::text('store_address', $store->store_address, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => '请输入职称']) }}
                    {{ Form::hidden('id', $store->id, ['class' => 'form-control fd', 'maxlength' => '191', 'required' => 'required', 'placeholder' => '请输入擅长领域']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('last_name', '门店位置',['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-7">
                    <select class="form-control" name="store_position" id="">
                        <option value="{{$store->store_position}}" class="check">{{$store->st_name}}</option>
                        @foreach($st as $k=>$v)
                            <option value="{{$v->id}}" class="forcheck">{{$v->st_name}}</option>
                        @endforeach
                    </select>
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('last_name', '门店电话',['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-7">
                    {{ Form::number('store_tel', $store->store_tel, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => '请输入职称']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('car_sort', '门店照片', ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-4">
                    <div id="container2">
                        <a href="javascript:void(0)" id="pickfiles2"><img src="http://owgtlty2t.bkt.clouddn.com/1.jpeg" alt="" width="150px" height="100px"></a><br>
                        @foreach($store->public as $k=>$v)
                            <div style="display:inline" ><img style="width:100px;height:100px" class="old" sid="{{$v->id}}" src='{{$v->public_picture}}'><img class="img_list_cover" src="/img/close.jpg"></div>
                        @endforeach
                        <input type="hidden" name="old_public" value="">
                        <input type="hidden" name="new_public" value="">
                    </div>
                </div><!--col-lg-10-->
            </div>

            <div class="form-group traffic">
                {{ Form::label('car_sort', '交通路线', ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-5">
                    {{ Form::text('sf', $store->sf, ['class' => 'form-control sf', 'maxlength' => '191', 'placeholder' => '']) }}
                    {{ Form::hidden('sd', $store->sd, ['class' => 'form-control sd', 'maxlength' => '191', 'required' => 'required', 'placeholder' => '']) }}

                </div><!--col-lg-10-->
                <div class="col-lg-1">
                    <a href="javascript:void(0)" class="add">保存</a>
                </div>
            </div><!--form control-->
            @foreach($store->traffic as $k=>$v)
            <div class="form-group traffic">
                <label class="col-lg-2 control-label"></label>
                    <div class="col-lg-5">
                        <input type="text" name="" class="form-control" required="required" readonly="readonly" value="{{$v->store_traffic}}">
                    </div><!--col-lg-10-->
                    <div class="col-lg-2">
                        <a href="{{url('admin/store/update')}}/{{$store->id}}?addId={{$v->id}}" class="">修改</a>|<a href="javascript:void(0)" class="dele" sid="{{$v->id}}">删除</a>
                    </div>
            </div><!--form control-->
            @endforeach

            <div class="form-group">
                {{ Form::label('news_content', '资讯内容',['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-6">
                    <textarea name="store_intro" id="editor" style="width: 100%;height: 300px" cols="30" rows="5">{!! $store->store_intro !!}</textarea>
                </div><!--col-lg-10-->
            </div><!--form control-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                {{ link_to_route('admin.store.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
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
    <script type="text/javascript" charset="utf-8" src="/qiniu_ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/qiniu_ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/utf8-php/lang/zh-cn/zh-cn.js"></script>
    <script src="http://ouvegnn6u.bkt.clouddn.com/qiniu.js"></script>
    <script src="http://ouvegnn6u.bkt.clouddn.com/moxie.js"></script>
    <script src="http://ouvegnn6u.bkt.clouddn.com/plupload.dev.js"></script>
    <script>
        var check = $('.check').val();
        $('.forcheck').each(function(index,element){
            if($(this).val() == check){
                $('.forcheck').eq(index).remove();
            }
        });
        var ue = UE.getEditor('editor');
        var arrUrl = [];
        $(function(){
            //证件
            var arr = [];
            $.post('{{route('admin.upToken')}}', {}, function (data) {
                var uploader = Qiniu.uploader({
                    runtimes: 'html5,flash,html4',      // 上传模式，依次退化
                    browse_button: 'pickfiles2',         // 上传选择的点选按钮，必需
                    uptoken: data, // uptoken是上传凭证，由其他程序生成
                    get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
                    unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
                    save_key: false,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
                    domain: 'http://p4sncjd6h.bkt.clouddn.com',     // bucket域名，下载资源时用到，必需
                    container: 'container2',             // 上传区域DOM ID，默认是browser_button的父元素
                    max_file_size: '100mb',             // 最大文件体积限制
                    flash_swf_url: 'path/of/plupload/Moxie.swf',  //引入flash，相对路径
                    drop_element: 'container2',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
                    chunk_size: '4mb',                  // 分块上传时，每块的体积
                    auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
                    init: {
                        'FilesAdded': function (up, files) {
                            plupload.each(files, function (file) {
                                // 文件添加进队列后，处理相关的事情
                            });
                        },
                        'BeforeUpload': function (up, file) {
                            // 每个文件上传前，处理相关的事情
                        },
                        'UploadProgress': function (up, file) {
                            // 每个文件上传时，处理相关的事情
                        },
                        'FileUploaded': function (up, file, info) {
                            // 查看简单反馈
                            var domain = up.getOption('domain');
                            //var res = parseJSON(info);
                            var res = eval('(' + info.response + ')');
                            var sourceLink = domain + '/' + res.key; //获取上传成功后的文件的Url
                            $('input[name="new_public"]').val(sourceLink);
                            $('#container2').children('.div').remove();
                            arrUrl.push(sourceLink);
                            console.log(arrUrl);
                        },
                        'Error': function (up, err, errTip) {
                            //上传出错时，处理相关的事情
                        },
                        'UploadComplete': function () {
                            //队列文件处理完毕后，处理相关的事情
                            var imgList = '';
                            for(var i=0; i<arrUrl.length; i++) {
                                imgList =      '<div style="display:inline" class="div">'+'<img style="width:100px;height:100px" class="show_img" sid="111" src='+ arrUrl[i] +'>'+'<img class="img_list_covers" onclick="remove($(this))" src="/img/close.jpg">'+'</div>';
                                // var imgList='< img class="show_img" src="'+arrUrl[i]+'">'
                                $("#container2").append(imgList);

                            }
                            $('input[name="new_public').val(arrUrl);
                        }
                    }
                });
            })
        })
        var arrSid = [];
        $('.img_list_cover').click(function(){
            var sid = $(this).siblings('.old').attr('sid');
            arrSid.push(sid);
            $('input[name="old_public"]').val(arrSid);
            console.log(arrSid)
            $(this).siblings('.old').remove();
            $(this).remove();
        })

        function remove(a){
            console.log(arrUrl)
            //console.log()
            // a.attr('src');
            var sid = a.siblings('.show_img').attr('src');
            a.siblings('.show_img').remove();
            a.remove();
            console.log(sid)
            function removeByValue(arr, val) {
                for(var i=0; i<arr.length; i++) {
                    if(arr[i] == val) {
                        arr.splice(i, 1);
                        break;
                    }
                }
            }
            removeByValue(arrUrl,sid);
            //console.log(arrUrl)
            $('input[name="new_public"]').val(arrUrl);
        }
        $('.add').click(function(){
            var sd = $('.sd').val();
            var sf = $('.sf').val();
            var fd = $('.fd').val();
            if(sd){
                if(sf){
                    $.post('{{route('admin.traffic.edit')}}',{id:sd,sf:sf},function(o){
                        if(o.code==2000){
                            window.location.href="{{url('admin/store/update')}}/"+fd;
                        }
                    })
                }else{
                    alert('修改不许为空');
                }

            }else{
                if(sf){
                    $.post('{{route('admin.traffic.create')}}',{fd:fd,sf:sf},function(o){
                        if(o.code==2000){
                            window.location.href="{{url('admin/store/update')}}/"+fd;
                        }
                    })
                }else{
                    alert('添加不许为空');
                }

            }
        })

        $('.dele').click(function(){
            var sid = $(this).attr('sid');
            var fd = $('.fd').val();
            $.post('{{route('admin.traffic.delete')}}',{id:sid},function(o){
                if(o.code==2000){
                    window.location.href="{{url('admin/store/update')}}/"+fd;
                }
            })
        })


    </script>
@endsection
