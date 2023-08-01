<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\PasienModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->lang = "Home/Home.";
    }
    public function index()
    {
        $data = [
            "lang" => $this->lang
        ];
        return view('Login/Login-page', $data);
    }
    public function Login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $userModel = new LoginModel();
        $pasienModel = new PasienModel();

        $data = $userModel->LogVal($username, $password);
        if ($data <= 0) {
            session()->setFlashdata('invalidSignUp', 'Username / Password Salah');
            session()->setFlashdata('classInvalid', 'alert alert-danger');
            return redirect()->to('Home/');
        } elseif ($data[0]['role'] === '1') {
            $this->session->set(['admin' => $username, 'status' => true]);
            return redirect()->to('/admin');
        } elseif ($data[0]['role'] === '2') {
            $this->session->set(['pasien' => $username, 'status' => true]);
            return redirect()->to('/pasien');
        }
    }
    public function Registrasi()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'lang' => 'Registrasi/Registrasi.'
        ];

        return view('Login/Registrasi', $data);
    }
    public function insertDataPasien()
    {
        $userModel = new PasienModel();
        if (!$this->validate([
            'nama' => 'required|is_unique[pasien.username]'
        ])) {
            session()->setFlashdata('regist', 'Gagal Melakukan Pendaftaran, Silahkan Username Telah Dipakai');
            return redirect()->to('Home/Registrasi');
        }


        $nama = $this->request->getVar('nama');
        $password = $this->request->getVar('password');
        $alamat = $this->request->getVar('alamat');
        $no_tlp = $this->request->getVar('no_tlp');
        $inserData = $userModel->RegisPasien($nama, $password, $alamat, $no_tlp);

        session()->setFlashdata('massage', 'Berhasil Melakukan Pendaftaran, Silahkan Login');
        session()->setFlashdata('classMassage', 'alert alert-success');

        return redirect()->to('Home/');
    }
    public function Logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
}
