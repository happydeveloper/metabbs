<?php
define('METABBS_TABLE_PREFIX', 'meta_');
function get_table_name($model) {
	return METABBS_TABLE_PREFIX . $model;
}
function get_column_pair($column) {
	return "$column->name=" . $column->to_string();
}

class Model
{
	var $id;
	var $db;

	function Model($attributes = null) {
		$this->db = get_conn();
		$this->import($attributes);
		$this->_init();
	}
	function _init() { }
	function get_model_name() {
		if (!isset($this->model)) {
			$this->model = strtolower(get_class($this));
		}
		return $this->model;
	}
	function import($attributes) {
		if (is_array($attributes)) {
			foreach ($attributes as $key => $value) {
				$this->$key = $value;
			}
		}
	}
	function exists() {
		return !!$this->id;
	}
	function get_id() {
		return $this->id;
	}
	function create() {
		$columns = $this->db->get_columns($this->table);
		$count = count($columns);
		for ($i = 0; $i < $count; $i++) {
			$column = &$columns[$i];
			$column->set_value(@$this->{$column->name});
		}
		$query = "INSERT INTO $this->table";
		$query .= " (".implode(",", array_map('get_column_name', $columns)).")";
		$query .= " VALUES(".implode(",", array_map('column_to_string', $columns)).")";
		$this->db->query($query);
		$this->id = $this->db->insertid();
	}
	function update() {
		$columns = $this->db->get_columns($this->table);
		$count = count($columns);
		for ($i = 0; $i < $count; $i++) {
			$column = &$columns[$i];
			$column->set_value(@$this->{$column->name});
		}
		$query = "UPDATE $this->table SET ";
		$query .= implode(",", array_map('get_column_pair', $columns));
		$query .= " WHERE id=$this->id";
		$this->db->query($query);
	}
	function delete() {
		$this->db->query("DELETE FROM $this->table WHERE id=$this->id");
	}
}
?>
