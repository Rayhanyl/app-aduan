<?php

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

function getBaseUrl()
{
    $baseUrl = env('BASE_URL');
    return $baseUrl;
}

function getBaseUrlComplaintNumber()
{
    $baseUrl = env('BASE_URL_COMPLAINT_NUMBER');
    return $baseUrl;
}

function getWilayahUrl()
{
    $baseUrl = env('BASE_URL_KECAMATAN');
    return $baseUrl;
}

function getWargaUrl()
{
    $baseUrl = env('BASE_URL_WARGA');
    return $baseUrl;
}

function getPublisherKeluhan()
{
    $baseUrl = env('KELUHAN_PUBLISHER');
    return $baseUrl;
}

function getPublisherComplaintNumber()
{
    $baseUrl = env('COMPLAINT_NUMBER');
    return $baseUrl;
}

function getPublisherKependudukan()
{
    $baseUrl = env('KEPENDUDUKAN_PUBLISHER');
    return $baseUrl;
}

function getPublisherKewilayahan()
{
    $baseUrl = env('WILAYAH_PUBLISHER');
    return $baseUrl;
}

function getAccessTokenAPI()
{
    $baseUrl = env('ACCESS_TOKEN');
    Session::put('access_token', $baseUrl);
    return $baseUrl;
}

function fetchApi($apiUrl)
{
    try {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->get($apiUrl);
        $statusCode = $response->getStatusCode();
        $reasonPhrase = $response->getReasonPhrase();
        $responseContent = $response->getBody()->getContents();
        if ($statusCode === 200) {
            return json_decode($responseContent);
        } elseif (in_array($statusCode, [404, 401, 500])) {
            return $statusCode;
        } else {
            return "Unknown error with status code: " . $statusCode;
        }
    } catch (\Exception $e) {
        Alert::toast('Error Fetch Data API', 'error');
    }
}

function fetchApiBearer($apiUrl)
{
    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . getAccessTokenAPI(),
        ])
            ->get($apiUrl);
        $statusCode = $response->getStatusCode();
        $reasonPhrase = $response->getReasonPhrase();
        $responseContent = $response->getBody()->getContents();
        if ($statusCode === 200) {
            return json_decode($responseContent);
        } elseif (in_array($statusCode, [404, 401, 500])) {
            return $statusCode;
        } else {
            return "Unknown error with status code: " . $statusCode;
        }
    } catch (\Exception $e) {
        Alert::toast('Error Fetch Data API', 'error');
    }
}

