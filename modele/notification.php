<?php 

class Notification{

	private $_bdd;
	private $_id;
	private $_id_user;
	private $_id_user2;
	private $_countNotif;
	private $_type_notif;
	private $_notifDate;
	private $_description;
	private $_statut;

	public function __construct($bdd){

		$this->_bdd=$bdd;
	}

	public function countNotif($id_user,$statut){

		$this->_id_user = $id_user;
		$this->_statut = $statut;

		$count = $this->_bdd->prepare('SELECT id FROM notification WHERE id_user=:id_user AND statut=:statut');
		$count->execute(array('id_user'=>$this->_id_user,
								'statut'=>$this->_statut));
		$nb= $count->rowCount();
		$this->_countNotif = $nb;
		return $this->_countNotif;

	}
		public function countAllNotif($id_user){

		$this->_id_user = $id_user;

		$count = $this->_bdd->prepare('SELECT id FROM notification WHERE id_user=:id_user');
		$count->execute(array('id_user'=>$this->_id_user));
		
		$nb= $count->rowCount();
		$this->_countNotif = $nb;
		return $this->_countNotif;

	}
	

		public function sendNotif($id_user,$recepteur,$type_notif,$description){

		$this->_id_user2 = $id_user;
		$this->_id_user = $recepteur;
		$this->_type_notif = $type_notif;
		$this->_description = $description;
		$this->_statut = 0;

		$insert = $this->_bdd->prepare('INSERT INTO notification (id_user,id_user2,type,statut,description,notifDate) VALUES (:id_user,:id_user2,:type,:statut,:description,NOW())');
		$insert->execute(array('id_user'=>$this->_id_user,
								'id_user2'=>$this->_id_user2,
								'type'=>$this->_type_notif,
								'description'=>$this->_description,
								'statut'=>$this->_statut));
		}

		public function selectAllNotif($id_user){

			$this->_id_user = $id_user;
			$select = $this->_bdd -> prepare('SELECT id,id_user,id_user2, DATE_FORMAT(notifDate, "%d/%m/%Y à %H:%i") as notifDate,type,description FROM notification WHERE id_user=:id_user ORDER BY notifDate DESC');
			$select->execute(array('id_user'=>$this->_id_user));

			
			return $select;
		}

		public function selectAllNotifByStatut($id_user,$statut){

			$this->_id_user = $id_user;
			$this->_statut = $statut;
			$select = $this->_bdd -> prepare('SELECT id,id_user,id_user2, DATE_FORMAT(notifDate, "%d/%m/%Y à %H:%i") as notifDate,type,description FROM notification WHERE id_user=:id_user AND statut=:statut ORDER BY notifDate DESC');
			$select->execute(array('id_user'=>$this->_id_user,
									'statut'=>$this->_statut));

			
			return $select;
		}

		public function selectUser($id_notif){

			$this->_id = $id_notif;
			$select = $this->_bdd -> prepare('SELECT id_user2 FROM notification WHERE id=:id');
			$select->execute(array('id'=>$this->_id));
			$result = $select->fetch();

			$this->_id_user = $result['id_user2'];
			
			return $this->_id_user;
		}

		public function selectType($id_notif){

			$this->_id = $id_notif;
			$select = $this->_bdd -> prepare('SELECT type FROM notification WHERE id=:id');
			$select->execute(array('id'=>$this->_id));
			$result = $select->fetch();

			$this->_type_notif = $result['type'];
			
			return $this->_type_notif;
		}

		public function modifNotif($id_user){

			$this->_id_user = $id_user;
			$this->_statut = 1;
			$update = $this->_bdd -> prepare('UPDATE notification SET statut=:statut WHERE id_user=:id_user');
			$update->execute(array('statut'=>$this->_statut,
								'id_user'=>$this->_id_user));
	
		}


	}


 ?>