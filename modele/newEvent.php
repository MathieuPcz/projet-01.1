<?php 

class Event{

	private $_bdd;
	private $_id;
	private $_id_user;
	private $_typeEvent;
	private $_heure_deb_event;
	private $_access;
	private $_villeEvent;
	private $_nameEvent;
	private $_dateEvent;
	private $_lieuEvent;
	private $_place_user;
	private $_id_event;
	private $_imgEvent;
	private $_event_description;

	public function __construct($bdd){

		$this->_bdd=$bdd;
	}

	public function countEvent(){

		$count = $this->_bdd->prepare('SELECT id_event FROM event');
		$count->execute(array());
		$nb= $count->rowCount();
		$this->_id_event = $nb+1;
		return $this->_id_event;

	}

	public function redirection(){

		$select = $this->_bdd->prepare('SELECT id FROM event ORDER BY id DESC LIMIT 1');
		$select->execute(array());
		$result = $select -> fetch();
		$this->_id = $result['id'];
		return '<script type="text/javascript">
				window.location = "event.php?id='.$this->_id.'";
				</script>';

	}

	public function insertEvent($id_user){

		$this->_id_user = $id_user;
		$this->_typeEvent = $_POST['typeEvent'];
		$this->_heure_deb_event = $_POST['heure_deb_event'];
		$this->_access = $_POST['access'];
		$date_event = htmlspecialchars(trim(ucfirst($_POST['dateEvent'])));
		$date = strtr($date_event,'/','-');
		$date = new DateTime($date);
		$this->_dateEvent =$date->format('Y-m-d');
		$this->_nameEvent = htmlspecialchars(trim(ucfirst($_POST['nameEvent'])));
		$this->_lieuEvent = htmlspecialchars(trim(ucfirst($_POST['lieuEvent'])));
		$this->_lieuEvent = htmlspecialchars(trim(ucfirst($_POST['villeEvent'])));
		$this->_place_user = htmlspecialchars(trim(ucfirst($_POST['place_user'])));
		$this->_event_description = nl2br(htmlspecialchars(trim(ucfirst($_POST['event_description']))));


		$insert = $this->_bdd->prepare('INSERT INTO event (typeEvent,heure_deb_event,access,nameEvent,dateEvent,lieuEvent,villeEvent,place_user,id_event,event_description,id_user,register_date) VALUES (:typeEvent,:heure_deb_event,:access,:nameEvent,:dateEvent,:lieuEvent,:villeEvent,:place_user,:id_event,:event_description,:id_user,NOW())');
		$insert->execute(array('typeEvent'=>$this->_typeEvent,
								'heure_deb_event'=>$this->_heure_deb_event,
								'access'=>$this->_access,
								'nameEvent'=>$this->_nameEvent,
								'dateEvent'=>$this->_dateEvent,
								'lieuEvent'=>$this->_lieuEvent,
								'villeEvent'=>$this->_villeEvent,
								'place_user'=>$this->_place_user,
								'id_event'=>$this->_id_event,
								'event_description'=>$this->_event_description,
								'id_user'=>$this->_id_user));

	
	}

