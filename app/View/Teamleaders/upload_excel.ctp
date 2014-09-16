 <!--BEGIN PAGE CONTAINER-->
<div class="container-fluid">
	<!-- BEGIN PAGE HEADER-->
	<div class="row-fluid">
		<div class="span12">
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="color-panel hidden-phone">
				<div class="color-mode-icons icon-color"></div>
				<div class="color-mode-icons icon-color-close"></div>
				<div class="color-mode">
					<p>THEME COLOR</p>
					<ul class="inline">
						<li class="color-black current color-default" data-style="default"></li>
						<li class="color-blue" data-style="blue"></li>
						<li class="color-brown" data-style="brown"></li>
						<li class="color-purple" data-style="purple"></li>
						<li class="color-grey" data-style="grey"></li>
						<li class="color-white color-light" data-style="light"></li>
					</ul>
					<label>
						<span>Layout</span>
						<select class="layout-option m-wrap small">
							<option value="fluid" selected>Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</label>
					<label>
						<span>Header</span>
						<select class="header-option m-wrap small">
							<option value="fixed" selected>Fixed</option>
							<option value="default">Default</option>
						</select>
					</label>
					<label>
						<span>Sidebar</span>
						<select class="sidebar-option m-wrap small">
							<option value="fixed">Fixed</option>
							<option value="default" selected>Default</option>
						</select>
					</label>
					<label>
						<span>Footer</span>
						<select class="footer-option m-wrap small">
							<option value="fixed">Fixed</option>
							<option value="default" selected>Default</option>
						</select>
					</label>
				</div>
			</div>
			<!-- END BEGIN STYLE CUSTOMIZER --> 
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				<?php echo $upload_excel; ?>&nbsp;&nbsp;&nbsp;<small><?php echo $upload_excel; ?></small>
			</h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li>
					<a href="#">Form Stuff</a>
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Dropzone File Upload</a></li>
			</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
		</div>
	</div>
	<!-- END PAGE HEADER-->
	<!-- BEGIN PAGE CONTENT-->
	<div class="row-fluid">
		<!-- <div class="span12">
			<p>
				<span class="label label-important">NOTE:</span>&nbsp;
				This plugins works only on Latest Chrome, Firefox, Safari, Opera & Internet Explorer 10.
			</p>
			<?php
				echo $this->Form->create('Teamleader',array("action" => "upload_excel",'class' => 'dropzone','type' => 'file' ,"inputDefaults" => array("label"=>false,"div" => false,"class"=> "input-xlarge"))); 
			?>
			<?php //echo $this->Form->create('Admin',array("action" => "upload_xls","class"=>"form-horizontal well","type" => "file" ,"inputDefaults" => array("label"=>false,"div" => false,"class"=> "input-xlarge"))); ?>

		</div> -->
		<div class="row-fluid fileupload-buttonbar">
			<div class="span7">
				<!-- The fileinput-button span is used to style the file input field as button -->
				<!-- <span class="btn green fileinput-button">
				<i class="icon-plus icon-white"></i>
				<span>Add files...</span>
				<input type="file" name="files[]" multiple>
				</span> -->
				
			</div>
			<!-- The global progress information -->
			<div class="span5 fileupload-progress fade">
				<!-- The global progress bar -->
				<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
					<div class="bar" style="width:0%;"></div>
				</div>
				<!-- The extended global progress information -->
				<div class="progress-extended">&nbsp;</div>
			</div>
		</div>
		<div class="row-fluid">
		    <div class="span8 offset2">
		        <?php 
		        	echo $this->Form->create('Teamleader',array("action" => "upload_excel",'type' => 'file' ,"inputDefaults" => array("label"=>false,"div" => false,"class"=> "input-xlarge"))); 
		        ?>
		            <fieldset>
		                <legend>Upload Excel Sheet</legend>
		                <div class="control-group">
		                    <label class="control-label" for="id_name">Name</label>
		                    <div class="controls">
		                        <?php echo $this->Form->input("xlsx_file", array("type" => "file")); ?>
		                    </div>
		                </div>
		                <div class="form-actions">
		                    <?php
		                    	echo $this->Form->button('<i class="icon-upload icon-white"></i>   Start upload',array(
		                    		'class'=> 'btn blue start','escape' => false));
		                    	echo $this->Form->end();
		                        echo $this->Html->link('<i class="icon-ban-circle icon-white"></i>  Cancel',array(
		                                'controller' => 'teamleaders',
		                                'action'     => 'index'
		                            ),array('class' => 'btn yellow cancel','type' => 'button','escape' => false)
		                        );
		                        echo $this->Form->button('<i class="icon-trash icon-white"></i>  Cancel upload' , array('class' => 'btn red delete' , 'escape' => false));
		                    ?>
		                </div>
		            </fieldset>
		        </form>
		    </div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
<script>
	Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element
	  // The configuration we've talked about above
	  autoProcessQueue: false,
	  uploadMultiple: true,
	  parallelUploads: 100,
	  maxFiles: 100,

	  // The setting up of the dropzone
	  init: function() {
	    var myDropzone = this;

	    // First change the button to actually tell Dropzone to process the queue.
	    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
	      // Make sure that the form isn't actually being sent.
	      e.preventDefault();
	      e.stopPropagation();
	      myDropzone.processQueue();
	    });

	    // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
	    // of the sending event because uploadMultiple is set to true.
	    this.on("sendingmultiple", function() {
	      // Gets triggered when the form is actually being sent.
	      // Hide the success button or the complete form.
	    });
	    this.on("successmultiple", function(files, response) {
	      // Gets triggered when the files have successfully been sent.
	      // Redirect user or notify of success.
	    });
	    this.on("errormultiple", function(files, response) {
	      // Gets triggered when there was an error sending the files.
	      // Maybe show form again, and notify user of error
	    });
	  }

	}
</script>