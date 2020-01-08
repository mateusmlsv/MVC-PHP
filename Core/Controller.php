<?

namespace Core;

/**
 * @author Mateus Leandro
 */
class Controller
{
	
	function view($controller, $file, $data = array()){
		extract($data);
		include "View".DS.$controller.DS.$file.".php";
	}
}