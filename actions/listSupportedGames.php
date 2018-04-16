<?php
class ListSupportedGames extends Action implements iActionHandler{
	function __construct(){
		parent::__construct();
	}
	public function getActionName(){
		return "listsupportedgames";
	}
	public function handleAction($parameters){
		return Api::getInstance()->listSupportedGames();
	}
	public function getFieldNames(){
		return array("required"=>[], "optional"=>[]);
	}
}
new ListSupportedGames();