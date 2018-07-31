@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.view'))

@section('page-header')
    <h1>
        活动详情
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">活动详情</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">

            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">详情</a>
                    </li>

                </ul>

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane mt-30 active" id="overview">
                        <table class="table table-striped table-hover">
                            <tbody><tr>
                                <th>活动名称</th>
                                <td>{{$act->act_title}}</td>
                            </tr>
                            <tr>
                                <th>活动起止时间</th>
                                <td>{{$act->act_stime}}</td>
                                <td>{{$act->act_etime}}</td>
                            </tr>
                            <tr>
                                <th>创建时间</th>
                                <td>{{$act->created_at}}</td>
                            </tr>
                             <tr>
                                <th>更新时间</th>
                                <td>{{$act->updated_at}}</td>
                            </tr>
                            <tr>
                                <th>活动封图</th>
                                <td>{{$act->act_picture}}</td>
                            </tr>
                            </tbody></table>                    </div><!--tab overview profile-->


                </div>

            </div><!--tab panel-->

        </div><!-- /.box-body -->
    </div><!--box-->
     <div class="box box-info">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.news.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->
                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->
@endsection
