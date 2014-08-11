<?php

class DBWrapper {
	
	private $server;
    private $user;
    private $passwd;
    private $dbname;
	private $connection;         		//The MySQL database connection
	

    public function __construct() {
		/*$this->server 	= "localhost";			// The database host server
	    $this->user 	= "vallei_auto";		// The database username
        $this->passwd 	= "j3rMJkJ5";		// The database password
	    $this->dbname 	= "vallei_auto";		// The database t
        $this->connect();
        */

        $this->server 	= "localhost";			// The database host server
	    $this->user 	= "root";		// The database username
        $this->passwd 	= "root";		// The database password
	    $this->dbname 	= "vallei_auto";		// The database t
        $this->connect();
	}
	
    private function connect() {
		$this->connection = mysql_connect ($this->server, $this->user, $this->passwd);
        @mysql_select_db ($this->dbname, $this->connection);
    }
	
    private function close() {
        return (mysql_close($this->connection));
    }
	
	
	
	
	
	
    public function query($query)  {
		$this->rs = @mysql_query($query, $this->connection);
        if (!$this->rs) {
			return "";
        } else {
			return ($this->rs);
        }
    }
	
	public function data_seek($row = "") {
		if ($row == "")
			$row = 0;
		@mysql_data_seek($rs, $row);
		return (true);
	}
	
    public function fetch_array($rs = "")  {
		if ($rs == "")
			$rs = $this->rs;
              
		$this->row = @mysql_fetch_array($rs, MYSQL_BOTH);
		return ($this->row);
	}
	
	public function num_rows($rs = "") {
		if ($rs == "")
			$rs = $this->rs;
		return (@mysql_num_rows($rs));
	}
	
	public function affected_rows() {
		return (@mysql_affected_rows());
    }
	
	public function free_result($rs = "") {
		if ($rs == "")
			$rs = $this->rs;
		return (@mysql_free_result($rs));
	}
	
	
}
?>