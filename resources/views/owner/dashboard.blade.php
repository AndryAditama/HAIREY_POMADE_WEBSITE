@extends("layout/template")

@section("content")

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Customer</h4>
                </div>
                <div class="card-body">
                    {{ $customer }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Produk</h4>
                </div>
                <div class="card-body">
                    {{ $product }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-hourglass"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Transaksi Pending</h4>
                </div>
                <div class="card-body">
                    {{ $transaksi_pending }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-check"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Transaksi</h4>
                </div>
                <div class="card-body">
                    {{ $transaksi_all }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection