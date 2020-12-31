<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                @if (isset($title)){{$title}}@endif
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li  class="breadcrumb-item"><a href="{{asset('/admin')}}"><i class="fas fa-home"></i>{{$parent}}</a>  </li>
                @if (isset($local))
                    <li><a href="{{route('admin.local.index')}}"><i></i>{{$local}}</a></li>
                @endif
                @if (isset($slider))
                    <li><a href="{{route('admin.slider.index')}}"><i></i>{{$slider}}</a></li>
                @endif
                @if (isset($users))
                    <li><a href="{{route('admin.users.index')}}"><i></i>{{$users}}</a></li>
                @endif
                @if (isset($sections))
                    <li><a href="{{route('admin.sections.index')}}"><i></i>{{$sections}}</a></li>
                @endif
                @if (isset($menu))
                    <li><a href="{{route('admin.menu.index')}}"><i></i>{{$menu}}</a></li>
                @endif
                @if (isset($info))
                    <li><a href="{{route('admin.info.index')}}"><i></i>{{$info}}</a></li>
                @endif
                @if (isset($home))
                    <li><a href="{{route('admin.home.index')}}"><i></i>{{$home}}</a></li>
                @endif
                @if (isset($advantage))
                    <li><a href="{{route('admin.advantage.index')}}"><i></i>{{$advantage}}</a></li>
                @endif
                @if (isset($why))
                    <li><a href="{{route('admin.why.index')}}"><i></i>{{$why}}</a></li>
                @endif
                @if (isset($category))
                    <li><a href="{{route('admin.categories.index')}}"><i></i>{{$category}}</a></li>
                @endif
                @if (isset($posts))
                    <li><a href="{{route('admin.posts.index')}}"><i></i>{{$posts}}</a></li>
                @endif
                @if (isset($comments))
                    <li><a href="{{route('admin.comments.index')}}"><i></i>{{$comments}}</a></li>
                @endif
                @if (isset($filters))
                    <li><a href="{{route('admin.filters.index')}}"><i></i>{{$filters}}</a></li>
                @endif
                @if (isset($portfolios))
                    <li><a href="{{route('admin.portfolios.index')}}"><i></i>{{$portfolios}}</a></li>
                @endif
                @if (isset($feedback))
                    <li><a href="{{route('admin.feedback.index')}}"><i></i>{{$feedback}}</a></li>
                @endif
                @if (isset($currency))
                    <li><a href=""><i></i>{{$currency}}</a></li>
                @endif
                <li><i class="breadcrumb-item active"></i> {{$active}}</li>

            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

