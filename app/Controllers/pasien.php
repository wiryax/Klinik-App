<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\PasienModel;
use CodeIgniter\I18n\Time;

class pasien extends BaseController
{
    public function index()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }

        return view('pasien/home');
    }
    public function Antrian()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        $model = new PasienModel();

        $data = ['dataPemeriksaan' => $model->getJadwalPemeriksaan(session()->get('pasien'))->get()->getResult()];
        return view('pasien/antrian', $data);
    }
    public function Resep()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }

        $model = new PasienModel();

        $data = ['dataPemeriksaan' => $model->dataPemeriksaan(session()->get('pasien'))->get()->getResult()];


        return view('pasien/resep', $data);
    }
    public function Pembayaran()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }

        $model = new PasienModel();

        $kd_pasien = $model->select('kd_pasien')->where('username', session()->get('pasien'))->get()->getResult('array');

        $data = ['dataPembayaran' => $model->dataPembayaran($kd_pasien)];
        return view('pasien/pembayaran', $data);
    }

    public function saveAntrian()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        $model = new PasienModel();

        $kd_pasien = session()->get('pasien');

        $tgl_periksa = $this->request->getVar('tgl_periksa');
        $timeNow = Time::parse('now', 'Asia/Jakarta');
        $timeBook = Time::parse($tgl_periksa, 'Asia/Jakarta');

        if (!$timeNow->isBefore($timeBook)) {
            session()->setFlashdata('invlidTime', 'Tanggal Yang Anda Pilih Tidak Boleh Kurang Dari Tanggal Sekarang');
            return redirect()->to('pasien/');
        }

        $model->createBilling($kd_pasien, $tgl_periksa);

        session()->setFlashdata('statusBooking', 'Data Berhasil Ditambahkan');

        return redirect()->to('/pasien/');
    }

    public function savePembayaran()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        if (!$this->validate([
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,1024]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Input Bukti Transfer',
                    'max_size' => 'Ukuran Gambar Terlalu Besar',
                    'is_image' => 'File hanya boleh gambar dengan format JPG, JPEG, PNG',
                    'mime_in' => 'File hanya boleh gambar dengan format JPG, JPEG, PNG'
                ]
            ]
        ])) {
            return redirect()->to('/pasien/Pembayaran')->withInput();
        }

        $model = new PasienModel();
        $tanggal = new Time('now', 'Asia/Jakarta');

        $file = $this->request->getFile('file');
        // pindah folder
        $file->move('img/bukti_pembayaran');
        // ambil nama
        $namaFile = $file->getName();

        $model->db->table('pembayaran')->where('no_transaksi', $this->request->getVar('no_transaksi'))->set(['tgl' => $tanggal, 'status' => 'Menunggu Verifikasi', 'biaya' => $this->request->getVar('biaya'), 'file' => $namaFile])->update();

        if ($model->db->affectedRows() === 0) {
            session()->setFlashdata('invalidPembayaran', 'Maaf Pembayaran Ditolak');
            session()->setFlashdata('invalidPembayaranClass', 'alert alert-danger');
            return redirect()->to('/pasien/Pembayaran');
        } else {
            session()->setFlashdata('validPembayaran', 'Berhasil, Pembayaran Akan Diproses Oleh Admin');
            session()->setFlashdata('validPembayaranClass', 'alert alert-success');
            return redirect()->to('/pasien/Pembayaran');
        }
    }
    public function masukan()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        return view('pasien/Masukan');
    }
    public function detilResep($kd_pemeriksaan, $kd_resep, $nama_pasien)
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        $model = new PasienModel();
        $data = ['nama_pasien' => $nama_pasien, 'dataPeriksa' => $model->db->table('informasi_pemeriksaan')->select('kd_pemeriksaan, hasil_periksa')->where('kd_pemeriksaan', $kd_pemeriksaan)->get()->getResult(), 'dataObat' => $model->dataObat($kd_resep)];

        return view('pasien/detilResep', $data);
    }

    public function kirimMasukan()
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }

        $model = new PasienModel();

        $data = [
            'username' => $this->request->getVar('username'),
            'perihal' => $this->request->getVar('perihal'),
            'pesan' => $this->request->getVar('masukan')
        ];

        $model->db->table('masukan')->insert($data);

        session()->setFlashdata('masukan', 'Terima kasih atas masukan anda');

        return redirect()->to('/pasien/masukan');
    }
    public function delete($kd_pemeriksaan = '')
    {
        if (session()->has('status') == false) {
            return redirect()->to('/');
            die;
        }
        $model = new PasienModel();
        // dd($model->deleteAntrian($kd_pemeriksaan));
        if ($model->deleteAntrian($kd_pemeriksaan) == false) {
            session()->setFlashdata('invalid-deleteAntrian', 'Data Antrian Yang Sudah Dibayar Tidak Dapat Dihapus');
            return redirect()->to('/pasien');
        } else {
            session()->setFlashdata('valid-deleteAntrian', 'Data Antrian Berhasil Dihapus');
            return redirect()->to('/pasien');
        }
    }
}
