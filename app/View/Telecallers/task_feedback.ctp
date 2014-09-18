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
			<!-- <div>
				<form>
				<?php echo "Task Id : ". $task_id;?>
					<div class="controls controls-row">
						<input class="span12 m-wrap" type="text" placeholder=".span12" />
					</div>
					<div class="controls controls-row">
						<input class="span11 m-wrap" type="text" placeholder=".span11" />
						<input class="span1 m-wrap" type="text" placeholder=".span1" />
					</div>
					<div class="controls controls-row">
						<input class="span10 m-wrap" type="text" placeholder=".span10" />
						<input class="span2 m-wrap" type="text" placeholder=".span2" />
					</div>
					<div class="controls controls-row">
						<input class="span9 m-wrap" type="text" placeholder=".span9" />
						<input class="span3 m-wrap" type="text" placeholder=".span3" />
					</div>
					<div class="controls controls-row">
						<input class="span8 m-wrap" type="text" placeholder=".span8" />
						<input class="span4 m-wrap" type="text" placeholder=".span4" />
					</div>
					<div class="controls controls-row">
						<input class="span7 m-wrap" type="text" placeholder=".span7" />
						<input class="span5 m-wrap" type="text" placeholder=".span5" />
					</div>
					<div class="controls controls-row">
						<input class="span6 m-wrap" type="text" placeholder=".span6" />
						<input class="span6 m-wrap" type="text" placeholder=".span6" />
					</div>
					<div class="controls controls-row">
						<input class="span5 m-wrap" type="text" placeholder=".span5" />
						<input class="span7 m-wrap" type="text" placeholder=".span7" />
					</div>
					<div class="controls controls-row">
						<input class="span4 m-wrap" type="text" placeholder=".span4" />
						<input class="span8 m-wrap" type="text" placeholder=".span8" />
					</div>
					<div class="controls controls-row">
						<input class="span3 m-wrap" type="text" placeholder=".span3" />
						<input class="span9 m-wrap" type="text" placeholder=".span9" />
					</div>
					<div class="controls controls-row">
						<input class="span2 m-wrap" type="text" placeholder=".span2" />
						<input class="span10 m-wrap" type="text" placeholder=".span10" />
					</div>
					<div class="controls controls-row">
						<input class="span1 m-wrap" type="text" placeholder=".span1" />
						<input class="span11 m-wrap" type="text" placeholder=".span11" />
					</div>
					<div class="controls controls-row">
						<input class="span2 m-wrap" type="text" placeholder=".span2" />
						<input class="span3 m-wrap" type="text" placeholder=".span3" />
						<input class="span4 m-wrap" type="text" placeholder=".span4" />
						<input class="span2 m-wrap" type="text" placeholder=".span2" />
						<input class="span1 m-wrap" type="text" placeholder=".span1" />
					</div>
				</form>
			</div> -->
        </div>
			<div style="font-size:50px; text-align:center;" ><?php echo "Page is Under Maintenance" ;?></div>
        
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- END PAGE CONTENT