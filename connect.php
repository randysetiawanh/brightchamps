<?php
class CodenodForm{
	
	private $conn;
	public $table_name = "job_application";

	/**
	 * Database connection
	 * Require database hostname | DB Name | DB pass
	 */
	public function __construct()
	{
		$this->conn=new mysqli("localhost","root","","brightchamps") or die("connetion error!"); // please change with your mysql detail
		
	}

	public function userReg($name,$username,$password,$email)
	{

		$password = md5($password);
		$sql="SELECT * FROM users WHERE username='$username' OR email='$email'";

		//checking if the username or email is available in db
		$check =  $this->conn->query($sql) ;
		$count_row = $check->num_rows;

		//if the username is not in db then insert to the table
		if ($count_row == 0){
			$query="INSERT INTO users SET username='$username', password='$password', name='$name', email='$email'";
			
			$result = mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
			return $result;
		} else { 
			return false;
		}
	}

	public function userLogin($user, $pass)
	{

		if($user == "" || $pass == "") {
			echo "Either username or password field is empty.";
		} else {
			$result = mysqli_query($this->conn, "SELECT * FROM users WHERE username='$user' AND password=md5('$pass')")
			or die("Could not execute the select query.");

			$row = mysqli_fetch_assoc($result);

			if(is_array($row) && !empty($row)) {
				$validuser = $row['username'];
				$_SESSION['valid'] = $validuser;
				$_SESSION['name'] = $row['name'];
				$_SESSION['level_admin'] = $row['level_admin'];
				$_SESSION['id'] = $row['id'];
			} else {
			}

			if(isset($_SESSION['valid'])) {
				header('Location: ../index.php');            
			}
		}
	}

	/**
	 * add user
	 */
	public function userAdd($name,$username,$email,$password,$level_admin)
	{
		$password = md5($password);

		if($username == "" || $password == "" || $email == "") {
			echo "Either username or password field is empty.";
		} else {
			$sql="SELECT * FROM users WHERE username='$username' OR email='$email'";

			$check =  $this->conn->query($sql) ;
			$count_row = $check->num_rows;
			//if the username is not in db then insert to the table
			if ($count_row == 0){
				$query="INSERT INTO users SET username='$username', password='$password', name='$name', email='$email'";
				$result = mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
				return $result;
			} else {
				return false;
			}

			if(isset($_SESSION['valid'])) {
				header('Location: user.php');            
			}
		}

		return true;

	}

	/**
	 * update user
	 */
	public function userUpdate($id,$name,$username,$email,$password,$level_admin,$table){
		$password = md5($password);
		mysqli_query($this->conn,"UPDATE $table SET name='$name', username='$username', email='$email', password='$password', level_admin='$level_admin' WHERE id=$id") or die(mysqli_error($this->conn));
		return true;
		
	}

	/*** starting the session ***/
	public function get_session(){
		return $_SESSION['login'];
	}

	public function user_logout() {
		$_SESSION['login'] = FALSE;
		session_destroy();
	}

	/**
	 * show all row
	 */
	public function showAll($table){
		$query=mysqli_query($this->conn,"SELECT * FROM $table");
		return mysqli_fetch_all($query,MYSQLI_ASSOC);
	}

	public function showAllJob($table){
		$query=mysqli_query($this->conn,"SELECT $table.id, $table.job_name, job_category.category_name FROM $table INNER JOIN job_category ON $table.job_category = job_category.id ORDER BY $table.id ASC");
		return mysqli_fetch_all($query,MYSQLI_ASSOC);
	}

	public function showAllApplication($table){
		$query=mysqli_query($this->conn,"SELECT $table.id, job_list.job_name, $table.status, $table.first_name, $table.last_name, $table.email, $table.phone, $table.country_list, $table.city_list, $table.address, $table.gender, $table.dob, $table.add_info, $table.resume, $table.date_interview, $table.meet_interview, $table.created FROM $table INNER JOIN job_list ON $table.job_title = job_list.id ORDER BY $table.created ASC");
		return mysqli_fetch_all($query,MYSQLI_ASSOC);
	}

