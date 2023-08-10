<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'kd_admin';
    protected $allowedFields = ['kd_admin', 'role', 'username', 'password'];

    public function getListPasien($search)
    {
        if ($search) {
            $builder = $this->db->table('informasi_pemeriksaan')->select('informasi_pemeriksaan.kd_pemeriksaan, informasi_pemeriksaan.tgl_periksa, pasien.username, pasien.kd_pasien, pembayaran.status')->join('pasien', 'pasien.kd_pasien = informasi_pemeriksaan.kd_pasien')->join('pembayaran', 'pembayaran.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan')->like('pasien.username', $search)->orLike('informasi_pemeriksaan.kd_pemeriksaan', $search)->orLike('tgl_periksa', $search)->orLike('pembayaran.status', $search);
        } else {
            $builder = $this->db->table('informasi_pemeriksaan')->select('informasi_pemeriksaan.kd_pemeriksaan, informasi_pemeriksaan.tgl_periksa, pasien.username, pasien.kd_pasien, pembayaran.status')->join('pasien', 'pasien.kd_pasien = informasi_pemeriksaan.kd_pasien')->join('pembayaran', 'pembayaran.kd_pemeriksaan = informasi_pemeriksaan.kd_pemeriksaan');
        }
        return $builder->get()->getResult();
    }
    public function dataPembayaran($search)
    {
        if ($search) {
            $result = $this->db->table('pembayaran')->select('pasien.username, pembayaran.tgl, pembayaran.status, pembayaran.no_transaksi, informasi_pemeriksaan.kd_pasien, pembayaran.biaya, pembayaran.file')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pemeriksaan = pembayaran.kd_pemeriksaan')->join('pasien', 'pasien.kd_pasien = informasi_pemeriksaan.kd_pasien')->like('pasien.username', $search)->orLike('pembayaran.tgl', $search)->orLike('pembayaran.no_transaksi', $search)->orLike('informasi_pemeriksaan.kd_pasien', $search)->orLike('pembayaran.biaya', $search);
        } else {
            $result = $this->db->table('pembayaran')->select('pasien.username, pembayaran.tgl, pembayaran.status, pembayaran.no_transaksi, informasi_pemeriksaan.kd_pasien, pembayaran.biaya, pembayaran.file')->join('informasi_pemeriksaan', 'informasi_pemeriksaan.kd_pemeriksaan = pembayaran.kd_pemeriksaan')->join('pasien', 'pasien.kd_pasien = informasi_pemeriksaan.kd_pasien');
        }
        return $result->get()->getResult();
    }
    public function dataDiagnosa($hasilPeriksa, $kd_pasien, $kd_periksa, $dataObat)
    {

        $create_kd_resep = 'formula-' . $kd_periksa;
        $biaya = 0;
        for ($i = 0; $i < count($dataObat); $i++) {
            $harga = $this->db->table('obat')->select('harga')->where('kd_obat', $dataObat[$i])->get()->getResult();
            $biaya += $harga[0]->harga;
        }

        $dataResep = [
            'kd_resep' => $create_kd_resep,
            'kd_pemeriksaan' => $kd_periksa,
            'kd_pasien' => $kd_pasien
        ];

        for ($i = 0; $i < count($dataObat); $i++) {
            $dataItemObat[$i] =
                [
                    'kd_resep' => $create_kd_resep,
                    'kd_obat' => $dataObat[$i]
                ];
        }

        if ($this->db->table('resep_obat')->select('*')->where('kd_pemeriksaan', $kd_periksa)->countAllResults() < 1) {
            $this->db->table('resep_obat')->insert($dataResep);
            $this->db->table('item_obat')->insertBatch($dataItemObat);
        }

        $this->db->table('informasi_pemeriksaan')->whereIn('kd_pemeriksaan', [$kd_periksa])->set(['hasil_periksa' => $hasilPeriksa])->update();
        $this->db->table('pembayaran')->whereIn('kd_pemeriksaan', [$kd_periksa])->set(['biaya' => $biaya])->update();
    }
}
