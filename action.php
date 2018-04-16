<?php
interface iActionHandler
{
	public function getActionName();
	public function handleAction($parameters);
	public function getFieldNames();
}

class Action{
	function __construct(){
		Api::getInstance()->registerAction($this);
	}
}