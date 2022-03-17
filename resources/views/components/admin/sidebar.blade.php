<div class="sidebar">
    <div class="brand px-20">
        <a href="#">
            <img src="{{ asset('images/logo.webp') }}" alt="logo" />
        </a>
    </div>
    <div>
        <ul class="sidebar__menu">
            <li>
                <a href="{{ route('admin.users.index') }}" class="nav__link active">
                    <i class="fa-solid fa-image-portrait pr-10"></i>
                    Users
                </a>
            </li>
            <li>
                <a href="#" class="nav__link">
                    <i class="fa-solid fa-file-lines pr-10"></i>
                    Pages
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a  href="{{ route('logout') }}" class="nav__link" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fa-solid fa-power-off pr-10"></i>
                        Logout
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>
