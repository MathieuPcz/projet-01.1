<?php 

class User{

	private $_bdd;
	private $_name;
	private $_firstname;
	private $_city;
	private $_email;
	private $_password;
	private $_id_user;

	public function __construct($bdd){

		$this->_bdd=$bdd;
	}
	public function countUser(){

		$count = $this->_bdd->prepare('SELECT id_user FROM user');
		$count->execute(array());
		$nb= $count->rowCount();
		$this->_id_user = $nb+1;
		return $this->_id_user;

	}
	public function verifMail(){

		$this->_email = htmlspecialchars(trim($_POST['email']));
		$select = $this->_bdd->prepare('SELECT email FROM user WHERE email=:email');
		$select->execute(array('email' => $this->_email));
		$result=$select->fetch();

		$this->_email = $result['email'];
		return $this->_email;
	}

		public function verifPassword(){

		$this->_email = htmlspecialchars(trim($_POST['email']));
		$select = $this->_bdd->prepare('SELECT password FROM user WHERE email=:email');
		$select->execute(array('email' => $this->_email));
		$result=$select->fetch();

		$this->password = $result['password'];
		return $this->password;
	}

	public function insertUser(){

		$this->_name = htmlspecialchars(trim(ucfirst($_POST['name'])));
		$this->_firstname = htmlspecialchars(trim(ucfirst($_POST['firstname'])));
		$this->_city = htmlspecialchars(trim(ucfirst($_POST['city'])));
		$this->_email = htmlspecialchars(trim($_POST['email']));
		$this->_password = sha1($_POST['password']);


		$insert = $this->_bdd->prepare('INSERT INTO user (name,firstname,city,email,password,id_user,register_date) VALUES (:name,:firstname,:city,:email,:password,:id_user,NOW())');
		$insert->execute(array('name'=>$this->_name,
								'firstname'=>$this->_firstname,
								'city'=>$this->_city,
								'email'=>$this->_email,
								'password'=>$this->_password,
								'id_user'=>$this->_id_user));
	}

	public function selectId(){

		$this->_email = htmlspecialchars(trim($_POST['email']));

		$select = $this->_bdd -> prepare('SELECT id FROM user WHERE email=:email');
		$select->execute(array('email'=>$this->_email));
		$result = $select -> fetch();
		$this_id = $result['id'];

		return $this_id;
	}

	public function selectName($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT name FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this_name = $result['name'];

		return $this_name;
	}

	public function selectFirstname($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT firstname FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this_firstname = $result['firstname'];

		return $this_firstname;
	}

}
	
 ?>