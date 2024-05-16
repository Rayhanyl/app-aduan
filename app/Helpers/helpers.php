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
    $baseUrl = 'eyJ4NXQiOiJOV0ZqWXpFek5XRTVaV1JtWmpSbE9EWTRNR0UzTXpOaU5tSm1ZMk00TUdFNE16RTJNak15WWciLCJraWQiOiJOVFUyWkRabU16UmhNR1poWmpCak4ySXdNMlUzTUdJNFpUaGtPREZsWlRaaVpUa3pNR1UzTjJJd01UYzBOell4WlRjeVptTmtNVFppTkRFM1lqRXhOUV9SUzI1NiIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiJzdWJzY3JpYmVyMSIsImF1dCI6IkFQUExJQ0FUSU9OIiwiYXVkIjoiOUJIY1NseWprdjl3NGxhSWRaMTF0WmhFX2JFYSIsIm5iZiI6MTcxNTgyODk0MSwiYXpwIjoiOUJIY1NseWprdjl3NGxhSWRaMTF0WmhFX2JFYSIsInNjb3BlIjoiZGVmYXVsdCIsImlzcyI6Imh0dHBzOlwvXC9hcGltLmFwaWNlbnRydW0uY2xvdWQ6NDQzXC9vYXV0aDJcL3Rva2VuIiwicmVhbG0iOnsic2lnbmluZ190ZW5hbnQiOiJzd2FtZWRpYS5hcGljZW50cnVtLmNsb3VkIn0sImV4cCI6MTcxNTgzMjU0MSwiaWF0IjoxNzE1ODI4OTQxLCJqdGkiOiJlMmY5ZTY3NS01OGZmLTRkZmUtODFkMC1lMDE0MWMwYzgzYzUifQ.kkPViNmLetZabOLwjR6mJkYhO4AoWqi_7CV7-HxcZTfUQSQ9knzVpPnFavWfz58sx2b5EyKjmNTOy_-fxf9bFLFg5dnICaw89ptIrpvSGgO3SfgB7-qbHkZHjRqyaFGKuvgziY3tqhuPHjhvVo-FAWGjWS2hLBp8V0VCRutZZPcrHN5VCQ-ct7zGvHI3g5t8aIippBJYhu2EN0rZaznkGOZSXQxrSfd_r_LCdf02YLRLGA8H9C7K5aa7MitwUwNU-qF55jNyR9rKe5-nGTVUJdDu1gZ5yrnS6DjMkrjfMFbjLCkvjp9hRmHMjL0TFzAjLSFqUiQvyseacVHsUM9APw';
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
