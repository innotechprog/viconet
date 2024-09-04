<?php
 function createRandomPassword() {
        $chars = "003232303232023232023456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ; 
        for($i; $i <= 30; $i++) {

          $num = rand() % 70;

          $tmp = substr($chars, $num, 1);

          $pass = $pass . $tmp;

 
        }
        return $pass;
      }

  $pass = createRandomPassword();

 function getSessionId($longText){
		$sess = substr($longText, 0,32);
		return $sess;
	}
	function createEncry($id){
		$encry = md5($id);
		return $encry;
	}


/**
 * 0726146568
 */
class LandingPage
{
	private $db;
	private $title;
	private $landingPic;
	private $landingContent;
	function __construct($db)
	{
		$this->db = $db;

	}
	function setLandingPage()
	{
		$query = $this->db->prepare("SELECT * FROM landing_page WHERE id = 1");
		$query->execute();
		
		while ($row = $query->fetch()) {
			$this->title = $row['l_title'];
			$this->landingContent = $row['l_content'];
			$this->landingPic = $row['l_image'];
		}
	}
	function getTitle(){
		return $this->title;
	}
	function getImg(){
		return $this->landingPic;
	}
	function getContent()
	{
		return $this->landingContent;
	}
}
/**
 * 
 */
class SendEmails
{ 
	private $db;
	private $username;
	private $password;
	private $host;
	private $port;
	function __construct($db)
	{
		$this->db = $db;
		$this->username = "info@viconetgroup.com";
		$this->password = "zjcApvIVbp_p4jV-yfF8dEuwmb0vS6NT";
		$this->port = 587;
		$this->host = "mail.viconetgroup.com";
	}
	public function getUsername(){
		return $this->username;
	}
	public function getPassword(){
		return $this->password;
	}
	public function getHost(){
		return $this->host;
	}
	public function getPort(){
		return $this->port;
	}
}

/**
 * 
 */

class Corporate
{
	private $upgradeMessage;
	private $db;
	//Company informatin
	private $compName;
	private $compReg;
	private $vatNumber;
	private $compIndustry;
	private $compEmail;
	private $compTel;
	private $compStatus;
	private $numUsers;
	private $compLogo;

	//Address
	private $address;
	private $addressEmail;
	private $code;
	private $city;
	private $state;
	private $state_id;
	private $country;
	private $country_id;

//Company users information
	private $userName;
	private $userSurname;
	private $userCell;
	private $userEmail;
	private $userPos;
	private $userPass;
	private $userPP;
	private $userId;
	private $userSess;
	private $addedBy;
	private $sub_start_date;
	private $sub_end_date;

//Packages
	private $package_id;
	private $package_name;
	private $package_desc;
	private $package_duration;
	private $package_price;
	private $package_price2;
	private $package_vat;
	private $total_price;
	private $total_price2;
	private $package_num_users;

	//Subscription
	private $subscr_id;
	private $compPackage_id;
	private $subscr_status;
	private $auto_renewal;
	//Receipt
	private $receipt_id;
	private $num_receipt;
	private $fakeId;
	private $fakeId2;
	//Functions

	function __construct($db)
	{
		$this->db = $db; 
		$this->fakeId = md5("receId");
		$this->fakeId2 = md5("receId2"); 
		$this->upgradeMessage = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>To view full candidate profile, click here to upgrade your package <a href="packages" class="bton btn1">Upgrade </a></div>';
	}
	public function addCorporate($cn,$ct,$ce,$cr,$st){
		$query=$this->db->prepare("INSERT INTO `corporate`(`company_name`, `company_tel`,`company_reg`, `company_email`, `status`) VALUES ('$cn','$ct','$cr','$ce','$st')");
		$query->execute();
	}
	//Update corporate user information
	public function updateCorporate($userName_,$userSurname_,$userCell_,$id_){
		$query = $this->db->prepare("UPDATE `users` SET `user_name`=?, `user_surname`=?, `user_cellphone`=? WHERE `id`= ?");
		$query->execute(array($userName_,$userSurname_,$userCell_,$id_));
	}
	//Update Corporate company information
	public function updateCorporateDetails($comp_industry,$comp_tel,$id){
		$sqlQuery = $this->db->prepare("UPDATE `corporate` SET `company_industry`='$comp_industry',`company_tel`='$comp_tel' WHERE `company_email`='$id'");
		$sqlQuery->execute();

	}
	public function updateVatNumber($vat_num,$compReg){
		$comp_reg = md5($this->compEmail);
		$query = $this->db->prepare("UPDATE `corporate` SET `vat_number`=? WHERE md5(company_email) = ? ");
		$query->execute(array($vat_num,$comp_reg));
	}
	//add corporates to database
	public function addCorporateUser($companyEmail, $userName,$userSurname,$userCellphone,$userEmail,$password,$userPos,$addedBy,$dateAdded,$endDate)
	{
		$companyEmail = strtolower($companyEmail);
		$userEmail = strtolower($userEmail);
		$query=$this->db->prepare("INSERT INTO `users`(`company_email`, `user_name`, `user_surname`, `user_cellphone`, `user_email`, `user_position`,`password`,`added_by`, `date_added`,`end_date`) VALUES ('$companyEmail', '$userName','$userSurname','$userCellphone','$userEmail','$userPos','$password','$addedBy','$dateAdded','$endDate')");
		$query->execute();
	} 
		//Get all users
	public function getAllUsers(){
		$compEmail = $this->compEmail;
		$query = $this->db->prepare("SELECT * FROM users WHERE company_email ='$compEmail' ");
		$query->execute();
		return $query;
	}
	public function countUsersPerComp(){
		$compEmail = $this->compEmail;
		$query = $this->db->prepare("SELECT count(id) as num_rows FROM users WHERE company_email='$compEmail'");
		$query->execute();
		$row = $query->fetch();
		return $row['num_rows'];
	}
	function updateNumUsers($comp_reg,$num_users)
	{
		$query = $this->db->prepare("UPDATE corporate SET num_users = ? WHERE company_email = ?");
		$query->execute(array($num_users,$comp_reg));
	}
	public function setCompData($id){
		$query = $this->db->prepare("SELECT * FROM corporate WHERE md5(company_email)='$id'");
		$query->execute();
		while($row=$query->fetch())
		{
			$this->compName = $row['company_name'];
			$this->compReg = $row['company_email'];
			$this->vatNumber = $row['vat_number'];
			$this->compIndustry = $row['company_industry'];
			$this->compTel = $row['company_tel'];
			$this->compStatus = $row['status'];
			$this->numUsers = $row['num_users'];
			$this->compLogo = $row['logo'];
		}
	}
	//Get all industries
	public function getAllIndustries(){
		$query = $this->db->prepare("SELECT * FROM industries");
		$query->execute();
		return $query;
	}
	public function setUsersData($id){
		
		$query = $this->db->prepare("SELECT * FROM users WHERE md5(user_email)='$id'");
		$query->execute();
		while($row=$query->fetch())
		{
			$this->userName = $row['user_name'];
			$this->compEmail = $row['company_email'];
			$this->userSurname = $row['user_surname'];
			$this->userEmail = $row['user_email'];
			$this->userCell = $row['user_cellphone'];
			$this->userPos = $row['user_position'];
			$this->userPass = $row['password'];
			$this->userPP = $row['user_pp'];
			$this->userId = $row['id'];
			$this->userSess = $row['sess_id'];
			$this->addedBy = $row['added_by'];
			$this->sub_start_date = $row['start_date'];
			$this->sub_end_date = $row['end_date'];
			$this->setCompData(md5($row['company_email']));
	}
}
//Adding packages
public function addPackages(){
$query = $this->db->prepare("INSERT INTO `packages`(`package_name`, `package_desc`, `package_duration`, `package_price`) VALUES ('','','','')");
$query->execute();
}
//Generate package_id
	public function generatePackageId(){
		$pack_id = "";
		$query = $this->db->prepare("SELECT package_id FROM packages WHERE package_id = '$pack_id'");
		$res = $query->execute();
		$res->fetch();
		while($res['package_id'] == $pack_id){
			$pack_id = 'vico-'.createRandomPassword();
			if($res['package_id'] != $pack_id)
			{
				return $pack_id;
			}
		}
	}
	//End generate 
	public function getAllPackages(){
		$query = $this->db->prepare("SELECT * FROM packages");
		$query->execute();
		return $query;
	}

