<?php 

class Friend{

	private $_bdd;
	private $_id_user;
	private $_id_user2;
	private $_countFriends;
	private $_statut;
	private $_longname;

	public function __construct($bdd){

		$this->_bdd=$bdd;
	}

/*	public function countFriends(){

		$count = $this->_bdd->prepare('SELECT id FROM friends WHERE id_user=:id_user');
		$count->execute(array());
		$nb= $count->rowCount();
		$this->_countFriends = $nb;
		return $this->_countFriends;

	}*/

	public function verifFriend($id_user,$id_user2){

		$this->_id_user = $id_user;
		$this->_id_user2 = $id_user2;
		$this->_statut = 1;

		$select = $this->_bdd -> prepare('SELECT id_user2 FROM friends WHERE id_user=:id_user AND id_user2=:id_user2');
		$select->execute(array('id_user'=>$this->_id_user,
								'id_user2'=>$this->_id_user2));

		$result = $select -> fetch();
		$this->_id_user2 = $result['id_user2'];

		return $this->_id_user2;
	}

	public function insertFriend($id_user,$id_user2,$longname){

		$this->_id_user = $id_user;
		$this->_id_user2 = $id_user2;
		$this->_statut = 0;
		$this->_longname = $longname;

		$insert = $this->_bdd->prepare('INSERT INTO friends (id_user,id_user2,statut,longname,friendDate) VALUES (:id_user,:id_user2,:statut,:longname,NOW())');
		$insert->execute(array('id_user'=>$this->_id_user,
								'id_user2'=>$this->_id_user2,
								'statut'=>$this->_statut,
								'longname'=>$this->_longname));

	
	}

		public function acceptFriend($id_user,$id_user2,$longname){

		$this->_id_user = $id_user;
		$this->_id_user2 = $id_user2;
		$this->_statut = 1;
		$this->_longname = $longname;

		$update = $this->_bdd->prepare('UPDATE friends SET statut=:statut WHERE id_user=:id_user AND id_user2=:id_user2');
		$update->execute(array('id_user'=>$this->_id_user,
								'id_user2'=>$this->_id_user2,
								'statut'=>$this->_statut));

		$insert = $this->_bdd->prepare('INSERT INTO friends (id_user,id_user2,statut,longname,friendDate) VALUES (:id_user,:id_user2,:statut,:longname,NOW())');
		$insert->execute(array('id_user'=>$this->_id_user2,
								'id_user2'=>$this->_id_user,
								'statut'=>$this->_statut,
								'longname'=>$this->_longname));

	
	}

	public function verifStatut($id_user,$id_user2){

		$this->_id_user = $id_user;
		$this->_id_user2 = $id_user2;

		$select = $this->_bdd -> prepare('SELECT statut FROM friends WHERE id_user=:id_user AND id_user2=:id_user2');
		$select->execute(array('id_user'=>$this->_id_user,
								'id_user2'=>$this->_id_user2));

		$result = $select -> fetch();
		$this->_statut = $result['statut'];

		return $this->_statut;
	}



		public function selectFriends($id_user){

		$this->_id_user = $id_user;
		$this->_statut = 1;

		$select = $this->_bdd -> prepare('SELECT id,id_user2, DATE_FORMAT(friendDate, "%d/%m/%Y") as friendDate FROM friends WHERE id_user=:id_user AND statut=:statut');
		$select->execute(array('id_user'=>$this->_id_user,
								'statut'=>$this->_statut));
		

		return $select;

	}

	public function selectFriendsTchat($id_user){

		$this->_id_user = $id_user;
		$this->_statut = 1;

		$select = $this->_bdd -> prepare('SELECT id,id_user2,longname  FROM friends WHERE id_user=:id_user AND statut=:statut ORDER BY longname');
		$select->execute(array('id_user'=>$this->_id_user,
								'statut'=>$this->_statut));
		

		return $select;

	}

	public function supprFriend($id_user,$id_user2){

		$this->_id_user = $id_user;
		$this->_id_user2 = $id_user2;

		$delete = $this->_bdd -> prepare('DELETE FROM friends WHERE id_user=:id_user AND id_user2=:id_user2');
		$delete->execute(array('id_user'=>$this->_id_user,
								'id_user2'=>$this->_id_user2));

		$delete = $this->_bdd -> prepare('DELETE FROM friends WHERE id_user=:id_user AND id_user2=:id_user2');
		$delete->execute(array('id_user'=>$this->_id_user2,
								'id_user2'=>$this->_id_user));
		

		

	}
	
}

 ?>