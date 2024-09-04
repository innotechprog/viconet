<?php
class Website{
	private $db;
	private $web_link_ext; // link extension to change when deploying to dev / staging or live

	function __construct($db){
		$this->db = $db;
		$this->setWebLinkExt();
	}
	private function setWebLinkExt(){
		$this->web_link_ext = ""; //if dev enviroment put dev, if staging environment put staging else leave it blank.
	}
	public function getWebLinkExt(){
		return $this->web_link_ext;
	}
}
?>