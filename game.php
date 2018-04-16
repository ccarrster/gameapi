<?php
interface iGame
{
	public function getName();
	public function createRoom($name);
}

class Game{
	function __construct(){
		Api::getInstance()->registerGame($this);
	}
}