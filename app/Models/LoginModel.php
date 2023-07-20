<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'kd_admin';

    public function LogVal($user, $pass)
    {
        $cekDataAdmin = $this->select('*')->where(['username' => $user, 'pass' => $pass]);
        if ($cekDataAdmin->countAllResults() <= 0) {
            $cekDataPasien = $this->db->table('pasien')->select('*')->where(['username' => $user, 'password' => $pass]);
            if ($cekDataPasien->countAllResults() >= 1) {
                return $cekDataPasien->get()->getResultArray();
            } else {
                return 0;
                die;
            }
        } else {
            return $cekDataAdmin->get()->getResultArray();
        }
    }
}
