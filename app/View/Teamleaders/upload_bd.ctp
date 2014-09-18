 <!--BEGIN PAGE CONTAINER-->
<div class="container-fluid">
	<!-- BEGIN PAGE HEADER-->
	
	<div class="row-fluid">
		<div class="span12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				<?php echo $upload_bd; ?>&nbsp;&nbsp;&nbsp;<small><?php echo $upload_bd; ?></small>
			</h3>
			<ul class="breadcrumb">
				<li>
					<?php
						echo $this->Html->link('<i class="icon-home"></i>  Home',array('action'     => 'index'),array('escape' => false));
					?>
					<i class="icon-angle-right"></i>
				</li>
				<li>
					<a href="#">Upload Excel</a>
				</li>
			</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
		</div>
	</div>
	<!-- END PAGE HEADER-->
	<div class="row-fluid">
	    <div class="span12">
	        <?php if($message = $this->Session->flash('error')):?>
	            <div class="alert alert-error"><?php echo $message; ?></div>
	        <?php elseif($message = $this->Session->flash('success')):?>
	            <div class="alert alert-success"><?php echo $message; ?></div>
	        <?php else: ?>
	            <div>&nbsp;</div>
	        <?php endif; ?>
	    </div>
	</div>
	<!-- BEGIN PAGE CONTENT-->
	<div class="row-fluid">
		<div class="row-fluid fileupload-buttonbar">
			<div class="span7">
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
		    <!-- <div class="span8 offset2">
		        <?php 
		        	echo $this->Form->create('Teamleader',array("action" => "upload_open_invoice",'type' => 'file' ,"inputDefaults" => array("label"=>false,"div" => false,"class"=> "input-xlarge"))); 
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
		    </div> -->
		    <div style="font-size:50px; text-align:center;" ><?php echo "Page is Under Maintenance" ;?></div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
