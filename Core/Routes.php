<?

namespace Core;

/**
 * @author Mateus Leandro
 */
class Routes
{
	private $uri;
	private $controller;
	private $action;
	private $method;


	function __construct()
	{
		$uri = $_SERVER['REQUEST_URI'];
		$base = '/sistema';
		$route = str_replace($base, "", $uri);
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->uri = $route;
		$this->redirectController();
		$this->loadController();
	}

	protected function redirectController()
	{
		switch ($this->uri) {
			case '/':
				self::controllerAndAction('Index','Index');
				break;
			
			case '/index':
				self::controllerAndAction('Index','Index');
				break;

			case '/login':
				if($this->method == 'POST'){
					self::controllerAndAction('Login','Logar');
				}else{
					self::controllerAndAction('Login','Index');
				}
				break;

			case '/logout':
				self::controllerAndAction('Login','Logout');
				break;

			default:
				self::controllerAndAction('Index','Error');
				break;
		}
	}

	protected function loadController()
	{
		$cont = "Controller\\".$this->controller."Controller";
		$controller = new $cont();
		$action = $this->action."Action";
		$controller->$action();
	}

	private function controllerAndAction($controller, $action)
	{
		$this->controller = $controller;
		$this->action = $action;
	}
}