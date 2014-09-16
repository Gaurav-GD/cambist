<?php
	App::import( 'Vendor' , 'Classes/PHPExcel.php');
	App::import( 'Model' , 'User' , array( 'file' => 'Model/User.php'));
	App::import( 'Model' , 'Superadmin' , array( 'file' => 'Model/Superadmin'));
	App::import( 'Model' , 'Manager' , array( 'file' => 'Model/Manager' ));

	class ExcelProcessor{

		protected $file_name;
		protected $file_path;
		protected $sheets;
		protected $sheet_names;
		protected $sheet_columns;
	    protected $sheet_errors = array();
	    protected $all_sheet_highest_columns = array();
	    protected $teamleader_id;
	    protected $user_data;
	    protected $reader;
	    protected $xls;


	    public function __construct($args){
	      $this->sheet_names = $args["sheet_names"];
	      $this->file_path = $args["file_path"];
	      $this->file_name = $args["file_name"];
	      $this->sheet_columns = $args["sheet_columns"];
	      $this->teamleader_id = $args["teamleader_id"];
	    }

	    public function is_file_format_correct(){
	      $file_name = $this->file_name;
	      $file_ext_arr = explode('.',$file_name);
	      $file_extension = $file_ext_arr[count($file_ext_arr)-1];
	      $file_extension_ok = ($file_extension === 'xlsx' /*|| $file_extension === 'xls' || $file_extension === 'ods' */ );
	      if(!$file_extension_ok){
	        $this->sheet_errors[] = "File format incorrect. It should be xlsx format";
	      }else{
	        $this->reader = new PHPExcel_Reader_Excel2007();
	        $this->xls = $this->reader->load("{$this->file_path}");
	        // echo"<pre>";print_r($this->xls);exit;
	      }
	      return $file_extension_ok;
	    }

	    public function all_sheets_present(){
	    	$all_sheets_present = true;
			foreach($this->sheet_names as $sheet_name){
				$sheet = $this->xls->getSheetByName($sheet_name);
				// echo"here";
				// print_r($sheet_name);exit;

				if($sheet){
				  $this->$sheet_name = $sheet;
				}
				else{
				  $all_sheets_present = false;
				  $this->sheet_errors[] = "$sheet_name Sheet not found!";
				}
			}
			return $all_sheets_present;
	    }

		public function all_sheets_columns_present(){
			$all_sheet_column_present = true;
			foreach($this->sheet_names as $sheet_name){
				$all_sheet_column_present = $all_sheet_column_present && $this->all_columns_present($sheet_name);
			}
			return $all_sheet_column_present;
		}

		public function add_data(){
			try{
				$inputFileType = PHPExcel_IOFactory::identify($this->file_path);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($this->file_path);
			}catch(Exception $e){
				die('Error loading file "' . pathinfo($this->file_path, PATHINFO_BASENAME) . '" : ' .$e->getMessage());
			}

			$sheet = $objPHPExcel->getSheet(0); 
			$highestRow = $sheet->getHighestDataRow(); 
			$highestColumn = $sheet->getHighestDataColumn();
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			
			for ($row = 2; $row <= $highestRow; $row++){ 
				for($col = 0 ; $col < $highestColumnIndex ; $col++){
					$value = $sheet->getCellByColumnAndRow($col,$row)->getValue();
					$data[$row-1][$col] = $value;
																	
				}
			echo"<pre>";print_r($insert_query);exit;

			}



			// echo"<pre>";print_r($data);exit;
		}
//test
	}

	// INSERT INTO mytable(Circle,Acct_Ext_Id,Mobile_Number,Total_DelCount,Colln_Manager,Service_Manager,Service_Cambist_RM,Collection_Cambist_RM,VAM,VAM_TL,KAM,KAM_TL,TC,Company_Name,Bill_Name,DepositAmt,Days_0_30,Days_30_60,Days_60_90,Days_90_120,Days_120_150,Days_150_180,Days_180_Above,Balance,PAID,BNC,Total_Due,Invalid_BNC_Data,Age_Bkt,Balance_BD,Collection_Paid_BD,Total_BD,Balance_60,Collection_Paid_60,60Flow,Bill_Period,Value_Type,VIP_Flag,Account_Status,Product_Type,Voice_Status,Service_Line,Dsl_Status,Credit_Limit,RatePlan,Aon,Account_Active_Date,Address,Bill_Zip,Area,Cust_Address,Cust_Phone1,Contact1_Phone,Phone_no,Last_invoice_No,Name,Number,Email_ID,CP_INDV,Category,Base,Original_Total_Due,Suspense_Amount) VALUES ('Mumbai','12418396','Multiple',301,'Cambist agency','0','0','Atish Renose','0','0','0','0','Asmita','Pyramid Consulting Pvt Ltd','',0,11247.23,11398.92,11287.69,158793.42,0,0,0.03,170233.29,22494,NULL,192727.29,'','90+',136106.43,22687.02,158793.45,136106.4,22687.02,158793.42,'W1A','Platinum','Normal','Active','ISDN PRA','Active','PRI','NO_DSL','0','0',91,'15/11/2006','Flat/Plotno ,Floor4,Hamilton Wing A Hiranandani Estate G B Road Patilpada Estate Thane W 400607',400607,'Sandoz Baug','Flat/Plotno ,Floor4,Hamilton Wing A','9833753536',NULL,'',441540052,'','','','CP','AES','TM',192727.29,-22687.02);















?>