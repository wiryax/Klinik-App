<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\PasienModel;;

class admin extends BaseController
{
    protected $helpers = ['form'];
    protected $AdminModel;
    protected $PasienModel;
    public function __construct()
    {
        $this->AdminModel   = new AdminModel();
        $this->PasienModel  = new PasienModel();
    }
    public function index()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        $data = ['dataPasien' => $this->AdminModel->getListPasien(), 'dataObat' => $this->AdminModel->db->table('obat')->select('kd_obat, nama_obat')->get()->getResult(), 'validation' => validation_errors()];
        return view('admin/dataPasien', $data);
    }
    public function dataPasien()
    {
        return view('admin/dataPasien');
    }
    public function daftarPembayaran()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        $data = [
            'dataPembayaran' => $this->AdminModel->dataPembayaran()
        ];

        return view('admin/dataPembayaran', $data);
    }
    public function saveDiagnosis()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }

        $kd_pemeriksaan = $this->request->getVar('kd_pemeriksaan');
        $dataObat       = $this->request->getVar('kd_obat');
        $hasil_periksa  = $this->request->getVar('hasil_periksa');
        $kd_pasien      = $this->request->getVar('kd_pasien');
        if (!$this->validate([
            'kd_obat' => [
                'rules' => 'required',
                'errors' => ['required' => 'Data Obat Belum Diinput']
            ],
            'hasil_periksa' => [
                'rules' => 'required',
                'errors' => ['required' => 'Data Hasil Periksa Belum Diinput']
            ]
        ])) {
            return redirect()->to('admin/')->withInput();
        }

        $this->AdminModel->dataDiagnosa($hasil_periksa, $kd_pasien, $kd_pemeriksaan, $dataObat);

        session()->setFlashdata('saveDiagnosis', 'Data Behasil Diinput');

        return redirect()->to('admin/');
    }
    public function verifPembayaran()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        $no_transaksi = $this->request->getVar('no_transaksi');

        $model->db->table('pembayaran')->where('no_transaksi', $no_transaksi)->set(['status' => 'Lunas'])->update();

        if ($model->db->affectedRows() === 0) {
            session()->setFlashdata('invalidVerifikasi', 'Verifikasi Ditolak');
            session()->setFlashdata('invalidVerifikasiClass', 'alert alert-danger');
            return redirect()->to('/admin/daftarPembayaran');
        } else {
            session()->setFlashdata('validVerifikasi', 'Berhasil Ter-Verifikasi');
            session()->setFlashdata('validVerifikasiClass', 'alert alert-success');
            return redirect()->to('/admin/daftarPembayaran');
        }
    }
    public function Masukan()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        $data = ['dataMasukan' => $this->AdminModel->db->table('masukan')->select('*')->get()->getResult()];
        return view('admin/Masukan', $data);
    }
    public function Laporan()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        $data = [
            'lap_pasien' => $this->PasienModel->db->table('pasien')->select('pasien.username, pasien.alamat, pasien.no_tlp, informasi_pemeriksaan.tgl_periksa, resep_obat.kd_resep')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pasien = pasien.kd_pasien')->join('resep_obat', 'resep_obat.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->get()->getResult(),

            'lap_pembayaran' => $this->PasienModel->db->table('pasien')->select('pasien.username, informasi_pemeriksaan.tgl_periksa, pembayaran.tgl, pembayaran.biaya, pembayaran.status')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pasien = pasien.kd_pasien')->join('pembayaran', 'pembayaran.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->where('pembayaran.status', 'Lunas')->orWhere('pembayaran.status', 'Menunggu Verifikasi')->get()->getResult(),

            'lap_diagnosa' => $this->PasienModel->db->table('pasien')->select('pasien.username, informasi_pemeriksaan.tgl_periksa, informasi_pemeriksaan.hasil_periksa')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pasien = pasien.kd_pasien')->join('pembayaran', 'pembayaran.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->where('pembayaran.status', 'Lunas')->get()->getResult()
        ];

        return view('admin/Laporan', $data);
    }

    public function cetakDataPasien()
    {
        $data = ['lap_pasien' => $this->PasienModel->db->table('pasien')->select('pasien.username, pasien.alamat, pasien.no_tlp, informasi_pemeriksaan.tgl_periksa, resep_obat.kd_resep')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pasien = pasien.kd_pasien')->join('resep_obat', 'resep_obat.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->get()->getResult()];

        return view('admin/laporan/dataPasien', $data);
    }
    public function cetakPembayaran()
    {

        $data = ['lap_pembayaran' => $this->PasienModel->db->table('pasien')->select('pasien.username, informasi_pemeriksaan.tgl_periksa, pembayaran.tgl, pembayaran.biaya, pembayaran.status')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pasien = pasien.kd_pasien')->join('pembayaran', 'pembayaran.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->where('pembayaran.status', 'Lunas')->orWhere('pembayaran.status', 'Menunggu Verifikasi')->get()->getResult()];

        return view('admin/laporan/dataPembayaran', $data);
    }
    public function cetakDataDiagnosa()
    {

        $data = ['lap_diagnosa' => $this->PasienModel->table('pasien')->select('pasien.username, informasi_pemeriksaan.tgl_periksa, informasi_pemeriksaan.hasil_periksa')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pasien = pasien.kd_pasien')->join('pembayaran', 'pembayaran.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->where('pembayaran.status', 'Lunas')->get()->getResult()];

        return view('admin/laporan/dataDiagnosa', $data);
    }
}
