<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;

class WilayahController extends Controller
{

    private $wilayahUrl;

    public function __construct()
    {
        $this->wilayahUrl = getWilayahUrl();
    }

    public function listWilayahView()
    {
        $data_kecamatan = fetchApi($this->wilayahUrl);
        return view('wilayah.index', compact('data_kecamatan'));
    }

    public function createWilayahView()
    {
        return view('wilayah.create');
    }

    public function editWilayahAjax(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data_kecamatan = fetchApi($this->wilayahUrl . '/' . $request->id_kecamatan);
                return view('wilayah.ajax._edit', compact('data_kecamatan'));
            }
            return abort(404);
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }

    public function storeWilayah(Request $request)
    {
        try {
            $payloads = [
                "nama" => $request->nama_kecamatan,
                "kodePos" => $request->kode_pos,
            ];
            $response = Http::withBody(json_encode($payloads), 'application/json')
                ->post($this->wilayahUrl);
            $data = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();
            if ($statusCode == 201 || $statusCode == 200) {
                Alert::toast('Berhasil menambahkan kecamatan', 'success');
                return redirect()->back();
            }
            Alert::toast('Error Code', 'error');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Error Store Data', 'error');
        }
    }

    public function updateWilayah(Request $request)
    {
        try {
            $payloads = [
                "nama" => $request->nama_kecamatan,
                "kodePos" => $request->kode_pos,
            ];
            $response = Http::withBody(json_encode($payloads), 'application/json')
                ->put($this->wilayahUrl . '/' . $request->id_kecamatan);
            $data = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();
            if ($statusCode == 201 || $statusCode == 200) {
                Alert::toast('Berhasil merubah data kecamatan', 'success');
                return redirect()->back();
            }
            Alert::toast('Error Code', 'error');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Error Store Data', 'error');
        }
    }

    public function deleteWilayah(Request $request, $id_kecamatan)
    {
        try {
            $response = Http::delete($this->wilayahUrl . '/' . $id_kecamatan);
            $data = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();
            if ($statusCode == 201 || $statusCode == 200) {
                Alert::toast('Berhasil menghapus kecamatan', 'success');
                return redirect()->back();
            }
            Alert::toast('Error Code', 'error');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Error Delete Data', 'error');
        }
    }
}
