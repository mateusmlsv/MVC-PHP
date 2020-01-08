<?

namespace Core;

/**
 * @author Mateus Leandro
 */
class Sql
{
	const HOSTNAME = "localhost";
	const USERNAME = "root";
	const PASSWORD = "";
	const DBNAME = "teste";

	private $conn;

	public function __construct()
	{
		$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME,
			Sql::USERNAME,
			Sql::PASSWORD
		);
	}

	private function setParams($statment, $parameters = array())
	{
		foreach ($parameters as $key => $value) {
			$this->bindParam($statment,$key,$value);
		}
	}

	private function bindParam($statment, $key, $value)
	{
		$statment->bindParam($key,$value);
	}

	public function query($rawQuery,$params = array())
	{
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt,$params);

		$stmt->execute();
	}

	public function select($rawQuery,$params = array())
	{
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt,$params);

		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public static function login($login, $senha)
	{
		session_start('sistema');
		$sql = new Sql();
		$results = $sql->select('SELECT * FROM usuarios WHERE login = :LOGIN',array(
			"LOGIN"=>$login
		));

		if(count($results) === 0){
			throw new \Exception("Usuário inexistente ou senha inválida.");			
		}

		$data = $results[0];

		if((md5($senha) == $data['senha']) === true){
			$_SESSION['id'] = $data['usersID'];
			$_SESSION['user'] = $data['nome'];
			$_SESSION['login'] = $data['login'];
			$_SESSION['email'] = $data['email'];			
			return true;
		}else{			
			return false;
		}
	}

	public static function verifyLogin(){
		session_start('sistema');		
		if(!isset($_SESSION['id']) || !$_SESSION['id']){
			header('Location: login');
			exit;
		}
	}
}