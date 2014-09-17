<?php
	
	APP::uses('AppController','Controller');
	App::uses('ExcelProcessor','Lib');
	App::import('Vendor', 'Classes/PHPExcel.php');
	App::import('Vendor','PHPExcel_IOFactory',array('file' => 'Classes/PHPExcel/IOFactory.php'));
	App::import('Vendor','PHPExcelReader',array('file' => 'Classes/PHPExcel/Reader/Excel2007.php'));
    App::import('Vendor','PHPExcelWriter',array('file' => 'Classes/PHPExcel/Writer/Excel2007.php'));
	class TeamleadersController extends AppController{

		public $uses = array(
	        "Role" ,
	        "User",
	        "Superadmin",
	        "Manager",
	        "Teamleader",
	        "Telecaller"
	    );
	    
	    public $paginate = array(
	        'limit' => 25,
	        'conditions' => array('status' => '1'),
	        'order' => array('User.username' => 'asc')
	    );

	    public function beforeFilter() {
	        parent::beforeFilter();
	    }

	    public function isAuthorized($user){
			if ( $user['role'] === 'TeamLeader'){
				if( $this->action === 'index' || $this->action === 'add' || $this->action === 'edit' || $this->action === 'delete'  || $this->action === 'upload_excel'){
					return true;
				}
			}else{
				return false;
			}
		}

	    
	    public function index() {
	        $this->paginate = array(
	            'limit' => 20,
	            'conditions' => array('User.role' => 'TeamLeader'),
	            'order' => array('User.username' => 'asc')
	        );
	        $users = $this->paginate('User');
	        $this->set(compact('users'));
	    }

	    public function add() {
        	$user = $this->Auth->user();
        	// $this->preprint($user);
	        if ($this->request->is('post')) {
	        	$this->request->data['User']['created_by'] = $user['id'];
	        	// echo"<pre>";print_r($this->request->data);exit;
	            $this->User->create();
	            if ($this->User->save($this->request->data)) {
	            	$teamleader['manager_id'] = $this->request->data['User']['manager_id'] ; 
	            	$teamleader['active'] = $this->request->data['User']['active'] ; 
	            	$this->Teamleader->save($teamleader);
            		$this->Session->setFlash(__('The user has been created'));
                	$this->redirect(array('action' => 'index'));	
	            	
	            } else {
	                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
	            }
	        }else{
	        	if($user['role'] == 'SuperAdmin'){
		        	$managers = $this->Manager->find('all');
		        	// print_r($managers);exit;
		        	$this->set(compact('managers'));
	        	}else{
		        	$this->set(compact('user'));
		        }
	        }

	    }

	    public function edit($id = null) {
			if (!$id) {
	            $this->Session->setFlash('Please provide a user id');
	            $this->redirect(array('action' => 'index'));
	        }

	        $user = $this->User->findById($id);
	        if (!$user) {
	            $this->Session->setFlash('Invalid User ID Provided');
	            $this->redirect(array('action' => 'index'));
	        }

	        if ($this->request->is('post') || $this->request->is('put')) {
	            $this->User->id = $id;
	        // echo"<pre>";print_r($this->request->data);exit;
	            if ($this->User->save($this->request->data)) {
	                $this->Session->setFlash(__('The user has been updated'));
	                $this->redirect(array('action' => 'index'));
	            } else {
	                $this->Session->setFlash(__('Unable to update your user.'));
	            }
	        }
	        if (!$this->request->data) {
	            $this->request->data = $user;
	        }
	    }

	    public function delete($id = null) {

	        if (!$id) {
	            $this->Session->setFlash('Please provide a user id');
	            $this->redirect(array('action' => 'index'));
	        }

	        $this->User->id = $id;
	        if (!$this->User->exists()) {
	            $this->Session->setFlash('Invalid user id provided');
	            $this->redirect(array('action' => 'index'));
	        }
	        if ($this->User->saveField('status', 0)) {
	            $this->Session->setFlash(__('User deleted'));
	            $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('User was not deleted'));
	        $this->redirect(array('action' => 'index'));
	    }

	    public function activate($id = null) {
	        if (!$id) {
	            $this->Session->setFlash('Please provide a user id');
	            $this->redirect(array('action' => 'index'));
	        }

	        $this->User->id = $id;
	        if (!$this->User->exists()) {
	            $this->Session->setFlash('Invalid user id provided');
	            $this->redirect(array('action' => 'index'));
	        }
	        if ($this->User->saveField('status', 1)) {
	            $this->Session->setFlash(__('User re-activated'));
	            $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('User was not re-activated'));
	        $this->redirect(array('action' => 'index'));
	    }

	    public function upload_master_allocation(){
	    	if($this->request->is('post')){
	    		$excel_data["file_name"] = $this->request->data['Teamleader']['xlsx_file']['name'];
                $excel_data["file_path"] = $this->request->data['Teamleader']['xlsx_file']['tmp_name'];
                $excel_data["teamleader_id"] = $this->Auth->user("id");
                $excel_data["sheet_names"] = array("Master_allocation");

                $excel_data["sheet_columns"] = array("Master_allocation" => array(
                   
                    "A" => "Circle",
                    "B" => "Acct_Ext_Id",
                    "C" => "Mobile_Number",
                    "D" => "Total_DelCount",
                    "E" => "Colln_Manager",
                    "F" => "Service_Manager",
                    "G" => "Service_Cambist_RM",
                    "H" => "Collection_Cambist_RM",
                    "I" => "VAM",
                    "J" => "VAM_TL",
                    "K" => "KAM",
                    "L" => "KAM_TL",
                    "M" => "TC",
                    "N" => "Company_Name",
                    "O" => "Bill_Name",
                    "P" => "DepositAmt",
                    "Q" => "Days_0_30",
                    "R" => "Days_30_60",
                    "S" => "Days_60_90",
                    "T" => "Days_90_120",
                    "U" => "Days_120_150",
                    "V" => "Days_150_180",
                    "W" => "Days_180_Above",
                    "X" => "Balance",
                    "Y" => "PAID",
                    "Z" => "BNC",
                    "AA" => "Total_Due",
                    "AB" => "Invalid_BNC_Data",
                    "AC" => "Age_Bkt",
                    "AD" => "Balance_BD",
                   	"AE" => "Collection_Paid_BD",
                   	"AF" => "Total_BD",
                    "AG" => "Balance_60",
                    "AH" => "Collection_Paid_60",
                    "AI" => "60Flow",
                    "AJ" => "Bill_Period",
                    "AK" => "Value_Type",
                    "AL" => "VIP_Flag",
                    "AM" => "Account_Status",
                    "AN" => "Product_Type",
                    "AO" => "Voice_Status",
                    "AP" => "Service_Line",
                    "AQ" => "Dsl_Status",
                    "AR" => "Credit_Limit",
                    "AS" => "RatePlan",
                    "AT" => "Aon",
                    "AU" => "Account_Active_Date",
                    "AV" => "Address",
                    "AW" => "Bill_Zip",
                    "AX" => "Area",
                    "AY" => "Cust_Address",
                    "AZ" => "Cust_Phone1",
                    "BA" => "Contact1_Phone",
                    "BB" => "Phone_no",
                    "BC" => "Last_invoice_No",
                    "BD" => "Name",
                    "BE" => "Number",
                    "BF" => "Email_ID",
                    "BG" => "CP_INDV",
                    "BH" => "Category",
                    "BI" => "Base",
                    "BJ" => "Original_Total_Due",
                    "BK" => "Suspense_Amount",

                  )
                  
                );

				$excel = new ExcelProcessor($excel_data);
				$excel_error = true;

				if($excel->is_file_format_correct()){
					$excel->add_data();
					$excel_error = false;
				}

	            if($excel_error){
	            	$this->Session->setFlash('Something went while uploading ! Please try again !!','', array() , 'error');
	            }
	            else{
	                $this->Session->setFlash('Excel file data uploaded successfully.' , '' , array() , 'success');
	                $this->redirect(array('action' => 'upload_master_allocation'));
	            }
	          

	    	}else{
	    		$this->set(array('upload_master_allocation' => 'Upload Master Allocation Excel'));
	    	}
	    }

	    public function upload_open_invoice(){
	    	$this->set(array('upload_open_invoice' => 'Upload Open Invoice Excel'));
	    }

		public function upload_ao(){
			$this->set(array('upload_ao' => 'Upload A&O Excel'));
	    }

	    public function upload_bd(){
	    	$this->set(array('upload_bd' => 'Upload BD Excel'));
	    }	    
	}
?>