	//Assigning values to package per id
	public function compPackage($id){
		$query = $this->db->prepare("SELECT * FROM packages WHERE package_id = '$id'");
		$query->execute();
		while ($row = $query->fetch()) {
			$this->package_id = $row['package_id'];
			$this->package_name = $row['package_name'];
			$this->package_desc = $row['package_desc'];
			$this->package_duration = $row['package_duration'];
			$this->package_price = $row['package_price'];
			$this->package_num_users = $row['num_users'];
			$this->setVat($row['package_price']);
		}
	}
	//Get prices of package with users
		public function compPackage2($id,$numUsers){
		$query = $this->db->prepare("SELECT * FROM packages WHERE package_id = '$id'");
		$query->execute();
		while ($row = $query->fetch()) {
			$this->package_id = $row['package_id'];
			$this->package_name = $row['package_name'];
			$this->package_desc = $row['package_desc'];
			$this->package_duration = $row['package_duration'];
			$this->package_price = $numUsers*$row['package_price'];
			$this->package_num_users = $numUsers;
			$this->setVat($numUsers*$row['package_price']);
		}
	}
	private function setVat($price){
			$vat = 0.15*$price;
			$this->package_vat = number_format($vat,2,'.',' ');
			$this->total_price = number_format(($price + $vat),2,'.',' ');
			$this->total_price2 = $price + $vat;
			$this->package_price2 = number_format($price,0,'.',' ');
	} 
		public function getSubscription(){
		$comp_reg =md5($this->compReg); 
		$query = $this->db->prepare("SELECT * FROM subscriptions WHERE company_reg ='$comp_reg'");
		$query->execute();
		$row = $query->fetch();
		$this->subscr_id = $row['subscription_id'];
		$this->compPackage_id = $row['package_id'];
		$this->auto_renewal =$row['auto_renewal'];
		$this->subscr_status = $row['status'];
		$this->compPackage($row['package_id']);
	}
	public function getDateDifference(){
		$comp_reg =md5($this->compReg); 
		$query = $this->db->prepare("SELECT DATEDIFF(end_date,start_date) AS monthDiff, DATEDIFF(end_date,start_date) AS daysDiff  FROM subscriptions WHERE company_reg ='$comp_reg'");
		$query->execute();
		$row = $query->fetch();
		$date="";
		
			$date = $row['daysDiff']." days";
		
		return $date;
	}
	public function createEndDate($monthsAdded){
		$date = new DateTime('now');
		$date->modify($monthsAdded); 
		$date = $date->format('Y-m-d');
		return $date;
	}
	public function autoDownGradeSubscription()
	{
		$date = date('Y-m-d');
		$userEmail =md5($this->userEmail); 
		$comp_reg = md5($this->compReg);
		$query = $this->db->prepare("SELECT * FROM users WHERE md5(user_email) ='$userEmail'");
		$query->execute();
		$row = $query->fetch();
		if(strtotime($date) > strtotime($row['end_date']) ){
			$query = $this->db->prepare("UPDATE subscriptions SET package_id=?,status=?  WHERE company_reg ='$comp_reg'");
			$query->execute(array('vicopac1','free'));
		}
	}
	//Add company to subscription
	public function addCompSubscription($comp_reg){
		$sql = $this->db->prepare("SELECT package_id FROM packages WHERE `package_price` = ?");
		$res = $sql->execute(array(0));
		$row = $sql->fetch();
		$package_id = $row['package_id'];
		$query = $this->db->prepare("INSERT INTO `subscriptions`(`company_reg`, `package_id`, `status`) VALUES (?,?,?)");
		$query->execute(array($comp_reg,$package_id,'free'));
	}
	public function updateSubscription($package_id,$status,$compReg,$startDate,$endDate,$autoRenewal){
		$compReg = md5($compReg);
		$query = $this->db->prepare("UPDATE subscriptions SET status=?, package_id =?,auto_renewal = ? WHERE company_reg=?");
		$query->execute(array($status,$package_id,$autoRenewal,$compReg));
	} 
	public function updateUserSubscription($email,$startDate,$endDate)
	{
		$query = $this->db->prepare("UPDATE users SET start_date=?, end_date = ? WHERE user_email = ?");
		$query->execute(array($startDate,$endDate,$email));
	}
	//count number of items on basket 
	public function countReceipts()
	{
		$query = $this->db->prepare("SELECT count(receipt_id) AS num_rows FROM receipts");
		$query->execute();
		$row = $query->fetch();
		return $row['num_rows'];
	}
	public function countCompReceipts($compEmail)
	{
		$compEmail =md5($compEmail);
		$addedBy = md5($this->userEmail);
		if(strtolower($this->addedBy)=="system")
		{
			$query = $this->db->prepare("SELECT count(receipt_id) AS num_rows FROM receipts where company_reg ='$compEmail'");
			$query->execute();
			$row = $query->fetch();
		}
		else{
			$query = $this->db->prepare("SELECT count(receipt_id) AS num_rows FROM receipts where company_reg ='$compEmail' and added_by='$addedBy'");
		$query->execute();
		$row = $query->fetch();
		}
		return $row['num_rows'];
	}
	public function countReceiptsPerUser($addedBy){
		$compEmail =md5($this->compReg);
		$query = $this->db->prepare("SELECT count(receipt_id) AS num_rows FROM receipts where company_reg ='$compEmail' and added_by='$addedBy'");
		$query->execute();
		$row = $query->fetch();
		return $row['num_rows'];
	}
	public function addToBasket($receipt_id,$comp_reg,$addedBy,$c_email,$cand_num,$status){
		$c_email = md5($c_email);
		$query = $this->db->prepare("INSERT INTO `basket`(`company_reg`, `c_email`,`added_by`,`receipt_id`,`shortlist_id`,`status`) VALUES ('$comp_reg','$c_email','$addedBy','$receipt_id','$cand_num','$status')");
		$query->execute();
	}
	//Checking if there is a receipt which is not paid
	public function checkReceiptNotPaid()
	{
		$id = md5($this->compReg);
		$query = $this->db->prepare("SELECT *,count(receipt_id) as num_rows FROM receipts WHERE company_reg='$id' and status='not paid'");
		$query->execute();
		$row = $query->fetch();
		$this->num_receipt = $row['num_rows'];
		$this->receipt_id = $row['receipt_id'];
	}
	public function notPaidReceipt(){

	}
	public function checkReceiptExist($rec_id){
		$comp_reg = md5($this->compReg);
		$query = $this->db->prepare("SELECT *,count(receipt_id) as num_rows FROM receipts WHERE company_reg='$comp_reg' and receipt_id='$rec_id'");
		$query->execute();
		//$row = $query->fetch();
	}
	public function checkReceiptExist_($rec_id){
	$query = $this->db->prepare("SELECT *,count(receipt_id) as num_rows FROM receipts WHERE receipt_id='$rec_id'");
	$query->execute();
	$row = $query->fetch();
	return $row['num_rows'];
	}	
	public function checkReceiptExistByName($rec_name){
	$comp_reg = md5($this->compReg);
	$query = $this->db->prepare("SELECT *,count(receipt_id) as num_rows FROM receipts WHERE name=? and company_reg=?");
	$query->execute(array($rec_name,$comp_reg));
	$row = $query->fetch();
	return $row['num_rows'];
	}	
	public function getReceiptById($rec_id){
		$comp_reg = md5($this->compReg);
		$query = $this->db->prepare("SELECT * FROM receipts WHERE company_reg='$comp_reg' and receipt_id='$rec_id'");
		$query->execute();
		//$row = $query->fetch();
		return $query;
	}
	//this function generates Receipt id and add 1 to the last receipt
	public function generateReceiptId(){
		$receipt_id ="";
		//call to checkReceiptExist function to check if the company have a receipt not checked out
		/*$this->checkReceiptNotPaid();
		if($this->num_receipt>0){
			$receipt_id = $this->receipt_id;
		}
		else{*/
				$i=1;
				$receipt_id="";
				$new_receipt = $this->countReceipts() + $i;
				$receipt_id = 'vico-inv'.$new_receipt;
				while($this->checkReceiptExist_($receipt_id) >0)
				{
					$new_receipt++;
					$receipt_id = 'vico-inv'.$new_receipt;
				}
			
		//}
		return $receipt_id;
	}
	//count invoices
	public function countInvoices()
	{
		$query = $this->db->prepare("SELECT count(invoice_id) AS num_rows FROM invoices");
		$query->execute();
		$row = $query->fetch();
		return $row['num_rows'];
	}
	//count invoices per company
	public function countInvPerComp($comp_reg)
	{
		$query = $this->db->prepare("SELECT count(invoice_id) AS num_rows FROM invoices WHERE company_reg = ?");
		$query->execute(array($comp_reg));
		$row = $query->fetch();
		return $row['num_rows'];
	}
	//check invoice exist
	public function checkInvoiceExist($inv_id){
	$query = $this->db->prepare("SELECT *,count(invoice_id) as num_rows FROM invoices WHERE invoice_id='$inv_id'");
	$query->execute();
	$row = $query->fetch();
	return $row['num_rows'];
	}	
	//Generate invoice number
	public function generateInvoice(){
			$i=1;
				$invoice_id="";
				$new_invoice = $this->countInvoices() + $i;
				$invoice_id = 'inv-'.str_pad($new_invoice,10,"0",STR_PAD_LEFT);
				while($this->checkInvoiceExist($invoice_id) > 0)
				{
					$new_invoice++;
					$invoice_id = 'inv-'.str_pad($new_invoice,10,"0",STR_PAD_LEFT);
				}			
		return $invoice_id;
	}
	//function to add invoice to the database after payment has been made
	public function addInvoice($inv_id, $comp_reg, $amount, $date,$status){
		$comp_reg = md5($comp_reg);
		$query = $this->db->prepare("INSERT INTO `invoices`(`invoice_id`, `company_reg`, `amount_paid`, `paid_date`, `status`) VALUES (?,?,?,?,?)");
		$query->execute(array($inv_id, $comp_reg, '100', $date, $status));
	}
	/*public function addToReceipt($receipt_id,$comp_reg,$desc,$status){
		if($this->num_receipt == 0)
		{
			$query = $this->db->prepare("INSERT INTO `receipts`(`receipt_id`, `company_reg`, `description`, `checkout_date`, `status`) VALUES ('$receipt_id','$comp_reg','$desc','','$status')");
			$query->execute();
		}
	}*/
	public function addToReceipt($receipt_id,$comp_reg,$addedBy,$status,$projName,$projDesc,$date){
		$query = $this->db->prepare("INSERT INTO `receipts`(`receipt_id`, `company_reg`,`added_by`, `name`, `description`, `m_type`, `checkout_date`, `status`) VALUES ('$receipt_id','$comp_reg','$addedBy','$projName','$projDesc','','$date','$status')");
			$query->execute();
	}
	//Update Receipts
	public function updateReceipt($projName_,$projDesc_,$what_,$status_,$date_){
		$compReg = md5($this->compReg);
		$query = $this->db->prepare("UPDATE `receipts` SET `name`=?,`description`=?,`m_type`=?, `checkout_date`=?,`status`=? WHERE `company_reg`=? AND `status`='not paid'");
		$query->execute(array($projName_,$projDesc_,$what_,$date_,$status_,$compReg));
	}
		public function updateReceiptStatus($status,$receipt_id){
		$compReg = md5($this->compReg);
		$query = $this->db->prepare("UPDATE `receipts` SET `status`=? WHERE `company_reg`=? AND `status`='not paid' and `receipt_id`=?");
		$query->execute(array($status,$compReg,$receipt_id));
	}
	//Get Paid receipt for company
	public function getReceipts()
	{
		$query = "";
		$compReg = md5($this->compReg);
		$addedBy = md5($this->userEmail);
		if(strtolower($this->addedBy) == 'system')
		{
			$query = $this->db->prepare("SELECT * from receipts where company_reg =? order by receipt_id desc");
			$query->execute(array($compReg));
		}
		else{
			$query = $this->db->prepare("SELECT * from receipts where company_reg =? and added_by='$addedBy' order by receipt_id desc");
			$query->execute(array($compReg));
		}
		return $query;
	}
	//Get projects by user_id
	public function getReceiptsByUsers($addedBy){
		$compReg = md5($this->compReg);
		$query = $this->db->prepare("SELECT * from receipts where company_reg =? and added_by='$addedBy' order by receipt_id desc");
			$query->execute(array($compReg));
		return $query;
	}
	//this function checks if a candidate has already been added on basket
	public function checkCandidateAdded($c_email)
	{
		$c_email = md5($c_email);
		$comp_reg = md5($this->compReg);
		$fakeId = md5("receId");
		$query = $this->db->prepare("SELECT count(receipt_id) as num_rows FROM basket WHERE c_email='$c_email' and company_reg = '$comp_reg' and receipt_id = '$fakeId'");
		$query->execute();
		$row = $query->fetch();
		return $row['num_rows'];
	}
	public function checkCandAddInProj($c_email,$rec_id)
	{
		$c_email = md5($c_email);
		$comp_reg = md5($this->compReg);
		$fakeId = md5("receId");
		$query = $this->db->prepare("SELECT count(receipt_id) as num_rows FROM basket WHERE c_email='$c_email' and company_reg = '$comp_reg' and receipt_id = '$rec_id'");
		$query->execute();
		$row = $query->fetch();
		return $row['num_rows'];
	}
	//this function checks if a candidate has already been added on a project
	public function checkCandAddedProj($c_email,$receipt_id)
	{
		$c_email = md5($c_email);
		$comp_reg = md5($this->compReg);
		$query = $this->db->prepare("SELECT count(receipt_id) as num_rows FROM basket WHERE c_email='$c_email' and company_reg = '$comp_reg' and receipt_id = '$receipt_id'");
		$query->execute();
		$row = $query->fetch();
		return $row['num_rows'];
	}
	//update project information
	public function updateProject($receipt_id,$receiptName,$receiptDesc){
		$comp_reg = md5($this->compReg);
		$query = $this->db->prepare("UPDATE `receipts` SET `name`='$receiptName',`description`='$receiptDesc' WHERE `receipt_id`='$receipt_id' and `company_reg`='$comp_reg'");
		$query->execute();
	}
	//Count number of candidates in the basket
	public function countCandatesInBasket(){
		$comp_reg = md5($this->compReg);
		$fakeId = md5("receId");
		$addedBy = md5($this->userEmail);
		$query = $this->db->prepare("SELECT count(receipt_id) as num_rows FROM basket WHERE company_reg = '$comp_reg' and receipt_id = '$fakeId' and added_by = '$addedBy'");
		$query->execute();
		$row = $query->fetch();
		return $row['num_rows'];
	}
//Count candidates within a project
	public function countCandidatesInProj($receipt_id){
		$comp_reg = md5($this->compReg);
		$fakeId = md5("receId");
		$addedBy = md5($this->userEmail);
		$query = $this->db->prepare("SELECT count(receipt_id) as num_rows FROM basket WHERE company_reg = '$comp_reg' and receipt_id = '$receipt_id' and added_by = '$addedBy'");
		$query->execute();
		$row = $query->fetch();
		return $row['num_rows'];
	}
		public function countCandInProjPerStatus($receipt_id,$status){
		$comp_reg = md5($this->compReg);
		$fakeId = md5("receId");
		$addedBy = md5($this->userEmail);
		$query = $this->db->prepare("SELECT count(receipt_id) as num_rows FROM basket WHERE company_reg = '$comp_reg' and receipt_id = '$receipt_id' and added_by = '$addedBy' and status ='$status'");
		$query->execute();
		$row = $query->fetch();
		return $row['num_rows'];
	}


