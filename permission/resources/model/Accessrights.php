<?php
Class Accessrights {
	private $id;
	private $profile_id;
	private $resource_id;
	private $accessrights;
	private $created;
	private $modified;
	private $createdby;
	private $modifiedby;
	private $deleted;

	public function __construct($id, $profile_id, $resource_id, $accessrights, $created, $modified, $createdby, $modifiedby, $deleted) {
		$this->id = $id;
		$this->profile_id = $profile_id;
		$this->resource_id = $resource_id;
		$this->accessrights = $accessrights;
		$this->created = $created;
		$this->modified = $modified;
		$this->createdby = $createdby;
		$this->modifiedby = $modifiedby;
		$this->deleted = $deleted;

	}

	public function getId() {
		return $this->id;
	}

	public function getProfile_id() {
		return $this->profile_id;
	}

	public function getResource_id() {
		return $this->resource_id;
	}

	public function getAccessrights() {
		return $this->accessrights;
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

	public function setProfile_id($profile_id) {
		$this->profile_id = $profile_id;
	}

	public function setResource_id($resource_id) {
		$this->resource_id = $resource_id;
	}

	public function setAccessrights($accessrights) {
		$this->accessrights = $accessrights;
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


	public static function select($profile_id=null) {
		$connexion=Connexion::getConnexion();
		$query="SELECT a.id, r.name as resource, a.profile_id, a.resource_id, a.c,a.r,a.u,a.d, a.created, a.modified, a.createdby, a.modifiedby, a.deleted FROM accessrights a INNER JOIN resources r ON a.resource_id=r.id WHERE a.profile_id=:profile_id";
		$transaction=$connexion->prepare($query);
		$transaction->execute(array('profile_id'=>$profile_id));
		$data=$transaction->fetchAll(PDO::FETCH_ASSOC);
        array_walk_recursive($data, function(&$item){
            if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
            }
        });
		return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR);
	}

	public static function insert($profile_id, $resource_id) {
		$connexion=Connexion::getConnexion();
        if (self::getAcccessId($profile_id, $resource_id) == null ){
            $query="INSERT INTO accessrights (profile_id, resource_id, c, r, u, d, p, v, created, modified, createdby, modifiedby, deleted) VALUES (:profile_id, :resource_id, 0, 0, 0, 0, 0, 0, now(), now(), 'System', 'System', 0)";
            $transaction=$connexion->prepare($query);
            $transaction->execute(array('profile_id'=>$profile_id, 'resource_id'=>$resource_id));
        }
		return true;
	}

	public static function update($id, $access, $val) {
		$connexion=Connexion::getConnexion();
		$query="";
        if ($access=="CREATE")
		    $query="UPDATE accessrights SET c=:val WHERE id=:id";
        elseif ($access=="READ")
            $query="UPDATE accessrights SET r=:val WHERE id=:id";
        elseif ($access=="UPDATE")
            $query="UPDATE accessrights SET u=:val WHERE id=:id";
        elseif ($access=="DELETE")
            $query="UPDATE accessrights SET d=:val WHERE id=:id";
        elseif ($access=="MENU")
            $query="UPDATE accessrights SET v=:val WHERE id=:id";
        else
            $query="UPDATE accessrights SET p=:val WHERE id=:id";

        $transaction=$connexion->prepare($query);
		$transaction->execute(array('id'=>$id, 'val'=>$val));
		return true;
	}

	public static function delete($id) {
		$connexion=Connexion::getConnexion();
		$query="DELETE FROM accessrights WHERE id=:id";
		$transaction=$connexion->prepare($query);
		$transaction->execute(array('id'=>$id));
		return true;
	}

    public static function CheckAccess($profile_id, $resource_id, $request){
        $connexion=Connexion::getConnexion();
        $query="";
        if ($request=="CREATE"){
            $query="SELECT c as access FROM accessrights WHERE profile_id=:profile_id AND resource_id=:resource_id";

        } elseif ($request=="READ"){
            $query="SELECT r as access FROM accessrights WHERE profile_id=:profile_id AND resource_id=:resource_id";

        } elseif ($request=="UPDATE"){
            $query="SELECT u as access FROM accessrights WHERE profile_id=:profile_id AND resource_id=:resource_id";

        } elseif ($request=="DELETE"){
            $query="SELECT d as access FROM accessrights WHERE profile_id=:profile_id AND resource_id=:resource_id";

        } elseif ($request=="MENU"){
            $query="SELECT v as access FROM accessrights WHERE profile_id=:profile_id AND resource_id=:resource_id";

        } else{
            $query="SELECT p as access FROM accessrights WHERE profile_id=:profile_id AND resource_id=:resource_id";

        }
        $transaction=$connexion->prepare($query);
        $transaction->execute(array('profile_id'=> $profile_id, 'resource_id'=>$resource_id));
        if($data=$transaction->fetch()){
            return $data["access"];
        }
    }

    public static function getAcccessId($profile_id, $resource_id){
        $connexion=Connexion::getConnexion();
        $query="SELECT id as access FROM accessrights WHERE profile_id=:profile_id AND resource_id=:resource_id";
        $transaction=$connexion->prepare($query);
        $transaction->execute(array('profile_id'=> $profile_id, 'resource_id'=>$resource_id));
        if($data=$transaction->fetch()){
            return $data["access"];
        }
    }


}