	public function selectTypeEvent($id_event){

		$this->_id = $id_event;

		$select = $this->_bdd -> prepare('SELECT typeEvent FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_typeEvent = $result['typeEvent'];

		return $this->_typeEvent;
	}

	public function selectHeure_deb_event($id_event){

		$this->_id = $id_event;

		$select = $this->_bdd -> prepare('SELECT heure_deb_event FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_heure_deb_event = $result['heure_deb_event'];

		return $this->_heure_deb_event;
	}

	public function selectAccess($id_event){

		$this->_id = $id_event;

		$select = $this->_bdd -> prepare('SELECT access FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_access = $result['access'];

		return $this->_access;
	}

	public function selectEvent($id_event){

		$this->_id = $id_event;

		$select = $this->_bdd -> prepare('SELECT event FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_event = $result['event'];

		return $this->_event;
	}

	public function selectNameEvent($id_event){

		$this->_id = $id_event;

		$select = $this->_bdd -> prepare('SELECT nameEvent FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_nameEvent = $result['nameEvent'];

		return $this->_nameEvent;
	}

	public function selectRegister_date($id_event){

		$this->_id = $id_event;

		$select = $this->_bdd -> prepare('SELECT DATE_FORMAT(register_date, "%d/%m/%Y") AS register_date FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_register_date = $result['register_date'];

		return $this->_register_date;
	}

	public function selectDateEvent($id_event){

		$this->_id = $id_event;

		$select = $this->_bdd -> prepare('SELECT DATE_FORMAT(dateEvent, "%d/%m/%Y") AS dateEvent FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_dateEvent = $result['dateEvent'];

		return $this->_dateEvent;
	}

	public function selectLieuEvent($id_event){

		$this->_id = $id_event;

		$select = $this->_bdd -> prepare('SELECT lieuEvent FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_lieuEvent = $result['lieuEvent'];

		return $this->_lieuEvent;
	}

		public function selectVilleEvent($id_event){

		$this->_id = $id_event;

		$select = $this->_bdd -> prepare('SELECT villeEvent FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_villeEvent = $result['villeEvent'];

		return $this->_villeEvent;
	}

	public function selectPlaceUser($id_event){

		$this->_id = $id_event;

		$select = $this->_bdd -> prepare('SELECT place_user FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_place_user = $result['place_user'];

		return $this->_place_user;
	}

	public function selectId_user($id_event){

		$this->_id = $id_event;

		$select = $this->_bdd -> prepare('SELECT id_user FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_id_user = $result['id_user'];

		return $this->_id_user;
	}

	public function selectDescription($id_event){

		$this->_id = $id_event;

		$select = $this->_bdd -> prepare('SELECT event_description FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		$this->_event_description = $result['event_description'];

		return $this->_event_description;
	}

	public function verifIMG($id_event){

		$this->_id = $id_event;
		$select = $this->_bdd -> prepare('SELECT imgEvent FROM event WHERE id=:id');
		$select->execute(array('id'=>$this->_id));
		$result = $select -> fetch();
		

		if(!empty($result['imgEvent'])){
			$this->_imgEvent = $result['imgEvent'];
			return '<img src="../images/event/'.$this->_imgEvent.'" alt="before-after">';
		}else{
			echo '<div id="imgEvent"><img src="../images/logo-header.png" alt="before-after"></div>';
		}

	}

	public function deleteEvent($id_event){
		$this->_id = $id_event;
		$suppr = $this->_bdd -> prepare('DELETE FROM event WHERE id=:id');
		$suppr->execute(array('id'=>$this->_id));
	}

	public function modifImg($modif_img,$id){

		$this->_imgEvent = $modif_img;
		$this->_id = $id;

		$modif=$this->_bdd->prepare('UPDATE event SET imgEvent=:imgEvent WHERE id=:id' );
		$modif->execute(array('imgEvent'=>$this->_imgEvent,
								'id'=>$this->_id));
	}

		public function modifEvent($id_event){
		$this->_id = $id_event;
		$this->_typeEvent = $_POST['typeEvent'];
		$this->_heure_deb_event = $_POST['heure_deb_event'];
		$this->_access = $_POST['access'];
		$this->_nameEvent = htmlspecialchars(trim(ucfirst($_POST['nameEvent'])));
		$date_event = htmlspecialchars(trim(ucfirst($_POST['dateEvent'])));
		$date = strtr($date_event,'/','-');
		$date = new DateTime($date);
		$this->_dateEvent =$date->format('Y-m-d');
		$this->_lieuEvent = htmlspecialchars(trim(ucfirst($_POST['lieuEvent'])));
		$this->_villeEvent = htmlspecialchars(trim(ucfirst($_POST['villeEvent'])));
		$this->_place_user = htmlspecialchars(trim(ucfirst($_POST['place_user'])));
		$this->_event_description = nl2br(html_entity_decode(trim(ucfirst($_POST['event_description']))));

		$modif=$this->_bdd->prepare('UPDATE event SET typeEvent=:typeEvent,heure_deb_event=:heure_deb_event,access=:access,nameEvent=:nameEvent,dateEvent=:dateEvent,villeEvent=:villeEvent,lieuEvent=:lieuEvent,place_user=:place_user,event_description=:event_description WHERE id=:id' );
		$modif->execute(array('typeEvent'=>$this->_typeEvent,
								'heure_deb_event'=>$this->_heure_deb_event,
								'access'=>$this->_access,
								'nameEvent'=>$this->_nameEvent,
								'dateEvent'=>$this->_dateEvent,
								'villeEvent'=>$this->_villeEvent,
								'lieuEvent'=>$this->_lieuEvent,
								'place_user'=>$this->_place_user,
								'event_description'=>$this->_event_description,
								'id'=>$this->_id));
	}

		public function selectAllEvent(){
			$select = $this->_bdd -> prepare('SELECT * FROM event ORDER BY dateEvent');
			$select->execute(array());

			return $select;
		}

		public function selectAllEventByUser($id_user){
			$this->_id_user = $id_user;
			$select = $this->_bdd -> prepare('SELECT * FROM event WHERE id_user=:id_user ORDER BY dateEvent');
			$select->execute(array('id_user'=>$this->_id_user));

			return $select;
		}

	public function deleteEventProfil($id_user){
		$this->_id_user = $id_user;
		$suppr = $this->_bdd -> prepare('DELETE FROM event WHERE id_user=:id_user');
		$suppr->execute(array('id_user'=>$this->_id_user));
	}
}


?>