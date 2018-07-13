@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.view'))

@section('page-header')
    <h1>
        服务项目-菜单管理
        <small>菜单管理详情</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">菜单管理详情</h3>

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
                                <th>标题</th>
                                <td>{{$project->title}}</td>
                            </tr>
                            <tr>
                                <th>简介</th>
                                <td>{{$project->intro}}</td>
                            </tr>
                            <tr>
                                <th>上级菜单</th>
                                <td>{{$project->prent_id}}</td>
                            </tr>
                            <tr>
                                <th>内容</th>
                                <td>{!!$project->content  !!}</td>
                            </tr>
                            </tbody></table>                    </div><!--tab overview profile-->


                </div>

            </div><!--tab panel-->

        </div><!-- /.box-body -->
    </div><!--box-->
@endsection