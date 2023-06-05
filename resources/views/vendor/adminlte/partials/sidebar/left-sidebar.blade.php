<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
    @include('adminlte::partials.common.brand-logo-xl')
    @else
    @include('adminlte::partials.common.brand-logo-xs')
    @endif


    {{-- Sidebar menu --}}
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{  URL::asset('img/user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Session::get('usuario')[0]->nome_completo}}</a>
            </div>
        </div>

        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <li class="nav-header">

                    Nofa Fiscal

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIXO }}/cadastro-nf">

                        <i class="fas fa-fw fa-user"></i>

                        <p>
                            Cadastrar

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIXO }}/controle-nf">

                        <i class="fas fa-fw fa-user"></i>

                        <p>
                            Controle

                        </p>

                    </a>

                </li>

                <li class="nav-header">

                    Empresa

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIXO }}/cadastro-empresa">

                        <i class="fas fa-fw fa-user"></i>

                        <p>
                            Cadastrar

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIXO }}/controle-empresa">

                        <i class="fas fa-fw fa-user"></i>

                        <p>
                            Controle

                        </p>

                    </a>

                </li>

                <li class="nav-header">

                    Usuário

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="http://127.0.0.1:8000/admin/settings">

                        <i class="fas fa-fw fa-user"></i>

                        <p>
                            Cadastrar

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="http://127.0.0.1:8000/admin/settings">

                        <i class="fas fa-fw fa-user"></i>

                        <p>
                            Controle

                        </p>

                    </a>

                </li>

            </ul>
        </nav>
    </div>

</aside>