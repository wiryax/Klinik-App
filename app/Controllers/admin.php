<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\PasienModel;
use \Dompdf\Dompdf;

class admin extends BaseController
{
    protected $helpers = ['form'];
    public function index()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        $model = new AdminModel();

        $data = ['dataPasien' => $model->getListPasien(), 'dataObat' => $model->db->table('obat')->select('kd_obat, nama_obat')->get()->getResult(), 'validation' => validation_errors()];
        return view('admin/dataPasien', $data);
    }
    public function dataPasien()
    {
        return view('admin/dataPasien');
    }
    public function daftarPembayaran()
    {
        $model = new AdminModel();

        $data = [
            'dataPembayaran' => $model->dataPembayaran()
        ];

        return view('admin/dataPembayaran', $data);
    }
    public function saveDiagnosis()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }

        $model = new AdminModel();
        $kd_pemeriksaan = $this->request->getVar('kd_pemeriksaan');
        $dataObat = $this->request->getVar('kd_obat');
        $hasil_periksa = $this->request->getVar('hasil_periksa');
        $kd_pasien = $this->request->getVar('kd_pasien');
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

        $model->dataDiagnosa($hasil_periksa, $kd_pasien, $kd_pemeriksaan, $dataObat);

        session()->setFlashdata('saveDiagnosis', 'Data Behasil Diinput');

        return redirect()->to('admin/');
    }
    public function verifPembayaran()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        $model = new AdminModel();
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
        $model = new PasienModel();
        $data = ['dataMasukan' => $model->db->table('masukan')->select('*')->get()->getResult()];
        return view('admin/Masukan', $data);
    }
    public function Laporan()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        $model = new PasienModel();
        $data = [
            'lap_pasien' => $model->db->table('pasien')->select('pasien.username, pasien.alamat, pasien.no_tlp, informasi_pemeriksaan.tgl_periksa, resep_obat.kd_resep')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pasien = pasien.kd_pasien')->join('resep_obat', 'resep_obat.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->get()->getResult(),

            'lap_pembayaran' => $model->db->table('pasien')->select('pasien.username, informasi_pemeriksaan.tgl_periksa, pembayaran.tgl, pembayaran.biaya, pembayaran.status')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pasien = pasien.kd_pasien')->join('pembayaran', 'pembayaran.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->where('pembayaran.status', 'Lunas')->orWhere('pembayaran.status', 'Menunggu Verifikasi')->get()->getResult(),

            'lap_diagnosa' => $model->db->table('pasien')->select('pasien.username, informasi_pemeriksaan.tgl_periksa, informasi_pemeriksaan.hasil_periksa')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pasien = pasien.kd_pasien')->join('pembayaran', 'pembayaran.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->where('pembayaran.status', 'Lunas')->get()->getResult()
        ];

        return view('admin/Laporan', $data);
    }

    public function cetakDataPasien()
    {
        $model = new PasienModel();
        $domPDF = new Dompdf();

        $data = ['lap_pasien' => $model->db->table('pasien')->select('pasien.username, pasien.alamat, pasien.no_tlp, informasi_pemeriksaan.tgl_periksa, resep_obat.kd_resep')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pasien = pasien.kd_pasien')->join('resep_obat', 'resep_obat.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->get()->getResult()];

        return view('admin/laporan/dataPasien', $data);

        // $domPDF->loadHtml($html);
        // $domPDF->setPaper('A4', 'potrait');
        // $domPDF->render();
        // $domPDF->stream('Laporan_Data_Pasien.pdf');

        // return redirect()->to('/admin/Laporan');
    }
    public function cetakPembayaran()
    {
        $model = new PasienModel();
        $domPDF = new Dompdf();

        $data = ['lap_pembayaran' => $model->db->table('pasien')->select('pasien.username, informasi_pemeriksaan.tgl_periksa, pembayaran.tgl, pembayaran.biaya, pembayaran.status')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pasien = pasien.kd_pasien')->join('pembayaran', 'pembayaran.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->where('pembayaran.status', 'Lunas')->orWhere('pembayaran.status', 'Menunggu Verifikasi')->get()->getResult()];

        return view('admin/laporan/dataPembayaran', $data);

        // $domPDF->loadHtml($html);
        // $domPDF->setPaper('A4', 'potrait');
        // $domPDF->render();
        // $domPDF->stream('Laporan_Data_Pembayaran.pdf');

        // return redirect()->to('/admin/Laporan');
    }
    // public function cetakTransaksi()
    // {
    //     $model = new PasienModel();
    //     $domPDF = new Dompdf();

    //     $data = ['lap_transaksi' => $model->db->table('pembayaran')->select('*')->get()->getResult()];

    //     $html = view('admin/laporan/dataTransaksi', $data);

    //     $domPDF->loadHtml($html);
    //     $domPDF->setPaper('A4', 'potrait');
    //     $domPDF->render();
    //     $domPDF->stream('Laporan_Data_Transaksi.pdf');

    //     return redirect()->to('/admin/Laporan');
    // }
    public function cetakDataDiagnosa()
    {
        $model = new PasienModel();
        $domPDF = new Dompdf();

        $data = ['lap_diagnosa' => $model->db->table('pasien')->select('pasien.username, informasi_pemeriksaan.tgl_periksa, informasi_pemeriksaan.hasil_periksa')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pasien = pasien.kd_pasien')->join('pembayaran', 'pembayaran.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->where('pembayaran.status', 'Lunas')->get()->getResult()];

        return view('admin/laporan/dataDiagnosa', $data);

        // $domPDF->loadHtml($html);
        // $domPDF->setPaper('A4', 'potrait');
        // $domPDF->render();
        // $domPDF->stream('Laporan_Data_Diagnosa.pdf');

        // return redirect()->to('/admin/Laporan');
    }
    // public function cetakDataResep()
    // {
    //     $model = new PasienModel();
    //     $domPDF = new Dompdf();

    //     $data = ['lap_resep' => $model->db->table('resep_obat')->select('*')->get()->getResult()];

    //     $html = view('admin/laporan/dataResepObat', $data);

    //     $domPDF->loadHtml($html);
    //     $domPDF->setPaper('A4', 'potrait');
    //     $domPDF->render();
    //     $domPDF->stream('Laporan_Data_ResepObat.pdf');

    //     return redirect()->to('/admin/Laporan');
    // }
}
