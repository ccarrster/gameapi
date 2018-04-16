<?php
class ListRooms extends Action implements iActionHandler{
	function __construct(){
		parent::__construct();
	}
	public function getActionName(){
		return "listrooms";
	}
	public function handleAction($parameters){
		$gameType = null;
		if(isset($parameters['gametype'])){
			$gameType = $parameters['gametype'];
		}
		return Api::getInstance()->listRooms($gameType);
	}
	public function getFieldNames(){
		return array("required"=>[], "optional"=>['gametype']);
	}
}
new ListRooms();