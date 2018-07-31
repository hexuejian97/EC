@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
    <link rel="stylesheet" href="/bootstrap-table-master/dist/bootstrap-table.css">
    <link href="/select2/select2.css" rel="stylesheet" />

@endsection

@section('page-header')
    <h1>
        资讯置顶管理
     <!--     <small>新闻列表</small>-->
    </h1>
@endsection

@section('content')
   <div class="box box-success">
                                            <form method="POST" action="http://localhost/admin/newtop/edit" accept-charset="UTF-8" class="form-horizontal" role="form"><input name="_token" type="hidden" value="LCM1H73qhXOK8FAJmDpl2gOlNZmSheS4X6QXKIcv">


        <div class="box-body">
            <div class="form-group">
                <label for="news_type" class="col-lg-2 control-label">官方公告</label>
                <div class="col-lg-6">
                        <select class="form-control" name="activity" id="">

                        </select>
                </div><!--col-lg-10-->
            </div><!--form control-->
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="form-group">
                <label for="news_type" class="col-lg-2 control-label">电竞赛事</label>
                <div class="col-lg-6">
                        <select class="form-control" name="activity" id="">

                        </select>
                </div><!--col-lg-10-->
            </div><!--form control-->
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="form-group" style="margin-bottom: 10px;">
                <label for="news_type" class="col-lg-2 control-label">最新活动</label>
                <div class="col-lg-6">
                        <select class="form-control" name="activity" id="">

                        </select>
                </div><!--col-lg-10-->
            </div><!--form control-->



