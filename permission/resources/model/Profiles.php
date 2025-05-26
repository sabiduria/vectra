<?php
Class Profiles {
	private $id;
	private $name;
	private $created;
	private $deleted;

	public function __construct($id, $name, $created, $deleted) {
		$this->id = $id;
		$this->name = $name;
		$this->created = $created;
		$this->deleted = $deleted;

	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getCreated() {
		return $this->created;
	}

	public function getDeleted() {
		return $this->deleted;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function setCreated($created) {
		$this->created = $created;
	}

	public function setDeleted($deleted) {
		$this->deleted = $deleted;
	}


	public static function select() {
		$connexion=Connexion::getConnexion();
		$query="SELECT id, name, created, deleted FROM profiles ORDER BY name ASC";
		$transaction=$connexion->prepare($query);
		$transaction->execute();
        $data=$transaction->fetchAll(PDO::FETCH_ASSOC);
        array_walk_recursive($data, function(&$item){
            if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
            }
        });
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR);
    }

	public function insert() {
		$connexion=Connexion::getConnexion();
		$query="INSERT INTO profiles (id, name, created, deleted) VALUES (:id, :name, :created, :deleted)";
		$transaction=$connexion->prepare($query);
		$transaction->execute(array('id'=>$this->getId(), 'name'=>$this->getName(), 'created'=>$this->getCreated(), 'deleted'=>$this->getDeleted()));
		return true;
	}

	public function update() {
		$connexion=Connexion::getConnexion();
		$query="UPDATE profiles SET name=:name, created=:created, deleted=:deleted WHERE id=:id";
		$transaction=$connexion->prepare($query);
		$transaction->execute(array('id'=>$this->getId(), 'name'=>$this->getName(), 'created'=>$this->getCreated(), 'deleted'=>$this->getDeleted()));
		return true;
	}

	public static function delete($id) {
		$connexion=Connexion::getConnexion();
		$query="DELETE FROM profiles WHERE id=:id";
		$transaction=$connexion->prepare($query);
		$transaction->execute(array('id'=>$id));
		return true;
	}

	public static function displayName($id){
        $connexion=Connexion::getConnexion();
        $query="SELECT name from profiles where id=:id";
        $transaction=$connexion->prepare($query);
        $transaction->execute(array('id'=> $id));
        if($data=$transaction->fetch()){
            return $data["name"];
        }
    }


}