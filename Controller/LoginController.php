<?

namespace Controller;
use \Core\Controller;
use \Core\Sql;

/**
 * @author Mateus Leandro
 */
class LoginController extends Controller
{
	
	function IndexAction()
	{		
		$this->view('Login','index');
	}

	function LogarAction()
	{				
		if(Sql::login($_POST['txtLogin'],$_POST['txtSenha'])){								
			header('Location: index');
		}else{
			header('Location: login');
		}
	}

	function LogoutAction()
	{
		session_start();
		session_destroy();
		header('Location: login');
	}
}