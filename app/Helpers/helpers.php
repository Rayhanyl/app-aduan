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
    $baseUrl = 'eyJ4NXQiOiJOV0ZqWXpFek5XRTVaV1JtWmpSbE9EWTRNR0UzTXpOaU5tSm1ZMk00TUdFNE16RTJNak15WWciLCJraWQiOiJOVFUyWkRabU16UmhNR1poWmpCak4ySXdNMlUzTUdJNFpUaGtPREZsWlRaaVpUa3pNR1UzTjJJd01UYzBOell4WlRjeVptTmtNVFppTkRFM1lqRXhOUV9SUzI1NiIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiJzdWJzY3JpYmVyMSIsImF1dCI6IkFQUExJQ0FUSU9OIiwiYXVkIjoiOUJIY1NseWprdjl3NGxhSWRaMTF0WmhFX2JFYSIsIm5iZiI6MTcxNTY3NTkxNiwiYXpwIjoiOUJIY1NseWprdjl3NGxhSWRaMTF0WmhFX2JFYSIsInNjb3BlIjoiZGVmYXVsdCIsImlzcyI6Imh0dHBzOlwvXC9hcGltLmFwaWNlbnRydW0uY2xvdWQ6NDQzXC9vYXV0aDJcL3Rva2VuIiwicmVhbG0iOnsic2lnbmluZ190ZW5hbnQiOiJzd2FtZWRpYS5hcGljZW50cnVtLmNsb3VkIn0sImV4cCI6MTcxNTY3OTUxNiwiaWF0IjoxNzE1Njc1OTE2LCJqdGkiOiJhYWRkZjE4My1mYjdmLTQxMmUtOWY3NS01Y2M4NTZmODg5ZDAifQ.taA_QIClm6hUvsET75mIrdr3GqvBj3gr7Mr_j_oIDoXkawJ1s45JnfYAUTFzWmHxNySwgJ5uUJ_42Mma_5sLV6FcHuXLEO9L1-IgJDx5bQjojWLCc6QLEjLauHOC7h7SuFinctaLNlXsUVOcYurud3dsZZMcY5MqVwdI6gAjL_RQAOrxCvTcel3bco2DztrHWuOwdh2mTILuJX2BnmthlHLqnvUb3T7kgJDmMSkn9-Ycc9oEHoA00ayLdvCLCvINVyBjn2a6fnFcqyXmRCdTPsfCzPcc5HzCx1RocfWPlVWVLbaonZdj7NepN7S6Reefz-ahJdq53cBGChnWcwvP5A';
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
