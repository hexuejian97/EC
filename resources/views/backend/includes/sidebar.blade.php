<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->full_name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->

        <!-- search form (Optional) -->
        {{ Form::open(['route' => 'admin.search.index', 'method' => 'get', 'class' => 'sidebar-form']) }}
        <div class="input-group">
            {{ Form::text('q', Request::get('q'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('strings.backend.general.search_placeholder')]) }}

            <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span><!--input-group-btn-->
        </div><!--input-group-->
    {{ Form::close() }}
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            {{--<li class="header">{{ trans('menus.backend.sidebar.general') }}</li>--}}

            {{--<li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}">--}}
                {{--<a href="{{ route('admin.dashboard') }}">--}}
                    {{--<i class="fa fa-dashboard"></i>--}}
                    {{--<span>{{ trans('menus.backend.sidebar.dashboard') }}</span>--}}
                {{--</a>--}}
            {{--</li>--}}

            <li class="header">{{ trans('menus.backend.sidebar.system') }}</li>

            @role(1)
            <li class="{{ active_class(Active::checkUriPattern('admin/access/*')) }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('权限模块') }}</span>

                    @if ($pending_approval > 0)
                        <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                    @else
                        <i class="fa fa-angle-left pull-right"></i>
                    @endif
                </a>
                  <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                       <!-- 接口路径 -->
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('权限管理') }}</span>
                        </a>
                    </li>

                </ul>

            </li>
            @endauth
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>首页模块</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.carousel.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>轮播图管理</span>
                        </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.hotspot.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>热点管理</span>
                        </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.newtop.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>资讯置顶管理</span>
                        </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('admin.latestnews.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>最新活动管理</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>资讯模块</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                       <!-- 接口路径 -->
                        <a href="{{ route('admin.news.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('新闻管理') }}</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>赛事模块</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                 <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('admin.news.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('赛事管理') }}</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>活动模块</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('admin.activity.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('活动管理') }}</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>视频模块</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                  <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('admin.video.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>视频管理</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>用户模块</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('admin.physician.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>用户详情</span>
                        </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('admin.phy_type.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>积分详情</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>学生认证审核</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

            </li>
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>积分模块</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('admin.news.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>积分录入</span>
                        </a>
                    </li>
                      <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('admin.news_type.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>历史录入</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>
