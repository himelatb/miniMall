<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">mini</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Mall</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <div class="nav-item dropdown">
                            <button style="height: 65px" type="button" class="btn d-flex align-items-center justify-content-between bg-primary w-100">
                                <h6 class="text-dark m-0 pr-5"><i class="fa fa-bars mr-2"></i> Categories</h6><i class="fa fa-angle-down text-dark"></i>
                            </button>
                            @if(isset($categories) && !empty($categories))
                            <div class="dropdown-menu">
                                <x-indexcategories :categories="$categories"/>
                            </div> 
                            @endif
                        </div>
                        <a href="{{url('/miniMall')}}" class="nav-item nav-link">Home</a>
                        <a href="#" class="nav-item nav-link">Shop</a>
                        <a href="#" class="nav-item nav-link">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down mt-1"></i></a>
                            <div class="dropdown-menu bg-primary rounded-0 border-0 m-0" style="left: auto;">
                                <a href="#" class="dropdown-item">Shopping Cart</a>
                                <a href="#" class="dropdown-item">Checkout</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="" class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                        </a>
                        <a href="" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>