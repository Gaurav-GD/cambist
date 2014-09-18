<!-- BEGIN PAGE HEADER-->   
<div class="row-fluid">
    <div class="span12">
        <h3 class="page-title">
            ADD New User
             <small></small>
        </h3>
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Dashboard</a> 
                <span class="icon-angle-right"></span>
            </li>
            <li>
                <a href="#">Form Stuff</a>
                <span class="icon-angle-right"></span>
            </li>
            <li><a href="#">Form Layouts</a></li>
        </ul>
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row-fluid">
    <div class="span12">
        <div class="tabbable tabbable-custom boxless">
            <div class="tab-content">
                <div>
                    <div class="portlet box blue ">
                        <div class="portlet-title">
                            <div class="caption"><i class="icon-reorder"></i>Add User</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <?php 
                                
                                echo $this->Form->create('User',array('class' => 'form-horizontal form-bordered form-row-stripped')); ?>
                                <div class="control-group">
                                    <label class="control-label">Username</label>
                                    <div class="controls">
                                        <!-- <input type="text" placeholder="small" class="m-wrap span12" /> -->
                                        <?php echo $this->Form->input('username',array('placeholder' => 'Username' , 'class' => 'm-wrap span12','label' => false));?>
                                        <!-- <span class="help-inline">This is inline help</span> -->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Email</label>
                                    <div class="controls">
                                        <!-- <input type="text" placeholder="medium" class="m-wrap span12" /> -->
                                        <?php echo $this->Form->input('email',array('placeholder' => 'Email' , 'class' => 'm-wrap span12','label' => false));?>
                                        <!-- <span class="help-inline">This is inline help</span> -->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Password</label>
                                    <div class="controls">
                                        <!-- <input type="text" placeholder="medium" class="m-wrap span12" /> -->
                                        <?php echo $this->Form->input('password',array('placeholder' => 'Password' , 'class' => 'm-wrap span12','label' => false));?>
                                        <!-- <span class="help-inline">This is inline help</span> -->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Confirm Password</label>
                                    <div class="controls">
                                        <!-- <input type="text" placeholder="medium" class="m-wrap span12" /> -->
                                        <?php echo $this->Form->input('password_confirm',array('placeholder' => 'Confirm Password' , 'class' => 'm-wrap span12','type'=>'password','label' => false));?>
                                        <!-- <span class="help-inline">This is inline help</span> -->
                                    </div>
                                </div>
                                <?php
                                    if(isset($teamleaders)){
                                        $options = array();
                                        foreach($teamleaders as $list)
                                            $options[$list ['Teamleader']['id']] = $list ['User']['username'];
                                ?>
                                        <div class="control-group">
                                            <label class="control-label">Teamleader</label>
                                            <div class="controls">
                                                <?php echo $this->Form->input('teamleader_id',array(
                                                    'options' =>$options,'label' => false 
                                                    ));
                                                ?>
                                            </div>
                                        </div>
                                <?php                                        
                                    }else{
                                        $options[$user['id']] = $user['username'];
                                ?>
                                    <div class="control-group">
                                            <label class="control-label">Team Leader</label>
                                            <div class="controls">
                                                <?php echo $this->Form->input('teamleader_id',array(
                                                    'options' => $options,'label' => false ,'readonly' => 'readonly'
                                                    ));
                                                ?>
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <div class="control-group">
                                    <label class="control-label">Active</label>
                                    <div class="controls">
                                        <?php echo $this->Form->input('active',array(
                                            'options' => array('YES' => 'YES' , 'NO' => 'NO'),'label' => false
                                            ));
                                        ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Role</label>
                                    <div class="controls">
                                        <?php echo $this->Form->input('role',array(
                                            'options' => array('TeleCaller' => 'TeleCaller'),'label' => false , 'readonly' => 'readonly'
                                            ));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <?php 
                                        echo $this->Form->button('<i class=icon-ok></i>  Save',array('class' => 'btn blue','escape' => false));
                                        echo $this->Form->end();
                                    ?>
                                    <button type="button" class="btn">Cancel</button>
                                </div>
                            </form>
                            <!-- END FORM-->  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT--> 