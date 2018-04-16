<?php
require_once("action.php");
require_once("game.php");
class Api
{
	private static $instance = null;
	private $gameTypes;
	private $actionHandlers;
	private $rooms;
	private function __construct()
	{
		$this->gameTypes = [];
		$this->actionHandlers = [];
		$this->rooms = [];
	}

	public static function getInstance()
	{
		if(self::$instance == null)
		{
			self::$instance = new Api();
		}
		return self::$instance;
	}
	public function registerAction($action){
		$this->actionHandlers[] = $action;
	}
	public function registerGame($game){
		$this->gameTypes[] = $game;
	}
	public function listSupportedGames(){
		$result = [];
		foreach($this->gameTypes as $gameType){
			$result[] = $gameType->getName();
		}
		return $result;
	}
	public function listActions(){
		$result = [];
		foreach($this->actionHandlers as $actionHandler){

			$result[] = $actionHandler->getActionName();
		}
		return $result;
	}
	public function performAction($parameters){
		$result = [];
		foreach($this->actionHandlers as $actionHandler){
			if($actionHandler->getActionName() == $parameters['action']){
				$result[] = $actionHandler->handleAction($parameters);
			}
		}
		return $result;
	}
	public function listRooms($gameType){
		$result = [];
		foreach($this->rooms as $room){
			if($gameType != null){
				if($room->gameType == $gameType){
					$result[] = $room;
				}
			} else {
				$result[] = $room;
			}
		}
		return $result;
	}
	public function createRoom($gameType, $name){
		$result = [];
		$roomAlreadyExists = false;
		foreach($this->rooms as $room){
			if($room->gameType == $gameType){
				if($room->name == $name){
					$roomAlreadyExists = true;
				}
			}
		}
		if(!$roomAlreadyExists){
			foreach($this->gameTypes as $currentGameType){
				if($currentGameType->getName() == $gameType){
					$newRoom = $currentGameType->createRoom($name);
					$this->rooms[] = $newRoom;
					$result[] = true;
				}
			}
		}
		return $result;
	}
}

$actionHandlerFiles = glob('actions/*.php');
foreach($actionHandlerFiles as $actionHandlerFile){
	require_once($actionHandlerFile);
}

$gameConfigFiles = glob('gameconfig/*.php');
foreach($gameConfigFiles as $gameConfigFile){
	require_once($gameConfigFile);
}

if(isset($_GET['action'])){
	$result = Api::getInstance()->performAction($_GET);
	echo(json_encode($result));
} else {
	$actions = Api::getInstance()->listActions();
	$actionString = "";
	foreach($actions as $action){
		if($actionString != ""){
			$actionString .= ", ";
		}
		$actionString .= $action;
	}
	echo(json_encode("action get parameter is required, available actions [".$actionString."]"));
}
