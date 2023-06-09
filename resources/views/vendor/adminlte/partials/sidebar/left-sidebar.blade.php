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
                <a href="{{ URL('/') }}/{{ $PREFIX }}/edit-user/{{Session::get('user')[0]->codhash}}" class="d-block">{{Session::get('user')[0]->name}}</a>
            </div>
        </div>

        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <li class="nav-header">
                    Empresa
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIX }}/company-create">
                        <i class="fas fa-fw fa-arrow-circle-right"></i>
                        <p>
                            Cadastrar Empresa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIX }}/company-control">
                        <i class="fas fa-fw fa-arrow-circle-right"></i>
                        <p>
                            Controle de Empresa
                        </p>
                    </a>
                </li>

                <li class="nav-header">
                    Categoria
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIX }}/category-create">
                        <i class="fas fa-fw fa-arrow-circle-right"></i>
                        <p>
                            Cadastrar Categoria
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIX }}/category-control">
                        <i class="fas fa-fw fa-arrow-circle-right"></i>
                        <p>
                            Controle de Categoria
                        </p>
                    </a>
                </li>

                <li class="nav-header">
                    Nofa Fiscal
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIX }}/invoice-create">
                        <i class="fas fa-fw fa-arrow-circle-right"></i>
                        <p>
                            Cadastrar Nota Fiscal
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIX }}/invoice-control">
                        <i class="fas fa-fw fa-arrow-circle-right"></i>
                        <p>
                            Controle de Nota Fiscal
                        </p>
                    </a>
                </li>

                <li class="nav-header">
                    Despesas
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIX }}/expense-create">
                        <i class="fas fa-fw fa-arrow-circle-right"></i>
                        <p>
                            Cadastrar Despesas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIX }}/expense-control">
                        <i class="fas fa-fw fa-arrow-circle-right"></i>
                        <p>
                            Controle de Despesas
                        </p>
                    </a>
                </li>

                
                <li class="nav-header">
                    MEI
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIX }}/mei-control">
                        <i class="fas fa-fw fa-arrow-circle-right"></i>
                        <p>
                            Controle de MEI
                        </p>
                    </a>
                </li>

                <li class="nav-header">
                    Usuário
                </li>
                <!--li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8000/admin/settings">
                        <i class="fas fa-fw fa-arrow-circle-right"></i>
                        <p>
                            Cadastrar
                        </p>
                    </a>
                </li-->

                <li class="nav-item">
                    <a class="nav-link" href="{{ URL('/') }}/{{ $PREFIX }}/edit-user/{{Session::get('user')[0]->codhash}}">
                        <i class="fas fa-fw fa-arrow-circle-right"></i>
                        <p>
                            Configuração de Alerta
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</aside>