	//Get candidates in basket
	public function candidatesInBasket($status){
		$comp_reg = md5($this->compReg);
		$fakeId = $this->fakeId;
		$addedBy = md5($this->userEmail);
		$query = $this->db->prepare("SELECT * FROM basket WHERE company_reg='$comp_reg' and receipt_id ='$fakeId' and added_by = '$addedBy'");
		$query->execute();
		return $query;
	}
	//Get candidates in basket. used on send_emails
	public function inviteCandidates($status,$receipt_id,$basketId){
		$comp_reg = md5($this->compReg);
		$fakeId = $this->fakeId;
		$query = $this->db->prepare("SELECT * FROM basket WHERE id='$basketId' and company_reg='$comp_reg' and receipt_id ='$receipt_id' and status ='$status'");
		$query->execute();
		return $query;
	}
	//Get number of shortlisted candidate candidates
	public function numOfShortlistedCand(){
		$comp_reg = md5($this->compReg);
		$fakeId = md5("receId");
		$query = $this->db->prepare("SELECT distinct count(c_email) as num_cand FROM basket WHERE company_reg='$comp_reg' and receipt_id ='$fakeId'");
		$query->execute();
		$row = $query->fetch();
		$num_cand = $row['num_cand'];
		return $num_cand;
	}
	public function checkedoutCandidates($payment_status,$receipt_id,$status){
		$comp_reg = md5($this->compReg);
		$query = $this->db->prepare("SELECT *  FROM basket WHERE company_reg='$comp_reg' and receipt_id ='$receipt_id' and status = '$status'");
		$query->execute();
		return $query;
	}

