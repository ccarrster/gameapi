<?php
class CreateRoom extends Action implements iActionHandler{
	function __construct(){
		parent::__construct();
	}
	public function getActionName(){
		return "createroom";
	}
	public function handleAction($parameters){
		$gameType = $parameters['gametype'];
		$name = $parameters['name'];
		return Api::getInstance()->createRoom($gameType, $name);
	}
	public function getFieldNames(){
		return array("required"=>['gametype', 'name'], "optional"=>['options']);
	}
}
new CreateRoom();