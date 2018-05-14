@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
    <link rel="stylesheet" href="/bootstrap-table-master/dist/bootstrap-table.css">
    <style>
        .dis{
            display:none;
        }
    </style>

@endsection

@section('page-header')
    <h1>
        导航管理
        <small>一级导航</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">一级导航</h3>

            <div class="box-tools pull-right">
                <a href="{{route('admin.first.add')}}" class="btn btn-success btn-xs">新建一级导航</a>

            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->
        <div id="toolbar" class="btn-group">
        </div>
        <ul >
            @foreach($nav as $k=>$v)
            <li style="margin-bottom: 10px">
               <div class="navc"><a href="javascript:void(0)" class="nav1">{{$v->nav_name}}</a> <a href="{{url('admin/second/add')}}/{{$v->id}}"  class="addSec" style="margin-left: 20px;">添加子菜单</a><a href="{{url('admin/first/update')}}/{{$v->id}}" style="margin-left: 20px;">修改</a></div>
                <div class="dis" sid="{{$v->id}}">
                    <ul style="margin-left: 100px;">
                        @foreach($nav[$k]['son'] as $a=>$b)
                        <li style="margin-top: 10px">{{$b->nav_name}} <a href="{{url('admin/second/update')}}/{{$b->id}}" style="margin-left: 20px;">修改</a><a href="javascript:void(0)" class="removeSon" sid="{{$b->id}}" style="margin-left: 20px;">删除</a></li>
                        @endforeach
                    </ul>
                </div>
            </li>
            @endforeach

        </ul>
        <div class="box-body">
            <div class="table-responsive" >


            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}
    <script src="/bootstrap-table-master/dist/bootstrap-table.min.js"></script>
    <script src="/bootstrap-table-master/dist/locale/bootstrap-table-zh-CN.js"></script>
    <script src="/layui/layui.js" charset="utf-8"></script>
    <script>
        $('.nav1').click(function(){
           var th =  $(this).parent('.navc').siblings('div').hasClass('dis');
           if(th){
               $(this).parent('.navc').siblings('div').removeClass('dis')
           }else{
               $(this).parent('.navc').siblings('div').addClass('dis');
           }
        })
        $(function(){

            $('.removeSon').click(function(){
                var sid = $(this).attr('sid');
                var thiss = $(this);
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
                        url: '{{route('admin.second.delete')}}',
                        dataType: 'json',
                        data: {id:sid},
                        success: function (data) {
                            if (data.code == 2000) {
                                thiss.parent('li').remove();
                                swal("已删除!", "已成功删除.", "success");
                            }else{
                                swal("删除失败!", data.msg, "warning");
                            }
                        },
                        error: function (data) {

                        }
                    });
                });
            })


        })

    </script>
@endsection
