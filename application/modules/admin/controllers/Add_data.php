<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_data extends Admin_Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Add_data_model');

        $group = 'admin';
        if (!$this->ion_auth->in_group($group)) {
            $this->session->set_flashdata('message', 'You must be an administrator to view the users page.');
            redirect('admin/dashboard/access_denied');
        }
    }

    public function index() {
        $this->data['title'] = 'Manage data';
        $this->data['breadcrumbs'] = 'Manage data';
        // $this->load->view('admin/add_data/manage', $this->data);
        $this->get_all(); // Panggil fungsi get_all untuk mendapatkan data
    }

    public function create_form() {
        $this->setOutputMode(NORMAL);
        if ($this->input->is_ajax_request()) {
            // $this->data['groups'] = $this->ion_auth->groups()->result();
            $view = $this->load->view('admin/add_data/add', $this->data, true);
            $this->output->set_output($view);
        } else {
            redirect('admin/dashboard');
        }
    }

    public function create(){
        $nama_penyedia = $this->input->post('nama_penyedia');
        $nama_bank = $this->input->post('nama_bank');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $no_pesanan = $this->input->post('no_pesanan');
        $kode_rekening = $this->input->post('kode_rekening');
        $jumlah_pengajuan = $this->input->post('jumlah_pengajuan');
        $potongan_pph = $_POST['potongan_pph']; // Mendapatkan nilai yang dipilih dari dropdown
        $biaya_kirim_uang = $this->input->post('biaya_kirim_uang');
        $jumlah_diterima = $this->input->post('jumlah_diterima');
        $keterangan = $this->input->post('keterangan');
        $jenis_spj = $_POST['jenis_spj']; 

        $Add_data = array(
            'nama_penyedia' => $nama_penyedia,
            'nama_bank' => $nama_bank,
            'kode_kegiatan' =>$kode_kegiatan,
            'no_pesanan' => $no_pesanan,
            'kode_rekening' => $kode_rekening,
            'jumlah_pengajuan' => $jumlah_pengajuan,
            'potongan_pph' => $potongan_pph,
            'biaya_kirim_uang' => $biaya_kirim_uang,
            'jumlah_diterima' => $jumlah_diterima,
            'keterangan' => $keterangan,
            'jenis_spj' => $jenis_spj

        );

        $this->Add_data_model->create($Add_data);
        redirect(base_url('admin/add_data/'));
    //     if ($Add_data) {
    //         // If data saving is successful, return success message
    //         echo json_encode([
    //             'status' => 'success',
    //             'message' => 'Data berhasil ditambahkan.'
    //         ]);
    //     } else {
    //         // If data saving fails, return error message
    //         echo json_encode([
    //             'status' => 'error',
    //             'message' => 'Gagal menambahkan data.'
    //         ]);
    //     }
    }

    // public function get_all() {
    //     $query = $this->Add_data_model-->get();
    //     $data =array('data_transaksi'=> $query);
    //     $this->load->view('admin/add_data/manage', $data);
       
    // }
    
    public function get_all() {
        // Mengambil data dari model
        $data['query'] = $this->Add_data_model->get();
        
        // Memuat view dan meneruskan data
        $this->load->view('admin/add_data/manage', $data);
    }
    public function edit_form() {
        $this->setOutputMode(NORMAL);
    
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $queryeditform = $this->Add_data_model->get_by_id($id);
            $data = array('query'=> $queryeditform); // Perbaikan variabel data
            $view = $this->load->view('admin/add_data/edit', $data, true); // Perbaikan penulisan variabel
            $this->output->set_output($view);
        } else {
            redirect('admin/dashboard');
        }
    }
    
    

    public function update() {
        $nama_penyedia = $this->input->post('nama_penyedia');
        $nama_bank = $this->input->post('nama_bank');
        $kode_kegiatan = $this->input->post('kode_kegiatan');
        $no_pesanan = $this->input->post('no_pesanan');
        $kode_rekening = $this->input->post('kode_rekening');
        $jumlah_pengajuan = $this->input->post('jumlah_pengajuan');
        $potongan_pph = $_POST['potongan_pph']; // Mendapatkan nilai yang dipilih dari dropdown
        $biaya_kirim_uang = $this->input->post('biaya_kirim_uang');
        $jumlah_diterima = $this->input->post('jumlah_diterima');
        $keterangan = $this->input->post('keterangan');
        $jenis_spj = $_POST['jenis_spj']; 

        $Arrupdate = array(
            'nama_penyedia' => $nama_penyedia,
            'nama_bank' => $nama_bank,
            'kode_kegiatan' =>$kode_kegiatan,
            'no_pesanan' => $no_pesanan,
            'kode_rekening' => $kode_rekening,
            'jumlah_pengajuan' => $jumlah_pengajuan,
            'potongan_pph' => $potongan_pph,
            'biaya_kirim_uang' => $biaya_kirim_uang,
            'jumlah_diterima' => $jumlah_diterima,
            'keterangan' => $keterangan,
            'jenis_spj' => $jenis_spj

        );

        $this->Add_data_model->update_data($id, $Arrupdate);
        redirect(base_url('admin/add_data/manage/'));
        


    }


    // public function update() {
    //     $this->form_validation->set_rules('nama_penyedia', 'Nama Penyedia', 'trim|required');
    //     $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'trim|required');
    //     $this->form_validation->set_rules('kode_kegitan', 'kode kegiatan', 'trim|required');
    //     $this->form_validation->set_rules('no_pesanan', 'No Pesanan', 'trim|required');
    //     $this->form_validation->set_rules('kode_rekening', 'Kode Rekening', 'trim|required');
    //     $this->form_validation->set_rules('jumlah_pengajuan', 'Jumlah Pengajuan', 'trim|required');
    //     $this->form_validation->set_rules('potongan_pph', 'Potongan PPH', 'trim|required');
    //     $this->form_validation->set_rules('biaya_kirim_uang', 'Biaya Kirim Uang', 'trim|required');
    //     $this->form_validation->set_rules('jumlah_diterima', 'Jumlah Diterima', 'trim|required');
    //     $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
    //     $this->form_validation->set_rules('jenis_spj', 'Jenis SPJ', 'trim|required');

    //     // Set other form validation rules as needed

    //     if ($this->form_validation->run() === FALSE) {
    //         // Validation failed, reload the edit view with error messages
    //         $this->load->view('admin/add_data/edit');
    //     } else {
    //         $id = $this->input->post('id');
    //         $data = array(
    //             'nama_penyedia' => $this->input->post('nama_penyedia'),
    //             'nama_bank' => $this->input->post('nama_bank'),
    //             'kode_kegiatan' => $this->input->post('kode_kegiatan'),
    //             'no_pesanan' => $this->input->post('no_pesanan'),
    //             'kode_rekening' => $this->input->post('kode_rekening'),
    //             'jumlah_pengajuan' => $this->input->post('jumlah_pengajuan'),
    //             'potongan_pph' => $this->input->post('potongan_pph'),
    //             'biaya_kirim_uang' => $this->input->post('biaya_kirim_uang'),
    //             'jumlah_diterima' => $this->input->post('jumlah_diterima'),
    //             'keterangan' => $this->input->post('keterangan'),
    //             'jenis_spj' => $this->input->post('jenis_spj')
    //         );

    //         if ($this->Add_data_model->update_data($id, $data)) {
    //             redirect('admin/add_data/manage/');
    //         } else {
    //             // Handle update failure
    //         }
    //     }
    // }
    
}

?>