</div><!-- /.box-body -->
</div>
   <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                {{ link_to_route('admin.newtop.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
            </div><!--pull-left-->

            <div class="pull-right">
                {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->

</form>


@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}
    <script src="/bootstrap-table-master/dist/bootstrap-table.min.js"></script>
    <script src="/bootstrap-table-master/dist/locale/bootstrap-table-zh-CN.js"></script>
    <script src="/select2/select2.js"></script>
    <script>
        function getidnex(value, row, index) {
            var options = $('#table').bootstrapTable('getOptions');
            return options.pageSize * (options.pageNumber - 1) + index + 1
        }
        $(function() {

            var $table = $('#table');
            //点击执行搜索
            $("#area").select2({
                placeholder: '请选择',
                width:"700px",
            });
            var $search = $('#search');
            $search.click(function () {
                $table.bootstrapTable('refresh');


            });
            /*var $key = $('#key-submit');
            $key.click(function () {
                $table.bootstrapTable('refresh');
            });*/
            $('#key-submit').click(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var key = $('input[name="name"]').val();
                $.ajax({
                    type: 'POST',
                url: '',
                    dataType: 'json',
                    data:{'key':key},
                    success: function(data){
                        if(data==1){
                            $table.bootstrapTable('refresh');
                        }else{
                            alert('该关键词已存在');
                        }
                    },
                    error: function(xhr, type){

                        alert('Ajax error!')
                    }
                })
            })

            //操作响应
            window.actionEvents = {
                //禁用
                'click .disable': function (e, value, row, index) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '',
                        dataType: 'json',
                        data:{'id':row.id,'valid':0},
                        success: function(data){
                            if(data.code==1){
                                $('#table').bootstrapTable('refresh');
                            }else if(data.state==0){
                                alert(data.msg);
                            }
                        },
                        error: function(xhr, type){
                            alert('Ajax error!')
                        }
                    });
                },
                //启用
                'click .enable': function (e, value, row, index) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '',
                        dataType: 'json',
                        data:{'id':row.id,'valid':1},
                        success: function(data){
                            if(data.code==1){
                                $('#table').bootstrapTable('refresh');
                            }else if(data.state==0){
                                alert(data.msg);
                            }
                        },
                        error: function(xhr, type){
                            alert('Ajax error!')
                        }
                    });
                },
                //删除
                'click .del': function (e, value, row, index) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'DELETE',
                        {{--url: '{{route('admin/news/deletes')}}',--}}
                        url: '',
                        dataType: 'json',
                        data:{'id':row.id},
                        success: function(data){
                            if(data.code==1){
                                $('#table').bootstrapTable('refresh');
                            }else if(data.state==2000){
                                alert(data.msg);
                            }
                        },
                        error: function(xhr, type){
                            alert('Ajax error!')
                        }
                    });
                }
            };
            /*$(".form_datetime").datetimepicker({
                format: 'yyyy-mm-dd hh:ii',
                weekStart: 1,
                language: 'zh-CN'
            });*/
            window.actionEvents = {
                'click .remove': function (e, value, row) {
                    swal({
                        title: "确定?",
                        text: "你将删除该数据吗!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确认删除",
                        cancelButtonText: "取消",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    }, function () {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'post',
                            url: '{{route('admin.news.delete')}}',
                            dataType: 'json',
                            data: {id:row.id},
                            success: function (data) {
                                if (data.code == 2000) {
                                    $('#table').bootstrapTable('remove', {field: 'id', values: [row.id]});
                                    swal("已删除!", "已成功删除.", "success");
                                }else{
                                    swal("删除失败!", "请稍后再试！", "warning");
                                }
                            },
                            error: function (data) {
                                $('#table').bootstrapTable('remove', {field: 'id', values: [row.id]});
                                swal("已删除!", "已成功删除.", "success");
                            }
                        });
                    });
                },

                'click .top': function (e, value, row) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: '{{route('admin.news.top')}}',
                        dataType: 'json',
                        data: {id: row.id},
                        success: function (data) {
                            if (data.code == 2000) {
                                console.log(data.data);
                                $('#table').bootstrapTable('refresh');
                                swal("成功!", data.msg, "success");
                            }else if(data.code == 2001){
                                swal("失败!", data.msg, "warning");
                            }else{
                                swal("失败!", "请稍后再试！", "warning");

                            }
                        },
                        error: function (data) {

                            swal("失败!", "出错.", "error");
                        }
                    })

                },
                'click .update' : function(e, value, row){
                    window.location.href='{{url('admin/front/update')}}'+'/'+row.id;
                }
            };
            var $batch_delete = $("#batch_delete");
            $batch_delete.click(function (){
                var check = $table.bootstrapTable('getSelections');
                if(check == ''){
                    sweetAlert("批量操作失败", "未选中任何记录!", "error");
                }else{
                    console.log(check.length)
                    var chk = [];
                    for(var i = 0;i<check.length;i++){
                        chk[i] = check[i].id;
                    }
                    $.post('',{chk:chk},function(data){
                        if(data==1){
                            $table.bootstrapTable('refresh');
                        }
                    })
                }
            });
        });
        //批量操作
        /*var $batch_delete = $("#batch_delete");
        $batch_delete.click(function (){
            var check = $table.bootstrapTable('refresh');
            if(check == ''){
                sweetAlert("批量操作失败", "未选中任何记录!", "error");
            }else{
                alert(111);
            }
        });*/
        //搜索参数
        function getQueryParams(params) {
            $('#toolbar').find('.ss').each(function () {
                params[$(this).attr('name')] = $(this).val();
            });
            $('#toolbar').find('select[name]').each(function () {
                params[$(this).attr('name')] = $(this).val();
            });

            return params; // body data
        }
        function sexFormatter(value) {
            switch (value){
                case 1:
                    return '男';
                    break;
                case 2:
                    return '女';
                    break;
            }
        }

        function actionFormatter(value, row, index) {
            if(row.news_top==1){
                var ddq = '<a href="javascript:void(0)" class="btn btn-xs btn-primary top"> ' +
                    '<i class="fa fa-pencil top" data-toggle="tooltip" data-placement="top" ' +
                    'data-toggle="tooltip" data-placement="top" title="置顶">取消置顶</i></a>&nbsp;&nbsp;';
            }else if(row.news_top==0){
                var ddq = '<a href="javascript:void(0)" class="btn btn-xs btn-primary top"> ' +
                    '<i class="fa fa-pencil top" data-toggle="tooltip" data-placement="top" ' +
                    'data-toggle="tooltip" data-placement="top" title="置顶">置顶</i></a>&nbsp;&nbsp;';
            }
            var ddf = '<a href="{{url('admin/news/info')}}/'+row.id+'" class="btn btn-xs btn-primary "> ' +
                '<i class="fa fa-pencil " data-toggle="tooltip" data-placement="top" ' +
                'data-toggle="tooltip" data-placement="top" title="查看">查看</i></a>&nbsp;&nbsp;';
            var del = '<a href="{{url('admin/news/update')}}/'+row.id+'" class="btn btn-xs btn-primary update"> ' +
                '<i class="fa fa-pencil update" data-toggle="tooltip" data-placement="top" ' +
                'data-toggle="tooltip" data-placement="top" title="修改">修改</i></a>&nbsp;&nbsp;';
            var dde = '<a href="javascript:void(0)" class="btn btn-xs btn-primary remove"> ' +
                '<i class="fa fa-pencil remove" data-toggle="tooltip" data-placement="top" ' +
                'data-toggle="tooltip" data-placement="top" title="删除">删除</i></a>&nbsp;&nbsp;';


            /*if(row.status == '已发布'){
                var freeze = ''
                return del+' '+freeze;

            }else if(row.status = '草稿'){
                var freeze = ''
                //return edit+' '+freeze+' '+del;
            }*/
            if(row.news_type==6 || row.news_type==10){
                return ddq+ddf+del+dde;

            }else{
                return ddf+del+dde;
            }

        }

        $("#tea-search").autocomplete({
            minLength: 0,
            source: "",
            focus: function (event, ui) {
                $("#tea-search").val(ui.item.label);
                $('#sid').val(ui.item.id);
                return false;
            },
            select: function (event, ui) {
                $("#tea-search").val(ui.item.label);
                $("#sid").val(ui.item.id);
                return false;
            }
        })
            .data("ui-autocomplete")._renderItem = function (ul, item) {
            $('.ul-li').parents('ul').addClass('show-ul-label');
            return $("<li class='ul-li'>")
                .append("<a class='show-label'>" + item.label + "</a>")
                .appendTo(ul);
        };

        $("#assistant-search").autocomplete({
            minLength: 0,
            source: "",
            focus: function (event, ui) {
                $("#assistant-search").val(ui.item.label);
                $('#sid').val(ui.item.id);
                return false;
            },
            select: function (event, ui) {
                $("#assistant-search").val(ui.item.label);
                $("#sid").val(ui.item.id);
                return false;
            }
        })
            .data("ui-autocomplete")._renderItem = function (ul, item) {
            $('.ul-li').parents('ul').addClass('show-ul-label');
            return $("<li class='ul-li'>")
                .append("<a class='show-label'>" + item.label + "</a>")
                .appendTo(ul);
        };

    </script>
@endsection
