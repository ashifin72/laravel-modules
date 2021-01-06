<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.index')}}" class="brand-link">
        <img src="{{asset('assets/admin/img/logo-mini.png')}}" alt="Админи панель проекта" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{__('admin.title')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(Auth::user()->img == null)
                    <img class="img-circle elevation-2" alt="{{ Auth::user()->name }}" src="{{asset('/assets/img-admin/logo-mini.png')}}"
                         alt="{{Auth::user()->name}}">
                @else <img class="img-circle elevation-2" alt="{{ Auth::user()->name}}" src="{{asset('/storage/' . Auth::user()->img)}}" alt="{{ Auth::user()->name}}">
                @endif

            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.info.edit', 1) }}" class="nav-link">
                        <i class="nav-icon  fas fa-info-circle text-danger"></i>
                        <p>
                            {{__('admin.info')}}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.locales.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-globe-africa"></i>
                        <p>
                            {{__('admin.locales')}}

                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="{{route('admin.menus.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>
                            {{__('admin.menus_site')}}
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>
                            {{__('admin.blog')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.posts.index')}}" class="nav-link">
                                <i class="far fa-address-card"></i>
                                <p>{{__('admin.article_blog')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.categories.index')}}" class="nav-link">
                                <i class="far fa-calendar-alt"></i>
                                <p>{{__('admin.categories_blog')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.tags.index')}}" class="nav-link">
                                <i class="fas fa-tags"></i>
                                <p>{{__('blog.tags')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.comments.index')}}" class="nav-link">
                                <i class="far fa-comments"></i>
                                <p>{{__('admin.title_comments')}}</p>
                            </a>
                        </li>

                    </ul>
{{--                </li>--}}
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-bars"></i>--}}
{{--                        <p>--}}
{{--                            {{__('admin.portfolio')}}--}}
{{--                            <i class="right fas fa-angle-left"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('admin.portfolios.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>{{__('admin.portfolio_article')}}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('admin.filters.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>{{__('admin.portfolio_filter')}}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('admin.feedback.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>{{__('admin.feedback')}}</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a href=""class="nav-link">
                        <i class="nav-icon fa fa-address-card text-info"></i>
                        <p>{{ __('admin.sections') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.users.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-user text-info"></i>
                        <p>{{ __('admin.users') }}</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt text-info"></i> <p> {{ __('admin.exit') }}</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
