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

function getConsumerKey()
{
    $baseUrl = env('CONSUMER_KEY');
    return $baseUrl;
}

function getConsumerSecret()
{
    $baseUrl = env('CONSUMER_SECRET');
    return $baseUrl;
}

function getTokenEndpoint()
{
    $baseUrl = env('TOKEN_ENDPOINT');
    return $baseUrl;
}

function getAccessTokenAPI()
{
    $baseUrl = 'eyJ4NXQiOiJOV0ZqWXpFek5XRTVaV1JtWmpSbE9EWTRNR0UzTXpOaU5tSm1ZMk00TUdFNE16RTJNak15WWciLCJraWQiOiJOVFUyWkRabU16UmhNR1poWmpCak4ySXdNMlUzTUdJNFpUaGtPREZsWlRaaVpUa3pNR1UzTjJJd01UYzBOell4WlRjeVptTmtNVFppTkRFM1lqRXhOUV9SUzI1NiIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiJzdWJzY3JpYmVyMSIsImF1dCI6IkFQUExJQ0FUSU9OIiwiYXVkIjoiOUJIY1NseWprdjl3NGxhSWRaMTF0WmhFX2JFYSIsIm5iZiI6MTcxNjk1Mjk3MiwiYXpwIjoiOUJIY1NseWprdjl3NGxhSWRaMTF0WmhFX2JFYSIsInNjb3BlIjoiZGVmYXVsdCIsImlzcyI6Imh0dHBzOlwvXC9hcGltLmFwaWNlbnRydW0uY2xvdWQ6NDQzXC9vYXV0aDJcL3Rva2VuIiwicmVhbG0iOnsic2lnbmluZ190ZW5hbnQiOiJzd2FtZWRpYS5hcGljZW50cnVtLmNsb3VkIn0sImV4cCI6MTcxNzAzOTM3MiwiaWF0IjoxNzE2OTUyOTcyLCJqdGkiOiI3YmVjNTFlZS1mNWQ2LTRkNmMtYjFlYy0yZWM2NDhjMGRkMmIifQ.VZPEIekMr4l4SIiIo-iV8sywaBUFDfNG-XEBFsHMLzA61iDr1_ujGo4whdN1HtpzK0t6pJb6rpketBD1As5jn3kgTkqdXnURi1DxXU54KTZPLVHTifKrOwZYHpZ2Ew8FSNVg676PtI-5hq73ZHfeLohbFYplRAOOHWwBWGqZyy7-BY09JwM_EaovpRnil3l5PlDGFC6XszCBoaSxRmAf2BgKFKxR9YTqmUNg-aG12zdQUAoMTHaGI3trPWYHfFONES_DmbPRy-4aqBFSoa9Y56ZWxk0V6lPPV7JQI7tMhiKtDCdo2TtwravrZ6awrNxABCoxRqzVMejc7x_3lSUIxQ';
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
            'Authorization' => 'Bearer ' . session('access_token'),
        ])
            ->get($apiUrl);
        $statusCode = $response->getStatusCode();
        $reasonPhrase = $response->getReasonPhrase();
        $responseContent = $response->getBody()->getContents();
        dd($statusCode, $responseContent);
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
