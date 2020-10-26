<?php 
class Usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setIdusuario($idusuario){
		$this->idusuario = $idusuario;
	}

	public function setDeslogin($deslogin){
		$this->deslogin = $deslogin;
	}

	public function setDessenha($dessenha){
		$this->dessenha = $dessenha;
	}

	public function setDtcadastro($dtcadastro){
		$this->dtcadastro = $dtcadastro;
	}

	//pega um usuário com aquele $id
	public function loadById($id){
		$sql = new Sql();
		//usei a variável $query para passar somente um argumento no select, pois ele estava acusando dois argumentos
		$query = "SELECT * FROM tb_usuarios WHERE idusuario = ".$id;

		$results = $sql->select($query);
		if (count($results) > 0) {
			$row = $results[0];
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}

	//traz uma lista de todos os usuários
	public static function getList(){
		$sql = new Sql();
		$query = "SELECT * FROM tb_usuarios ORDER BY deslogin;";

		return $sql->select($query);

	}

	public static function searchUsuario($login){
		$sql = new Sql();
		$query = "SELECT * FROM tb_usuarios WHERE deslogin LIKE '%".$login."%';";

		return $sql->select($query);
	}

	public function login($login, $password){
		$sql = new Sql();
		$query = "SELECT * FROM tb_usuarios WHERE deslogin = '".$login."' AND dessenha = '". $password."'";

		$results = $sql->select($query);
		if (count($results) > 0) {
			$row = $results[0];
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		} else {

			throw new Exception("Login e/ou senha inválidos.");
		}
	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}
}
 ?>