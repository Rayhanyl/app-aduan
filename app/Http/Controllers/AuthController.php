<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{

    private $consumerKey;
    private $consumerSecret;
    private $urlToken;

    public function __construct()
    {
        $this->consumerKey = getConsumerKey();
        $this->consumerSecret = getConsumerSecret();
        $this->urlToken = getTokenEndpoint();
    }

    private function dataUser()
    {
        return [
            'keluhan' => [
                (object) [
                    'email' => 'admin_keluhan@mail.com',
                    'password' => Hash::make('qwerty'),
                    'username' => 'Admin',
                    'role' => 'keluhan',
                    'aplikasi' => 'Sistem Aplikasi Keluhan Warga',
                    'img' => '1',
                ],
            ],
            'kependudukan' => [
                (object) [
                    'email' => 'admin_kependudukan@mail.com',
                    'password' => Hash::make('qwerty'),
                    'username' => 'Admin',
                    'role' => 'kependudukan',
                    'aplikasi' => 'Sistem Aplikasi Kependudukan',
                    'img' => '3',
                ],
            ],
            'kewilayahan' => [
                (object) [
                    'email' => 'admin_kewilayahan@mail.com',
                    'password' => Hash::make('qwerty'),
                    'username' => 'Admin',
                    'role' => 'kewilayahan',
                    'aplikasi' => 'Sistem Aplikasi Kewilayahan',
                    'img' => '4',
                ],
            ],
        ];
    }

    public function mainMenuView()
    {
        return view('auth.main_menu');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $users = $this->dataUser();
        $param = $request->input('param');
        $foundUser = null;

        if (isset($users[$param])) {
            foreach ($users[$param] as $user) {
                if ($user->email === $request->email && Hash::check($request->password, $user->password)) {
                    $foundUser = $user;
                    break;
                }
            }
        }

        if ($foundUser) {
            $base64 = base64_encode($this->consumerKey . ':' . $this->consumerSecret);
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $base64,
            ])->asForm()->post($this->urlToken, [
                'grant_type' => 'client_credentials'
            ]);
            $access_token = json_decode($response->getBody()->getContents());
            Session::put([
                'email' => $foundUser->email,
                'role' => $foundUser->role,
                'username' => $foundUser->username,
                'aplikasi' => $foundUser->aplikasi,
                'img' => $foundUser->img,
                'access_token' => $access_token->access_token,
            ]);

            Alert::toast('Selamat datang', 'success');

            if ($foundUser->role == 'keluhan') {
                return redirect()->route('view.main.page');
            } elseif ($foundUser->role == 'kependudukan') {
                return redirect()->route('view.list.warga.page');
            } else {
                return redirect()->route('view.list.wilayah.page');
            }
        } else {
            Alert::toast('User Tidak Ditemukan', 'warning');
            return back();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or you are trying to log in with a different role.',
        ]);
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('view.main.menu.page');
    }
}
