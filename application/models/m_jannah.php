<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jannah extends CI_Model {
    public function tampil()
    {
        $tm_jannah=$this->db
                      ->join('kategori','kategori.id_kategori=jannah.id_kategori')
                      ->get('jannah')
                      ->result();
        return $tm_jannah;
    }
    public function data_kategori()
    {
        return $this->db->get('kategori')
                        ->result();
    }
    public function simpan_jannah($file_cover)
    {
        if ($file_cover=="") {
             $object = array(
                'id_jannah' => $this->input->post('id_jannah'), 
                'merk_jannah' => $this->input->post('merk_jannah'), 
                'size' => $this->input->post('size'), 
                'id_kategori' => $this->input->post('id_kategori'), 
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
             );
        }else{
            $object = array(
                'id_jannah' => $this->input->post('id_jannah'), 
                'merk_jannah' => $this->input->post('merk_jannah'), 
                'size' => $this->input->post('size'), 
                'id_kategori' => $this->input->post('id_kategori'), 
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'foto' => $file_cover
             );
        }
        return $this->db->insert('jannah', $object);
    }
    public function detail($a)
    {
        $tm_buku=$this->db
                      ->join('kategori', 'kategori.id_kategori=jannah.id_kategori')
                      ->where('id_jannah', $a)
                      ->get('jannah')
                      ->row();
        return $tm_buku;
    }
    public function edit_jannah()
    {
        $data = array(
            'id_jannah' => $this->input->post('id_jannah'), 
            'merk_jannah' => $this->input->post('merk_jannah'), 
            'size' => $this->input->post('size'), 
            'id_kategori' => $this->input->post('id_kategori'), 
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok')

            );

        return $this->db->where('id_jannah', $this->input->post('id_jannah_lama'))
                        ->update('jannah', $data);
    }
    public function edit_jannah_dengan_foto($file_cover)
    {
        $data = array(
                'id_jannah' => $this->input->post('id_jannah'), 
                'merk_jannah' => $this->input->post('merk_jannah'), 
                'size' => $this->input->post('size'), 
                'id_kategori' => $this->input->post('id_kategori'), 
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'foto' => $file_cover

            );

        return $this->db->where('id_jannah', $this->input->post('id_jannah_lama'))
                        ->update('jannah', $data);
    }
    public function hapus_jannah($id_jannah='')
    {
        return $this->db->where('id_jannah', $id_jannah)
                    ->delete('jannah');
    }
    

}

/* End of file M_buku.php */
/* Location: ./application/models/M_buku.php */