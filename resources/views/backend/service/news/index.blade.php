@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
    <link rel="stylesheet" href="/bootstrap-table-master/dist/bootstrap-table.css">
    <link href="/select2/select2.css" rel="stylesheet" />

@endsection

@section('page-header')
    <h1>
        新闻管理
        <small>新闻列表</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">新闻列表</h3>
            <div class="box-tools pull-right">
                <a href="{{route('admin.news.add')}}" class="btn btn-success btn-xs">新建新闻</a>
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->
        <div id="toolbar" class="btn-group">
            <div class="form-inline" role="form">
                <div class="form-group">
                    <select class="select2" name="name">
                        <option value="" >请选择区域</option>
                        @foreach($nt as $k=>$v)
                            <option value="{{$v->id}}">{{$v->nt_name}}</option>
                        @endforeach
                    </select>
                    <button id="search" type="submit" class="btn btn-default" style="margin-left: 52px">查&nbsp; &nbsp; &nbsp; &nbsp;询</button>
                    {{--批量操作--}}
                </div>
            </div>
        </div>

        <div class="box-body">
            <div class="table-responsive" >

                <table  id="table"  data-toggle="table" data-url="{{route('admin.news.data')}}" data-toolbar="#toolbar"
                        {{--data-click-to-select="true"--}}
                        data-show-refresh="true"
                        data-show-toggle="true"
                        data-side-pagination="server"
                        data-pagination="true"
                        data-page-size="10"
                        data-page-list="[10, 20, 30, 40]"
                        data-pagination-first-text="第一页"
                        data-pagination-pre-text="上一页"
                        data-pagination-next-text="下一页"
                        data-pagination-last-text="最后一页"
                        data-query-params="getQueryParams" style="overflow: scroll" >
                    <thead >
                    <tr>
                        <th data-field="" data-checkbox="true"></th>
                        <th data-field="index" data-formatter="getidnex"  data-sort-name="id" data-sort-order="desc" data-align="center">ID</th>
                        <th data-field="news_title"  data-align="center">新闻标题</th>
                        <th data-field="nt_name"  data-align="center">新闻类型</th>
                        <th data-field="news_intro"  data-align="center">简介</th>
                        <th data-formatter="actionFormatter" data-events="actionEvents">操作</th>
                    </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

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
