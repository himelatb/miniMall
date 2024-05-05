<div class="container-fluid">
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">mini</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Mall</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="{{url('/search')}}" method="get">
                <div class="input-group">
                    <input type="text" class="form-control searchFilter" name="search" id="search" placeholder="Search for products">
                    <button class="input-group-append bg-transparent" style="border: 0;">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>