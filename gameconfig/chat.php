<?php
class Chat extends Game implements iGame{
	function __construct(){
		parent::__construct();
	}
	public function getName(){
		return "chat";
	}
	public function createRoom($roomName){
		return new ChatRoom($this->getName(), $roomName); 
	}
}

class ChatRoom {
	var $roomName;
	var $gameType;
	function __construct($gameType, $roomName){
		$this->gameType = $gameType;
		$this->roomName = $roomName;
	}
}
$chat = new Chat();
Api::getInstance()->createRoom($chat->getName(), "Global");