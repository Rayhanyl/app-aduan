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
    $baseUrl = 'eyJ4NXQiOiJOV0ZqWXpFek5XRTVaV1JtWmpSbE9EWTRNR0UzTXpOaU5tSm1ZMk00TUdFNE16RTJNak15WWciLCJraWQiOiJOVFUyWkRabU16UmhNR1poWmpCak4ySXdNMlUzTUdJNFpUaGtPREZsWlRaaVpUa3pNR1UzTjJJd01UYzBOell4WlRjeVptTmtNVFppTkRFM1lqRXhOUV9SUzI1NiIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiJzdWJzY3JpYmVyMSIsImF1dCI6IkFQUExJQ0FUSU9OIiwiYXVkIjoiOUJIY1NseWprdjl3NGxhSWRaMTF0WmhFX2JFYSIsIm5iZiI6MTcxNTgyNDE0NywiYXpwIjoiOUJIY1NseWprdjl3NGxhSWRaMTF0WmhFX2JFYSIsInNjb3BlIjoiZGVmYXVsdCIsImlzcyI6Imh0dHBzOlwvXC9hcGltLmFwaWNlbnRydW0uY2xvdWQ6NDQzXC9vYXV0aDJcL3Rva2VuIiwicmVhbG0iOnsic2lnbmluZ190ZW5hbnQiOiJzd2FtZWRpYS5hcGljZW50cnVtLmNsb3VkIn0sImV4cCI6MTcxNTgyNzc0NywiaWF0IjoxNzE1ODI0MTQ3LCJqdGkiOiI0NWNkOTU0MS02YjIwLTQ0ODEtOTgzYi1lODU0OWQxOGQyNDgifQ.IcmicHUDPAzLju_dKJw1krEFcya01zdaAn-MwwPtmTelppfEPjN3Ryb3ZczYdwKeL-yZNecLOzT_4eIEkyHFt_P0T4ZMeRs6yu8giWd3HX7FKZ8ypxQl4BYW2P2SSsjqcsqJeVLymlHRW4JBBBgw_qQCtUBhZL8_B4JwgAoLxbQk_EycZG4tWxqgV7ZRXyZhiqijYrq2_01RdfYIa4hjQKShEgPsXHWQ_kpsQoVwtR2d_pSnkFQ96WKM2j0T1xAprT_riYVWl2aasJLf8l1U67VYujQsIcUDRj9Wt4W_IsJQuPZXDkkNObjh1VgcEmpJmL_BQ7csJ4pKkWnE05gv9w';
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