	/**
	 * Insert value
	 * @param [type] $job_title     [description]
	 * @param [type] $first_name    [description]
	 * @param [type] $last_name     [description]
	 * @param [type] $email         [description]
	 * @param [type] $phone         [description]
	 * @param [type] $country_list  [description]
	 * @param [type] $city_list     [description]
	 * @param [type] $gender        [description]
	 * @param [type] $address       [description]
	 * @param [type] $add_info      [description]
	 * @param [type] $table         [description]
	 */
	public function Insert($job_title,$first_name,$last_name,$email,$phone,$country_list,$city_list,$gender,$dob,$address,$add_info,$upload, $upload_tmp, $upload_size, $table)
	{
		$filename = $upload;
		
	    //upload file
		if($filename != '')
		{
			
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];

			        //check if file type is valid
			if (!in_array($ext, $allowed))
			{
				echo "You file extension must be .zip, .pdf, jpg, png, gif, doc or .docx";
			} elseif ($upload_size > 1000000) { 
				return "File too large!";
			} else {
			            //set target directory
				$path = 'uploads/';

				// get last record id
				$sql = "SELECT max(id) as id from $table";
				$result = mysqli_query($this->conn, $sql);

				if ($result)
				{
					$row = mysqli_fetch_array($result);
					$filename = ($row['id']+1) . '-' . $filename;
				}
				else
					$filename = '1' . '-' . $filename;

				$created = @date('Y-m-d H:i:s');

				// get email
				$sql = "SELECT * FROM $table WHERE email='$email'";
				$res=mysqli_query($this->conn,$sql);
				if (mysqli_num_rows($res) > 10000) {
					$row = mysqli_fetch_assoc($res);
					if($email==$row['email'])
					{
						echo "Email already exists";
						return false;

					}
				} else {
					if(move_uploaded_file($upload_tmp,($path . $filename)) ) {
						mysqli_query($this->conn,"INSERT INTO $table SET job_title='$job_title', first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', country_list='$country_list', city_list='$city_list', gender='$gender', dob='$dob', address='$address', add_info='$add_info', resume='$filename', created='$created'" ) or die(mysqli_error($this->conn));
						return true;
					} else {
						echo "fail to upload";
					}
				}
			}
		}
		// return true;
	}

	/**
	 * Delete row
	 */
	public function Delete($id,$table)
	{
		mysqli_query($this->conn,"DELETE FROM $table WHERE id=$id") or die(mysqli_error($this->conn));

		return true;
	}

	/**
	 * edit value
	 * @return id
	 */
	public function editValue($id,$table){
		$query=mysqli_query($this->conn,"SELECT * FROM $table WHERE id=$id") or die(mysqli_error($this->conn));
		return mysqli_fetch_assoc($query);
	}

	public function editValueApplication($id,$table){
		$query=mysqli_query($this->conn,"SELECT $table.id, job_list.job_name, $table.status, $table.first_name, $table.last_name, $table.email, $table.phone, $table.country_list, $table.city_list, $table.address, $table.gender, $table.dob, $table.add_info, $table.resume, $table.date_interview, $table.meet_interview, $table.created FROM $table INNER JOIN job_list ON $table.job_title = job_list.id WHERE $table.id=$id") or die(mysqli_error($this->conn));
		return mysqli_fetch_assoc($query);
	}
	
	/**
	 * Update table
	 * @param int $id      unique id
	 * @param string $name    first name
	 * @param email $email   email
	 * @param number $mobile  phone no
	 * @param string $address address
	 * @param db $table
	 */
	public function Update($id,$status,$meet_date,$meet_link,$table){
		mysqli_query($this->conn,"UPDATE $table SET status='$status', date_interview='$meet_date', meet_interview='$meet_link' WHERE id=$id") or die(mysqli_error($this->conn));
		return true;
	}

	public function jobsCategoryAdd($category){
		if($category == "") {
			$msgError = "Either category name field is empty.";
		} else {
			$sql="SELECT * FROM job_category WHERE category_name='$category'";

			$check =  $this->conn->query($sql);
			$count_row = $check->num_rows;
			//if the username is not in db then insert to the table
			if ($count_row == 0){
				$query="INSERT INTO job_category SET category_name='$category'";
				$result = mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
				return $result;
			} else {
				return false;
			}

			if(isset($_SESSION['valid'])) {
				header('Location: user.php');            
			}
		}

		return true;
	}

	public function jobsListAdd($job_name,$job_category){
		if($job_name == "" || $job_category == "") {
			$msgError = "Either category name field is empty.";
		} else {
			$sql="SELECT * FROM job_list WHERE job_name='$job_name'";

			$check =  $this->conn->query($sql);
			$count_row = $check->num_rows;
			//if the username is not in db then insert to the table
			if ($count_row == 0){
				$query="INSERT INTO job_list SET job_name='$job_name',job_category='$job_category'";
				$result = mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
				return $result;
			} else {
				return false;
			}

			if(isset($_SESSION['valid'])) {
				header('Location: user.php');            
			}
		}

		return true;
	}
}

$obj=new CodenodForm;