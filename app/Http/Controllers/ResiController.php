<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResiController extends Controller
{
    public function resi(){
		return view('resi');
    }
    public function remove(){
        
        return redirect()->back();
    }

    public function cek(Request $request){
		$resi = $request->resi;
		$kurir = $request->kurir;

		// \DB::table('ongkir')->where('group_id',$group_id)->update([
		// 	'harga'=>
		// ])

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.shipping.esoftplay.com/waybill/$resi/$kurir",
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
