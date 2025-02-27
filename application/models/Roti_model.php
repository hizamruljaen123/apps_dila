<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roti_model extends CI_Model {
    // CRUD untuk tabel roti
    public function get_all_roti() {
        return $this->db->get('roti')->result();
    }

    public function get_roti_by_id($id) {
        return $this->db->where('id', $id)->get('roti')->row();
    }

    public function insert_roti($data) {
        return $this->db->insert('roti', $data);
    }

    public function update_roti($id, $data) {
        return $this->db->where('id', $id)->update('roti', $data);
    }

    public function delete_roti($id) {
        return $this->db->where('id', $id)->delete('roti');
    }

    // Mengambil data fuzzy variables
    public function get_fuzzy_variables() {
        return $this->db->get('fuzzy_variables')->result();
    }

    public function insert_fuzzy_variable($data) {
        return $this->db->insert('fuzzy_variables', $data);
    }

    public function update_fuzzy_variable($id, $data) {
        return $this->db->where('id', $id)->update('fuzzy_variables', $data);
    }

    public function delete_fuzzy_variable($id) {
        return $this->db->where('id', $id)->delete('fuzzy_variables');
    }

    // Mengambil data fuzzy rules
    public function get_fuzzy_rules() {
        return $this->db->get('fuzzy_rules')->result();
    }

    public function insert_fuzzy_rule($data) {
        return $this->db->insert('fuzzy_rules', $data);
    }

    public function update_fuzzy_rule($id, $data) {
        return $this->db->where('id', $id)->update('fuzzy_rules', $data);
    }

    public function delete_fuzzy_rule($id) {
        return $this->db->where('id', $id)->delete('fuzzy_rules');
    }
}