@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.view'))

@section('page-header')
    <h1>
        连锁店管理
        <small>连锁店详情</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">连锁店详情</h3>

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
                                <th>门店名称</th>
                                <td>{{$store->store_name}}</td>
                            </tr>

                            <tr>
                                <th>门店地址</th>
                                <td>{{$store->store_address}}</td>
                            </tr>

                            <tr>
                                <th>门店简介</th>
                                <td>{{$store->store_intro}}</td>
                            </tr>

                            <tr>
                                <th>门店交通</th>

                                <td>@foreach($store->traffic as $k=>$v){{$v->store_traffic}}@endforeach</td>

                            </tr>

                            <tr>
                                <th>联系方式</th>
                                <td>{{$store->store_tel}}</td>
                            </tr>
                            <tr>
                                <th>门店照片</th>
                                <td>@foreach($store->public as $k=>$v)<img src="{{$v->public_picture}}" width="100px" height="80px" style="margin-left: 10px">@endforeach</td>
                            </tr>
                            </tbody></table>                    </div><!--tab overview profile-->


                </div>

            </div><!--tab panel-->

        </div><!-- /.box-body -->
    </div><!--box-->
@endsection