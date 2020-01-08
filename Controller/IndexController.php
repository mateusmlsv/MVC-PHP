<?

namespace Controller;

use \Core\Controller;
use \Core\Sql;
use \Model\Usuarios;

/**
 * @author Mateus Leandro
 */
class IndexController extends Controller
{	

	function IndexAction()
	{
		Sql::verifyLogin();
		$users = new Usuarios();
		$info['list'] = $users->lista();
		$this->view('Index','index',$info);
	}

	function ErrorAction()
	{
		$this->view('Index','error');
	}	
}