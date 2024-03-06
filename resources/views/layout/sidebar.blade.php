<ul class="navbar-nav bg-sidebar-personalized sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mesa Partes</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item {{ Request::is('incidencias') || Request::is('incidenciasose') ? 'active' : ''}} ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-file-excel"></i>
            <span>Soporte</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('incidencias') ? 'active' : ''}}" href="{{ route('incidencias.list')}}">Incidencias</a>
                <a class="collapse-item {{ Request::is('incidenciasose') ? 'active' : ''}}" href="{{ route('incidenciasose.list')}}">Incidencias OSE</a>
                <a class="collapse-item {{ Request::is('api') ? 'active' : ''}}" href="{{ route('api')}}">Consulta API</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item {{ Request::is('usuarios') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Sistema</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('usuarios') ? 'active' : ''}}" href="{{ route('usuarios')}}">Usuarios</a>
            </div>
        </div>
    </li>
</ul>
