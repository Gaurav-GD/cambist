<!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <?php
            echo $this->Form->create('User', array('id' => 'form_sample_1', 'class' => 'form-vertical login-form', 'inputDefaults' => array(
                    'label' => false,
                    'div' => false
            )));
        ?>
            <h3 class="form-title">Login to your account</h3>
            <div class="alert alert-error hide">
                <button class="close" data-dismiss="alert"></button>
                <span>Enter any username and password.</span>
            </div>
            <div class="control-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-user"></i>
                        <?php echo $this->Form->input('username', array('placeholder' => "Username", 'class' => "m-wrap placeholder-no-fix")); ?>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-lock"></i>
                       <?php echo $this->Form->input('password', array('placeholder' => 'Password', 'class' => "m-wrap placeholder-no-fix")); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <label class="checkbox">
                <input type="checkbox" name="remember" value="1"/> Remember me
                </label>
                <?php
                    echo $this->Form->button('Logins  <i class="m-icon-swapright m-icon-white"></i>',array('class' => "btn green pull-right",'escape' => false));
                    echo $this->Form->end();
                ?> 
            </div>
            <!-- <div class="forget-password">
                <h4>Forgot your password ?</h4>
                <p>
                    no worries, click <a href="javascript:;" class="" id="forget-password">here</a>
                    to reset your password.
                </p>
            </div> -->
        </form>
        <!-- END LOGIN FORM -->        
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form class="form-vertical forget-form collapse" action="index.html">
            <h3 class="">Forget Password ?</h3>
            <p>Enter your e-mail address below to reset your password.</p>
            <div class="control-group">
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-envelope"></i>
                        <input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="email" />
                        <?php
                            echo $this->Form->input('email',array('class' => 'm-wrap placeholder-no-fix' , 'placeholder' => 'Email'));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="button" id="back-btn" class="btn">
                <i class="m-icon-swapleft"></i> Back
                </button>
                <?php
                    echo $this->Form->button('Submit  <i class="m-icon-swapright m-icon-white"></i>', array('class' => 'btn green pull-right'));
                    echo $this->Form->end();
                ?>
                <button type="submit" class="btn green pull-right">
                Submit <i class="m-icon-swapright m-icon-white"></i>
                </button>            
            </div>
        </form>
        <!-- END FORGOT PASSWORD FORM -->
    </div>
    <!-- END LOGIN -->