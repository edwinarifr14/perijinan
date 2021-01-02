<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;
use App\Province;
use App\City;

class HomeController extends Controller {

    public function index() {
      return redirect('/admin/login');
    }

    public function produkPage() {
        $idKategori = Input::get('kategori');
        $search = Input::get('search-key');
        $kategories = Kategori::getAll();
        $produk = Produk::with(['kategori', 'kemasan'])->orderBy('produk_id', 'DESC');
        $result = [
            'input' => '',
            'kategories' => $kategories,
            'prices' => [
                'max' => Produk::max('produk_harga'),
                'min' => Produk::min('produk_harga')
            ]
        ];

        if ($idKategori) {
            $result['input'] = "&kategori={$idKategori}";
            $result['produks'] = $produk->where('produk_kategori', '=', $idKategori)->simplePaginate(12);
        } else if ($search) {
            $result['input'] = "&search-key={$search}";
            $result['produks'] = $produk->where('produk_nama', 'LIKE', "%{$search}%")->simplePaginate(12);
        } else {
            $result['produks'] = $produk->simplePaginate(12);
        }

        return view('app.produk', $result);
    }

    public function kontakPage() {
        return view('app.contact');
    }

    public function login() {
        return view('app.login');
    }

    public function register() {
      $province = Province::all();
        return view('app.register', compact('province'));
    }

    public function index1() {
        return "halaman";
    }

    public function getprovince() {
        $client = new Client();
        try{
          $response = $client->get('https://api.rajaongkir.com/starter/province',
            array(
              'headers' => array(
                'key' => '01b297c03ed339ba85c02f251227179c',

              )
            )
          );
        }catch(RequestException $e){
          var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json, true);
        // print_r($array_result);
        // echo $array_result["rajaongkir"]["results"][1]["province"];
        for($i = 0; $i < count($array_result["rajaongkir"]["results"]); $i++)
        {
          $province = new \App\Province;
          $province->id = $array_result["rajaongkir"]["results"][$i]['province_id'];
          $province->name = $array_result["rajaongkir"]["results"][$i]['province'];
          $province->save();
        }
    }

    public function getcity() {
        $client = new Client();
        try{
          $response = $client->get('https://api.rajaongkir.com/starter/city',
            array(
              'headers' => array(
                'key' => '01b297c03ed339ba85c02f251227179c',

              )
            )
          );
        }catch(RequestException $e){
          var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json, true);
        // print_r($array_result);
        // echo $array_result["rajaongkir"]["results"][0]["city_name"];
        for($i = 0; $i < count($array_result["rajaongkir"]["results"]); $i++)
        {
          $city = new \App\City;
          $city->id = $array_result["rajaongkir"]["results"][$i]['city_id'];
          $city->name = $array_result["rajaongkir"]["results"][$i]['city_name'];
          $city->id_province = $array_result["rajaongkir"]["results"][$i]['province_id'];
          $city->save();
        }
    }

    public function checkshipping() {
      $title = "Check Shipping";
      $city = City::get();

      return view('app.checkshipping', compact('title', 'city'));
    }

    public function processShipping(Request $request)
    {
      $title = "Check Shipping Result";
      $client = new Client();
      try{
        $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
          [
            'body' => 'origin=12&destination=20&weight=1700&courier=jne',
            'headers' => [
              'key' => '01b297c03ed339ba85c02f251227179c',
              'content-type' => 'application/x-www-form-urlencoded',
            ]
          ]
        );
      }catch(RequestException $e){
        var_dump($e->getResponse()->getBody()->getContents());
      }
      $json = $response->getBody()->getContents();
      $array_result[] = json_decode($json, true);

      try{
        $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
          [
            'body' => 'origin=12&destination=2&weight='.$request->weight.'&courier=jne',
            'headers' => [
              'key' => '01b297c03ed339ba85c02f251227179c',
              'content-type' => 'application/x-www-form-urlencoded',
            ]
          ]
        );
      }catch(RequestException $e){
        var_dump($e->getResponse()->getBody()->getContents());
      }
      $json = $response->getBody()->getContents();
      $array_result[] = json_decode($json, true);

      // $origin = $array_result["rajaongkir"]["origin_details"]["city_name"];
      // $destination = $array_result["rajaongkir"]["destination_details"]["city_name"];

      dd($array_result);
      // echo $array_result["rajaongkir"]["results"][0]["costs"][1]["cost"][0]["value"];

      return view('app.result', compact('title', 'array_result'));
    }

    public function city(Request $request)
    {
      $city = City::select('name','id')->where('id_province',$request->id)->get();
      return response()->json($city);
    }

    public function coba() {
      $a = 2;
        return view('coba',compact('a'));
    }

    public function tes(Request $req){
      $asd = trim($req->asd);
      dd($asd);
      return view('tes');
    }
}
