<?php
	App::import( 'Vendor' , 'Classes/PHPExcel.php' );

	App::import( 'Model' , 'User' , array( 'file' => 'Model/User.php' ));
	App::import( 'Model' , 'Superadmin' , array( 'file' => 'Model/Superadmin' ));
	App::import( 'Model' , 'Manager' , array( 'file' => 'Model/Manager' ));
	App::import( 'Model' , 'Allocationmasters' , array( 'file' => 'Model/Allocationmasters' ));

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

	    protected $allocationmasters ;
	    protected $users;
	    // $test = ClassRegistry::init('User');

	    public function __construct($args){
	      $this->sheet_names = $args["sheet_names"];
	      $this->file_path = $args["file_path"];
	      $this->file_name = $args["file_name"];
	      $this->sheet_columns = $args["sheet_columns"];
	      $this->teamleader_id = $args["teamleader_id"];

	      $this->users = ClassRegistry::init('User');
	      $this->allocationmasters = ClassRegistry::init('Allocationmasters');
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
			$keys = array();
			for ($row = 1; $row <= $highestRow; $row++){ 
				for($col = 0 ; $col < $highestColumnIndex ; $col++){
					if($row == 1){
						$value = $sheet->getCellByColumnAndRow($col,$row)->getValue();
						$keys[$col] = $value;
					}else{
						$value = $sheet->getCellByColumnAndRow($col,$row)->getValue();
						$data['Allocationmasters'][$keys[$col]] = $value;	
					}
				}
				if($row > 1){
					$this->allocationmasters->save($data);
					// echo"<pre>";print_r($data);
				}
			}
			exit;
			// $test = ClassRegistry::init('Allocationmasters');
			// $test_ar = $this->users->find('all');
			// echo"<pre>";print_r($keys);
			// echo"<pre>";print_r($data);exit;

		}
	} 


?>