	//update basket
	public function updateBasket($status,$id){
		$comp_reg = md5($this->compReg);
		$query = $this->db->prepare("UPDATE basket SET status =? WHERE md5(id)=? and company_reg =?");
		$query->execute(array($status,$id,$comp_reg));
	}
	public function updateBasket__($status,$id){
		$query = $this->db->prepare("UPDATE basket SET status =? WHERE md5(id)=?");
		$query->execute(array($status,$id));
	}
	public function updateBasket2($status,$receipt_id,$prev_status,$id){
		$comp_reg = md5($this->compReg);
		$query = $this->db->prepare("UPDATE basket SET status =? WHERE receipt_id=? and status=? and company_reg =? and id=?");
		$query->execute(array($status,$receipt_id,$prev_status,$comp_reg,$id));
	}
	//Set receipts for candidates in a basket that are added to existing projects
	public function updateBasket_($receipt_id){
		$comp_reg = md5($this->compReg);
		$query = $this->db->prepare("UPDATE basket SET receipt_id =? WHERE company_reg=? and receipt_id=?");
		$query->execute(array($receipt_id,$comp_reg,$this->fakeId));
	}
	//Update company basket 
	public function updateCompBasket($receipt_id){
		$comp_reg = md5($this->compReg);
		$query = $this->db->prepare("UPDATE basket SET receipt_id =? WHERE company_reg=? and receipt_id=?");
		$query->execute(array($receipt_id,$comp_reg,$this->fakeId2));
	}
	public function scheduleDetails($what){
		$value="";
		if($what == "Meeting")
		{
			$value =" has gone through your profile and would like to invite you for a meeting. See details below to Accept or Decline the meeting. ";
		}
		else
		{
			$value=" has gone through your profile and would like to invite you for an interview. See details below to Accept or Decline the interview.";
		}
		return $value;
	}
		public function addAddress($location,$city,$state,$country,$zip_code)
	{
		$compEmail = md5($this->compEmail);
		$query = $this->db->prepare("INSERT INTO `address`(`email`, `address`, `city`, `code`, `state`, `country`) VALUES ('$compEmail','$location','$city','$zip_code','$state','$country')");
		$query->execute();
	}
	public function addLocation($user,$location){
		$query = $this->db->prepare("INSERT INTO `address`(`email`, `address`) VALUES ('$user','$location')");
		$query->execute();
	}
	public function updateAddress($location,$city,$state,$country,$zip_code)
	{
		$compEmail = md5($this->compEmail);
		$query = $this->db->prepare("UPDATE `address` SET `address`=?,`city`=?,`code`=?,`state`=?,`country`=? WHERE `email`=?");
		$query->execute(array($location,$city,$zip_code,$state,$country,$compEmail));
	}
	//Check company address exist
	public function countCompAddress()
	{
		$email = md5($this->compEmail);
		$query = $this->db->prepare("SELECT count(email) AS num_rows FROM `address` WHERE email='$email'");
		$query->execute();
		$row=$query->fetch();
		return $row['num_rows'];
	}
	public function address(){
		$email = md5($this->compEmail);
		$query = $this->db->prepare("SELECT * FROM address WHERE email='$email'");
		$query->execute();
		while($row = $query->fetch())
		{
			$this->addressEmail = $row['email'];
			$this->address = $row['address'];
			$this->city = $row['city'];
			$this->code = $row['code'];
			$this->state = $row['state']; 
			
			//get country by id
			$country_id2 = $row['country'];
			$this->country_id = $row['country'];
			$sql = $this->db->prepare("SELECT * FROM countries WHERE id='$country_id2'");
			$sql->execute();
			$country_row = $sql->fetch();
			$this->country = $country_row['name'];

			//Get State by Id
			$state_id2 = $row['state'];
			$this->state_id = $row['state'];
			$my_sql = $this->db->prepare("SELECT * FROM states WHERE id='$state_id2'");
			$my_sql->execute();
			$state_row = $my_sql->fetch();
			$this->state = $state_row['name'];
						
		}
	}
	//Getting address by email
	public function getAddressBy($email){
		$query = $this->db->prepare("SELECT * FROM address WHERE email='$email'");
		$query->execute();
		while($row = $query->fetch())
		{
			$this->addressEmail = $row['email'];
			$this->address = $row['address'];
			$this->city = $row['city'];
			$this->code = $row['code'];
			$this->state = $row['state']; 
			
			//get country by id
			$country_id2 = $row['country'];
			$this->country_id = $row['country'];
			$sql = $this->db->prepare("SELECT * FROM countries WHERE id='$country_id2'");
			$sql->execute();
			$country_row = $sql->fetch();
			$this->country = $country_row['name'];

			//Get State by Id
			$state_id2 = $row['state'];
			$this->state_id = $row['state'];
			$my_sql = $this->db->prepare("SELECT * FROM states WHERE id='$state_id2'");
			$my_sql->execute();
			$state_row = $my_sql->fetch();
			$this->state = $state_row['name'];
						
		}

	}
	//function to create payfast payment frequence
	public function paymentFrequence($months){
		if($months = "3 months"){
			return 4;
		}
		else if($months = "6 months"){
			return 5;
		}
		else if($months = "12 months"){
			return 6;
		}
	}
	//get upgrade message
	public function getUpgradeMessage(){
		return $this->upgradeMessage;
	}
	//Getting Address
	public function getAddressEmail(){
		return $this->addressEmail;
	}
	public function getAddress(){
		return $this->address;
	}
	public function getCity(){
		return $this->city;
	}
	public function getCode(){
		return $this->code;
	}
	public function getState(){
		return $this->state;
	}
	public function getStateId(){
		return $this->state_id;
	}
	public function getCountry(){
		return ucfirst($this->country);
	}
	public function getCountryId(){
		return $this->country_id;
	}
	//Company Details
	public function getCompId(){
		return $this->userId;
	}
	public function getCompName(){
		return $this->compName;
	}
	public function getCompReg(){
		return $this->compReg;
	} 
		public function getVatNumber(){
		return $this->vatNumber;
	} 
	public function getCompIndustry(){
		return $this->compIndustry;
	}
	public function getCompStatus(){
		return $this->compStatus;
	}
	public function getCompNumUsers(){
		return $this->numUsers;
	}
	public function getCompLogo(){
		return $this->compLogo;
	}
	//Get company package Id
	public function getCompPackId(){
		return $this->compPackage_id;
	}
	//Get company subscription id
	public function getCompSubscrId(){
		return $this->subscr_id;
	}
	//Get company subscription auto renewal
	public function getCompSubscrAutoRenewal(){
		return $this->auto_renewal;
	}
	//Get company subscription status
	public function getCompSubscrStatus(){
		return $this->subscr_status;
	}
	//Users
	public function getUserID(){
		return $this->userId;
	}
	public function getUserSess(){
		return $this->userSess;
	}
	public function getAddedBy(){
		return $this->addedBy;
	}
	public function getSubStartDate(){
		return $this->sub_start_date;
	}
	public function getSubEndDate(){
		return $this->sub_end_date;
	}
	public function getUserEmail(){
		return $this->userEmail;
	}
	public function getUserName(){
		return $this->userName;
	}
	public function getUserSurname(){
		return $this->userSurname;
	}
	public function getCompEmail(){
		return $this->compEmail;
	}
	public function getCompTel()
	{
		return $this->compTel;
	}
	public function getUserCell(){
		return $this->userCell;
	}
	public function getUserPos(){
		return $this->userPos;
	}
	public function getPass(){
		return $this->userPass;
	}
	public function getPP(){
		return $this->userPP;
	}

