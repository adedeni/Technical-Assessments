<?php

namespace Hello_Staff\Models;

use CodeIgniter\Model;

class Hello_Staff_Model extends Model
{
    protected $table;
    protected $primaryKey = 'id';
    protected $returnType = 'object';

    public function __construct()
    {
        parent::__construct();
        $this->table = get_db_prefix() . "plugin_hello_staff_items";
        $this->db = db_connect('default');
    }

    /**
     * Return non-deleted items from demo table.
     * @return array of stdClass rows
     */
    public function list_items(): array
    {
        $builder = $this->db->table($this->table);
        $builder->where('deleted', 0);
        return $builder->get()->getResult();
    }
}
