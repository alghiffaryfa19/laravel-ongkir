<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Province;
use App\City;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('tracking');
	}
	public function store(Request $request)
    {
        //
    }

    public function getprovince(){
        $client = new Client();

        try{
            $response = $client->get('http://api.shipping.esoftplay.com/province',
            
                );
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json, true);
        
        print_r($array_result);
        
    }

    public function getcity(){
        $client = new Client();

        try{
            $response = $client->get('http://api.shipping.esoftplay.com/city',
            
                );
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json, true);
        print_r($array_result);
        
    }

    public function getdistrik(){
        $client = new Client();

        try{
            $response = $client->get('http://api.shipping.esoftplay.com/subdistrict/168',
            
                );
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json, true);
        print_r($array_result);
        
    }

    public function cekongkir(){
        $title = "Check Ongkir";
        $city = City::get();
        return view('jne.cek', compact('title', 'city'));
    }

    public function proses(Request $request){
        $title = "Hasil";
        $client = new Client();

        try{
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
            [
                'body' => 'origin='.'22'.'&destination='.$request->destination.'&weight='.$request->weight.'&courier=jne',
                'headers' => [
                    'key' => 'bdde7585d5b11b3b77ecc7a68a862252',
                    'content-type' => 'application/x-www-form-urlencoded',
                ]
            ]
                );
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json, true);
        //print_r($array_result);
        $origin = $array_result["rajaongkir"]["origin_details"]["city_name"];
        $destination = $array_result["rajaongkir"]["destination_details"]["city_name"];

        return view('jne.hasil', compact('title', 'origin', 'destination', 'array_result'));
    }




    public function ongkir(){
        $title = 'Sangcahaya.com | Cek Ongkir';
        
        $curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.shipping.esoftplay.com/province",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if($err){
			dd($err);
		}else{
			$provinsi = json_decode($response);
		}
		
        
		return view('ongkir',compact('title','provinsi'));
    }
    
    public function kota($provinsi){
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.shipping.esoftplay.com/city/$provinsi",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$kota = json_decode($response);
			// dd($kota);
		}

		return response()->json([
			'data'=>$kota
		]);
	}
	
	public function kecamatan($kota){
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.shipping.esoftplay.com/subdistrict/$kota",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$kecamatan = json_decode($response);
			//dd($kota);
		}

		return response()->json([
			'data'=>$kecamatan
		]);
    }
    
    public function remove(){
        
        return redirect()->back();
    }

	public function cek(Request $request){
		$kota_asal = $request->kota_asal;
		$kota_tujuan = $request->kota_tujuan;
		$kurir = $request->kurir;
		$berat = $request->berat;
		$group_id = $request->group_id;

		// \DB::table('ongkir')->where('group_id',$group_id)->update([
		// 	'harga'=>
		// ])

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.shipping.esoftplay.com/domesticCost/356/$kota_tujuan/$berat/$kurir",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {	  echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response);
		}

		return response()->json([
			'hasil'=>$data
		]);
    }


}
