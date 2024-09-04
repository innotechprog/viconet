<?php
class Website{
	private $db;
	private $web_link_ext; // link extension to change when deploying to dev / staging or live

	function __construct($db){
		$this->db = $db;
		$this->setWebLinkExt();
	}
	private function setWebLinkExt(){
		$this->web_link_ext = "dev."; //if dev enviroment put dev followed with a dot(.), if staging followed with a dot(.) environment put staging else leave it blank.
	}
	public function getWebLinkExt(){
		return $this->web_link_ext;
	}
}
?>