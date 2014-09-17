<!--BEGIN PAGE HEADER-->
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
            Manager <small>Users Details</small>
        </h3>
        <ul class="breadcrumb">
            <li>
                <?php echo $this->Html->link('<i class="icon-home"></i>  DashBoard  <i class="icon-angle-right"></i>',array('action' => 'dashboard'),array('escape' => false));?>
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
    <div class="span8 offset2">
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
                <div class="caption"><i class="icon-edit"></i>User Details</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="clearfix">
                    <div class="btn-group">
                        <!-- <button id="sample_editable_1_new" class="btn green">
                        Add New <i class="icon-plus"></i>
                        </button> -->
                        <?php echo $this->Html->link("Add New Manager    <i class='icon-plus'></i>",array('action' => 'add'),array( 'id' => 'sample_editable_1_new','class' => 'btn green','escape' => false));?>
                    </div>
                    <div class="btn-group pull-right">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#">Print</a></li>
                            <li><a href="#">Save as PDF</a></li>
                            <li><a href="#">Export to Excel</a></li>
                        </ul>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                    <thead>
                        <tr>
                            <th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
                            <th><?php echo $this->Paginator->sort('username', 'Username');?></th>
                            <th><?php echo $this->Paginator->sort('email', 'E-Mail');?></th>
                            <th><?php echo $this->Paginator->sort('created', 'Created');?></th>
                            <th><?php echo $this->Paginator->sort('modified','Last Update');?></th>
                            <th><?php echo $this->Paginator->sort('role','Role');?></th>
                            <th><?php echo $this->Paginator->sort('status','Status');?></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr class="">
                            <td>alex</td>
                            <td>Alex Nilson</td>
                            <td>1234</td>
                            <td class="center">power user</td>
                            <td><a class="edit" href="javascript:;">Edit</a></td>
                            <td><a class="delete" href="javascript:;">Delete</a></td>
                        </tr> -->

                        <?php $count=0; ?>
                        <?php foreach($users as $user): ?>                
                        <?php $count ++;?>
                        <?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
                        <?php endif; ?>
                            <td><?php echo $this->Form->checkbox('User.id.'.$user['User']['id']); ?></td>
                            <td><?php echo $this->Html->link( ucfirst($user['User']['username'])  ,   array('action'=>'edit', $user['User']['id']),array('escape' => false) );?></td>
                            <td style="text-align: center;"><?php echo $user['User']['email']; ?></td>
                            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
                            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['modified']); ?></td>
                            <td style="text-align: center;"><?php echo $user['User']['role']; ?></td>
                            <td style="text-align: center;"><?php echo $user['User']['status']; ?></td>
                            <td >
                            <?php echo $this->Html->link(    "Edit",   array('action'=>'edit', $user['User']['id']) ); ?> | 
                            <?php
                                if( $user['User']['status'] != 0){ 
                                    echo $this->Html->link(    "Delete", array('action'=>'delete', $user['User']['id']));}else{
                                    echo $this->Html->link(    "Re-Activate", array('action'=>'activate', $user['User']['id']));
                                    }
                            ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($user); ?>
                        
                    </tbody>
                </table>
                <?php 
                    echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'     disabled'));
                    echo $this->Paginator->numbers(array(   'class' => 'numbers'     ));
                    echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));
                ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- END PAGE CONTENT