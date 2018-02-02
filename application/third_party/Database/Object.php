<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Database_Object extends CI_Model
{
	function __construct($table_name = FALSE, $id = NULL) {
		parent::__construct();

		if ($table_name) {
			$this->_obTable = $table_name;
		}

		if ($id) {
			$this->setId($id);
			$this->setObData($this->initData());
		}

		return $this;
	}

	/**
	 * Properties
	 */
	protected $_obTable;
	protected $_obData = array();
	protected $_id = NULL;

	/**
	 * Init table to be used
	 */
	public function init($table_name) {
		$this->_obTable = $table_name;
		return clone $this;
	}

	/**
	 * Return new instance
	 */
	public function create($table_name = NULL) {

		if ($table_name) $this->init($table_name);

		if (!$this->_obTable) return FALSE;

		return clone $this;
	}

	/**
	 * Load the row with specified id
	 */
	public function load($id) {

		if (!$_clone = $this->create()) return FALSE;

		$_clone->setId($id);
		$_clone->setObData($_clone->initData());

		return $_clone;
	}
	
	public function getCollection($limit = NULL){
		$collection = $this->db->get($this->getTableName());
		$arrCollection = array();
		$count = 0;
		foreach($collection->result_array() as $col){

			if ($limit && $count >= $limit)  {
				break;
			}

			$arrCollection[] = $col;

			$count++;

		}
		return $arrCollection;
	}

	public function getAll($limit = NULL) {
		return $this->getCollection($limit);
	}
	
	public function setId($id) {
		$this->setData('id',$id);
		$this->_id = $id;
		return $this;
	}

	public function setObData($data) {
		$this->_obData = $data;
	}

	/**
	 * Stores data to be queried fast
	 */
	protected function initData() {
		$result = $this->db->get_where($this->_obTable,array(
			"id"=>$this->_id
		));
		return $result->row_array();
	}

	/**
	 * Get field value
	 */
	public function getData($field = NULL) {
		if ($field==NULL) return $this->getAttributes();
		// return (isset($this->_obData[$field]))?$this->_obData[$field]['value']:FALSE;
		return (isset($this->_obData[$field]))?$this->_obData[$field]:FALSE;
	}

	/**
	 * Returns all fields of loaded row
	 */
	public function getAttributes() {
		return $this->_obData;
	}

	/**
	 * Store data on the ob
	 */
	public function setData($field,$value, $escape = TRUE) {
		// $this->_obData[$field] = array(
		// 	'value'=>$value,
		// 	'escape'=>($escape) ? TRUE: FALSE
		// );
		$this->_obData[$field] = $value;
		return $this;
	}

	/**
	 * Store data on the ob
	 */
	public function unsetData($field) {
		unset($this->_obData[$field]);
		return $this;
	}

	/**
	 * Get loaded id
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * Returns initialized table
	 */
	public function getTableName() {
		return $this->_obTable;
	}

	/**
	 * Updates row of loaded id
	 * Insert new row if no id is loaded
	 */
	public function save($fields=array()) {

		/* Get attributes */

		$data = array();

		// foreach ($this->_obData as $key => $info) {
		// 	// $data[$key] = $info['value'];
		// }


		// $data = $this->_obData;

		foreach ($this->_obData as $key => $value) {
			if (is_array($fields) && $fields) {
				if ( ! in_array($key, $fields)) continue;
			}

			$data[$key] = $value;
		}

		if ($this->getId()) {
			$this->db->update($this->_obTable,$data,array('id'=>$this->getId()));
		}
		else {
			$this->unsetData('id');
			$this->db->insert($this->_obTable,$data);
			$id = $this->db->insert_id();
			$this->setId($id);
		}
		return $this->getId();
	}

	/**
	 * Delete row with loaded id
	 */
	public function delete() {
		// $this->db->delete($this->_obTable, array('id' => $this->_id));
		return $this->db->delete($this->_obTable, array('id' => $this->_id));
		// return $this->init($this->_obTable);
	}

	/**
	 * Returns array of rows with specified field
	 */
	public function get_by_field($fields = array()) {
		if (!is_array($fields))
			return array();
		if (count($fields) < 1)
			return array();

		$result = $this->db->get_where($this->_obTable,$fields);
		return $result->row_array();
	}

	public function getByFields($fields = array()) {
		return $this->get_by_field($fields);
	}

	/**
	 * Returns array of rows with specified field
	 */
	public function get_items_by_field($fields = array()) {
		if (!is_array($fields))
			return array();
		if (count($fields) < 1)
			return array();

		$rows = array();

		$result = $this->db->get_where($this->_obTable,$fields);

		foreach ($result->result_array() as $row) {
			$rows[$row['id']] = $row;
		}

		return $rows;
	}
	
	public function getItemsByField($field = array()){
		return $this->get_items_by_field($field);
	}
	/**
	 * Display table column names
	 */
	public function listFields() {
		return $this->db->list_fields($this->getTableName());
	}
	public function list_fields() {
		return $this->listFields();
	}
	
	public function getFields(){
		return $this->listFields();
	}
	/**
	* Display Vertical Attributes Fields
	*/
	public function getAttributeNames($options=NULL){
		$_attribute = array();
		if($options) $this->db->like('options', $options);
		$attributes = $this->db->get($this->getTableName());
		foreach ($attributes->result() as $attribute) {
    		$_attribute[] = $attribute->name;
    	}
    	return $_attribute;
	}


	public function removeData($field){

		if (isset($this->_obData[$field])) {
			unset($this->_obData[$field]);
		}

		return $this;

	}
}