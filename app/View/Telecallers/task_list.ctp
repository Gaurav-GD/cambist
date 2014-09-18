<?php //echo"<pre>";print_r($tasks);exit;?>
<!-- BEGIN PAGE HEADER-->   
<div class="row-fluid">
    <div class="span12">
        <h3 class="page-title">
            Task List
             <small></small>
        </h3>
        <ul class="breadcrumb">
            <li>
            <?php
            	echo $this->Html->link('<i class="icon-home"></i>  Task List' , array('controller' => 'telecallers' , 'action' => 'task_list') , array('escape' => false));
            ?>
                <span class="icon-angle-right"></span>
            </li>
        </ul>
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
<!-- BEGIN SAMPLE TABLE PORTLET-->
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-cogs"></i>Assigned Tasks List</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="#portlet-config" data-toggle="modal" class="config"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body no-more-tables">
		<table class="table-bordered table-striped table-condensed cf">
			<thead class="cf">
				<tr>
					<th>Circle</th>
					<th>Company Name</th>
					<th>Colln Manager</th>
					<th class="numeric">Acct Ext Id</th>
					<th class="numeric">Bill Period</th>
					<th class="numeric">Value Type</th>
					<th class="numeric">PAID</th>
					<th class="numeric">Balance</th>
					<th class="numeric">Total Due</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($tasks as $task): ?>
				<tr>
					<td data-title="Code"><?php echo $task["Allocationmaster"]["Circle"]; ?></td>
					<td data-title="Company"><?php echo $task["Allocationmaster"]["Company_Name"]; ?></td>
					<td data-title="Price" class="numeric"><?php echo $task["Allocationmaster"]["Colln_Manager"]; ?></td>
					<td data-title="Change" class="numeric"><?php echo $task["Allocationmaster"]["Acct_Ext_Id"]; ?></td>
					<td data-title="Change %" class="numeric"><?php echo $task["Allocationmaster"]["Bill_Period"];?></td>
					<td data-title="Open" class="numeric"><?php echo $task["Allocationmaster"]["Value_Type"]; ?></td>
					<td data-title="High" class="numeric"><?php echo $task["Allocationmaster"]["PAID"]; ?></td>
					<td data-title="Low" class="numeric"><?php echo $task["Allocationmaster"]["Balance"]; ?></td>
					<td data-title="Volume" class="numeric"><?php echo $task["Allocationmaster"]["Total_Due"]; ?></td>
					<td data-title="Volume">
						<?php 
							echo $this->Html->link('Add FeedBack' , array('controller' => 'telecallers','action' => 'task_feedback' , $task['Allocationmaster']['id']) , array('class' => 'btn blue'));
						?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<!-- END SAMPLE TABLE PORTLET-->