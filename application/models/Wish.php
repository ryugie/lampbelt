<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wish extends CI_Model {

	public function registerUser($dataz) {
		$sql = "INSERT INTO users (name, username, password, datehired, created_at, updated_at) VALUES (?, ?, ?, ?, NOW() ,NOW())";
		$params = [
			$dataz['name'],
			$dataz['username'],
			$dataz['password'],
			$dataz['datehired']
		];

		$this->db->query($sql, $params);
	}

	public function loginUser($dataz) {
		$sql = "SELECT * FROM users WHERE username = ? AND password = ?";

		$params = [
			$dataz['username'],
			$dataz['password']
		];

		return $this->db->query($sql, $params)->row_array();
	}

	public function createTables() {
		$sql = "SELECT items.name, items.creator, items.created_at FROM items 
				LEFT JOIN wishlists ON item_id = items.id 
				LEFT JOIN users on user_id = users.id WHERE username = '{$this->session->userdata('currentUser')['username']}'";
		return $this->db->query($sql)->result_array();
	}

	public function createTables2() {
		$sql = "SELECT items.name, items.creator, items.created_at FROM items 
				LEFT JOIN wishlists ON item_id = items.id 
				LEFT JOIN users on user_id = users.id
				LIMIT 10"; // LIMIT NUMBER OF ROWS HERE
		return $this->db->query($sql)->result_array();
	}

	public function registerItem($dataz) {
		$sql = "INSERT INTO items (name, creator, created_at, updated_at) VALUES (?, '{$this->session->userdata('currentUser')['username']}', NOW() ,NOW())";
		$params = [
			$dataz['creation']
		];
		$this->db->query($sql, $params);

		$sql2 = "SELECT items.id FROM items ORDER BY created_at DESC LIMIT 1"; // yea yea i know
		$itemID = $this->db->query($sql2)->row_array();

		$sql3 = "INSERT INTO wishlists (user_id, item_id, created_at, updated_at) VALUES ({$this->session->userdata('currentUser')['id']}, {$itemID['id']}, NOW(), NOW())";
		$this->db->query($sql3);
	}

	// ------------------FIX QUERIES---------------------------

	public function deleteItem($dataz) {
		$sql = "DELETE FROM items WHERE items.name = '{$dataz}'";

		$this->db->query($sql);
	}

	public function unwishItem($dataz) { 
		$sql0 = "SELECT item_id FROM wishlists 
				LEFT JOIN items ON items.id = wishlists.item_id
				LEFT JOIN users ON wishlists.user_id = users.id
				WHERE items.name = '{$dataz}' AND wishlists.user_id = '{$this->session->userdata('currentUser')['id']}'";
		$test = $this->db->query($sql0)->row_array();

		$sql = "DELETE FROM wishlists
				WHERE wishlists.user_id = '{$this->session->userdata('currentUser')['id']}' AND item_id = '{$test['item_id']}'";

		$this->db->query($sql);
	}

	// --------------------------------------------------------

	public function wishItem($n) {
		$sql0 = "SELECT items.id FROM items WHERE items.name = '{$n}'";
		$temp = $this->db->query($sql0)->row_array();

		$sql = "INSERT INTO wishlists (user_id, item_id, created_at, updated_at) VALUES ({$this->session->userdata('currentUser')['id']}, {$temp['id']}, NOW(), NOW())";
		$this->db->query($sql);

		redirect('/Wishes/viewDash');
	}

	public function grabUsers($n) {
		$sql = "SELECT users.name FROM users
				LEFT JOIN wishlists ON user_id = users.id
				LEFT JOIN items ON items.id = item_id
				WHERE items.name = '{$n}'";
		return $this->db->query($sql)->result_array();
	}
}