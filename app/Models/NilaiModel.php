<?php
namespace App\Models;
use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table            = 'nilai';
    protected $primaryKey       = 'id_nilai';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_rs', 'nilai_tugas', 'nilai_uts', 'nilai_uas', 'nilai_akhir', 'grade_huruf'];
}