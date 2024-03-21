<?php
class Add_data_model extends CI_Model
{
    public $_table = 'data_transaksi';

    function __construct()
    {
        parent::__construct();
    }

    public function create($insertData)
    {
        $result = $this->db->insert($this->_table, $insertData);
        return $result; // Mengembalikan hasil dari operasi penambahan data ke tabel
    }

    public function get()
      {
         return $this->db->get($this->_table)->result(); // Mengembalikan semua data
      }

//    public function get_all_users()
//    {
//       $this->db->select('u.*,GROUP_CONCAT(g.name) as group_name')
//         ->from('users as u')
//         ->join('users_groups as ug', 'ug.user_id = u.id', 'left')
//         ->join('groups as g', 'g.id = ug.group_id', 'left')
//         ->group_by('ug.user_id')
//         ->order_by('u.id', 'DESC');
//       $query = $this->db->get();
//       if ($query->num_rows() != 0) {
//          return $query->result_array();
//       } else {
//          return false;
//       }
//    }

   // get a record by id
   public function get_by_id($id)
   {
      $this ->db->where('id', $id);
      $query = $this->db->get('data_transaksi');
      return $query->row();
   
   }
//    public function get_data_by_id($id) {
//       $query = $this->db->get_where('data_transaksi', array('id' => $id));
//       return $query->row();
//   }

  public function update_data($id, $data) {
      $this->db->where('id', $id);
      $this->db->update('data_transaksi', $data);
  }

//    public function get_data_by_id($id) {
//       // Get data by ID
//       $query = $this->db->get_where('data_transaksi', array('id' => $id));
//       return $query->row();
//   }

//   public function update_data($id, $data) {
//       // Update data by ID
//       $this->db->where('id', $id);
//       return $this->db->update('data_transaksi', $data);
//   }
}
?>
