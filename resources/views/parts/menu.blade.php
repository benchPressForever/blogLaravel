<ul class="navbar-nav me-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index') }}">Посты</a>
    </li>

    @auth()
        @if(Auth::user()->is_admin)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">Админка</a>
            </li>
        @endif
        @else
        <a    class="btn btn-primary w-auto AdminButton ">
            Стать админом
        </a>
    @endauth
</ul>
