<?php 
class Participant{

	private $_bdd;
	private $_id;
	private $_id_user;
	private $_id_event;
	private $_count;
	private $_status;

	public function __construct($bdd){

		$this->_bdd=$bdd;
	}

	public function selectLastId(){

		$select =$this->_bdd->prepare('SELECT id FROM event ORDER BY id DESC LIMIT 1');
		$select -> execute(array());
		$result = $select->fetch();

		return $result['id'];
	}

	public function addParticipant($id_user,$id_event,$status){
		$this->_id_user = $id_user;
		$this->_id_event = $id_event;
		$this->_status = $status;
		$insert = $this->_bdd -> prepare('INSERT INTO participant (id_user,id_event,status) VALUES (:id_user,:id_event,:status)');
		$insert->execute(array('id_user'=>$this->_id_user,
								'id_event'=>$this->_id_event,
								'status'=>$this->_status));
	}

	public function countParticipant($id_event,$status){

		$this->_id_event = $id_event;
		$this->_status =$status;
		$select = $this->_bdd -> prepare('SELECT * FROM participant WHERE id_event=:id_event AND status=:status');
		$select -> execute(array('id_event'=>$this->_id_event,
								'status'=>$this->_status));
		$count = $select->rowCount();
		return $count;
	}

		public function countAllParticipant($id_event){

		$this->_id_event = $id_event;
		$select = $this->_bdd -> prepare('SELECT id FROM participant WHERE id_event=:id_event');
		$select -> execute(array('id_event'=>$this->_id_event));
		$count = $select->rowCount();
		return $count;
	}

	public function selectAllParticipant($id_event,$status){

		$this->_id_event = $id_event;
		$this->_status =$status;
		$select = $this->_bdd -> prepare('SELECT * FROM participant WHERE id_event=:id_event AND status=:status');
		$select -> execute(array('id_event'=>$this->_id_event,
								'status'=>$this->_status));
		return $select;

	}

	public function selectAllIdEventByUser($id_user,$status){
		$this->_id_user = $id_user;
		$this->_status =$status;
		$select = $this->_bdd -> prepare('SELECT * FROM participant WHERE id_user=:id_user AND status=:status');
		$select -> execute(array('id_user'=>$this->_id_user,
								'status'=>$this->_status));
		return $select;
	}


	public function verifParticipation($id_user,$id_event){

		$this->_id_user = $id_user;
		$this->_id_event = $id_event;
		$select = $this->_bdd -> prepare('SELECT id_user FROM participant WHERE id_event=:id_event AND id_user=:id_user');
		$select -> execute(array('id_event'=>$this->_id_event,
								'id_user'=>$this->_id_user));
		
		$result= $select->fetch();
		return $result['id_user'];


	}

		public function declineParticipation($id_user,$id_event){

		$this->_id_user = $id_user;
		$this->_id_event = $id_event;
		$suppr = $this->_bdd -> prepare('DELETE FROM participant WHERE id_user=:id_user AND id_event=:id_event');
		$suppr->execute(array('id_user'=>$this->_id_user,
								'id_event'=>$this->_id_event));
		


	}

	public function deleteParticipantProfil($id_user){
		$this->_id_user = $id_user;
		$suppr = $this->_bdd -> prepare('DELETE FROM participant WHERE id_user=:id_user');
		$suppr->execute(array('id_user'=>$this->_id_user));
	}

	public function verifEtatParticipation($id_user,$id_event,$statut){

		$this->_id_user = $id_user;
		$this->_id_event = $id_event;
		$this->_status = $statut;
		$select = $this->_bdd -> prepare('SELECT id_user FROM participant WHERE id_event=:id_event AND id_user=:id_user AND status=:status');
		$select -> execute(array('id_event'=>$this->_id_event,
								'id_user'=>$this->_id_user,
								'status'=>$this->_status));
		$result=$select->fetch();
		return $result['id_user'];


	}

	public function modifEtatParticipation($id_user,$id_event,$status){

		$this->_id_user = $id_user;
		$this->_id_event = $id_event;
		$this->_status = $status;
		$update = $this->_bdd -> prepare('UPDATE participant SET status=:status WHERE id_event=:id_event AND id_user=:id_user');
		$update -> execute(array('id_event'=>$this->_id_event,
								'id_user'=>$this->_id_user,
								'status'=>$this->_status));
	}
}

 ?>