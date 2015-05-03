<?php 

class Tchat{

	private $_bdd;
	private $_id_user;
	private $_id_user2;
	private $_countMessage;
	private $_longname;
	private $_message;
	private $_look;

	public function __construct($bdd){

		$this->_bdd=$bdd;
	}

	public function countMessage($id_user){

		$count = $this->_bdd->prepare('SELECT id FROM friends WHERE id_user=:id_user');
		$count->execute(array('id_user'=>$this->_id_user));
		$nb= $count->rowCount();
		$this->_countMessage = $nb;
		return $this->_countMessage;

	}

	public function insertMessage($id_user,$id_user2,$longname,$message){

		$this->_id_user = $id_user;
		$this->_id_user2 = $id_user2;
		$this->_longname = $longname;
		$this->_message = $message;

		$select = $this->_bdd -> prepare('INSERT INTO tchat (id_user,id_user2,longname,message,dateMessage) VALUES (:id_user,:id_user2,:longname,:message,NOW())');
		$select->execute(array('id_user'=>$this->_id_user,
								'id_user2'=>$this->_id_user2,
								'longname'=>$this->_longname,
								'message'=>$this->_message));

	}


		public function selectAllMessage($id_user,$id_user2){

		$this->_id_user = $id_user;
		$this->_id_user2 = $id_user2;
		$select = $this->_bdd -> prepare('SELECT id_user,id_user2,longname,message,DATE_FORMAT(dateMessage, "Le %d/%m/%Y à %H:%m") as dateMessage FROM tchat WHERE id_user=:id_user AND id_user2=:id_user2 ORDER BY id DESC');
		$select->execute(array('id_user'=>$this->_id_user,
								'id_user2'=>$this->_id_user2));

		$result = $select;
		return $result;
	
	}

	public function modifLook($id_user,$id_user2,$look){
		$this->_id_user = $id_user;
		$this->_id_user2 = $id_user2;
		$this->_look = $look;
		$update = $this->_bdd -> prepare('UPDATE tchat SET look=:look WHERE id_user=:id_user AND id_user2=:id_user2');
		$update->execute(array('look'=>$this->_look,
								'id_user'=>$this->_id_user,
								'id_user2'=>$this->_id_user2));

	}
}

 ?>