<?php

include 'database.php';

/**
* CRUD Operation
*/
class crud
{
	// CRUD Table
	private $table = 'crud_table';

	// Take value and set in this variable
	private $name;
	private $profession;
	private $age;

	// Data will reach and set by this function from index
	public function setName($take_name)
	{
		$this->name = $take_name;
	}
	public function setProfession($take_profession)
	{
		$this->profession = $take_profession;
	}
	public function setAge($take_age)
	{
		$this->age = $take_age;
	}

	// Now Insert data to database
	public function create_all()
	{
		$c_query = "INSERT INTO $this->table(name, profession, age) VALUES(:nam, :pro, :age)";
		$c_result = DB::prepare_crud($c_query);
		$c_result->bindparam(':nam', $this->name);
		$c_result->bindparam(':pro', $this->profession);
		$c_result->bindparam(':age', $this->age);
		return $c_result->execute();
	}

	// Funtion to show all data
	public function read_all()
	{
		$query  = "SELECT * FROM $this->table";
		$result = DB::prepare_crud($query);
		$result->execute();
		return $result->fetchAll();
	}

	//Update Data
	public function readbyid($id)
	{
		$u_query = "SELECT * FROM $this->table WHERE id=:id";
		$u_result = DB::prepare_crud($u_query);
		$u_result->bindparam(':id', $id);
	    $u_result->execute();
	    return $u_result->fetch();

	}
	public function update_all($id)
	{
		$u_query = "UPDATE $this->table SET name=:name, profession=:pro, age=:age WHERE id=:id";
		$u_result = DB::prepare_crud($u_query);
		$u_result->bindparam(':id', $id);
		$u_result->bindparam(':name', $this->name);
		$u_result->bindparam(':pro', $this->profession);
		$u_result->bindparam(':age', $this->age);
		return $u_result->execute();
	}

	//Delete Data
	public function delete($id){
		$d_query = "DELETE FROM $this->table WHERE id=:id";
		$d_result = DB::prepare_crud($d_query);
		$d_result->bindparam(':id', $id);
	    return $d_result->execute();

	}
}