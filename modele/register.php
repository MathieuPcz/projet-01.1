<?php 

class User{

	private $_bdd;
	private $_id;
	private $_name;
	private $_firstname;
	private $_city;
	private $_email;
	private $_password;
	private $_id_user;
	private $_avatar;
	private $_register_date;
	private $_love;
	private $_age;
	private $_profession;
	private $_naissance;
	private $_etude;
	private $_citation;
	private $_description;

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

		$this->_password = $result['password'];
		return $this->_password;
	}

	public function insertUser(){

		$this->_longname = htmlspecialchars(trim(ucfirst($_POST['firstname']))).' '.htmlspecialchars(trim(ucfirst($_POST['name'])));
		$this->_name = htmlspecialchars(trim(ucfirst($_POST['name']))); 
		$this->_firstname = htmlspecialchars(trim(ucfirst($_POST['firstname'])));
		$this->_city = htmlspecialchars(trim(ucfirst($_POST['city'])));
		$this->_email = htmlspecialchars(trim($_POST['email']));
		$this->_password = sha1($_POST['password']);


		$insert = $this->_bdd->prepare('INSERT INTO user (longname,name,firstname,city,email,password,id_user,register_date) VALUES (:longname,:name,:firstname,:city,:email,:password,:id_user,NOW())');
		$insert->execute(array('longname'=>$this->_longname,
								'name'=>$this->_name,
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
		$this->_id = $result['id'];

		return $this->_id;
	}

		public function selectLongname($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT longname FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_longname = $result['longname'];

		return $this->_longname;
	}

	public function selectName($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT name FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_name = $result['name'];

		return $this->_name;
	}

	public function selectFirstname($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT firstname FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_firstname = $result['firstname'];

		return $this->_firstname;
	}

		public function selectEmail($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT email FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_email = $result['email'];

		return $this->_email;
	}

	public function selectLieu($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT city FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_city = $result['city'];

		return $this->_city;
	}

		public function selectLove($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT love FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_love = $result['love'];

		return $this->_love;
	}

		public function selectAge($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT age FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_age = $result['age'];

		return $this->_age;
	}
		public function selectProfession($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT profession FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_profession = $result['profession'];

		return $this->_profession;
	}

		public function selectNaissance($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT naissance FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_naissance = $result['naissance'];

		return $this->_naissance;
	}

		public function selectEtude($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT etude FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_etude = $result['etude'];

		return $this->_etude;
	}

	public function selectCitation($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT citation FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_citation = $result['citation'];

		return $this->_citation;
	}

		public function selectDescription($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT description FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_description = $result['description'];

		return $this->_description;
	}


		public function selectAvatar($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT avatar FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_avatar = $result['avatar'];

		if(!empty($this->_avatar)){
			return '	<img src="../images/user/'.$this->_avatar.'"  alt="avatar">';
		}else{
			
		}
	}
			public function selectRegister_date($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT DATE_FORMAT(register_date, "%d/%m/%Y") AS register_date FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_register_date = $result['register_date'];

		return $this->_register_date;
	}

	public function selectPassword($user_id){
		$this->_id = $user_id;

		$select = $this->_bdd -> prepare('SELECT password FROM user WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_password = $result['password'];

		return $this->_password;
	}

	public function modifAvatar($user_id,$modif_img){
		$this->_id = $user_id;
		$this->_avatar = $modif_img;
		$update = $this->_bdd -> prepare('UPDATE user SET avatar=:avatar WHERE id=:id');
		$update->execute(array('avatar'=>$this->_avatar,
								'id'=>$this->_id));

	}

	public function modifUser(){

		$this->_id = $_POST['id_user'];
		$this->_love = htmlspecialchars(trim(ucfirst($_POST['love'])));
		$this->_name = htmlspecialchars(trim(ucfirst($_POST['name'])));
		$this->_firstname = htmlspecialchars(trim(ucfirst($_POST['firstname'])));
		$this->_city = htmlspecialchars(trim(ucfirst($_POST['city'])));
		$this->_age = htmlspecialchars(trim(ucfirst($_POST['age'])));
		$this->_profession = htmlspecialchars(trim(ucfirst($_POST['profession'])));
		$this->_naissance = htmlspecialchars(trim(ucfirst($_POST['naissance'])));
		$this->_etude = htmlspecialchars(trim(ucfirst($_POST['etude'])));
		$this->_citation = htmlspecialchars(trim(ucfirst($_POST['citation'])));
		$this->_description = htmlspecialchars(trim(ucfirst($_POST['description'])));

		$update = $this->_bdd -> prepare('UPDATE user SET love=:love,name=:name,firstname=:firstname,city=:city,age=:age,profession=:profession,naissance=:naissance,etude=:etude,citation=:citation,description=:description WHERE id=:id');
		$update->execute(array('love'=>$this->_love,
								'name'=>$this->_name,
								'firstname'=>$this->_firstname,
								'city'=>$this->_city,
								'age'=>$this->_age,
								'profession'=>$this->_profession,
								'naissance'=>$this->_naissance,
								'etude'=>$this->_etude,
								'citation'=>$this->_citation,
								'description'=>$this->_description,
								'id'=>$this->_id));
	}

	public function deleteProfil($id_user){

		$this->_id = $id_user;
		$delete = $this->_bdd -> prepare('DELETE FROM user WHERE id=:id');
		$delete->execute(array('id'=>$this->_id));
	}

	public function verifAncienPass($id_user){

		$this->_id = $id_user;
		$select = $this->_bdd->prepare('SELECT password FROM user WHERE id=:id');
		$select->execute(array('id' => $this->_id));
		$result=$select->fetch();

		$this->_password = $result['password'];
		return $this->_password;
	}

		public function modifPassword($id_user,$newPass){
		$this->_id = $id_user;
		$this->_password = $newPass;
		$update = $this->_bdd -> prepare('UPDATE user SET password=:password WHERE id=:id');
		$update->execute(array('password'=>$this->_password,
								'id'=>$this->_id));

	}
}
	
 ?>