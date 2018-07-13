@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.view'))

@section('page-header')
    <h1>
        医师管理
        <small>医师详情</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">医师详情</h3>

            <div class="box-tools pull-right">
                <a href="{{route('admin.paib.create')}}/{{$phy->id}}" class="btn btn-success btn-xs">新建排班</a>
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
                            <tbody id="add">
                            <tr>
                                <th>头像</th>
                                <td><img src="{{$phy->phy_picture}}"width="120px" height="180px" class="user-profile-image"></td>
                            </tr>

                            <tr>
                                <th>名字</th>
                                <td>{{$phy->phy_name}}</td>
                            </tr>
                            <tr class="pb">
                                <th>排班信息</th>
                                <td>
                                </td>
                            </tr>


                            </tbody></table>                    </div><!--tab overview profile-->


                </div>

            </div><!--tab panel-->

        </div><!-- /.box-body -->
    </div><!--box-->
@endsection
