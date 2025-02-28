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
            // Verifikasi data
            $r->stok = max(1, intval($r->stok)); // Pastikan stok minimal 1 untuk menghindari division by zero
            $r->terjual = min(intval($r->terjual), $r->stok); // Terjual tidak boleh lebih dari stok
            $r->sisa = $r->stok - $r->terjual; // Hitung ulang sisa untuk memastikan konsistensi
            
            // Hitung persentase terjual
            $persentase_terjual = ($r->terjual / $r->stok) * 100;
            $r->persentase_terjual = round($persentase_terjual, 2);
            
            // Panggil fuzzy dengan data yang sudah diverifikasi
            $r->potensi = $this->calculate_fuzzy($r->stok, $r->terjual, $r->sisa, $r->harga, $r->pembeli, $r->tanggal, $persentase_terjual);
            
            // Akumulasi untuk statistik
            $total_stok += $r->stok;
            $total_terjual += $r->terjual;

            // Kategorikan potensi penjualan berdasarkan nilai crisp
            if ($r->potensi <= 25) {
                $r->kategori = 'Tidak Laris';
                $potensi_counts['Tidak Laris']++;
            } elseif ($r->potensi <= 50) {
                $r->kategori = 'Sedang';
                $potensi_counts['Sedang']++;
            } elseif ($r->potensi <= 75) {
                $r->kategori = 'Laris';
                $potensi_counts['Laris']++;
            } else {
                $r->kategori = 'Sangat Laris';
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
            $stok = max(1, intval($this->input->post('stok')));
            $terjual = min(intval($this->input->post('terjual')), $stok);
            $sisa = $stok - $terjual;
            
            $data = [
                'nama' => $this->input->post('nama'),
                'stok' => $stok,
                'terjual' => $terjual,
                'sisa' => $sisa,
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
            $stok = max(1, intval($this->input->post('stok')));
            $terjual = min(intval($this->input->post('terjual')), $stok);
            $sisa = $stok - $terjual;
            
            $update_data = [
                'nama' => $this->input->post('nama'),
                'stok' => $stok,
                'terjual' => $terjual,
                'sisa' => $sisa,
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

    // Implementasi Algoritma Fuzzy Mamdani yang Diperbarui
    private function fuzzify($value, $variable_name) {
        $variables = $this->Roti_model->get_fuzzy_variables();
        $result = [];
        
        // Logging untuk debugging
        log_message('debug', "Fuzzifying variable: $variable_name with value: $value");
        
        foreach ($variables as $var) {
            if ($var->nama == $variable_name) {
                $membership = 0;
                
                // Perbaikan fungsi keanggotaan
                if ($value <= $var->batas_bawah) {
                    $membership = ($variable_name == 'Sisa' || $variable_name == 'PersentaseTerjual' && $var->kategori == 'Sangat Rendah') ? 1 : 0;
                } elseif ($value < $var->batas_tengah) {
                    $membership = ($value - $var->batas_bawah) / ($var->batas_tengah - $var->batas_bawah);
                } elseif ($value == $var->batas_tengah) {
                    $membership = 1;
                } elseif ($value < $var->batas_atas) {
                    $membership = ($var->batas_atas - $value) / ($var->batas_atas - $var->batas_tengah);
                } else {
                    $membership = ($variable_name == 'Terjual' || $variable_name == 'PersentaseTerjual' && $var->kategori == 'Sangat Tinggi') ? 1 : 0;
                }
                
                $result[$var->kategori] = max(0, min(1, $membership));
                log_message('debug', "Variable: $variable_name, Category: {$var->kategori}, Membership: $membership");
            }
        }
        
        // Pastikan semua kategori ada dengan nilai default 0
        $default_categories = ['Sangat Rendah' => 0, 'Rendah' => 0, 'Sedang' => 0, 'Tinggi' => 0, 'Sangat Tinggi' => 0];
        $result = array_merge($default_categories, $result);
        
        log_message('debug', "Fuzzify result for $variable_name: " . json_encode($result));
        
        return $result;
    }

    private function evaluate_rules($stok_fuzzy, $terjual_fuzzy, $sisa_fuzzy, $harga_fuzzy, $pembeli_fuzzy, $tanggal_fuzzy, $persentase_fuzzy) {
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
                } elseif ($var == 'PersentaseTerjual') {
                    $min_value = min($min_value, $persentase_fuzzy[$cat] ?? 0);
                }
            }
            
            // Jika semua kondisi terpenuhi (min_value > 0)
            if ($min_value > 0) {
                $output[$rule->output] = max($output[$rule->output], $min_value);
                log_message('debug', "Rule fired: {$rule->kondisi} -> {$rule->output}, Value: $min_value");
            }
        }
        
        log_message('debug', 'Aggregated output: ' . json_encode($output));
        return $output;
    }

    private function defuzzify($output) {
        // Centroids diatur lebih seimbang untuk membedakan kategori dengan jelas
        $centroids = [
            'Tidak Laris' => 12.5,  // Center of 0-25 range
            'Sedang' => 37.5,       // Center of 25-50 range
            'Laris' => 62.5,        // Center of 50-75 range
            'Sangat Laris' => 87.5  // Center of 75-100 range
        ];
        
        $numerator = 0;
        $denominator = 0;
    
        foreach ($centroids as $category => $centroid) {
            $value = $output[$category] ?? 0;
            $numerator += $centroid * $value;
            $denominator += $value;
            
            log_message('debug', "Defuzzify: Category $category, Value $value, Centroid $centroid");
        }
    
        // Jika tidak ada rule yang terpicu, gunakan nilai default berdasarkan persentase penjualan
        $crisp_value = $denominator > 0 ? $numerator / $denominator : 0;
        
        log_message('debug', "Final crisp value: $crisp_value");
        return $crisp_value;
    }

    private function calculate_fuzzy($stok, $terjual, $sisa, $harga, $pembeli, $tanggal, $persentase_terjual) {
        // Verifikasi data
        $stok = max(1, intval($stok));
        $terjual = min(intval($terjual), $stok);
        $sisa = intval($sisa);
        $harga = floatval($harga);
        $pembeli = intval($pembeli);
        
        // Pastikan persentase valid
        $persentase_terjual = min(100, max(0, $persentase_terjual));
        
        // Logging untuk debug
        log_message('debug', "Calculate fuzzy for: Stok=$stok, Terjual=$terjual, Sisa=$sisa, Persentase=$persentase_terjual");
        
        // Fuzzify all input variables
        $stok_fuzzy = $this->fuzzify($stok, 'Stok');
        $terjual_fuzzy = $this->fuzzify($terjual, 'Terjual');
        $sisa_fuzzy = $this->fuzzify($sisa, 'Sisa');
        $harga_fuzzy = $this->fuzzify($harga, 'Harga');
        $pembeli_fuzzy = $this->fuzzify($pembeli, 'Pembeli');
        
        // Fuzzify tanggal (day of week)
        $tanggal_obj = new DateTime($tanggal);
        $hari = $tanggal_obj->format('N'); // 1 (Monday) to 7 (Sunday)
        $tanggal_fuzzy = $this->fuzzify($hari, 'Tanggal');
        
        // Fuzzify persentase terjual (penting untuk menentukan popularitas)
        $persentase_fuzzy = $this->fuzzify($persentase_terjual, 'PersentaseTerjual');
        
        // Rule evaluation
        $output = $this->evaluate_rules(
            $stok_fuzzy, 
            $terjual_fuzzy, 
            $sisa_fuzzy, 
            $harga_fuzzy, 
            $pembeli_fuzzy, 
            $tanggal_fuzzy, 
            $persentase_fuzzy
        );
        
        // Jika tidak ada rule yang terpicu, gunakan default berdasarkan persentase
        $sum_output = array_sum($output);
        if ($sum_output < 0.01) {
            log_message('debug', "No rules fired, using percentage-based fallback");
            
            // Default mapping berdasarkan persentase penjualan
            if ($persentase_terjual < 25) {
                return 12.5; // Tidak Laris
            } elseif ($persentase_terjual < 50) {
                return 37.5; // Sedang
            } elseif ($persentase_terjual < 75) {
                return 62.5; // Laris
            } else {
                return 87.5; // Sangat Laris
            }
        }
        
        // Defuzzification
        return $this->defuzzify($output);
    }
}