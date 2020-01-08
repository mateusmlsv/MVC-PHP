<?

namespace Model;
use \Core\Sql;

/**
 * @author Mateus Leandro
 */
class Usuarios extends Sql
{
	
	private $id;
	private $nome;
	private $login;
	private $email;
	private $senha;

	public function lista()
	{
		$list = $this->select('Select * from usuarios');
		return $list;
	}
}