	//Package info
	public function getPackID()
	{
		return $this->package_id;
	}
	public function getPackPrice()
	{
		return $this->package_price;
	}
	public function getPackPrice2()
	{
		return $this->package_price2;
	}
	public function getPackVat()
	{
		return $this->package_vat;
	}
	public function getTotPrice()
	{
		return $this->total_price;
	}
		public function getTotPrice2()
	{
		return $this->total_price2;
	}
	public function getPackName()
	{
		return $this->package_name;
	}
	public function getPackDesc()
	{
		return $this->package_desc;
	}
	public function getPackDuration()
	{
		return $this->package_duration;
	}
	public function getPackNumCand()
	{
		return $this->package_num_users;
	}
	
	//This function checks if the subscription is free or not if free replace important info with a *
	public function getHidden($str){
		$hiddenText = "";
		$this->getSubscription();
		if($this->package_price == 0)
		{
			for($i = 0 ; $i < strlen($str);$i++){
				$hiddenText .= str_replace(substr($str,$i,1), '*', substr($str,$i,1));
			}
			return $hiddenText;
		}
		else{
			return $str;
		}

	}
}

/**
 Candidates class
 */
class Candidates
{
	private $db;
	private $id;
	private $name;
	private $surname;
	private $email;
	private $cellphone;
	private $DOB;
	private $gender;
	private $race;
	private $nationality;
	private $profilePic;
	private $sess;
	private $status;
	private $added_by;

	//Address
	private $address;
	private $addressEmail;
	private $code;
	private $city;
	private $state;
	private $state_id;
	private $country;
	private $country_id;

	//CV Data
	private $pdf_cv;
	private $experience;
	private $video_cv;
	private $bio;
	private $workMethod;

	//Current job
	private $cur_jobEmail;
	private $cur_jobID;
	private $cur_companyName;
	private $cur_jobTitle;
	private $cur_startDate;

	//Date break 
	private $year;
	private $month;
	private $day;
	function __construct($db)
	{
		$this->db = $db;
	}
	//Add candidate
	public function addCandidate($name,$surname,$email,$userCell,$dateOB,$race,$gender,$password,$status,$date_registered){
		$email = strtolower($email);
		$query = $this->db->prepare("INSERT INTO `candidate_tbl`(`c_name`, `c_surname`, `c_email`, `c_cellphone`, `c_DOB`,`race`,`gender`, `c_password`, `c_verified`, `date_registered`) VALUES ('$name','$surname','$email','$userCell','$dateOB','$race','$gender','$password','$status','$date_registered')");
	$query->execute();
	}
	public function addCandidate2($name,$surname,$email,$userCell,$dateOB,$race,$gender,$password,$status,$date_registered,$addedBy){
		$email = strtolower($email);
		$query = $this->db->prepare("INSERT INTO `candidate_tbl`(`c_name`, `c_surname`, `c_email`, `c_cellphone`, `c_DOB`,`race`,`gender`, `c_password`, `c_verified`, `date_registered`,`added_by`) VALUES ('$name','$surname','$email','$userCell','$dateOB','$race','$gender','$password','$status','$date_registered','$addedBy')");
	$query->execute();
	}
	public function addEncryPass($email,$pass){
		$enemail = md5($email);
		$query = $this->db->prepare("SELECT count(id) as num_rows from pass_encry where email='$enemail'");
		$query->execute();
		$row = $query->fetch();
		if($row['num_rows'] == 0)
		{
			$query1 = $this->db->prepare("INSERT INTO `pass_encry`(`email`, `encry`) VALUES ('$enemail','$pass')");
			$query1->execute();
		}
		else{
			$query1 = $this->db->prepare("UPDATE pass_encry SET encry='$pass' WHERE email = '$enemail' ");
            $query1->execute();
		}
	}
	//add candidate role
	public function addCandidateRole($email,$company_name,$job_title,$start_date,$end_date,$status){
		$sql = $this->db->prepare("INSERT INTO `candidate_role`(`c_email`, `company_name`, `job_title`, `starting_date`, `end_date`, `status`) VALUES ('$email', '$company_name','$job_title','$start_date','$end_date','$status')");
			$sql->execute();
	}
	//Current role description
	public function addKeyRole($email,$desc){
		$query = $this->db->prepare("INSERT INTO `key_roles`(`c_email`, `role`) VALUES (?,?)");
		$query->execute(array($email,$desc));
	}
	public function getAllCandidates(){
		$query = $this->db->prepare("select * from candidate_tbl");
		$query->execute();
		return $query;
	}
	//this function set logged in candidate data
	public function setCandidate($id)
	{
		$query = $this->db->prepare("select * from candidate_tbl where md5(c_email) = '$id'");
		$query->execute();
		while($row=$query->fetch())
		{
			$this->id = $row['c_id'];
			$this->name = $row['c_name'];
			$this->surname = $row['c_surname'];
			$this->email = $row['c_email'];
			$this->cellphone = $row['c_cellphone'];
			$this->DOB = $row['c_DOB'];
			$this->gender = $row['gender'];
			$this->race = $row['race'];
			$this->nationality = $row['c_nationality'];
			$this->profilePic = $row['profile_pic'];
			$this->status = $row['c_verified'];
			$this->sess = $row['sess_id'];	
			$this->added_by = $row['added_by'];		
		} 
	}
	//this function get data for the provided candidate and return them
	public function candidateData($id){
		$query = $this->db->prepare("select * from candidate_tbl where md5(c_email) = '$id'");
		$query->execute();
		return $query;
	}
	//Add Address
	public function addAddress($location,$city,$state,$country,$zip_code)
	{
		$compEmail = md5($this->compEmail);
		$query = $this->db->prepare("INSERT INTO `address`(`email`, `address`, `city`, `code`, `state`, `country`) VALUES ('$compEmail','$location','$city','$zip_code','$state','$country')");
		$query->execute();
	}
	public function addAddress_($email,$location,$city,$state,$country,$zip_code)
	{
		$query = $this->db->prepare("INSERT INTO `address`(`email`, `address`, `city`, `code`, `state`, `country`) VALUES ('$email','$location','$city','$zip_code','$state','$country')");
		$query->execute();
	}
	//Update candidate Address
	public function updateAddress($location,$city,$state,$country,$zip_code)
	{
		$compEmail = md5($this->compEmail);
		$query = $this->db->prepare("UPDATE `address` SET,`address`=?,`city`=?,`code`=?,`state`=?,`country`=? WHERE `email`=?");
		$query->execute(array($location,$city,$zip_code,$state,$country,$compEmail));
	}
	public function countAddress()
	{
		$email = md5($this->email);
		$query = $this->db->prepare("SELECT count(email) AS num_rows FROM `address` WHERE email='$email'");
		$query->execute();
		$row=$query->fetch();
		return $row['num_rows'];
	}
	//Check company address exist
	public function countCompAddress()
	{
		$email = md5($this->compEmail);
		$query = $this->db->prepare("SELECT count(c_email) AS num_rows FROM `email` WHERE email='$email'");
		$query->execute();
		$row=$query->fetch();
		return $row['num_rows'];
	}
	public function address(){
		$email = md5($this->email);
		$query = $this->db->prepare("SELECT * FROM address WHERE email='$email'");
		$query->execute();
		while($row = $query->fetch())
		{
			$this->addressEmail = $row['email'];
			$this->address = $row['address'];
			$this->city = $row['city'];
			$this->code = $row['code'];
			$this->state = $row['state']; 
			
			//get country by id
			$country_id2 = $row['country'];
			$this->country_id = $row['country'];
			$sql = $this->db->prepare("SELECT * FROM countries WHERE id='$country_id2'");
			$sql->execute();
			$country_row = $sql->fetch();
			$this->country = $country_row['name'];

			//Get State by Id
			$state_id2 = $row['state'];
			$this->state_id = $row['state'];
			$my_sql = $this->db->prepare("SELECT * FROM states WHERE id='$state_id2'");
			$my_sql->execute();
			$state_row = $my_sql->fetch();
			$this->state = $state_row['name'];
						
		}
	}
	//Getting all the countries
	public function getCountries(){
		$query = $this->db->prepare("SELECT * FROM countries");
		$query->execute();
		return $query;
	}
	//Getting all the states
	public function getStates(){
		$query = $this->db->prepare("SELECT * FROM states");
		$query->execute();
		return $query;
	}
	public function countQualifications()
	{
	$email = md5($this->email);
		$query = $this->db->prepare("SELECT count(c_email) AS num_rows FROM qualifications WHERE c_email='$email'");
		$query->execute();
		$row=$query->fetch();
		return $row['num_rows'];
	}
	public function addQualification($instiName,$qualificationName,$dateCompleted){
		$email = md5($this->email);
		$query = $this->db->prepare("INSERT INTO `qualifications`(`c_email`, `q_name`,`qw_date_completed`, `institution_name`) VALUES ('$email','$qualificationName','$dateCompleted','$instiName')");
		$query->execute();
	}
	//add qualification for multiple can 
	public function addMultQualifications($email,$instiName,$qualificationName,$dateCompleted,$fieldOfStudy){
		$query = $this->db->prepare("INSERT INTO `qualifications`(`c_email`, `q_name`,`qw_date_completed`, `institution_name`,`field_of_study`) VALUES (?,?,?,?,?)");
		$query->execute(array($email,$qualificationName,$dateCompleted,$instiName,$fieldOfStudy));
	}
		public function updateQualification($instiName,$qualificationName,$dateCompleted,$id){
		$email = md5($this->email);
		$query = $this->db->prepare("UPDATE `qualifications` SET `q_name` = '$qualificationName',`qw_date_completed`= '$dateCompleted', `institution_name`= '$instiName' WHERE q_id = '$id'");
		$query->execute();
	}

