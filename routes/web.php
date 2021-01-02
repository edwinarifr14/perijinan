<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// super admin route
Route::middleware('checksuper')->group(function() {
    // process routes
    Route::post('/admin', 'AdminController@add');
    Route::delete('/admin/{id}', 'AdminController@delete');
    Route::delete('/admin/pelanggan/{id}','AdminController@deletePelanggan');
    Route::get('/admin/data', 'AdminController@datatables');

    // page routes
    Route::get('/admin/registeradmin', 'AdminController@register');
    Route::get('/admin/dataadmin', 'AdminController@list');
});


// admin route
Route::middleware('checkadmin')->group(function() {
    // process routes
    Route::put('/admin/{id}', 'AdminController@update');

    Route::get('/kategori/data', 'KategoriController@datatables');
    Route::post('/kategori', 'KategoriController@add');
    Route::put('/kategori/{id}', 'KategoriController@update');
    Route::delete('/kategori/{id}', 'KategoriController@delete');

    Route::get('/kemasan/data', 'KemasanController@datatables');
    Route::post('/kemasan', 'KemasanController@add');
    Route::put('/kemasan/{id}', 'KemasanController@update');
    Route::delete('/kemasan/{id}', 'KemasanController@delete');

    Route::get('/produk/data', 'ProdukController@datatables');
    Route::post('/produk', 'ProdukController@add');
    Route::put('/produk/{id}', 'ProdukController@update');
    Route::delete('/produk/{id}', 'ProdukController@delete');

    Route::get('/admin/pelanggan/topup', 'TransaksiController@datatablesTopUp');
    Route::get('/admin/pelanggan/data', 'AdminController@datatablesPelanggan');
    Route::get('/admin/pesanan/data', 'AdminController@datatablesPesanan');
    Route::get('/admin/datapelanggan','AdminController@listPelanggan');
    Route::get('/admin/datatopup','AdminController@listTopUp');
    Route::get('/admin/saldo/{id}','AdminController@konfTopUp');
    Route::put('/admin/conf/{id}','TransaksiController@updateTopUp');

    // page routes
    Route::get('/admin/pesanan', 'PesananController@listPage');
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/kategori/add', 'KategoriController@addPage');
    Route::get('/admin/kategori', 'KategoriController@listPage');
    Route::get('/admin/kemasan/add', 'KemasanController@addPage');
    Route::get('/admin/kemasan', 'KemasanController@listPage');
    Route::get('/admin/produk/add', 'ProdukController@addPage');
    Route::get('/admin/produk', 'ProdukController@listPage');
    Route::get('/admin/produk/{id}', 'ProdukController@editPage');
});

// user pelanggan route
Route::middleware('checkuser')->group(function() {
    // process route
    Route::post('/user/keranjang/{id}','PelangganController@simpanProdukKeKeranjang');
    Route::get('/user/keranjang/delete/{keranjang_id}','PelangganController@buangProdukDariKeranjang');

    // page route

    Route::get('/produk/datauser', 'ProdukController@datatablesUser');
    Route::get('/user/produkku/tambah', 'ProdukController@addPageUser');

    Route::get('/user/produkku', 'ProdukController@listPageUser');
    Route::get('/user/produkku/{id}', 'ProdukController@editPageUser');
    Route::put('/produkku/{id}', 'ProdukController@updateUser');
    Route::delete('user/produkku/{id}', 'ProdukController@deleteUser');
    Route::get('/user/{id}/edit', 'ProdukController@editPageUser');
    Route::post('/user/produk', 'ProdukController@addUser');

    Route::get('/user/{id}/sukses', 'PesananController@sukses');
    Route::get('/user/{id}/pengemasan', 'PesananController@pengemasan');
    Route::get('/user/{id}/pengiriman', 'PesananController@pengiriman');

    Route::put('/user/{id}', 'PelangganController@update');
    Route::put('/user/saldo/{id}', 'TransaksiController@confSaldo');
    Route::post('/user/saldo/req', 'TransaksiController@addSaldo');
    Route::get('/user/delete', 'PelangganController@deleteAccountPage');
    Route::get('/user/keranjang','PelangganController@keranjang');
    Route::get('/user/profil', 'PelangganController@profilPage');
    Route::get('/cityprofil', 'PelangganController@city');
    Route::get('/user/saldo', 'PelangganController@saldoPage');
    Route::get('/user/saldo/konfirmasi', 'PelangganController@saldoKonfPage');
    Route::get('/user/pesanan', 'PesananController@pesananPage');
    Route::get('/user/penjualan', 'PesananController@PenjualanPage');
    Route::get('/user/alamatPembelian', 'PelangganController@alamatPembelian');
    Route::post('/user/ongkir', 'PelangganController@ongkirPage');
    Route::post('/user/ongkir/simpan', 'PesananController@addpesanan');
});

// admin and user route
Route::middleware('checkuseradmin')->group(function() {
    Route::put('/user/{id}', 'PelangganController@update');
    Route::delete('/user/{id}', 'PelangganController@delete');
});

Route::get('/logout/{entity}', 'Auth\LogoutController@index');
Route::post('/user/register', 'PelangganController@register');
Route::post('/user/login', 'PelangganController@auth');
Route::post('/admin/login', 'AdminController@auth');

// route guest
Route::get('/', 'HomeController@index');
Route::get('/getprovince', 'HomeController@getprovince');
Route::get('/getcity', 'HomeController@getcity');
Route::get('/checkshipping', 'HomeController@checkshipping');
Route::post('/processShipping', 'HomeController@processShipping');
Route::get('/produk', 'HomeController@produkPage');
Route::get('/contact', 'HomeController@kontakPage');
Route::get('/login', 'HomeController@login');
Route::get('/city', 'HomeController@city');
Route::get('/register', 'HomeController@register');
Route::get('/admin/login', 'AdminController@login');

Route::get('/coba', 'HomeController@coba');
Route::post('/tes', 'HomeController@tes');
// route produk
Route::get('/produk/{produk_id}', 'ProdukController@detailProduk');
