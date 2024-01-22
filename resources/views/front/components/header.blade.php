<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light">

        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Navbar
            </a>

            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nivel 1 sin dropdown</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Nivel 1</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#">Nivel 2 &raquo</a>
                                <ul class="submenu dropdown-menu">
                                    <li><a class="dropdown-item" href="">Nivel 3</a></li>
                                    <li><a class="dropdown-item" href="">Nivel 3</a></li>
                                    <li><a class="dropdown-item" href="">Nivel 3</a></li>
                                    <li><a class="dropdown-item" href="">Nivel 3</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Nivel 2</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown has-megamenu">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Mega menu</a>
                        <div class="dropdown-menu megamenu" role="menu">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu One</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div>  <!-- col-megamenu.// -->
                                    </div><!-- end col-3 -->
                                    <div class="col-md-3">
                                        <div class="col-megamenu">
                                        <h6 class="title">Title Menu Two</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div>  <!-- col-megamenu.// -->
                                    </div><!-- end col-3 -->
                                    <div class="col-md-3">
                                        <div class="col-megamenu">
                                        <h6 class="title">Title Menu Three</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div>  <!-- col-megamenu.// -->
                                    </div>    
                                    <div class="col-md-3">
                                        <div class="col-megamenu">
                                        <h6 class="title">Title Menu Four</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div>  <!-- col-megamenu.// -->
                                    </div><!-- end col-3 -->
                                </div><!-- end row --> 
                            </div>
                        </div> <!-- dropdown-mega-menu.// -->
                    </li>
                </ul>
            </div>
        </div>
        
    </nav>
</header>