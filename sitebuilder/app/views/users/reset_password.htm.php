<?php $this->layout = 'login' ?>
<?php $this->pageTitle = s('Reset password') ?>

<?php echo $this->form->create('', array(
    'class' => 'form-register default-form',
    'id' => 'FormReset',
    'object' => $user
)) ?>

<fieldset>
    <div class="field-group">
        <div class="form-grid-220 first">
            <?php echo $this->form->input('password', array(
                'label' => s('New password'),
                'class' => 'ui-text',
                'value' => ''
            )) ?>
        </div>

        <div class="form-grid-220 first">
            <?php echo $this->form->input('confirm_password', array(
                'label' => s('Confirm password'),
                'class' => 'ui-text',
                'type' => 'password'
            )) ?>
        </div>
    </div>
</fieldset>

<fieldset class="actions">
    <?php echo $this->form->submit(s('Reset password'), array(
        'class' => 'ui-button large',
        'style' => 'float: left'
    )) ?>
</fieldset>

<?php echo $this->form->close() ?>
