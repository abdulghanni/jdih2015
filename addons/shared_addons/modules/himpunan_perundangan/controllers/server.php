<?php class xrpc_server extends Controller {

	function xrpc_server()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');
		$config['functions']['Greetings'] = array('function' => 'xrpc_server.process');
		$this->xmlrpcs->initialize($config);
		$this->xmlrpcs->serve();
	}
	
	function process($request)
	{
		$parameters = $request->output_parameters();
		$response = array(
							array(
									'you_said'  => $parameters['0'],
									'i_respond' => 'Not bad at all.'),
							'struct');
		return $this->xmlrpc->send_response($response);
	}

}

?>