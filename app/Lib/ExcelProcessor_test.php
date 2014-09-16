<?php
  ini_set('memory_limit','100000M');
  ini_set('max_execution_time',30000);
  App::import('Vendor', 'Classes/PHPExcel.php');
  App::import('Model','User', array("file" => "Plugin/V2/Model/User.php"));
  App::import('Model','Employee', array("file" => "Plugin/V2/Model/Employee.php"));
  App::import('Model','Admin', array("file" => "Plugin/V2/Model/Admin.php"));
  App::import('Model','Task', array("file" => "Plugin/V2/Model/Task.php"));
  App::import('Model','Project', array("file" => "Plugin/V2/Model/Project.php"));
  App::import('Model','Company', array("file" => "Plugin/V2/Model/Company.php"));
  App::import('Model','CompaniesProject', array("file" => "Plugin/V2/Model/CompaniesProject.php"));
  App::import('Model','Employeerole', array("file" => "Plugin/V2/Model/Employeerole.php"));
  App::import('Model','CompaniesEmployee', array("file" => "Plugin/V2/Model/CompaniesEmployee.php"));
  App::import('Model','EmployeerolesTask', array("file" => "Plugin/V2/Model/EmployeerolesTask.php"));
  App::import('Model','EmployeesTask', array("file" => "Plugin/V2/Model/EmployeesTask.php"));
  
  
  class ExcelProcessor{
    var $sheet_names;
    var $sheets;
    var $reader;
    var $xls;
    protected $file_path;
    protected $file_name;
    protected $sheet_errors = array();
    protected $all_sheet_highest_columns = array();
    protected $company_name;
    protected $company_id;
    protected $project_id;
    protected $project_name;
    protected $admin_id;
    protected $user_data;
    protected $task_data;
    protected $roles_array = array();
    protected $assigned_to_roles_array = array();
    protected $assigned_to_names_array = array();
    public function __construct($args){
      $this->sheet_names = $args["sheet_names"];
      $this->file_path = $args["file_path"];
      $this->file_name = $args["file_name"];
      $this->sheet_columns = $args["sheet_columns"];
      $this->admin_id = $args["admin_id"];
    }
    
    public function is_file_format_correct(){
      $file_name = $this->file_name;
      $file_ext_arr = explode('.',$file_name);
      $file_extension = $file_ext_arr[count($file_ext_arr)-1];
      $file_extension_ok = ($file_extension === 'xlsx' /*|| $file_extension === 'xls' */|| $file_extension === 'ods');
      if(!$file_extension_ok){
        $this->sheet_errors[] = "File format incorrect. It should be xlsx or ods format";
      }
      else{
        $this->reader = new PHPExcel_Reader_Excel2007();
        $this->xls = $this->reader->load("{$this->file_path}");
      }
      return $file_extension_ok;
    }
    
    public function all_sheets_present(){
      $all_sheets_present = true;
      foreach($this->sheet_names as $sheet_name){
        $sheet = $this->xls->getSheetByName($sheet_name);
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
    
    public function all_columns_present($sheet_name){
      $columns_present = true;
      $highest_data_column = $this->$sheet_name->getHighestDataColumn();
      if($highest_data_column != end((array_keys($this->sheet_columns[$sheet_name])))){
        $this->sheet_errors[] = "All columns not found for Sheet $sheet_name";
        $columns_present = false;
      }
      return $columns_present;
    }
    
    public function all_sheets_columns_present(){
      $all_sheet_column_present = true;
      foreach($this->sheet_names as $sheet_name){
        $all_sheet_column_present = $all_sheet_column_present && $this->all_columns_present($sheet_name);
      }
      return $all_sheet_column_present;
    }
    
    public function get_all_sheets(){
      $this->sheets = array();
      foreach($this->sheet_names as $sheet_name){
        $this->sheets[$sheet_name] = $this->xls->getSheetByName($sheet_name);
      }
    }
    
    public function get_sheet_errors(){
      return $this->sheet_errors;
    }
    
    
    public function get_company_name(){
      return $this->sheets["SETTING"]->getCellByColumnAndRow(0, 2)->getFormattedValue();
    }
    
    public function get_project_name(){
      return $this->sheets["SETTING"]->getCellByColumnAndRow(1, 2)->getFormattedValue();
    }
    
    public function company_valid($company_name){
      $company = new Company();
      $company_exists = false;
      $data = $company->find("first",array(
          "contain" => false,
          "field" => "Company.id",
          "joins" => array(
            array(
              'table' => 'admins_companies',
              'alias' => 'AdminsCompany',
              'type'  => 'LEFT',
              'conditions' => "AdminsCompany.company_id=Company.id"
            )
          ),
          "conditions" => array(
            "AdminsCompany.admin_id" => $this->admin_id,
            "Company.name" => $company_name
          )
        )
      );
      if(!empty($data)){
        $company_exists = true;
        $this->company_name = $company_name;
        $this->company_id = $data["Company"]["id"];
        $this->admin_id = $this->admin_id;
      }
      else{
        $this->sheet_errors[] = "Company " . $company_name . " is not assigned to you.";
      }
      return $company_exists;
    }
    
    public function project_valid($project_name){
      $project = new Project();
      $project_valid = false;
      $project = $project->findByName($project_name);
      $project_exists = false;
      if($project){
        $project_exists = true;
        $project = new Project();
        $project = $project->find("first",array(
            "contain" => false,
            "joins" => array(
              array(
                'table' => 'companies_projects',
                'alias' => 'CompaniesProject',
                'type'  => 'LEFT',
                'conditions' => array(
                  "CompaniesProject.project_id=Project.id"
                )
              )
            ),
            "field" => "Project.id",
            "conditions" => array(
              "CompaniesProject.company_id" => $this->company_id,
              "Project.name" => $project_name
            )
          )
        );
      }
      if(!empty($project)){
        $this->project_name = $project_name;
        $this->project_id = $project["Project"]["id"];
        $project_valid = true;
      }
      else{
        if($project_exists){
          $this->sheet_errors[] = "Project name already added by different admin";
        }
        else{
          $this->project_name = $project_name;
          $this->add_project_for_admin();
          $project_valid = true;
        }
      }
      return $project_valid;
    }
    
    function add_project_for_admin(){
      $edit_feedback = $this->sheets["SETTING"]->getCellByColumnAndRow(2, 2)->getFormattedValue();
      $task_display_count = $this->sheets["SETTING"]->getCellByColumnAndRow(3,2)->getFormattedValue();
      $logo = $this->sheets["SETTING"]->getCellByColumnAndRow(4,2)->getFormattedValue();
      $lottery_nr = $this->sheets["SETTING"]->getCellByColumnAndRow(5,2)->getFormattedValue();
      $lottery_response = $this->sheets["SETTING"]->getCellByColumnAndRow(6,2)->getFormattedValue();
      $project_data = array(
        "Project" => array(
          "name" => $this->project_name,
          "edit_feedbacks" => (($edit_feedback == "YES") ? "YES" : "NO"),
          "lottery_nr" => $lottery_nr,
          "lottery_response" => $lottery_response,
          "logo" => $logo
        )
      );
      if(!empty($task_display_count)){
        $project_data["Project"]["task_display_count"] = $task_display_count;
      }
      $project = new Project();
      $project->save($project_data);
      $this->project_id = $project->id;
      $companies_project_data = array(
        "CompaniesProject" => array(
          "company_id" => $this->company_id,
          "project_id" => $this->project_id
        )
      );
      $companies_project = new CompaniesProject();
      $companies_project->save($companies_project_data);
    }
    
    public function employees_valid(){
      $col_count = count($this->sheet_columns["USER"]);
      $row_count = $this->sheets["USER"]->getHighestRow();
      #$row_count = 8;
      $user_data = array();
      
      $user_table_column_arr = array(
        0 => "username",
        1 => "email",
        2 => "mobile",
        4 => "password"
      );
      $employee_table_column_arr = array(
        3 => "employeerole_id",
        5 => array("active","YES"),
        6 => array("locked","YES"),
        7 => array("status","YES"),
        8 => array("user_raci","R"),
        9 => array("anonymous","NO")
      );
      $user_data_arr = array();
      $employee_data_arr = array();
      for($row=2;$row<=$row_count;$row++){
        for($col=0;$col<$col_count;$col++){
          if(in_array($col,array_keys($user_table_column_arr))){
            $col_value = $this->sheets["USER"]->getCellByColumnAndRow($col, $row)->getFormattedValue();
            if($col==0 && empty($col_value) && $col_value=='') {
              break 2;
            }
            $user_data["User"][$user_table_column_arr[$col]] = $col_value;
          }
          else{
            $col_value = $this->sheets["USER"]->getCellByColumnAndRow($col, $row)->getFormattedValue();
            if(is_array($employee_table_column_arr[$col])){
              if(!empty($col_value)){
                $user_data["Employee"][$employee_table_column_arr[$col][0]] = $col_value;
              }
              else{
                $user_data["Employee"][$employee_table_column_arr[$col][0]] = $employee_table_column_arr[$col][1];
              }
            }
            else{
              $user_data["Employee"][$employee_table_column_arr[$col]] = $col_value;
            }
          }
        
        }
        $user_data["User"]["role"] = "employee";
        $user_data["Employee"]["admin_id"] = $this->admin_id;
        $user_data_arr[$row] = $user_data;
      }
      $employees_ok = true;
      foreach($user_data_arr as $key => $ud){
        $temp_email = $ud["User"]["email"];
        //echo $temp_email . "   i m h ere<br/>";
        $temp_username = $ud["User"]["username"];
        $employee = $this->employee_exists($temp_email,"email");
        if(!empty($employee))
        {
          if($employee["User"]["username"] == $temp_username){
            if($employee["Company"][0]["id"] == $this->company_id)
            {
              $user_data_arr[$key]["User"]["id"] = $employee["Employee"]["id"];
              $user_data_arr[$key]["Employee"]["id"] = $employee["Employee"]["id"];
              $employees_ok = $employees_ok && true;
            }
            else{
              $employees_ok = false;
              $this->sheet_errors[] = "Employee with email " . $temp_email . " exists for some other Company in USER sheet at row number " . $key;
            }
          }
          else{
            $employees_ok = false;
            $this->sheet_errors[] = "Employee with email " . $temp_email . " already exists and email-username combination does not match in USER sheet at row number " . $key;
          }
        }
        else{
          $employee = $this->employee_exists($temp_username,"username");
          if(!empty($employee)){
            $employees_ok = false;
            $this->sheet_errors[] = "Employee with username " . $temp_username . " already exists and email-username combination does not match in USER sheet at row number " . $key;
          }
          else{
            if(!$this->employee_data_validates($ud, $key)){
              $employees_ok = false;
            }
          }
        }
      }
      if($employees_ok){
        $this->user_data = $user_data_arr;
      }
      return $employees_ok;
    }
    
    public function employee_data_validates($user_data, $row){
      $user = new User();
      $user->set($user_data["User"]);
      $emp_data_valid = true;
      if(!$user->validates(array('fieldList' => array('email', 'password')))){
        $emp_data_valid = false;
        foreach($user->validationErrors as $field_errors){
          foreach($field_errors as $field_error){
            $this->sheet_errors[] = $field_error . " at in USER sheet at row number " . $row;
          }
        }
      }
      return $emp_data_valid;
    }
    
    public function employee_exists($value_to_check, $email_or_name="email"){
      $user = new User();
      $find_by = "findBy" . ucfirst($email_or_name);
      $user = $user->$find_by($value_to_check);
      if(!empty($user)){
        $employee = new Employee();
        $employee = $employee->find(
          "first",
          array(
            "conditions" => array(
              "Employee.id" => $user["User"]["id"]
            )
          )
        );

      }
      else{
        $employee = false;
      }
      return $employee;
    }
    
    public function roles_exists(){
      $roles_ok = true;
      $emp_roles = new Employeerole();
      $emp_roles_array = $emp_roles->find('all',array('fields' => 'name','contain' => false));
      $emprole = false;
      foreach($emp_roles_array as $role) {
        $emprole[] = $role['Employeerole']['name'];
      }
      $row_count = $this->sheets["USER"]->getHighestRow();
      for($row=2;$row<=$row_count; $row++){
        $role = $this->sheets["USER"]->getCellByColumnAndRow(3, $row)->getFormattedValue();
        //$emprole = array("EMP","TL","PM");
        if(!empty($role) && in_array($role,$emprole)){
          $roles_ok = $roles_ok && true;
          if($emprole == $this->validate_role($role)){
            $roles_ok = $roles_ok && true;
            $this->roles_array[$role] = $emprole["Employeerole"]["id"]; 
          }
          else{
            $this->sheet_errors[] = "Role with name " . $role . " does not exists in USER sheet at row " . ($row);
          }
        }
        else{
          $username = $this->sheets["USER"]->getCellByColumnAndRow(0, $row)->getFormattedValue();
          if(!empty($username)) {
            $this->sheet_errors[] = "Role not defined in USER sheet at row " . ($row);
            $roles_ok = false;
          }
          break;
        }
      }
      return $roles_ok;
    }
    
    public function add_employees(){
      foreach($this->user_data as $key => $ud){
        $this->user_data[$key]["Employee"]["employeerole_id"] = $this->roles_array[$ud["Employee"]["employeerole_id"]];
      $user = new User();
        
        if($user->save($this->user_data[$key]["User"])){
          $employee = new Employee();
          $this->user_data[$key]["Employee"]["id"] = $user->id;
          $employee->save($this->user_data[$key]["Employee"]);
          if(!(key_exists("id",$this->user_data[$key]["User"]) && !empty($this->user_data[$key]["User"]["id"]))){
            $companies_employee = new CompaniesEmployee();
            $comp_emp_data = array(
              "CompaniesEmployee" => array(
                "company_id" => $this->company_id,
                "employee_id" => $employee->id
              )
            );
            $companies_employee->save($comp_emp_data);
          }
          
          unset($employee);
          unset($user);
          unset($companies_employee);
        }
      }
    }
    
    public function tasks_valid(){
      $task_sheet = $this->sheets["TASKS"];
      $task_data_arr = array();
      $row_count = $task_sheet->getHighestRow();
      $col_count = count($this->sheet_columns["TASKS"]);
      $task_data = array();
      $task_cols = array(
        1 => "name",
        2 => "description",
        3 => array("mood","","YES"),
        4 => array("picture","","YES"),
        5 => array("attendees","","YES"),
        6 => array("feedback_text","","YES"),
        7 => "multiple",
        8 => "info_web",
        9 => "lottery_winner",
        10 => "assigned_to_role",
        11 => "assigned_to_name",
        12 => array("public_by","date"),
        13 => array("status","","DRAFT"),
        14 => array("notification_to","email"),
        15 => array("response_until","date"),
        16 => "threshold",
        17 => "parent_id",
        18 => array("show_until","date"),
        19 => array("lottery_value","","NO"),
        20 => array("conditional_questions","","NO"),
      );
      $tasks_ok = true;
      for($row=2;$row<=$row_count; $row++){
        $task_data["Task"] = array();
        $task_sheet_no = $task_sheet->getCellByColumnAndRow(0, $row)->getFormattedValue();
        
        $task_parent = $task_sheet->getCellByColumnAndRow(17, $row)->getFormattedValue();
        if(empty($task_parent) || (!empty($task_parent) && ((int)$task_parent < $task_sheet_no)))
        {
          $task_data["Task"]["project_id"] = $this->project_id;
          if(isset($task_sheet_no) && !empty($task_sheet_no)){
            for($col=1;$col< $col_count; $col++){
              $col_value = $task_sheet->getCellByColumnAndRow(1, $row)->getFormattedValue();
              if($col==1 && empty($col_value) && $col_value=='') {
                break;
              }
              if(isset($task_sheet_no) && !empty($task_sheet_no)){
                if($col!=10 && $col!=11){
                  if(is_array($task_cols[$col])){
                    if(!empty($task_cols[$col][1])){
                      if($task_cols[$col][1] == "date"){
                        $date_val = $task_sheet->getCellByColumnAndRow($col, $row)->getFormattedValue();
                        $date_val = explode("-",$date_val);
                        if(count($date_val) == 3){
                          $date_day = $date_val[1];
                          $date_month = $date_val[0];
                          $date_year = $date_val[2];
                          $task_data["Task"][$task_cols[$col][0]] = $date_year . "-" . $date_month . "-" . $date_day;
                        }
                        else{
                          $date_val = $date_val[0];
                          $date_val = explode("/",$date_val);
                          if(count($date_val) == 3){
                            $date_day = $date_val[1];
                            $date_month = $date_val[0];
                            $date_year = $date_val[2];
                            $task_data["Task"][$task_cols[$col][0]] = $date_year . "-" . $date_month . "-" . $date_day;
                          }
                          else{
                            $tasks_ok = false;
                            $this->sheet_errors[] = $task_cols[$col][0] . " Date Value not found in TASKS sheet on row number " . $row;
                          }
                          
                        }
                        //$task_data["Task"][$task_cols[$col][0]] = date('m-d-Y',strtotime($task_sheet->getCellByColumnAndRow($col, $row)->getFormattedValue()));
                        //$task_data["Task"][$task_cols[$col][0]][1] = $task_sheet->getCellByColumnAndRow($col, $row)->getFormattedValue();
                      }
                      else{
                        if($task_cols[$col][1] == "email"){
                          $task_data["Task"][$task_cols[$col][0]] = strip_tags($task_sheet->getCellByColumnAndRow($col, $row)->getFormattedValue());
                        }
                      }
                    }
                    else{
                      $col_value = $task_sheet->getCellByColumnAndRow($col, $row)->getFormattedValue();
                      if(!empty($col_value)){
                        $task_data["Task"][$task_cols[$col][0]] = $col_value;
                      }
                      else{
                        $task_data["Task"][$task_cols[$col][0]] = $task_cols[$col][2];
                      }
                    }
                  }
                  else{
                    $task_data["Task"][$task_cols[$col]] = $task_sheet->getCellByColumnAndRow($col, $row)->getFormattedValue();  
                  }
                  if($col == 7){
                    $multiple_values = $task_sheet->getCellByColumnAndRow($col, $row)->getFormattedValue();
                    $illegal_value = array(';');
                    //$multiple_values = preg_replace ('/[^\p{L}\p{N}]/u',',',$multiple_values);
                    $multiple_values = str_replace ($illegal_value,',',$multiple_values);
                    //$test = preg_match('@\;@',$multiple_values);
                    //if($test == 0){
                      $task_data["Task"][$task_cols[$col]] = $multiple_values;    
                    //}
                  }
                }
                else{
                  if($col == 10){
                    $assigned_to_roles = $task_sheet->getCellByColumnAndRow($col, $row)->getFormattedValue();
                    $assigned_to_roles = $this->extract_roles_and_validate($assigned_to_roles, $row);
                    if($assigned_to_roles !== false){
                      $task_data["Task"][$task_cols[$col]] = $assigned_to_roles;
                    }
                    else{
                      $tasks_ok = false;
                    }
                  }
                  else{
                    $assigned_to_names = $task_sheet->getCellByColumnAndRow($col, $row)->getFormattedValue();
                    $assigned_to_names = $this->extract_names_and_validate($assigned_to_names, $row);
                    if($assigned_to_names !== false){
                      $task_data["Task"][$task_cols[$col]] = $assigned_to_names;
                    }
                    else{
                      $tasks_ok = false;
                    }
                  }
                  
                }
              }
            }
            $task_data_arr[$task_sheet_no] = $task_data;
          }
        }
        else{
          $this->sheet_errors[] = "'Parent' column can not have value equal or greater than 'No' column in TASKS sheet at row number " . $row;
          $tasks_ok = false;
        }
      }
      $this->task_data = $task_data_arr;
      return $tasks_ok;
    }
    
    public function add_tasks(){

      $task_model_task_sheet_mapping = array();
      foreach($this->task_data as $key => $task_d){
        $task = new Task();
        $task_exists = $this->is_task_already_exists($task_d["Task"]["name"]);
        if($task_exists != false){
          $task_id = $task_exists["Task"]["id"];
          $task->id = $task_id;
        }
        if(!empty($task_d["Task"]["parent_id"])){
          $task_model_parent_id = $task_model_task_sheet_mapping[$task_d["Task"]["parent_id"]];
          $parent_id = $this->task_data[$key]["Task"]["parent_id"];
          $this->task_data[$key]["Task"]["parent_id"] = $task_model_parent_id;
        }
        $assigned_to_roles = $this->task_data[$key]["Task"]["assigned_to_role"];
        $assigned_to_names = $this->task_data[$key]["Task"]["assigned_to_name"];
        unset($this->task_data[$key]["Task"]["assigned_to_role"]);
        unset($this->task_data[$key]["Task"]["assigned_to_name"]);
        $task->save($this->task_data[$key]["Task"]);
        if(!empty($assigned_to_roles)){
          $this->assign_tasks_to_roles($assigned_to_roles, $task->id);
        }
        if(!empty($assigned_to_names)){
          $this->assign_tasks_to_names($assigned_to_names, $task->id);
        }
        $this->task_data[$key]["Task"]["id"] = $task->id;
        $task_model_task_sheet_mapping[$key] = $task->id;
        unset($task); 
      }
      
      
      
      
      
    }
    
    public function is_task_already_exists($task_name){
      $task = new Task();
      $task = $task->find("first", array(
          'conditions' => array(
            'Task.name' => $task_name,
            'Task.project_id' => $this->project_id
          )
        )
      );
      if($task){
        return $task;
      }
      else{
        return false;
      }
    }
    public function extract_roles_and_validate($roles,$row){
      $roles_array = array();
      $roles = str_replace(array(",",", ", ";", "; "), " ",$roles);
      $roles = explode(" ",$roles);
      $roles_ok = true;
      foreach($roles as $key=> $role){
        if($role == ""){
          unset($roles[$key]);
        }
        else{
          $validated_role = $this->validate_role($roles[$key]);
          if($validated_role === false){
            $roles_ok = false;
            $this->sheet_errors[] = "Role '" . $roles[$key] . "' not found in database, Please check in TASKS sheet on row number " . $row;
          }
          else{
            $roles[$key] = $validated_role["Employeerole"]["id"];
          }
        }
      }
      if($roles_ok){
        return $roles;
      }
      else{
        return false;
      }
    }
    
    public function extract_names_and_validate($names, $row){
      $names_array = array();
      $validated_name = array();
      $names = str_replace(array(",",", ", ";", "; "), " ",$names);
      $names = explode(" ",$names);
      $names_ok = true;
      foreach($names as $key=> $name){
        if(trim($name) == ""){
          unset($names[$key]);
        }
        else{
          $validated_name = $this->employee_exists($names[$key],"email");
          if($validated_name === false){
            $names_ok = false;
            $this->sheet_errors[] = "Email '" . $names[$key] . "' not found in database, Please check in TASKS sheet on row number " . $row;
          }
          else{
            $names[$key] = $validated_name["User"]["id"];
          }
        }
      }
      if($names_ok){
        return $names;
      }
      else{
        return false;
      }
      
      return $names;
    }
    
    public function validate_role($role){
      $emprole = new Employeerole();
      $emprole = $emprole->findByName($role);
      $role_ok = false;
      if(!empty($emprole)){
        $this->roles_array[$role] = $emprole["Employeerole"]["id"]; 
        $role_ok = true;
      }
      if($role_ok != true){
        return false;
      }
      else{
        return $emprole;
      }
    }
    
    
    public function assign_tasks_to_roles($roles_array, $task_id){
      foreach($roles_array as $role_id){
        $role_task = new EmployeerolesTask();
        $role_task = $role_task->find("first", array(
            "contain" => false,
            "conditions" => array(
              "EmployeerolesTask.employeerole_id" => $role_id,
              "EmployeerolesTask.task_id" => $task_id
            )
          )
        );
        if(!$role_task){
          unset($role_task);
          $role_task = new EmployeerolesTask();
          $role_task->set(array(
              "EmployeerolesTask" => array(
                "employeerole_id" => $role_id,
                "task_id" => $task_id,
                "company_id" => $this->company_id
              )
            )
          );
          $role_task->save();
        }
        unset($role_task);
      }
    }
    
    public function assign_tasks_to_names($names_array, $task_id){
      foreach($names_array as $employee_id){
        $emp_task = new EmployeesTask();
        
        $emp_task = $emp_task->find("first", array(
            "contain" => false,
            "conditions" => array(
              "EmployeesTask.employee_id" => $employee_id,
              "EmployeesTask.task_id" => $task_id
            )
          )
        );
        if(!$emp_task){
          unset($emp_task);
          $emp_task = new EmployeesTask();
          $emp_task->set(
            array(
              "EmployeesTask" => array(
                "employee_id" => $employee_id,
                "task_id" => $task_id
              )
            )
          );
          $emp_task->save();
        }
        unset($emp_task);
      }
    }
  }


?>