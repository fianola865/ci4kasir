<?php

namespace App\Controllers;
use App\Models\PelangganModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pelanggan extends BaseController
{
    public function index()
    {
        return view('pelanggan/table');
    }
    public function tampil()
    {
        $model = new PelangganModel();
        $data = $model->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'pelanggan' => $data
        ]);
    }
    public function simpan()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'NamaPelanggan' => 'required',
            'Alamat' => 'required',
            'NomorTlp' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $data = [
            'NamaPelanggan' => $this->request->getPost('NamaPelanggan'),
            'Alamat' => $this->request->getPost('Alamat'),
            'NomorTlp' => $this->request->getPost('NomorTlp'),
        ];

        $model = new PelangganModel();
        if ($model->save($data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan data']);
        }
    }

    public function edit()
    {
        $id = $this->request->getVar('id');
        $model = new PelangganModel();
        $data = $model->find($id);
        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan'], 404);
        }

    }
    public function update()
    {
        $model = new PelangganModel();
        $id = $this->request->getPost('id');

        if (!$id || !$model->find($id)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }

        $data = [
            'NamaPelanggan' => $this->request->getVar('NamaPelanggan'),
            'Alamat' => $this->request->getVar('Alamat'),
            'NomorTlp' => $this->request->getVar('NomorTlp'),
        ];

        if ($model->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui data']);
        }
    }
    public function hapus($id)
    {
        $model = new PelangganModel();

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
