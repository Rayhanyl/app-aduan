<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class MainController extends Controller
{

    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = getBaseUrl();
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
        return view('keluhan.create');
    }

    public function openAjax(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data_open = fetchApi($this->baseUrl . '?status=OPEN&size=999999');
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
                $data_inprogress = fetchApi($this->baseUrl . '?status=INPROGRESS&size=999999');
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
                $data_reject = fetchApi($this->baseUrl . '?status=REJECT&size=999999');
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
                $data_done = fetchApi($this->baseUrl . '?status=DONE&size=999999');
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
                $detail_keluhan = fetchApi($this->baseUrl . '/' . $request->id_keluhan);
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
                $detail_keluhan = fetchApi($this->baseUrl . '?createdDate=' . $request->date . '&size=999999');
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
                $data_tracking = fetchApi('https://asabri.apicentrum.store/aduan/api/1.0/trace/by-complaint-number?nomorKeluhan=' . $nomor);
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
                $data_info = fetchApi($this->baseUrl . '/' . $request->id_complaint);
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
            $response = Http::withBody(json_encode($payloads), 'application/json')
                ->put($this->baseUrl  . '/' . $request->id);
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
            $response = Http::withBody(json_encode($payloads), 'application/json')
                ->post($this->baseUrl);
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