	public function getQualifications(){
		$email = md5($this->email);
		$query=$this->db->prepare("SELECT * from qualifications WHERE c_email = '$email'");
		$query->execute();
		return $query;
	}
	//Add work experience
	public function addExperience($c_name, $job_title, $start_date,$end_date,$status){
		$email = md5($this->email);
		$sql = $this->db->prepare("SELECT count(c_email) AS num_rows FROM candidate_role WHERE status='$status' and c_email='$email'");
		$sql->execute();
		$sql_row = $sql->fetch();
		if($sql_row['num_rows'] > 0){ 
			$query = $this->db->prepare("UPDATE `candidate_role` SET `company_name`='$c_name',`job_title`='$job_title',`starting_date`='$start_date',`end_date`='$end_date' WHERE c_email='$email' and status = '$status'");
			$query->execute();
		}
		else{
		$query = $this->db->prepare("INSERT INTO `candidate_role`(`c_email`, `company_name`, `job_title`, `starting_date`, `end_date`,`status`) VALUES ('$email','$c_name','$job_title','$start_date', '$end_date','$status')");
		$query->execute();
		}
	}
	//Add work experience duplicate
	public function addExperience1($c_name, $job_title, $start_date,$end_date,$status){
		$email = md5($this->email);
		$sql = $this->db->prepare("SELECT count(c_email) AS num_rows FROM candidate_role WHERE status='$status' and c_email='$email'");
		$sql->execute();
		$sql_row = $sql->fetch();	
		$query = $this->db->prepare("INSERT INTO `candidate_role`(`c_email`, `company_name`, `job_title`, `starting_date`, `end_date`,`status`) VALUES ('$email','$c_name','$job_title','$start_date', '$end_date','$status')");
		$query->execute();
		
	}
		public function updateExperience($c_name, $job_title, $start_date,$end_date,$id){
		$email = md5($this->email);
		
			$query = $this->db->prepare("UPDATE `candidate_role` SET `company_name`='$c_name',`job_title`='$job_title',`starting_date`='$start_date',`end_date`='$end_date' WHERE id = '$id'");
			$query->execute();
		
	}

	//Get Work experiences
	public function getExperiences(){
		$email = md5($this->email);
		$query=$this->db->prepare("SELECT * FROM candidate_role WHERE c_email='$email' and status ='post'");
		$query->execute();
		return $query;
	}
	public function countPreviousJobs()
	{
	$email = md5($this->email);
		$query = $this->db->prepare("SELECT count(c_email) AS num_rows1 FROM candidate_role WHERE c_email='$email' and status ='post'");
		$query->execute();
		$row=$query->fetch();
		return $row['num_rows1'];
	}
	//Get Current Job
		public function countCurrentJob()
	{
	$email = md5($this->email);
		$query = $this->db->prepare("SELECT count(c_email) AS num_rows FROM candidate_role WHERE c_email='$email'");
		$query->execute();
		$row=$query->fetch();
		return $row['num_rows'];
	}
	public function getCurrentJob(){
		$email = md5($this->email);
		$query=$this->db->prepare("SELECT * FROM candidate_role WHERE c_email='$email' and status='current'");
		$query->execute();
		$row = $query->fetch();
		$this->cur_jobID = $row['id'];
		$this->cur_jobEmail = $row['c_email'];       
		$this->cur_companyName = $row['company_name'];
		$this->cur_jobTitle =$row['job_title'];
		$this->cur_startDate = $row['starting_date'];
	}

