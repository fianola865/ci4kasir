<?php

namespace App\Controllers;

use App\Models\produkmodel;
use CodeIgniter\Controller;


class Produk extends Controller
{
    public function index()
    {

        return view('dataproduk/index');
    }

    public function tampil_produk()
    {
        $model = new produkmodel();

        $produk = $model->findAll();
        return $this->response->setJSON([
            'status' => 'success',
            'produk' => $produk
        ]);
    }
    public function simpan_produk()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_produk' => 'required',
            'harga' => 'required|decimal',
            'stok' => 'required|integer',
            
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }
        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
        ];

        $model = new produkmodel();
        $model->save($data);

           
    }


    public function edit_produk()
    {
        $produkID = $this->request->getVar('id');
        $model = new produkmodel();
        $produk = $model->find($produkID);

        if ($produk) {
            return $this->response->setJSON($produk);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan'], 404);
        }
    }

    public function update_produk()
    {
        $model = new ProdukModel();
        $id = $this->request->getVar('id');
        // Validasi ID produk
        if (!$id || !$model->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ]);
        }

        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok')
        ];

        // Coba update produk
        if ($model->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Gagal memperbarui produk'
            ]);
        }
    }

    public function hapus_produk($id)
    {
        $model = new produkmodel();

        // Pastikan ID valid dan data produk ditemukan
        if (!$model->find($id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ])->setStatusCode(404);
        }

        // Hapus produk
        if ($model->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Produk berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus produk'
            ])->setStatusCode(500);
        }
    }


}
