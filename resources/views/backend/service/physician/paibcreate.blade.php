@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.create'))

@section('page-header')
    <h1>
        {{ trans('新建医师') }}
        <small>{{ trans('新建医师') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.paib.addpaibdata', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('新建医师') }}</h3>

            <div class="box-tools pull-right">

            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body" id="add">
            <input type="hidden" name="id" value="{{$data['id']}}">
            <div class="form-group">
                {{ Form::label('last_name', '姓名',['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-6">
                    {{$data['phy_name']}}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('last_name', '姓名',['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-6">
                    <tr>
                        <td><img src="{{$data['phy_picture']}}"width="120px" height="180px" class="user-profile-image"></td>
                    </tr>
                </div>
            </div>
            @if($data['paib']==1)
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">排班信息</label>
                    <div class="col-lg-6">
                        <label for="" ><span> &nbsp; &nbsp; 预约开始时间：</span><input class="form-control ss test1 {{'str'.$data['time']}}" onclick="times({{'str'.$data['time']}})"  start="test1" type="text"  name="time{{$data['time']}}[]" placeholder="" ></label>-
                        <label for="" ><span> &nbsp; &nbsp; 预约结束时间：</span><input class="form-control ss test2 {{'end'.$data['time']}}"  start="test2" onclick="times({{'end'.$data['time']}})" type="text"  name="time{{$data['time']}}[]" placeholder="" ></label>
                        <input type="hidden" name="times[]" value="{{$data['time']}}">
                        <label for=""  num="" ><span class="addpb" pbinfo="1"  style="color: green;font-size: 25px;cursor: pointer">+</span>&nbsp;&nbsp;&nbsp;<span class="delpb" pbinfo="1"  style="color:red;font-size: 24px;cursor: pointer">x</span></label>
                    </div><!--col-lg-10-->
                </div>
            @else
                @foreach($data['paib'] as $k=>$v)
                    <div class="form-group">
                    <label for="" class="col-lg-2 control-label">排班信息</label>
                    <div class="col-lg-6">
                        <label for="" ><span> &nbsp; &nbsp; 预约开始时间：</span><input class="form-control ss test1 {{'str'.$k}}" onclick="times({{'str'.$k}})"  start="test1" type="text" value="{{$v[0]}}" name="time{{$data['time'].$k}}[]" placeholder="" ></label>-
                        <label for="" ><span> &nbsp; &nbsp; 预约结束时间：</span><input class="form-control ss test2 {{'end'.$k}}"  start="test2" onclick="times({{'end'.$k}})" type="text" value="{{$v[1]}}" name="time{{$data['time'].$k}}[]" placeholder="" ></label>
                        <input type="hidden" name="times[]" value="{{$data['time'].$k}}">
                        <label for=""  num="" ><span class="addpb" pbinfo="1"  style="color: green;font-size: 25px;cursor: pointer">+</span>&nbsp;&nbsp;&nbsp;<span class="delpb" pbinfo="1"  style="color:red;font-size: 24px;cursor: pointer">x</span></label>
                    </div><!--col-lg-10-->
                </div>
                @endforeach
            @endif
        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                {{ link_to_route('admin.physician.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
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
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}
    <script src="/bootstrap-table-master/dist/bootstrap-table.min.js"></script>
    <script src="/bootstrap-table-master/dist/locale/bootstrap-table-zh-CN.js"></script>
    <script type="text/javascript" src="/layDate-v5.0.7/laydate/laydate.js"></script>
    <script  src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
    <script>
        $(function(){
            $('.addpb').click(function(){
                var time=new Date().getTime();
                var start ='str'+ new Date().getTime();
                var end = 'end'+ new Date().getTime();
                var str = '';
                str+='<div class="form-group"><label for="" class="col-lg-2 control-label">排班</label><div class="col-lg-6">';
                str+='<label for="" ><span> &nbsp; &nbsp; 预约开始时间：</span><input class="form-control ss test1 '+start+'" star="'+start+'" type="text" name="time'+time+'[]" onclick="time(\''+start+'\')" placeholder="" ></label>-';
                str+='<label for="" ><span> &nbsp; &nbsp; 预约结束时间：</span><input class="form-control ss test2 '+end+'" star="'+end+'" type="text" name="time'+time+'[]" onclick="time(\''+end+'\')" placeholder="" ></label>';
                str+='<label for="" ><span onclick="delpd()" class="delpb" pbinfo="1" style="font-size: 25px;cursor: pointer">x</span></label></div></div>';
                str+='<input type="hidden" name="times[]" value="'+time+'" />'
                $('#add').append(str);
            });
            $('.delpb').live('click',function(){
                $(this).parent().parent().parent('.form-group').remove()
            })
        });
        laydate.render({
            elem: "{{'.str'.$data['time']}}",
            trigger: 'click',
            type: 'datetime'
        });
        laydate.render({
            elem: "{{'.end'.$data['time']}}",
            trigger: 'click',
            type: 'datetime'
        });
        @if($data['paib']!==1)
            @foreach($data['paib'] as $k=>$v)
                laydate.render({
                    elem: "{{'.str'.$k}}",
                    trigger: 'click',
                    type: 'datetime'
                });
                laydate.render({
                    elem: "{{'.end'.$k}}",
                    trigger: 'click',
                    type: 'datetime'
                });
            @endforeach
        @else
            laydate.render({
                elem: "{{'.str'}}",
                trigger: 'click',
                type: 'datetime'
            });
            laydate.render({
                elem: "{{'.end'}}",
                trigger: 'click',
                type: 'datetime'
            });
        @endif
        function time(val){
            laydate.render({
                elem: '.'+''+val+'',
                type: 'datetime',
                show: true
            });
        }
    </script>
@endsection