	//Count Key courses
		public function countKeyCourses()
	{
	$email = md5($this->email);
		$query = $this->db->prepare("SELECT count(c_email) AS num_rows FROM key_courses WHERE c_email='$email'");
		$query->execute();
		$row=$query->fetch();
		return $row['num_rows'];
	}
	//Add key courses
	public function addKeyCourses($course){
		$email = md5($this->email);
		$query = $this->db->prepare("INSERT INTO `key_courses`(`c_email`, `key_course`) VALUES ('$email','$course')");
		$query->execute();
	}
	public function updateKeyCourses($course,$id){
		$email = md5($this->email);
		$query = $this->db->prepare("UPDATE `key_courses`SET key_course='$course' WHERE id='$id'");
		$query->execute();
	}
	public function getKeyCourses(){
		$email = md5($this->email);
		$query = $this->db->prepare("SELECT * FROM `key_courses` WHERE c_email='$email'");
		$query->execute();
		return $query;
	}
//count key skills
	public function countKeySkills()
	{
	$email = md5($this->email);
		$query = $this->db->prepare("SELECT count(c_email) AS num_rows FROM key_skills WHERE c_email='$email'");
		$query->execute();
		$row=$query->fetch();
		return $row['num_rows'];
	}
//Add key skills
	public function addKeySkills($skill){
		$email = md5($this->email);
		$query = $this->db->prepare("INSERT INTO `key_skills`(`c_email`, `skill`) VALUES ('$email','$skill')");
		$query->execute();
	}
	//Add skills for multiple candidates
	public function addSkills($email,$skill)
	{
		$query = $this->db->prepare("INSERT INTO `key_skills`(`c_email`, `skill`) VALUES (?,?)");
		$query->execute(array($email,$skill));
	}
		public function updateKeySkills($skill,$id){
		$email = md5($this->email); 
		$query = $this->db->prepare("UPDATE `key_skills`SET skill='$skill' WHERE id='$id'");
		$query->execute();
	}
	public function getKeySkills(){
		$email = md5($this->email);
		$query = $this->db->prepare("SELECT * FROM `key_skills` WHERE c_email='$email'");
		$query->execute();
		return $query;
	}
	public function _getKeySkills($job){
		$sql = $this->db->prepare("SELECT  distinct a.skill as skill,b.job_title FROM key_skills a,candidate_role b where a.c_email = b.c_email and b.job_title = '$job'");
		$sql->execute();
		return $sql;
	}
	public function getCombinedSkills($email){
		$skills ="";
		$sql = $this->db->prepare("SELECT distinct skill FROM key_skills where c_email = '$email'");
		$sql->execute();
		for ($i=0; $rows=$sql->fetch() ; $i++) { 
			$skills = strtolower($skills.$rows['skill']).' ,';
		}
		return substr($skills,0,-1);
	}
	//Creating a string of key roles
		public function getCombinedRoles($email){
		$roles ="";
		$sql = $this->db->prepare("SELECT distinct role FROM key_roles where c_email = '$email'");
		$sql->execute();
		for ($i=0; $rows=$sql->fetch() ; $i++) { 
			$roles = strtolower($roles.$rows['role']).' ,';
		}
		return substr($roles,0,-1);
	}
	//Creating a string of key roles
		public function getCombinedCourses($email){
		$courses ="";
		$sql = $this->db->prepare("SELECT distinct key_course FROM key_courses where c_email = '$email'");
		$sql->execute();
		for ($i=0; $rows=$sql->fetch() ; $i++) { 
			$courses = strtolower($courses.$rows['key_course']).' ,';
		}
		return substr($courses,0,-1);
	}
	//Creating a string of companies candidate have worked for
		public function getCombinedExperience($email){
		$experience ="";
		$sql = $this->db->prepare("SELECT distinct company_name,job_title FROM candidate_role where c_email = '$email'");
		$sql->execute();
		for ($i=0; $rows=$sql->fetch() ; $i++) { 
			$experience = strtolower($experience.$rows['company_name'].' ,'.$rows['job_title']).' ,';
		}
		return substr($experience,0,-1);
	}
	//Creating a string of qualification
		public function getCombinedQualification($email){
		$qualification ="";
		$sql = $this->db->prepare("SELECT distinct q_name,institution_name FROM qualifications where c_email = '$email'");
		$sql->execute();
		for ($i=0; $rows=$sql->fetch() ; $i++) { 
			$qualification = strtolower($qualification.$rows['q_name'].' ,'.$rows['institution_name']).' ,';
		}
		return substr($qualification,0,-1);
	}
	//Creating a string of location
		public function getCombinedLocation($email){
		$location ="";
		$sql = $this->db->prepare("SELECT a.address as address, s.name as state_name, c.name as country_name FROM address a, states s, countries c  where email = '$email' and a.state = s.id and a.country =  c.id");
		$sql->execute();
		for ($i=0; $rows=$sql->fetch() ; $i++) { 
			$location = strtolower($location.$rows['address'].' ,'.$rows['state_name'].' ,'.$rows['country_name']).' ,';
		}
		return substr($location,0,-1);
	}
	//Combined names
	public function getCombinedNames($email){
		$names ="";
		$sql = $this->db->prepare("SELECT c_name, c_surname FROM candidate_tbl WHERE md5(c_email) = '$email'");
		$sql->execute();
		for ($i=0; $rows=$sql->fetch() ; $i++) { 
			$names = strtolower($names.$rows['c_name'].' ,'.$rows['c_surname']).' ,';
		}
		return substr($names,0,-1);
	}
	public function getCombinedNames_($email){
		$names ="";
		$sql = $this->db->prepare("SELECT c_name, c_surname FROM candidate_tbl WHERE md5(c_email) = '$email'");
		$sql->execute();
		for ($i=0; $rows=$sql->fetch() ; $i++) { 
			$names = strtolower($names.$rows['c_name'].' '.$rows['c_surname']).' ,';
			$names = trim(preg_replace('/[\t\n\r\s]+/', ' ', $names));
		}
		return substr($names,0,-1);
	}
	public function getCombinedNames__($email){
		$names ="";
		$sql = $this->db->prepare("SELECT c_name, c_surname FROM candidate_tbl WHERE md5(c_email) = '$email'");
		$sql->execute();
		for ($i=0; $rows=$sql->fetch() ; $i++) { 
			$names = strtolower($rows['c_surname'].' '.$names.$rows['c_name']).' ,';
			$names = trim(preg_replace('/[\t\n\r\s]+/', ' ', $names));
		}
		return substr($names,0,-1);
	}
	//Combined CV
	public function getCombinedCV($email){
		$workMethod ="";
		$sql = $this->db->prepare("SELECT * FROM curriculum_vitae WHERE c_email ='$email'");
		$sql->execute();
		for ($i=0; $rows=$sql->fetch() ; $i++) { 
			$workMethod = strtolower($workMethod.$rows['work_method']).' ,';
		}
		return substr($workMethod,0,-1);
	}
	//count key roles
	public function countKeyRoles()
	{
	$email = md5($this->email);
		$query = $this->db->prepare("SELECT count(c_email) AS num_rows FROM key_roles WHERE c_email='$email'");
		$query->execute();
		$row=$query->fetch();
		return $row['num_rows'];
	}
	//Add role
	public function addRole($role){
		$email = md5($this->email);
		$check_query = $this->db->prepare("SELECT * FROM `key_roles` WHERE c_email='$email'");
		$check_query->execute();
		$check_row = $check_query->fetch();
		if($check_row['role'] != $role)
		{
			$query = $this->db->prepare("INSERT INTO `key_roles`(`c_email`, `role`) VALUES ('$email','$role')");
			$query->execute();
		}
	}
	public function addRoles($email,$role){
		
		$check_query = $this->db->prepare("SELECT * FROM `key_roles` WHERE c_email='$email'");
		$check_query->execute();
		$check_row = $check_query->fetch();
		if($check_row['role'] != $role)
		{
			$query = $this->db->prepare("INSERT INTO `key_roles`(`c_email`, `role`) VALUES ('$email','$role')");
			$query->execute();
		}
	}
	public function UpdateKeyRole($role,$id){
		$email = md5($this->email);
		$query = $this->db->prepare("UPDATE `key_roles`SET role='$role' WHERE id='$id'");
		$query->execute();
	}

