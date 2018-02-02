<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Database_Meta extends CI_Model
{
	/**
	 * Config
	 *
	 * $metainfo = array(
	 *   "table"=>$table,
	 *   "table_meta"=>$table_meta,
	 *   "value_column"=>$table_meta,
	 *   "field_column"=>$table_meta,
	 *   "parent_column"=>$table_meta,
	 *   "foreign_keys"=>array("field"=>$val),
	 *   "id"=>$id
	 * );
	 *
	 */
	public function __construct($metainfo) {
		parent::__construct();

		if (!is_array($metainfo)) return false;
		$this->_config = $metainfo;

		if (!isset($this->_config['parent_column'])) $this->_config['parent_column'] = "parent_id";
		if (!isset($this->_config['field_column'])) $this->_config['field_column'] = "field";
		if (!isset($this->_config['value_column'])) $this->_config['value_column'] = "value";
		if (!isset($this->_config['is_vertical'])) $this->_config['is_vertical'] = true;

			/* Init instances */
			$this->loadParentTable();

		if (isset($this->_config['id'])) {
			/* Check if id exists */
			if (!$this->_parentInstance->getData('id')) return false;
			$this->loadMetaTable();
		}
	}

	/* Props */
	protected $_config = array();
	protected $_data = array();
	protected $_props = array();
	protected $_parentInstance = array();

	/* Get Data */
	public function getData($field=null) {

		if (!$this->_config['is_vertical']) return $this->_data;
		
		if (!$field) return $this->_props;

		if (!isset($this->_props[$field]))
			return false;

		return $this->_props[$field];
	}

	private function loadMetaTable() {

		$meta_db_fields = $this->db->list_fields($this->_config['table_meta']);

		$res = $this->db->get_where($this->_config['table_meta'],array($this->_config['parent_column']=>$this->_config['id']));
		$res = $res->result_array();

		$rta = array();

		foreach ($res as $rw) {

			/* Return $rw if not vertical meta */
			if (!$this->_config['is_vertical']) {
				$this->_data[] = $rw;
				continue;
			}

			$rval = ($this->core_misc->is_serialized($rw[$this->_config['value_column']]))?unserialize($rw[$this->_config['value_column']]):$rw[$this->_config['value_column']];
			$rta[$rw[$this->_config['field_column']]] = $rval;
		}

		$this->_props = $rta;

		return $this;
	}

	private function loadParentTable() {
		$dbo = new Database_Object($this->_config['table']);

		if (isset($this->_config['id'])) {
			$dbo = $dbo->load($this->_config['id']);
		}

		$this->_parentInstance = $dbo;
		
		/** modified 12/04/17 test fix jo, saree... **/
		if($dbo->getData()){
			$this->_props['parent_data'] = $dbo->getData();			
		}
		/** modified 12/04/17 test fix jo, saree... **/
		
		return $this;
	}

	public function getParent() {
		return $this->_parentInstance;
	}

	public function setData($field, $value) {
		// $fval = (is_array($value))?serialize($value):$value;
		// $this->_props[$field] = $fval;
		$this->_props[$field] = $value;
		return $this;
	}

	public function updateParent() {
		$this->_config['id'] = $this->_parentInstance->getData('id');
	}

	public function delete() {
		return $this->_parentInstance->delete();
	}

	public function save($fields=array()) {

		if (!isset($this->_config['id'])) {


			$f_keys = array("cache"=>md5(rand()));

			if (isset($this->_config['foreign_keys'])) {
				foreach ($this->_config['foreign_keys'] as $fld => $vl) {
					$f_keys[$fld] = $vl;
				}
			}

			$this->db->insert($this->_config['table'],$f_keys);
			$this->_config['id'] = $this->db->insert_id();
			$main_model = new Database_Object($this->_config['table']);
			$this->_parentInstance = $main_model->load($this->_config['id']);
		}

		if (count($this->_props) > 0) {
			foreach ($this->_props as $field => $value) {

				if (is_array($value)) $value = serialize($value);

				if (is_array($fields) && $fields) {
					if ( ! in_array($field, $fields)) continue;
				}

				$where = array(
					$this->_config['parent_column']=>$this->_config['id'],
					$this->_config['field_column']=>$field
				);

				/* Check if field exists */
				$this->db->where($where);
				$res = $this->db->get($this->_config['table_meta']);
				$res = $res->result_array();

				$meta = array(
					$this->_config['field_column']=>$field,
					$this->_config['value_column']=>$value
				);
				$meta[$this->_config['parent_column']] = $this->_config['id'];

				if ($res) { /* If field exist */
					$this->db->where($where);
					$this->db->update($this->_config['table_meta'],$meta);
				} else { /* Insert new field */
					$this->db->insert($this->_config['table_meta'],$meta);
				}
			}
		}


		return $this->_config['id'];
	}

	public function getAll($opts = array()) {

		if ($opts) {
			if (is_array($opts)) {
				if (isset($opts['parent_data']) && $opts['parent_data'] && is_array($opts['parent_data'])) {
					foreach ($opts['parent_data'] as $key => $value) {
						if ($value) {
							$this->db->where($key,$value);
						}
					}
				}

				if (isset($opts['in']) && $opts['in']) {
					$this->db->where_in('id',$opts['in']);
				}
			}
		}

		$tb = $this->db->get($this->_config['table']);
		$tbr = $tb->result_array();

		$res = array();

		foreach ($tbr as $td) {
			$config =  $this->_config;
			$config['id'] = $td['id'];

			$item = new Database_Meta($config);

			$tm = $item->getData();
			/** modified 12/04/17 test fix jo, saree... **/
			if($item->getParent()->getData()){
				$tm['parent_data'] = $item->getParent()->getData();				
			}
			/** modified 12/04/17 test fix jo, saree... **/

			$res[] = $tm;
		}

		return $res;
	}


	public function delete_data($attr) {

		if ($this->getData($attr)) {
			$this->db->where($this->_config['field_column'],$attr);
			$this->db->where($this->_config['parent_column'],$this->_config['id']);
			$this->db->delete($this->_config['table_meta']);
		}

		return $this;
	}
}