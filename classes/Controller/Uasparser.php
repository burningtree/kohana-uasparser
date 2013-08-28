<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Serve Kohana Twitter Bootstrap static files
 *
 * @package    Kohana-twitter-bootstrap
 * @category   Controllers
 * @author     Luiz Alberto <madeinnordeste@gmail.com>
 */
class Controller_Uasparser extends Controller {

	public function action_assets()
	{
		// Generate and check the ETag for this file
	  $this->check_cache(sha1($this->request->uri()));

		// Get the file path from the request
		$file = $this->request->param('file');

		// Find the file extension
		$ext = pathinfo($file, PATHINFO_EXTENSION);

		// Remove the extension from the filename
		$file = substr($file, 0, -(strlen($ext) + 1));
				
		if ($file = Kohana::find_file('assets/', $file, $ext))
		{
			// Send the file content as the response
			$this->response->send_file($file, NULL, array('inline' => TRUE));
		}
		else
		{
			// Return a 404 status
      throw HTTP_Exception::factory(404);
		}
	}
}
