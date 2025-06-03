<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            HealthCare
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @if(Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/articles*') ? 'active' : '' }}" href="{{ route('admin.articles.index') }}">
                            <i class="fas fa-newspaper me-1"></i> Artikel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/health-assessments*') ? 'active' : '' }}" href="{{ route('admin.health-assessments.index') }}">
                            <i class="fas fa-heartbeat me-1"></i> Tes Kesehatan
                        </a>
                    </li>
                @elseif(Auth::user()->role == 'doctor')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('doctor/dashboard') ? 'active' : '' }}" href="{{ route('doctor.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('doctor/schedule*') ? 'active' : '' }}" href="{{ route('doctor.schedule') }}">
                            <i class="fas fa-calendar-alt me-1"></i> Jadwal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('chat*') ? 'active' : '' }}" href="{{ route('chat.index') }}">
                            <i class="fas fa-comments me-1"></i> Chat
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('appointments*') ? 'active' : '' }}" href="{{ route('appointments.create') }}">
                            <i class="fas fa-calendar-plus me-1"></i> Buat Janji
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('forum*') ? 'active' : '' }}" href="{{ route('forum.index') }}">
                            <i class="fas fa-comments me-1"></i> Forum
                        </a>
                    </li>
                @endif
            </ul>
            
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-cog me-1"></i> Profil
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>