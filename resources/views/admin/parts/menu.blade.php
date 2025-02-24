<ul class="navbar-nav me-auto">

    <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.index')) active @endif" href="{{ route('admin.index') }}">Админка</a>
    </li>

   <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.posts.index')) active @endif" href="{{ route('admin.posts.index') }}">Посты</a>
    </li>

   <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.categories.index')) active @endif" href="{{ route('admin.categories.index') }}">Категории</a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.users.index')) active @endif" href="{{ route('admin.users.index') }}">Пользователи</a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.comments.index')) active @endif" href="{{ route('admin.comments.index') }}">Комментарии</a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.complaints.index')) active @endif" href="{{ route('admin.complaints.index') }}">Жалобы</a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.reasons.index')) active @endif" href="{{ route('admin.reasons.index') }}">Причины</a>
    </li>

</ul>
