<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class MainController extends Controller
{

    private $baseUrl;
    private $wargaUrl;
    private $wilayahUrl;
    private $publisherKeluhan;
    private $publisherKependudukan;
    private $publisherWilayah;
    private $complaintNumber;
    private $publisherComplaintNumber;


    public function __construct()
    {
        $this->baseUrl = getBaseUrl();
        $this->wargaUrl = getWargaUrl();
        $this->wilayahUrl = getWilayahUrl();
        $this->publisherKeluhan = getPublisherKeluhan();
        $this->publisherWilayah = getPublisherKewilayahan();
        $this->complaintNumber = getBaseUrlComplaintNumber();
        $this->publisherComplaintNumber = getPublisherComplaintNumber();
        $this->publisherKependudukan = getPublisherKependudukan();
    }

    public function mainView()
    {
        return view('main.index');
    }

    public function listView()
    {
        return view('keluhan.list');
    }

    public function monitoringView()
    {
        return view('keluhan.monitoring');
    }

    public function createView()
    {
        // $kecamatan = fetchApi($this->wilayahUrl);
        $kecamatan = fetchApiBearer($this->publisherWilayah);
        return view('keluhan.create', compact('kecamatan'));
    }

    public function getDataWarga(Request $request)
    {
        try {
            if ($request->ajax()) {
                // $data_penduduk = fetchApi($this->wargaUrl . '/' . $request->id_penduduk);
                $data_penduduk = fetchApiBearer($this->publisherKependudukan . '/' . $request->id_penduduk);
                return response()->json($data_penduduk);
            }
            return abort(404);
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }

    public function openAjax(Request $request)
    {
        try {
            if ($request->ajax()) {
                // $data_open = fetchApi($this->baseUrl . '?status=OPEN&size=999999');
                $data_open = fetchApiBearer($this->publisherKeluhan . '?status=OPEN&size=999999');
                return view('keluhan.ajax._open', compact('data_open'));
            }
            return abort(404);
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }

    public function inprogressAjax(Request $request)
    {
        try {
            if ($request->ajax()) {
                // $data_inprogress = fetchApi($this->baseUrl . '?status=INPROGRESS&size=999999');
                $data_inprogress = fetchApiBearer($this->publisherKeluhan . '?status=INPROGRESS&size=999999');
                return view('keluhan.ajax._inprogress', compact('data_inprogress'));
            }
            return abort(404);
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }

    public function rejectAjax(Request $request)
    {
        try {
            if ($request->ajax()) {
                // $data_reject = fetchApi($this->baseUrl . '?status=REJECT&size=999999');
                $data_reject = fetchApiBearer($this->publisherKeluhan . '?status=REJECT&size=999999');
                return view('keluhan.ajax._reject', compact('data_reject'));
            }
            return abort(404);
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }

    public function doneAjax(Request $request)
    {
        try {
            if ($request->ajax()) {
                // $data_done = fetchApi($this->baseUrl . '?status=DONE&size=999999');
                $data_done = fetchApiBearer($this->publisherKeluhan . '?status=DONE&size=999999');
                return view('keluhan.ajax._done', compact('data_done'));
            }
            return abort(404);
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }

    public function detailAjax(Request $request)
    {
        try {
            if ($request->ajax()) {
                // $detail_keluhan = fetchApi($this->baseUrl . '/' . $request->id_keluhan);
                $detail_keluhan = fetchApiBearer($this->publisherKeluhan . '/' . $request->id_keluhan);
                return view('keluhan.ajax._detail', compact('detail_keluhan'));
            }
            return abort(404);
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }

    public function listMonitoringAjax(Request $request)
    {
        try {
            if ($request->ajax()) {
                // $detail_keluhan = fetchApi($this->baseUrl . '?createdDate=' . $request->date . '&size=999999');
                $detail_keluhan = fetchApiBearer($this->publisherKeluhan . '?createdDate=' . $request->date . '&size=999999');
                return view('keluhan.ajax._list_monitoring', compact('detail_keluhan'));
            }
            return abort(404);
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }

    private function encodeCurlyBraces($url)
    {
        $encodedUrl = str_replace(['{', '}', '/'], ['%7B', '%7D', '%2F'], $url);
        return $encodedUrl;
    }

    public function trackingAjax(Request $request)
    {
        try {
            if ($request->ajax()) {
                $detail_data = fetchApi($this->baseUrl . '/' . $request->id_complaint);
                $nomor = $this->encodeCurlyBraces($detail_data->data->nomor);
                // $data_tracking = fetchApi($this->complaintNumber . '?nomorKeluhan=' . $nomor);
                $data_tracking = fetchApiBearer($this->publisherComplaintNumber . '?nomorKeluhan=' . $nomor);
                return view('keluhan.ajax._tracking', compact('data_tracking'));
            }
            return abort(404);
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }

    public function infoAjax(Request $request)
    {
        try {
            if ($request->ajax()) {
                // $data_info = fetchApi($this->baseUrl . '/' . $request->id_complaint);
                $data_info = fetchApiBearer($this->publisherKeluhan . '/' . $request->id_complaint);
                return view('keluhan.ajax._info', compact('data_info'));
            }
            return abort(404);
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }

    public function approvalComplaint(Request $request)
    {
        try {
            $payloads = [
                'uraianKeluhan' => $request->uraian_keluhan,
                'status' => $request->status,
            ];
            // $response = Http::withBody(json_encode($payloads), 'application/json')
            //     ->put($this->baseUrl  . '/' . $request->id);
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('access_token'),
            ])
                ->withBody(json_encode($payloads), 'application/json')
                ->put($this->publisherKeluhan  . '/' . $request->id);
            $data = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();
            if ($statusCode == 201 || $statusCode == 200) {
                Alert::toast('Berhasil mengubah status', 'success');
                return redirect()->back();
            }
            Alert::toast('Error Code', 'error');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Error Code', 'error');
        }
    }

    public function storeComplaint(Request $request)
    {
        try {
            $payloads = [
                "bidang" => $request->bidang,
                "alamatKeluhan" => $request->alamat_lokasi_laporan,
                "namaKecamatan" => $request->kecamatan,
                "namaPelapor" => $request->nama_lengkap,
                "emailPelapor" => $request->email,
                "waPelapor" => $request->no_wa,
                "uraianKeluhan" => $request->uraian_keluhan
            ];
            // $response = Http::withBody(json_encode($payloads), 'application/json')
            //     ->post($this->baseUrl);
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('access_token'),
            ])
                ->withBody(json_encode($payloads), 'application/json')
                ->post($this->publisherKeluhan);
            $data = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();
            if ($statusCode == 201 || $statusCode == 200) {
                Alert::toast('Berhasil menambahkan keluhan', 'success');
                return redirect()->back();
            }
            Alert::toast('Error Code', 'error');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }
}
