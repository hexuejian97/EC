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
                                <th>头像</th>
                                <td><img src="{{$phy->phy_picture}}"width="120px" height="180px" class="user-profile-image"></td>
                            </tr>

                            <tr>
                                <th>名字</th>
                                <td>{{$phy->phy_name}}</td>
                            </tr>
                            <tr>
                                <th>性别</th>
                                <td>{{$phy->sex}}</td>
                            </tr>
                            <tr>
                                <th>职称</th>
                                <td>{{$phy->phy_type}}</td>
                            </tr>

                            <tr>
                                <th>政治面貌</th>
                                <td>{{$phy->political_face}}</td>
                            </tr>

                            <tr>
                                <th>毕业院校</th>
                                <td>{{$phy->phy_school}}</td>
                            </tr>

                            <tr>
                                <th>学历</th>
                                <td>{{$phy->education}}</td>
                            </tr>

                            <tr>
                                <th>门店</th>
                                <td>{{$phy->phy_store}}</td>
                            </tr>
                            <tr>
                                <th>专业方向</th>
                                <td>{{$phy->phy_good_at}}</td>
                            </tr>

                            <tr>
                                <th>工作年限</th>
                                <td>{{$phy->phy_life}}</td>
                            </tr>
                            <tr>
                                <th>教育背景</th>
                                <td>{!! $phy->educational_bg !!}</td>
                            </tr>

                            <tr>
                                <th>临床医疗工作背景</th>
                                <td>{!! $phy->clinical_bg !!}</td>
                            </tr>
                            <tr>
                                <th>专业技能</th>
                                <td>{!! $phy->skills !!}</td>
                            </tr>

                            <tr>
                                <th>科研情况及发表文章情况</th>
                                <td>{!! $phy->research !!}</td>
                            </tr>
                            <tr>
                                <th>参与科研项目及培训</th>
                                <td>{!! $phy->research_project !!}</td>
                            </tr>

                            <tr>
                                <th>参与全国学术会议情况</th>
                                <td>{!! $phy->learning !!}</td>
                            </tr>
                            <tr>
                                <th>奖励与荣誉
                                </th>
                                <td>{!!$phy->honor  !!}</td>
                            </tr>



                            </tbody></table>                    </div><!--tab overview profile-->


                </div>

            </div><!--tab panel-->

        </div><!-- /.box-body -->
    </div><!--box-->
@endsection