<?php
class Audio_content
{
	private $db;
	private $aCName;
	private $aCDateInitiated;
	private $date;

	function __construct($db){
		$this->db = $db;
		$this->date = date('Y-m-d');
	}
	function SetAudioContent(){
		//$t

	}
	public function getPodcasts(){
		$query = $this->db->prepare("SELECT distinct email_type FROM email_sentout");
		$query->execute();
		return $query;
	}
	public function addOpenedEmail($enemail,$podcast_name){
		$emailStatus = "Yes";
		$date = $this->date;
		$query = $this->db->prepare("UPDATE email_sentout SET email_opened = ?, date_email_opened = ? 
			WHERE md5(c_email) = ? and email_type=?");
		$query->execute(array($emailStatus,$date,$enemail,$podcast_name));
	}
	public function countOpenedEmails($emailType){
		$query = $this->db->prepare("SELECT  c_email FROM email_sentout where email_opened ='Yes' and email_type = ?");
		$query->execute(array($emailType));
		return $query->rowCount();
	}
	public function getNumEmailSent($emailType){
		$query = $this->db->prepare("SELECT  c_email FROM email_sentout where email_type=?");
		$query->execute(array($emailType));
		return $query->rowCount();
	}
	public function getOpenedEmailRate($emailType){
		$numSentEmails = $this->countOpenedEmails($emailType);
		$totSentEmails = $this->getNumEmailSent($emailType);
		$totRate = round(($numSentEmails / $totSentEmails) * 100,2);
		return $totRate;
	}
	public function loadFailedEmails($email,$emailType,$reason,$date){
		$query = $this->db->prepare("INSERT INTO failed_emails (c_email,email_type,reason,date_failed) VALUES (?,?,?,?)");
		$query->execute(array($email,$emailType,$reason,$date));
	}
	//Get total number of failed jobs to email type
	public function getNumberOfFailedJobs($emailType){
		$query = $this->db->prepare("SELECT  c_email FROM failed_emails where email_type=?");
		$query->execute(array($emailType));
		return $query->rowCount();
	}
}