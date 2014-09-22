<!-- Begin Task Feedback Page Content -->
<!--BEGIN PAGE HEADER-->
<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Task Name <small>FeedBack Form</small>
        </h3>
        <ul class="breadcrumb">
            <li>
                <?php echo $this->Html->link('<i class="icon-home"></i>  Task List  <i class="icon-angle-right"></i>',array('action' => 'task_list'),array('escape' => false));?>
            </li>
            <li>
                <a href="#"></a>
                <i class=""></i>
            </li>
            <li><a href="#"></a></li>
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
    <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-edit"></i>FeedBack Form</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            
			
        </div>
        <div class="tab-content">
				<?php 
	                echo $this->Form->create('',array('class' => 'form-horizontal form-bordered form-row-stripped')); 
	                //echo "Task Id : ". $task_id;
	            ?>
	            	<!-- <div class="control-group">
	            		<div class="controls controls-row span12">
		            		<center><H1<b> Customer Details</b></H1></center>
	            		</div>
	            	</div> -->
	            	<div class="control-group">
	            		<div class="controls controls-row span4"> 
	            			<label class="control-label span3">Company Name</label>
	            			<?php 
	            				echo $this->Form->input('Company_Name',array('placeholder' => 'Company Name' , 'class' => 'm-wrap span9','label' => false));
	            			?>
	            		</div>
	            		<div class="controls controls-row span4">
	            			<label class="control-label span3">Bill Name</label>
	            			<?php
	            				echo $this->Form->input('Bill_Name' , array('placeholder' => 'Bill Name' , 'class' => 'm-wrap span9' ,'label' => false));
	            			?>
	            		</div>
	            		<div class="controls controls-row span4">
	            			<label class="control-label span2">Acct Ext Id</label>
	            			<?php
	            				echo $this->Form->input('Acct_Ext_Id' , array('placeholder' => 'Acct Ext Id' , 'class'=>'m-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls control-row span4">
	            			<label class="control-label span3">Name</label>
	            			<?php
	            				echo $this->Form->input('Name1' , array('placeholder' => 'Name' , 'class' => 'm-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span3">Number</label>
	            			<?php
	            				echo $this->Form->input('Number1' , array('placeholder' => 'Number' , 'class' => 'm-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span3">Email Id</label>
	            			<?php
	            				echo $this->Form->input('Email1' , array('placeholder' => 'Email Id' , 'class' => 'm-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls control-row span4">
	            			<label class="control-label span3">Name</label>
	            			<?php
	            				echo $this->Form->input('Name2' , array('placeholder' => 'Name' , 'class' => 'm-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span3">Number</label>
	            			<?php
	            				echo $this->Form->input('Number2' , array('placeholder' => 'Number' , 'class' => 'm-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span3">Email Id</label>
	            			<?php
	            				echo $this->Form->input('Email2' , array('placeholder' => 'Email Id' , 'class' => 'm-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls  span4">
	            			<label class="control-label span3">Name</label>
	            			<?php
	            				echo $this->Form->input('Name3' , array('placeholder' => 'Name' , 'class' => 'm-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span3">Number</label>
	            			<?php
	            				echo $this->Form->input('Number3' , array('placeholder' => 'Number' , 'class' => 'm-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span3">Email Id</label>
	            			<?php
	            				echo $this->Form->input('Email3' , array('placeholder' => 'Email Id' , 'class' => 'm-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls control-row span12">
	            			<label class="control control-row span1">Address</label>
	            			<?php
	            				echo $this->Form->input('Address' , array('placeholder' => 'Address' , 'class' => 'm-wrap span11' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls  span4">
	            			<label class="control-label span3">Mobile Num</label>
	            			<?php
	            				echo $this->Form->input('Mobile_Num' , array('placeholder' => 'Mobile Num' , 'class' => 'm-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span3">Alternate Number</label>
	            			<?php
	            				echo $this->Form->input('Alternate_Number' , array('placeholder' => 'Alternate Number' , 'class' => 'm-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span3">Alternate Number</label>
	            			<?php
	            				echo $this->Form->input('Alternate_Number' , array('placeholder' => 'Alternate Number' , 'class' => 'm-wrap span9' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls  span3">
	            			<label class="control-label span5">Days_0_30</label>
	            			<?php
	            				echo $this->Form->input('Days_0_30' , array('placeholder' => 'Days_0_30' , 'class' => 'm-wrap span6' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">Days_30_60</label>
	            			<?php
	            				echo $this->Form->input('Days_30_60' , array('placeholder' => 'Days_30_60' , 'class' => 'm-wrap span6' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">Days_60_90</label>
	            			<?php
	            				echo $this->Form->input('Days_30_60' , array('placeholder' => 'Days_30_60' , 'class' => 'm-wrap span6' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">Days_90_120</label>
	            			<?php
	            				echo $this->Form->input('Days_90_120' , array('placeholder' => 'Days_90_120' , 'class' => 'm-wrap span6' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls  span4">
	            			<label class="control-label span5">Days_120_150</label>
	            			<?php
	            				echo $this->Form->input('Days_120_150' , array('placeholder' => 'Days_120_150' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span5">Days_150_180</label>
	            			<?php
	            				echo $this->Form->input('Days_150_180' , array('placeholder' => 'Days_150_180' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span5">Days_180_Above</label>
	            			<?php
	            				echo $this->Form->input('Days_180_Above' , array('placeholder' => 'Days_180_Above' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls  span3">
	            			<label class="control-label span5">Balance</label>
	            			<?php
	            				echo $this->Form->input('Balance' , array('placeholder' => 'Balance' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">PAID</label>
	            			<?php
	            				echo $this->Form->input('PAID' , array('placeholder' => 'PAID' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">Total Due</label>
	            			<?php
	            				echo $this->Form->input('Total_Due' , array('placeholder' => 'Total Due' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">Cat</label>
	            			<?php
	            				echo $this->Form->input('Cat' , array('placeholder' => 'Cat' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls  span4">
	            			<label class="control-label span5">RM</label>
	            			<?php
	            				echo $this->Form->input('RM' , array('placeholder' => 'RM' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span5">CSA</label>
	            			<?php
	            				echo $this->Form->input('CSA' , array('placeholder' => 'CSA' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span5">KAM</label>
	            			<?php
	            				echo $this->Form->input('KAM' , array('placeholder' => 'KAM' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls  span4">
	            			<label class="control-label span5">Bill Period</label>
	            			<?php
	            				echo $this->Form->input('Bill_Period' , array('placeholder' => 'Bill Period' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span5">Value Type</label>
	            			<?php
	            				echo $this->Form->input('Value_Type' , array('placeholder' => 'Value Type' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span4">
	            			<label class="control-label span5">VIP Flag</label>
	            			<?php
	            				echo $this->Form->input('VIP_Flag' , array('placeholder' => 'VIP Flag' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls  span3">
	            			<label class="control-label span5">Account Status</label>
	            			<?php
	            				echo $this->Form->input('Account_Status' , array('placeholder' => 'Account Status' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">Product Type</label>
	            			<?php
	            				echo $this->Form->input('Product_Type' , array('placeholder' => 'Product Type' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">Voice Status</label>
	            			<?php
	            				echo $this->Form->input('Voice_Status' , array('placeholder' => 'Voice Status' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">Service Line</label>
	            			<?php
	            				echo $this->Form->input('Service_Line' , array('placeholder' => 'Service Line' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls  span3">
	            			<label class="control-label span5">Dsl Status</label>
	            			<?php
	            				echo $this->Form->input('Dsl_Status' , array('placeholder' => 'Dsl Status' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">Dsl Status</label>
	            			<?php
	            				echo $this->Form->input('Dsl_Status' , array('placeholder' => 'Dsl Status' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">RatePlan</label>
	            			<?php
	            				echo $this->Form->input('RatePlan' , array('placeholder' => 'RatePlan' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">Aon</label>
	            			<?php
	            				echo $this->Form->input('Aon' , array('placeholder' => 'Aon' , 'class' => 'm-wrap span7' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls  span3">
	            			<label class="control-label span5">Back Office Status</label>
	            			<?php
	            				echo $this->Form->input('Back_Office_Status' , array('placeholder' => 'Back Office Status' , 'class' => 'm-wrap span6' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">RM status</label>
	            			<?php
	            				echo $this->Form->input('RM_status' , array('placeholder' => 'RM status' , 'class' => 'm-wrap span6' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">Payment File</label>
	            			<?php
	            				echo $this->Form->input('Payment_File' , array('placeholder' => 'Payment File' , 'class' => 'm-wrap span6' , 'label' => false));
	            			?>
	            		</div>
	            		<div class="controls control-row span3">
	            			<label class="control-label span5">Age Bkt</label>
	            			<?php
	            				echo $this->Form->input('Age_Bkt' , array('placeholder' => 'Age Bkt' , 'class' => 'm-wrap span6' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
	            	<div class="control-group">
	            		<div class="controls control-row span12">
	            			<label class="control control-row span1">Data Captured</label>
	            			<?php
	            				echo $this->Form->input('Data_Captured' , array('placeholder' => 'Data Captured' , 'class' => 'm-wrap span11' , 'label' => false));
	            			?>
	            		</div>
	            	</div>
					
				</form>
			</div>
		<div style="font-size:50px; text-align:center;" ><?php echo "Page is Under Maintenance" ;?></div>
        
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- END PAGE CONTENT