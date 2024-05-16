<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;

class KependudukanController extends Controller
{
    private $wargaUrl;

    public function __construct()
    {
        $this->wargaUrl = getWargaUrl();
    }

    public function loginView()
    {
        return view('kependudukan.login');
    }

    public function listWargaView()
    {
        $data_warga = fetchApi($this->wargaUrl);
        return view('kependudukan.index', compact('data_warga'));
    }

    public function createWargaView()
    {
        return view('kependudukan.create');
    }

    public function detailAjax(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data_penduduk = fetchApi($this->wargaUrl . '/' . $request->id_penduduk);
                return view('kependudukan.ajax._detail', compact('data_penduduk'));
            }
            return abort(404);
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }

    public function editAjax(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data_penduduk = fetchApi($this->wargaUrl . '/' . $request->id_penduduk);
                return view('kependudukan.ajax._edit', compact('data_penduduk'));
            }
            return abort(404);
        } catch (\Exception $e) {
            Alert::toast('Error Ajax', 'error');
        }
    }

    public function storeWarga(Request $request)
    {
        try {
            $payloads = [
                "nik" => $request->nik,
                "nama" => $request->nama_penduduk,
                "tempatLahir" => $request->tempat_lahir,
                "tanggalLahir" => $request->tanggal_lahir,
                "jenisKelamin" => $request->jenis_kelamin,
                "agama" => $request->agama,
                "status" => $request->status,
                "golonganDarah" => $request->gol_darah,
                "alamat" => $request->alamat,
                "pekerjaan" => $request->pekerjaan,
                "email" => $request->email,
                "noWa" => $request->no_wa
            ];
            $response = Http::withBody(json_encode($payloads), 'application/json')
                ->post($this->wargaUrl);
            $data = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();
            if ($statusCode == 201 || $statusCode == 200) {
                Alert::toast('Berhasil menambahkan data penduduk', 'success');
                return redirect()->back();
            }
            Alert::toast('Error Code', 'error');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Error Store Data', 'error');
        }
    }

    public function updateWarga(Request $request)
    {
        try {
            $payloads = [
                "nik" => $request->nik,
                "nama" => $request->nama_penduduk,
                "tempatLahir" => $request->tempat_lahir,
                "tanggalLahir" => $request->tanggal_lahir,
                "jenisKelamin" => $request->jenis_kelamin,
                "agama" => $request->agama,
                "status" => $request->status,
                "golonganDarah" => $request->gol_darah,
                "alamat" => $request->alamat,
                "pekerjaan" => $request->pekerjaan,
                "email" => $request->email,
                "noWa" => $request->no_wa
            ];
            $response = Http::withBody(json_encode($payloads), 'application/json')
                ->put($this->wargaUrl . '/' . $request->nik);
            $data = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();
            if ($statusCode == 201 || $statusCode == 200) {
                Alert::toast('Berhasil merubah data penduduk', 'success');
                return redirect()->back();
            }
            Alert::toast('Error Code', 'error');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Error Store Data', 'error');
        }
    }

    public function deleteWarga(Request $request)
    {
        try {
            $response = Http::delete($this->wargaUrl . '/' . $request->id_penduduk);
            $data = json_decode($response->getBody()->getContents());
            $statusCode = $response->getStatusCode();
            if ($statusCode == 201 || $statusCode == 200) {
                Alert::toast('Berhasil menghapus data penduduk', 'success');
                return redirect()->back();
            }
            Alert::toast('Error Code', 'error');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Error Store Data', 'error');
        }
    }
}
