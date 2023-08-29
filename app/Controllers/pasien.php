<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\PasienModel;
use CodeIgniter\I18n\Time;

class pasien extends BaseController
{
    protected $PasienModel;
    public function __construct()
    {
        $this->PasienModel  = new PasienModel();
        $this->lang         = "Pasien/Pasien.";
    }
    public function index()
    {
        return view('pasien/home');
    }
    public function Antrian()
    {
        $data = [
            'dataPemeriksaan' => $this->PasienModel->getJadwalPemeriksaan(session()->get('pasien'))->get()->getResult(),
            'lang' => $this->lang
        ];
        return view('pasien/antrian', $data);
    }
    public function Resep()
    {
        $data = [
            'dataPemeriksaan' => $this->PasienModel->dataPemeriksaan(session()->get('pasien'))->get()->getResult(),
            'lang' => $this->lang
        ];

        return view('pasien/resep', $data);
    }
    public function Pembayaran()
    {
        $kd_pasien = $this->PasienModel->select('kd_pasien')->where('username', session()->get('pasien'))->get()->getResult('array');

        $data = [
            'dataPembayaran' => $this->PasienModel->dataPembayaran($kd_pasien),
            'lang' => $this->lang
        ];
        return view('pasien/pembayaran', $data);
    }

    public function saveAntrian()
    {
        $kd_pasien = session()->get('pasien');

        $tgl_periksa = $this->request->getVar('tgl_periksa');
        $timeNow = Time::parse('now', 'Asia/Jakarta');
        $timeBook = Time::parse($tgl_periksa, 'Asia/Jakarta');

        if (!$timeNow->isBefore($timeBook)) {
            session()->setFlashdata('invlidTime', 'Tanggal Yang Anda Pilih Tidak Boleh Kurang Dari Tanggal Sekarang');
            return redirect()->to('pasien/');
        }

        $this->PasienModel->createBilling($kd_pasien, $tgl_periksa);

        session()->setFlashdata('statusBooking', 'Data Berhasil Ditambahkan');

        return redirect()->to('/pasien/');
    }
    public function savePembayaran()
    {
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
        $tanggal = new Time('now', 'Asia/Jakarta');

        $file = $this->request->getFile('file');
        // pindah folder
        $file->move('img/bukti_pembayaran');
        // ambil nama
        $namaFile = $file->getName();

        $this->PasienModel->db->table('pembayaran')->where('no_transaksi', $this->request->getVar('no_transaksi'))->set(['tgl' => $tanggal, 'status' => 'Menunggu Verifikasi', 'biaya' => $this->request->getVar('biaya'), 'file' => $namaFile])->update();

        if ($this->PasienModel->db->affectedRows() === 0) {
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
        $data = [
            "lang" => $this->lang
        ];
        return view('pasien/Masukan', $data);
    }
    public function detilResep($kd_pemeriksaan, $kd_resep, $nama_pasien)
    {
        $data = [
            'nama_pasien' => $nama_pasien, 'dataPeriksa' => $this->PasienModel->db->table('informasi_pemeriksaan')->select('kd_pemeriksaan, hasil_periksa')->where('kd_pemeriksaan', $kd_pemeriksaan)->get()->getResult(),
            'dataObat' => $this->PasienModel->dataObat($kd_resep),
            'lang' => $this->lang
        ];

        return view('pasien/detilResep', $data);
    }

    public function kirimMasukan()
    {
        $data = [
            'username' => $this->request->getVar('username'),
            'perihal' => $this->request->getVar('perihal'),
            'pesan' => $this->request->getVar('masukan')
        ];

        $this->PasienModel->db->table('masukan')->insert($data);

        session()->setFlashdata('masukan', 'Terima kasih atas masukan anda');

        return redirect()->to('/pasien/masukan');
    }
    public function delete($kd_pemeriksaan = '')
    {
        if ($this->PasienModel->deleteAntrian($kd_pemeriksaan) == false) {
            session()->setFlashdata('invalid-deleteAntrian', 'Data Antrian Yang Sudah Dibayar Tidak Dapat Dihapus');
            return redirect()->to('/pasien');
        } else {
            session()->setFlashdata('valid-deleteAntrian', 'Data Antrian Berhasil Dihapus');
            return redirect()->to('/pasien');
        }
    }
}
