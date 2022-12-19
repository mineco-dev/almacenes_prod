<?php   
class DBMS { 
	var $result, 
	$rowcount, 
	$curpos, 
	$fieldcount, 
	$fn, 
	$rowset, 
	$connection, 
	$bdd,
	$sql; 
	
	function DBMS($Conn) { 
		
		$this->connection=$Conn; 
	} 
	
	function Query2() { 
		$this->Close(); 
		$this->result = mssql_query($this->bdd,$this->sql); 
		if (!$this->result) 
		return(0); 
		$this->rowcount = mssql_num_rows($this->result); 


		$this->fieldcount = mssql_num_fields($this->result); 
		for ($i=1;$i<=$this->fieldcount;$i++) { 
			$f=mssql_fetch_field($this->result,$i-1); 
			$this->fn[$i]=$f->name; 
		} 
		$this->curpos=0; 
	} 
	
	function QueryI() { 
		$this->Close(); 
		$this->result = mssql_db_query($this->bdd,$this->sql); 
		if (!$this->result) 
		return(0); 
		$this->curpos=0; 
	} 
	
	function MoveFirst() { 
		$this->curpos=0; 
	} 
	
	function MoveNext() { 
		if (!$this->result) return(0); 
		if ($this->curpos==$this->rowcount) return(0); 
		for($i=1;$i<=$this->fieldcount;$i++) 
		$this->rowset[$this->fn[$i]] = mssql_result($this->result,$this->curpos,$this->fn[$i]); 
		$this->curpos++; 
		return($this->rowset); 
	} 
	
	function Eof() { 
		if ($this->curpos==$this->rowcount-1) 
		return(1); 
		return(0); 
	} 
	
	function Bof() { 
		if (!$this->curpos) 
		return(1); 
		return(0); 
	} 
	
	function Close() { 
		if ($this->result && $this->rowcount) 
		mssql_free_result($this->result); 
		$this->result=0; 
		$this->fn=array(); 
		$this->rowset=array(); 
		$this->rowcount=0; 
		$this->fieldcount=0; 
	} 
} 
?> 
