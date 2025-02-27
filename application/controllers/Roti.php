<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roti extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Roti_model');
        $this->load->helper('url');
    }

    // Menampilkan dashboard roti
    public function index() {
        $data['roti'] = $this->Roti_model->get_all_roti();
        
        $total_roti = count($data['roti']);
        $total_stok = 0;
        $total_terjual = 0;
        $potensi_counts = ['Tidak Laris' => 0, 'Sedang' => 0, 'Laris' => 0, 'Sangat Laris' => 0];

        foreach ($data['roti'] as &$r) {
            $r->potensi = $this->calculate_fuzzy($r->stok, $r->terjual, $r->sisa, $r->harga, $r->pembeli, $r->tanggal);
            $total_stok += $r->stok;
            $total_terjual += $r->terjual;

            // Kategorikan potensi penjualan berdasarkan nilai crisp dengan rentang lebih jelas
            if ($r->potensi <= 20) {
                $potensi_counts['Tidak Laris']++;
            } elseif ($r->potensi <= 45) {
                $potensi_counts['Sedang']++;
            } elseif ($r->potensi <= 70) {
                $potensi_counts['Laris']++;
            } else {
                $potensi_counts['Sangat Laris']++;
            }
        }

        $data['total_roti'] = $total_roti;
        $data['avg_stok'] = $total_roti ? $total_stok / $total_roti : 0;
        $data['avg_terjual'] = $total_roti ? $total_terjual / $total_roti : 0;
        $data['tidak_laris'] = $potensi_counts['Tidak Laris'];
        $data['sedang'] = $potensi_counts['Sedang'];
        $data['laris'] = $potensi_counts['Laris'];
        $data['sangat_laris'] = $potensi_counts['Sangat Laris'];

        $this->load->view('index', $data);
    }

    // Form tambah roti
    public function create() {
        if ($this->input->post()) {
            $data = [
                'nama' => $this->input->post('nama'),
                'stok' => $this->input->post('stok'),
                'terjual' => $this->input->post('terjual'),
                'sisa' => $this->input->post('sisa'),
                'harga' => $this->input->post('harga'),
                'pembeli' => $this->input->post('pembeli'),
                'tanggal' => $this->input->post('tanggal')
            ];
            $this->Roti_model->insert_roti($data);
            redirect('roti');
        }
        $this->load->view('roti_form');
    }

    // Form edit roti
    public function edit($id) {
        $data['roti'] = $this->Roti_model->get_roti_by_id($id);
        if ($this->input->post()) {
            $update_data = [
                'nama' => $this->input->post('nama'),
                'stok' => $this->input->post('stok'),
                'terjual' => $this->input->post('terjual'),
                'sisa' => $this->input->post('sisa'),
                'harga' => $this->input->post('harga'),
                'pembeli' => $this->input->post('pembeli'),
                'tanggal' => $this->input->post('tanggal')
            ];
            $this->Roti_model->update_roti($id, $update_data);
            redirect('roti');
        }
        $this->load->view('roti_form', $data);
    }

    // Hapus roti
    public function delete($id) {
        $this->Roti_model->delete_roti($id);
        redirect('roti');
    }

    // Konfigurasi fuzzy variables
    public function fuzzy_variables() {
        $data['variables'] = $this->Roti_model->get_fuzzy_variables();
        $this->load->view('fuzzy_variables', $data);
    }

    public function add_variable() {
        if ($this->input->post()) {
            $data = [
                'nama' => $this->input->post('nama'),
                'kategori' => $this->input->post('kategori'),
                'batas_bawah' => $this->input->post('batas_bawah'),
                'batas_tengah' => $this->input->post('batas_tengah'),
                'batas_atas' => $this->input->post('batas_atas')
            ];
            $this->Roti_model->insert_fuzzy_variable($data);
            redirect('roti/fuzzy_variables');
        }
        $this->load->view('add_variable');
    }

    public function edit_variable($id) {
        $data['variable'] = $this->Roti_model->get_fuzzy_variables()[$id - 1];
        if ($this->input->post()) {
            $update_data = [
                'nama' => $this->input->post('nama'),
                'kategori' => $this->input->post('kategori'),
                'batas_bawah' => $this->input->post('batas_bawah'),
                'batas_tengah' => $this->input->post('batas_tengah'),
                'batas_atas' => $this->input->post('batas_atas')
            ];
            $this->Roti_model->update_fuzzy_variable($id, $update_data);
            redirect('roti/fuzzy_variables');
        }
        $this->load->view('add_variable', $data);
    }

    public function delete_variable($id) {
        $this->Roti_model->delete_fuzzy_variable($id);
        redirect('roti/fuzzy_variables');
    }

    // Konfigurasi fuzzy rules
    public function fuzzy_rules() {
        $data['rules'] = $this->Roti_model->get_fuzzy_rules();
        $this->load->view('fuzzy_rules', $data);
    }

    public function add_rule() {
        if ($this->input->post()) {
            $data = [
                'kondisi' => $this->input->post('kondisi'),
                'output' => $this->input->post('output')
            ];
            $this->Roti_model->insert_fuzzy_rule($data);
            redirect('roti/fuzzy_rules');
        }
        $this->load->view('add_rule');
    }

    public function edit_rule($id) {
        $data['rule'] = $this->Roti_model->get_fuzzy_rules()[$id - 1];
        if ($this->input->post()) {
            $update_data = [
                'kondisi' => $this->input->post('kondisi'),
                'output' => $this->input->post('output')
            ];
            $this->Roti_model->update_fuzzy_rule($id, $update_data);
            redirect('roti/fuzzy_rules');
        }
        $this->load->view('add_rule', $data);
    }

    public function delete_rule($id) {
        $this->Roti_model->delete_fuzzy_rule($id);
        redirect('roti/fuzzy_rules');
    }

    // Implementasi Algoritma Fuzzy Mamdani yang Diperbarui Secara Menyeluruh
    private function fuzzify($value, $variable_name) {
        $variables = $this->Roti_model->get_fuzzy_variables();
        $result = [];
        
        foreach ($variables as $var) {
            if ($var->nama == $variable_name) {
                $membership = 0;
                // Fungsi keanggotaan segitiga yang lebih fleksibel
                if ($value < $var->batas_bawah) {
                    $membership = 0;
                } elseif ($value <= $var->batas_tengah) {
                    $membership = ($value - $var->batas_bawah) / ($var->batas_tengah - $var->batas_bawah);
                } elseif ($value <= $var->batas_atas) {
                    $membership = ($var->batas_atas - $value) / ($var->batas_atas - $var->batas_tengah);
                } else {
                    $membership = 0;
                }
                $result[$var->kategori] = max(0, min(1, $membership));
            }
        }
        // Pastikan selalu ada nilai untuk semua kategori
        $default_categories = ['Sangat Rendah' => 0, 'Rendah' => 0, 'Sedang' => 0, 'Tinggi' => 0, 'Sangat Tinggi' => 0];
        return array_merge($default_categories, $result);
    }

    private function evaluate_rules($stok_fuzzy, $terjual_fuzzy, $sisa_fuzzy, $harga_fuzzy, $pembeli_fuzzy, $tanggal_fuzzy) {
        $rules = $this->Roti_model->get_fuzzy_rules();
        $output = ['Tidak Laris' => 0, 'Sedang' => 0, 'Laris' => 0, 'Sangat Laris' => 0];

        foreach ($rules as $rule) {
            $conditions = explode(' AND ', $rule->kondisi);
            $min_value = 1;

            foreach ($conditions as $cond) {
                $parts = explode(' ', trim($cond));
                $var = $parts[0];
                $cat = $parts[1] ?? '';
                
                if ($var == 'Stok') {
                    $min_value = min($min_value, $stok_fuzzy[$cat] ?? 0);
                } elseif ($var == 'Terjual') {
                    $min_value = min($min_value, $terjual_fuzzy[$cat] ?? 0);
                } elseif ($var == 'Sisa') {
                    $min_value = min($min_value, $sisa_fuzzy[$cat] ?? 0);
                } elseif ($var == 'Harga') {
                    $min_value = min($min_value, $harga_fuzzy[$cat] ?? 0);
                } elseif ($var == 'Pembeli') {
                    $min_value = min($min_value, $pembeli_fuzzy[$cat] ?? 0);
                } elseif ($var == 'Tanggal') {
                    $min_value = min($min_value, $tanggal_fuzzy[$cat] ?? 0);
                }
            }
            // Pastikan nilai minimum tidak terlalu tinggi untuk menghindari bias
            $min_value = max(0, min(1, $min_value));
            $output[$rule->output] = max($output[$rule->output], $min_value);
        }
        // Normalisasi output agar distribusi lebih merata
        $total = array_sum($output);
        if ($total > 0) {
            foreach ($output as &$value) {
                $value = $value / $total;
            }
        }
        return $output;
    }

    private function defuzzify($output) {
        $centroids = [
            'Tidak Laris' => 10,
            'Sedang' => 35,
            'Laris' => 65,
            'Sangat Laris' => 90
        ];
        $numerator = 0;
        $denominator = 0;

        foreach ($centroids as $category => $centroid) {
            $value = $output[$category] ?? 0;
            $numerator += $centroid * $value;
            $denominator += $value;
        }

        return $denominator > 0 ? $numerator / $denominator : 0;
    }

    private function calculate_fuzzy($stok, $terjual, $sisa, $harga, $pembeli, $tanggal) {
        // Fuzzifikasi semua variabel
        $stok_fuzzy = $this->fuzzify($stok, 'Stok');
        $terjual_fuzzy = $this->fuzzify($terjual, 'Terjual');
        $sisa_fuzzy = $this->fuzzify($sisa, 'Sisa');
        $harga_fuzzy = $this->fuzzify($harga, 'Harga');
        $pembeli_fuzzy = $this->fuzzify($pembeli, 'Pembeli');
        
        // Konversi tanggal ke hari dalam seminggu (1 = Senin, 7 = Minggu)
        $tanggal_obj = new DateTime($tanggal);
        $hari = $tanggal_obj->format('N'); // 1-7
        $tanggal_fuzzy = $this->fuzzify($hari, 'Tanggal');

        // Evaluasi aturan dengan semua variabel
        $output = $this->evaluate_rules($stok_fuzzy, $terjual_fuzzy, $sisa_fuzzy, $harga_fuzzy, $pembeli_fuzzy, $tanggal_fuzzy);
        return $this->defuzzify($output);
    }
}