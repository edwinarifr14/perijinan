@extends('layouts.app')

@section('title', 'List Produk')

@section('heads')
    <link rel="stylesheet" href="{{ url('/assets/css/home.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
          <div class="sidebar-categories mt-50">
            <!-- <a href="{{ url('/user/produkku') }}" class="w3-button w3-block w3-teal">Produk Saya</a> -->
            <a href="{{ url('/user/produkku') }}" class="btn btn-primary active btn-block" role="button" aria-pressed="true">Produk Saya</a>

            <br>
          </div>
            <div class="sidebar-categories">
                <div class="head">Kategori Produk</div>
                <ul class="main-categories">
                        <li class="main-nav-list">
                            <a href="{{ url('/produk') }}">Semua Kategori</a>
                        </li>
                    @foreach ($kategories->get() as $k)
                        <li class="main-nav-list">
                            <a href="{{ url("/produk?kategori={$k->kategori_id}") }}">{{ $k->kategori_nama }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>



            {{-- filter harga soon --}}
            {{-- <div class="sidebar-filter mt-50">
                <div class="top-filter-head">Filter Harga</div>
                <div class="common-filter">
                    <div class="head">Harga</div>
                    <div class="price-range-area">
                        <div id="price-range"></div>
                        <div class="value-wrapper d-flex">
                            <div class="price">Harga:</div>
                            <span>Rp.</span>
                            <div id="lower-value"></div>
                            <div class="to">-</div>
                            <span>Rp.</span>
                            <div id="upper-value"></div>
                        </div>
                        <br>
                        <div>
                            <a id="filter-harga" href="#" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Filter Harga</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center">
                @unless ($produks->onFirstPage())
                    <div class="pagination">
                        <a href="{{ $produks->previousPageUrl().$input }}" class="back-arrow">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>
                    </div>
                @endunless
                @if ($produks->hasMorePages())
                    <div class="pagination ml-auto">
                        <a href="{{ $produks->nextPageUrl().$input }}" class="next-arrow" style="float: right">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                @endif
            </div>
            <!-- End Filter Bar -->

            <!-- Start Best Seller -->
            <section class="lattest-product-area pb-40 category-list">
                <div class="row">
                    @foreach ($produks as $p)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                <img class="img-fluid" src="{{ $p->produk_gambar ? url('/uploads/images/produk/'.$p->produk_gambar) : url('/assets/img/no image2.jpg') }}" onerror="this.setAttribute('src', '{{ url('/assets/img/no image2.jpg') }}')">
                                <div class="product-details">
                                    <h6>{{ $p->produk_nama }}</h6>
                                    <p>{{ $p->kategori->kategori_nama }}</p>
                                    <div class="price">
                                        @if ($p->produk_stok !== 0)
                                            <h6>{{ rupiah($p->produk_harga) }}/{{ $p->kemasan->kemasan_kode }}</h6>
                                        @else
                                            <h6 style="color: crimson">STOK HABIS !</h6>
                                        @endif
                                    </div>
                                    <div class="prd-bottom">
                                        @if (isset(session('login')['pelanggan']))
                                            <a class="social-info" onclick="callCardModal({{ '\''.url('/user/keranjang').'/'.$p->produk_id.'\', '.$p->produk_stok }})" style="cursor: pointer">
                                                <span class="ti-bag"></span>
                                                <p class="hover-text">keranjang</p>
                                            </a>
                                        @endif
                                        <a href="{{ url("/produk/{$p->produk_id}") }}" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">detail</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            <!-- End Best Seller -->

            <div class="filter-bar d-flex flex-wrap align-items-center">
                @unless ($produks->onFirstPage())
                    <div class="pagination">
                        <a href="{{ $produks->previousPageUrl().$input }}" class="back-arrow">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>
                    </div>
                @endunless
                @if ($produks->hasMorePages())
                    <div class="pagination ml-auto">
                        <a href="{{ $produks->nextPageUrl().$input }}" class="next-arrow" style="float: right">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function callCardModal(url, stock) {
    $('#add-cart').attr('action', url);
    $('#cart-stock').val(1);
    $('#cart-stock').attr('max', stock);
    $('#cart-modal').modal('show');
}

$(function(){
    if(document.getElementById("price-range")){
        var nonLinearSlider = document.getElementById('price-range');

        noUiSlider.create(nonLinearSlider, {
            connect: true,
            behaviour: 'tap',
            start: [ {{ $prices['min'] }}, {{ $prices['max'] }} ],
            range: {
                // Starting at 500, step the value by 500,
                // until 4000 is reached. From there, step by 1000.
                'min': [ {{ $prices['min'] }} ],
                // '10%': [ 500, 500 ],
                // '50%': [ 4000, 1000 ],
                'max': [ {{ $prices['max'] }} ]
            }
        });

        var filterHarga = document.getElementById('filter-harga');

        var nodes = [
            document.getElementById('lower-value'), // 0
            document.getElementById('upper-value')  // 1
        ];

        // Display the slider value and how far the handle moved
        // from the left edge of the slider.
        nonLinearSlider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
            nodes[handle].innerHTML = values[handle];
        });

        filterHarga.addEventListener('click', function(ev) {
            ev.preventDefault();
            var min = nodes[0].textContent;
            var max = nodes[1].textContent;

        })
    }
})
</script>
@endsection