	public function getRole(){
		$email = md5($this->email);
		$query = $this->db->prepare("SELECT * FROM `key_roles` WHERE c_email='$email'");
		$query->execute();
		return $query;
	}
	public function countRoles()
	{
	$email = md5($this->email);
		$query = $this->db->prepare("SELECT count(c_email) AS num_rows FROM `key_roles` WHERE c_email='$email'");
		$query->execute();
		$row=$query->fetch();
		return $row['num_rows'];
	}
		//Add Bio
	public function addBio($bio){
		$email = md5($this->email);
		$query = $this->db->prepare("SELECT count(c_email) AS num_rows, bio FROM curriculum_vitae WHERE c_email = '$email'");
		$query->execute();
		$rw = $query->fetch();
		if($rw['num_rows'] > 0){
			$sql = $this->db->prepare("UPDATE `curriculum_vitae` SET `bio`='$bio' WHERE c_email = '$email'");
			$sql->execute();
		}
		else{
			$sql = $this->db->prepare("INSERT INTO `curriculum_vitae`(`c_email`, `bio`) VALUES ('$email','$bio')");
			$sql->execute();
		}
	}
	//Add Or Update CV
	public function addCv($cv){
		$email = md5($this->email);
		$query = $this->db->prepare("SELECT count(c_email) AS num_rows FROM curriculum_vitae WHERE c_email = '$email'");
		$query->execute();
		$rw = $query->fetch();
		if($rw['num_rows'] > 0){
			
			
		}
		else{
			$sql = $this->db->prepare("INSERT INTO `curriculum_vitae`(`c_email`, `bio`, `cv_file`) VALUES ('$email','','$cv')");
			$sql->execute();
		}
	}
	public function addCVData($email,$experience,$cv){
		$sql = $this->db->prepare("INSERT INTO `curriculum_vitae`(`c_email`, `bio`, `years_experience`,`cv_file`) VALUES ('$email','','$experience','$cv')");
			$sql->execute();
	}
	
	public function getCvData()
	{
		$email = md5($this->email);
		$query = $this->db->prepare("SELECT * FROM `curriculum_vitae` WHERE c_email = ?");
		$query->execute(array($email));
		for($i = 0;$row = $query->fetch();$i++)
		{
		$this->bio = $row['bio'];
		$this->experience = $row['years_experience'];
		$this->pdf_cv = $row['cv_file'];
		$this->video_cv = $row['video_cv'];
		$this->workMethod = $row['work_method'];
		}
	}
	//Search for talent
	/*public function searchTalent($search_val, $location){

		$query=$this->db->prepare("SELECT id, c_email, company_name, job_title, starting_date, end_date, status FROM candidate_role WHERE job_title LIKE '%$search_val%' OR md5(c_email) IN (SELECT email FROM address WHERE country = '$location')");
		$query->execute();
		return $query;
	}*/
		public function searchTalent($search_val, $location){
			if(str_contains($search_val,'-')){
				$job_title = substr($search_val,0,strpos($search_val,'-'));
			}
			else{
				$job_title = $search_val;
			}			
		$query=$this->db->prepare("SELECT id, c_email, company_name, job_title, starting_date, end_date, status FROM candidate_role WHERE job_title LIKE '%$job_title%' /*OR md5(c_email) IN (SELECT email FROM address WHERE country = '$location')*/");
		$query->execute();
		return $query;
	}
	public function globalSearch($search_val, $data){
		$count = 0;
		$array2 = explode(',',$search_val);
			foreach( $array2 as $value2)
			{
				if(str_contains($data,strtolower($value2))) 
				{
					//secho $value.' '.$value2."<br>";
					$count = $count+1;
					//echo $count."<br>";
				}
			}
		if(sizeof($array2) == $count)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/*public function searchByName(){
		$query = $this->db->prepare("SELECT * from candidate_tbl WHERE c_name")
	}*/
	public function searchTalentBySkills($search,$skills){
		$count = 0;
		$array = explode(',',substr($search,strpos($search,'-')+1));
		foreach( $array as $value)
		{
			if(str_contains($skills, strtolower($value))) 
			{
				$count = $count+1;
			}
		}
		if(sizeof($array) == $count)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function checkProfileCompletion(){
		$percent = 0;
		if(!empty($this->getPP())){
			$percent += 10;
		}
		if(!empty($this->getPdfCV())){
			$percent += 20;
		}
		if(!empty($this->getVideoCV())){
			$percent += 20;
		}
		if(!empty($this->getYearsExperience())){
			$percent += 10;
		}
		if(!empty($this->getBio())){
			$percent += 10;
		}
		if($this->countKeySkills() > 0){
			$percent += 10;
		}
		if($this->countKeyRoles() > 0){
			$percent += 10;
		}
		if($this->countQualifications() > 0){
			$percent += 10;
		}
	

		return $percent;
	}
	public function getJobTitle(){
		$sql = $this->db->prepare("SELECT distinct job_title,c_email FROM candidate_role");
		$sql->execute();
		return $sql;
	}
	public function setDate(){
		$date = $this->getCandDOB();
		$this->year = substr($date,0,4);
		$this->month = substr($date, 5,2);
		$this->day = substr($date,8,2);
	}
  //converting num month to fULL MONTH
  public function month(){
  	$month = $this->month;
  	$month = DateTime::createFromFormat('!m', $month);
		return $month->format('F');
  }
  //Check if work type exist
  public function setWorkType($methods,$wt){
  	$checked = "checked";
		if(str_contains($methods,$wt))
		{
			return $checked;
		} 
		else{
			return '';
		}  	
  }

  //Get date data
  public function getYear(){
  	return $this->year;
  }
  public function getMonth(){
  	return $this->month;
  }
  public function getDay(){
  	return $this->day;
  }

	public function getBio(){		
		return $this->bio; 
	}
	public function getYearsExperience(){
		return $this->experience;
	}
	public function getPdfCV(){
		return $this->pdf_cv;
	}
	public function getVideoCV(){
		return $this->video_cv;
	}
	public function getWorkMethods(){
		return $this->workMethod;
	}
	//Return candidate data
	public function getCandID(){
	return $this->id;
	}
	public function getCandEmailByID($id){
	
		$query = $this->db->prepare("select * from candidate_tbl where c_id = '$id'");
		$email = "";
		$query->execute();
		while($row=$query->fetch())
		{
			$email = $row['c_email'];			
		} 		
	return $email;
	}
	//Check if candidate has accepted or declined offer
	public function checkOfferStatus($status){
		$message = "";
		if($status==md5("accepted")){
		 $message= "Accepted the offer";
		}
		 else if($status ==md5("declined"))
		{
       $message = "declined the offer"; 
     }
     return $message;
		}
	public function getCandName(){
		return ucfirst($this->name);
	}
	public function getCandSurname(){
		return ucfirst($this->surname);
	}
	public function getCandEmail(){
		return strtolower($this->email);
	}
	public function getCandCell(){
		return $this->cellphone;
	}
	public function getCandDOB(){
		return $this->DOB;
	}
	public function getNationality(){
		return $this->nationality;
	}
	public function getGender(){
		return $this->gender;
	}
	public function getRace(){
		return $this->race;
	}
	public function getPP(){
		return $this->profilePic;
	}
	//Getting Address
	public function getAddressEmail(){
		return $this->addressEmail;
	}
	public function getAddress(){
		return $this->address;
	}
	public function getCity(){
		return $this->city;
	}
	public function getCode(){
		return $this->code;
	}
	public function getState(){
		return $this->state;
	}
	public function getStateId(){
		return $this->state_id;
	}
	public function getCountry(){
		return ucfirst($this->country);
	}
	public function getCountryId(){
		return $this->country_id;
	}
	public function getStatus(){
		return $this->status;
	}
	public function getSession(){
		return $this->sess;
	}
	//Get current job
	public function getCurJobID(){
		return $this->cur_jobID;
	}
	public function getCurJobEmail(){
		return $this->cur_jobEmail;
	}
	public function getCurCompName(){
		return $this->cur_companyName;
	}
	public function getCurJobTitle(){
		return $this->cur_jobTitle;
	}
	public function getCurStartDate(){
		return $this->cur_startDate;
	}
	public function getAddedBy(){
		return $this->added_by;
	} 
}