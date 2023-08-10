<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class PasienModel extends Model
{
    protected $table = 'pasien';
    protected $allowedFields = ['kd_pasien', 'role', 'username', 'alamat', 'no_tlp', 'password'];
    protected $primaryKey = 'kd_pasien';

    public function RegisPasien($username, $password, $alamat, $no_tlp)
    {
        $jumlah_pasien = $this->select('*')->countAllResults();
        $data = [
            'kd_pasien' => 'p-' . $jumlah_pasien + 1,
            'role' => '2',
            'username' => $username,
            'alamat' => $alamat,
            'no_tlp' => $no_tlp,
            'password' => $password
        ];

        return $this->insert($data);
    }

    public function getJadwalPemeriksaan($username)
    {
        $kd_pasien = $this->select('kd_pasien')->where('username', $username)->get()->getResultArray();

        return $this->db->table('informasi_pemeriksaan')->select('*')->where('kd_pasien', $kd_pasien[0]);
    }

    public function createBilling($username, $tgl_periksa)
    {
        $time       = Time::parse('now');
        $timeHour   = $time->getHour();
        $timeMinute = $time->getMinute();
        $timeSecond = $time->getSecond();
        $kd_periksa = 'Booking-' . $timeHour . $timeMinute . $timeSecond . $this->db->table('informasi_pemeriksaan')->select('*')->countAllResults() + 1;
        $kd_pasien  = $this->select('kd_pasien')->where('username', $username)->get()->getResultArray();
        // $kd_resep = $this->db->table('resep_obat')->select('*')->countAllResults() + 1;

        $dataPeriksa = [
            'kd_pemeriksaan' => $kd_periksa,
            'kd_pasien' => $kd_pasien[0],
            'tgl_periksa' => $tgl_periksa,
            'hasil_periksa' => '',
        ];

        $dataPembayaran = [
            'no_transaksi' => 'Pay-' . $this->db->table('pembayaran')->select('*')->countAllResults() + 1,
            'kd_pemeriksaan' => $kd_periksa,
            'tgl' => '',
            'biaya' => 0,
            'status' => 'Menunggu'
        ];

        $createDataPeriksa = $this->db->table('informasi_pemeriksaan')->insert($dataPeriksa);
        $createPembayaran = $this->db->table('pembayaran')->insert($dataPembayaran);
    }

    public function getDataPembayaran($username)
    {
        $kd_pasien = $this->select('kd_pasien')->where('username', $username)->get()->getResultArray();
        return $this->db->table('pembayaran')->select('pembayaran.kd_pemeriksaan')->join('informasi_pemeriksaan', 'pembayaran.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->join('pasien', 'pasien.kd_pasien = informasi_pemeriksaan.kd_pasien')->where('pasien.kd_pasien', $kd_pasien[0])->get()->getResult('array');
    }

    public function dataPembayaran($kd_pasien)
    {
        $rincianBiaya = $this->db->table('pembayaran')->select('pembayaran.tgl, pembayaran.status, pembayaran.kd_pemeriksaan, pembayaran.no_transaksi, pembayaran.biaya')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pemeriksaan = pembayaran.kd_pemeriksaan')->join('pasien', 'pasien.kd_pasien = informasi_pemeriksaan.kd_pasien')->where('pasien.kd_pasien', $kd_pasien[0]['kd_pasien'])->get()->getResult();

        return $rincianBiaya;
    }
    public function dataPemeriksaan($username)
    {
        $kd_pasien = $this->select('kd_pasien')->where('username', $username)->get()->getResultArray();

        $dataPemeriksaan = $this->db->table('informasi_pemeriksaan')->select('informasi_pemeriksaan.kd_pemeriksaan, informasi_pemeriksaan.hasil_periksa, pasien.username, resep_obat.kd_resep')->join('pasien', 'pasien.kd_pasien = informasi_pemeriksaan.kd_pasien')->join('resep_obat', 'resep_obat.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->where('informasi_pemeriksaan.kd_pasien', $kd_pasien[0]);

        return $dataPemeriksaan;
    }
    public function dataObat($kd_resep)
    {
        return $this->db->table('obat')->select('obat.nama_obat')->join('item_obat', 'item_obat.kd_obat = obat.kd_obat')->where('item_obat.kd_resep', $kd_resep)->get()->getResult();
    }
    public function deleteAntrian($kd_pemeriksaan)
    {
        $cekDataResep = $this->db->table('resep_obat')->select('kd_resep')->where('kd_pemeriksaan', $kd_pemeriksaan);
        $cekStatusPembayaran = $this->db->table('pembayaran')->select('status')->where('kd_pemeriksaan', $kd_pemeriksaan);
        // return $cekStatusPembayaran->get()->getResult()[0] == "Menunggu Verifikasi" || $cekStatusPembayaran->get()->getResult()[0] == "Lunas" ? true : false;
        // die;
        if ($cekStatusPembayaran->countAllResults() != 0)
            if ($cekStatusPembayaran->get()->getResult()[0] == "Menunggu Verifikasi" || $cekStatusPembayaran->get()->getResult()[0] == "Lunas") {
                return false;
            } else {
                if ($cekDataResep->countAllResults() == 0) {
                    $this->db->table('informasi_pemeriksaan')->delete(['kd_pemeriksaan' => $kd_pemeriksaan]);
                    $this->db->table('pembayaran')->delete(['kd_pemeriksaan' => $kd_pemeriksaan]);
                    return true;
                } else {
                    $kd_resep = $cekDataResep->get()->getResult();
                    $this->db->table('informasi_pemeriksaan')->delete(['kd_pemeriksaan' => $kd_pemeriksaan]);
                    $this->db->table('pembayaran')->delete(['kd_pemeriksaan' => $kd_pemeriksaan]);
                    $this->db->table('resep_obat')->delete(['kd_pemeriksaan' => $kd_pemeriksaan]);
                    $this->db->table('item_obat')->delete($kd_resep);
                    return true;
                }
            }
    }
}
