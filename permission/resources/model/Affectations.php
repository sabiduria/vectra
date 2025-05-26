<?php
Class Affectations {
	private $id;
	private $user_id;
	private $shop_id;
	private $profile_id;
	private $created;
	private $modified;
	private $createdby;
	private $modifiedby;
	private $deleted;

	public function __construct($id, $user_id, $shop_id, $profile_id, $created, $modified, $createdby, $modifiedby, $deleted) {
		$this->id = $id;
		$this->user_id = $user_id;
		$this->shop_id = $shop_id;
		$this->profile_id = $profile_id;
		$this->created = $created;
		$this->modified = $modified;
		$this->createdby = $createdby;
		$this->modifiedby = $modifiedby;
		$this->deleted = $deleted;

	}

	public function getId() {
		return $this->id;
	}

	public function getUser_id() {
		return $this->user_id;
	}

	public function getShop_id() {
		return $this->shop_id;
	}

	public function getProfile_id() {
		return $this->profile_id;
	}

	public function getCreated() {
		return $this->created;
	}

	public function getModified() {
		return $this->modified;
	}

	public function getCreatedby() {
		return $this->createdby;
	}

	public function getModifiedby() {
		return $this->modifiedby;
	}

	public function getDeleted() {
		return $this->deleted;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setUser_id($user_id) {
		$this->user_id = $user_id;
	}

	public function setShop_id($shop_id) {
		$this->shop_id = $shop_id;
	}

	public function setProfile_id($profile_id) {
		$this->profile_id = $profile_id;
	}

	public function setCreated($created) {
		$this->created = $created;
	}

	public function setModified($modified) {
		$this->modified = $modified;
	}

	public function setCreatedby($createdby) {
		$this->createdby = $createdby;
	}

	public function setModifiedby($modifiedby) {
		$this->modifiedby = $modifiedby;
	}

	public function setDeleted($deleted) {
		$this->deleted = $deleted;
	}


	public static function select() {
		$connexion=Connexion::getConnexion();
		$query="SELECT id, user_id, shop_id, profile_id, created, modified, createdby, modifiedby, deleted FROM affectations";
		$transaction=$connexion->prepare($query);
		$transaction->execute();
		$data=$transaction->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($data);
	}

	public function insert() {
		$connexion=Connexion::getConnexion();
		$query="INSERT INTO affectations (user_id, shop_id, profile_id, createdby, modifiedby) VALUES (:user_id, :shop_id, :profile_id, :createdby, :modifiedby)";
		$transaction=$connexion->prepare($query);
		$transaction->execute(array('user_id'=>$this->getUser_id(), 'shop_id'=>$this->getShop_id(), 'profile_id'=>$this->getProfile_id(), 'createdby'=>$this->getCreatedby(), 'modifiedby'=>$this->getModifiedby()));
		return true;
	}

	public function update() {
		$connexion=Connexion::getConnexion();
		$query="UPDATE affectations SET user_id=:user_id, shop_id=:shop_id, profile_id=:profile_id, created=:created, modified=:modified, createdby=:createdby, modifiedby=:modifiedby, deleted=:deleted WHERE id=:id";
		$transaction=$connexion->prepare($query);
		$transaction->execute(array('id'=>$this->getId(), 'user_id'=>$this->getUser_id(), 'shop_id'=>$this->getShop_id(), 'profile_id'=>$this->getProfile_id(), 'created'=>$this->getCreated(), 'modified'=>$this->getModified(), 'createdby'=>$this->getCreatedby(), 'modifiedby'=>$this->getModifiedby(), 'deleted'=>$this->getDeleted()));
		return true;
	}

	public static function delete($id) {
		$connexion=Connexion::getConnexion();
		$query="DELETE FROM affectations WHERE id=:id";
		$transaction=$connexion->prepare($query);
		$transaction->execute(array('id'=>$id));
		return true;
	}

    public static function nberOfMagasinOf($users_id){
        $connexion=Connexion::getConnexion();
        $query="SELECT count(*) as nber FROM affectations where user_id=:users_id";
        $transaction=$connexion->prepare($query);
        $transaction->execute(array('users_id'=> $users_id));
        if($data=$transaction->fetch()){
            return $data["nber"];
        }
    }

    public static function getShopIdOf($users_id){
        $connexion=Connexion::getConnexion();
        $query="SELECT shop_id FROM affectations WHERE user_id=:users_id ORDER BY id ASC LIMIT 1 ";
        $transaction=$connexion->prepare($query);
        $transaction->execute(array('users_id'=> $users_id));
        if($data=$transaction->fetch()){
            return $data["shop_id"];
        }
    }


}