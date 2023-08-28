<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService {
    public function getAccessToken($email){
        $response = Http::withHeaders([
            'email' => $email,
        ])->post('https://chinaonlinebd-code-interview.vercel.app/api/v1/get-access-token');

        if($response->successful()){
            return $response->json();
        }
        else{
            return [
                'error' => 'Api Request Failed',
                'status' => $response->status(),
            ];
        }
    }

    public function grantToken($accessToken){
        $response = Http::withHeaders([
            'token' => $accessToken,
        ])->post('https://chinaonlinebd-code-interview.vercel.app/api/v1/grant-token');

        if($response->successful()){
            return $response->json();
        }
        else{
            return [
                'error' => 'Grant Token Generation Failed',
                'status' => $response->status(),
            ];
        }
    }

    public function refreshToken($accesstoken, $grantToken){
        $response = Http::withHeaders([
            'token' => $accesstoken,
            'grant' => $grantToken,
        ])->post('https://chinaonlinebd-code-interview.vercel.app/api/v1/refresh-token');

        if($response->successful()){
            return $response->json();
        }
        else{
            return [
                'error' => 'Refresh Token Generation Failed',
                'status' => $response->status(),
            ];
        }
    }

    public function getQuestion($accessToken, $grantToken){
        $response = Http::withHeaders([
            'token' => $accessToken,
            'grant' => $grantToken,
        ])->post('https://chinaonlinebd-code-interview.vercel.app/api/v1/get-the-question');

        if($response->successful()){
            return $response->json();
        }
        else{
            return [
                'error' => 'Fetching Question Failed',
                'status' => $response->status(),
            ];
        }
    }
}