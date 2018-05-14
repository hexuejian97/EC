@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
    <link rel="stylesheet" href="/bootstrap-table-master/dist/bootstrap-table.css">

@endsection

@section('page-header')
    <h1>
        预约管理
        <small>预约列表</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">预约列表</h3>

            <div class="box-tools pull-right">

            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->
        <div id="toolbar" class="btn-group">
            <div class="form-inline" role="form">
                <div class="form-group">
                    <label for="" ><span> &nbsp; &nbsp;病人名：</span><input class="form-control ss" type="text" name="name" placeholder="" ></label>
                    <label for="" ><span> &nbsp; &nbsp; &nbsp;手机号：</span><input class="form-control ss" type="text" name="phone" placeholder="" ></label>
                    <label for="" ><span> &nbsp; &nbsp; 预约时间：</span><input class="form-control ss" type="text" name="time" placeholder="" id="test5"></label>
                    <br>

                    <label for="" >
                        <span> &nbsp; &nbsp;门 &nbsp;店：</span>

                        <select class="form-control ss" name="store" id="">
                            <option value="">请  选  择</option>
                            @foreach($store as $k=>$v)
                                <option value="{{$v->id}}">{{$v->store_name}}</option>
                            @endforeach
                        </select>
                    </label>
                    <label for="" >
                        <span> &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;医生姓名：</span>

                        <select class="form-control ss" name="phy" id="">
                            <option value="">请  选  择</option>
                            @foreach($phy as $k=>$v)
                                <option value="{{$v->id}}">{{$v->phy_name}}</option>
                            @endforeach
                        </select>
                    </label>
                    <button id="search" type="submit" class="btn btn-default" style="margin-left: 52px">查&nbsp; &nbsp; &nbsp; &nbsp;询</button>

                    {{--批量操作--}}
                </div>
            </div>
        </div>


        <div class="box-body">
            <div class="table-responsive" >

                <table  id="table"  data-toggle="table" data-url="{{route('admin.order.data')}}" data-toolbar="#toolbar"
                        {{--data-click-to-select="true"--}}
                        data-show-refresh="true"
                        data-show-toggle="true"
                        data-side-pagination="server"
                        data-pagination="true"
                        data-sort-order="desc"
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
                        <th data-field="id" data-sort-name="id" data-align="center">ID</th>
                        <th data-field="order_name"  data-align="center">病人姓名</th>
                        <th data-field="order_tel"  data-align="center">病人联系方式</th>
                        <th data-field="order_time"  data-align="center">预定时间</th>
                        <th data-field="store_name" data-align="center">预定门店</th>
                        <th data-field="phy_name"   data-align="center">预定医生</th>
                        <th data-field="order_num"  data-align="center">病历号</th>
                        <th data-field="order_sure" data-formatter="actionFormatter" data-events="actionEvents">状态</th>
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
    <script type="text/javascript" src="/layDate-v5.0.7/laydate/laydate.js"></script>

    <script>
        laydate.render({
            elem: '#test5'
            ,type: 'datetime'
        });
        $(function() {
            var $table = $('#table');
            //点击执行搜索
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
                var key = $('input[name="time"]').val();
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
                            url: '{{route('admin.physician.delete')}}',
                            dataType: 'json',
                            data: {id:row.id},
                            success: function (data) {

                                if (data.code == 2000) {
                                    $('#table').bootstrapTable('remove', {field: 'id', values: [row.id]});
                                    swal("已删除!", "已成功删除.", "success");
                                }
                            },
                            error: function (data) {
                                $('#table').bootstrapTable('remove', {field: 'id', values: [row.id]});
                                swal("已删除!", "已成功删除.", "success");
                            }
                        });
                    });
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

        function avatarFormatter(value, row, index){
            var dde = '<img src="'+value+'" width="50px" height="50px"/>';
            return dde;
        }

        function actionFormatter(value, row, index) {
            var ddf = '<a href="javascript:void(0)" class="btn btn-xs btn-primary "> ' +
                '<i class="fa  " data-toggle="tooltip" data-placement="top" ' +
                'data-toggle="tooltip" data-placement="top" title="正常">正常</i></a>&nbsp;&nbsp;';
            var ddq = '<a href="javascript:void(0)" class="btn btn-xs btn-primary "> ' +
                '<i class="fa  " data-toggle="tooltip" data-placement="top" ' +
                'data-toggle="tooltip" data-placement="top" title="已取消">已取消</i></a>&nbsp;&nbsp;';



            /*if(row.status == '已发布'){
                var freeze = ''
                return del+' '+freeze;

            }else if(row.status = '草稿'){
                var freeze = ''
                //return edit+' '+freeze+' '+del;
            }*/
            if(row.order_sure==1){
                return ddf;

            }else{
                return ddq;

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
