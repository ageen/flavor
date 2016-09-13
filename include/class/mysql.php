<?php
class opera_db {
	
	var $show_errors = true;
	var $suppress_errors = false;
	var $ready = false;
	
	var $charset;
	var $collect;
	
	function opera_db($dbuser, $dbpassword, $dbname, $dbhost) {
		return $this->__construct($dbuser, $dbpassword, $dbname, $dbhost);	
	}
	
	// PHP5 constructor
	function __construct($dbuser, $dbpassword, $dbname, $dbhost) {
		register_shutdown_function(array(&$this, "__destruct"));
		
		if (defined('DB_CHARSET')) {
			$this->charset = DB_CHARSET;
		}
		
		if (defined('DB_COLLATE')) {
			$this->collate = DB_COLLATE;	
		}
		$this->conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
		if (!$this->conn) {
			$this->print_error("This either means that the username and password information in your <code>config.php</code> file is incorrect or we can't contact the database server at <code>$dbhost</code>. This could mean your host's database server is down.
			", "error establishing a database connection");
			return;
		}
		if(!mysqli_set_charset($this->conn, "utf8")){
			printf("Error loading character set utf8: %s\n", mysqli_error($this->conn));	
		}
	}
	
	function __destruct() {
		return true;
	}
	
	function query_insert($feed, $table) {
		$feed = add_magic_quotes($feed);
		$fields = array_keys($feed);
		$sql = "INSERT INTO $table (`" . implode('`,`',$fields) . "`) VALUES ('".implode("','",$feed)."')";
		return $sql;
	}
	
	function query_update($feed, $table, $where) {
		$feed = add_magic_quotes($feed);
		$bits = $wheres = array();
		foreach (array_keys($feed) as $k) {
			$bits[] = "`$k` = '$feed[$k]'";
		}
		$sql = "UPDATE $table SET " . implode(', ', $bits ) . ' WHERE ' . $where . ' LIMIT 1';
		return $sql;
	}
	
	function query_delete($id, $table) {
		$sql = "DELETE FROM $table WHERE id = $id";
		return $sql;
	}
	
	function query_ex($term) {
		if ($this->result = mysqli_query($this->conn, $term)) {
			return $this->result;
		} else {
			return false;
		}
	}
	
	function return_array($result, $type) {
		if ($type == 'num') {
			return $this->row = @mysqli_fetch_array($result, MYSQLI_NUM);
		} elseif ($type == 'assoc') {
			return $this->row = @mysqli_fetch_array($result, MYSQLI_ASSOC);	
		} else {
			return $this->row = @mysqli_fetch_array($result);
		}
	}
	
	function return_num($result) {
		return $this->num = mysqli_num_rows($result);
	}
	
	function free_result($result) {
		@mysqli_free_result($result);	
	}
	
	function print_error($str = '', $title = '') {
		global $EZSQL_ERROR;
		if($str == ''){
			$str = mysqli_error($this->conn);	
		}
		
		$EZSQL_ERROR[] = array('error_str' => $str);
		
		if ($this->suppress_errors) {
			return false;	
		}
		
		$error_str = "<p class='text-error'>$str</p>";
		if ($caller = $this->get_caller()) {
			$error_str .= " made by $caller";	
		}

		//	Is error output turned on or not ..
		if (!$this->show_errors) {
			return false;
		}
		
		//	If there is an error then take note of it
		if ($title != "") {
			bm_die($error_str, $title);
		} else {
			bm_die($error_str);
		}
	}
	
	//	Turn error handling on or off..
	function show_errors($show = true) {
		$errors = $this->show_errors;
		$this->showerrors = $show;
		return $errors;
	}
	
	function hide_errors() {
		$show = $this->show_errors;
		$this->show_errors = false;
		return $show;
	}
	
	function suppress_errors($suppress = true) {
		$errors = $this->suppress_errors;
		$this->suppress_errors = $suppress;
		return $errors;
	}
	
	function get_caller() {
		//	requires PHP 4.3+
		if (!is_callable('debug_backtrace')) {
			return '';	
		}
		
		$bt = debug_backtrace();
		$caller = '';
		
		foreach ($bt as $trace) {
			if (@$trace['class'] == __CLASS__) {
				continue;
			} elseif (strtolower(@$trace['function']) == 'call_user_func_array') {
				continue;	
			} elseif (strtolower(@$trace['function']) == 'apply_filters') {
				continue;	
			} elseif (strtolower(@$trace['function']) == 'do_action') {
				continue;	
			}
			
			$caller = $trace['function'];
			break;
		}
		return $caller;
	}
}

if (!isset($idb)) {
	$idb = new opera_db(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
}
?>
