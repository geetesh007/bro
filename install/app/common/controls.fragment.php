<form method="post" id="controls" class="step">
    <input type="hidden" name="_ACTION" value="install">
    <div class="subsection">
        <?php if($Notify) { ?>
            <div class="bg-warning-lt alert"><?php echo $Notify;?></div>
        <?php } ?>
        <div class="subsection">
            <div class="subsection-title">Database connection details:</div>
            <div class="form-group">
                <label class="custom-label">Database Host</label>
                <input type="text" class="form-control" name="db_host" value="" placeholder="Database Host">
            </div>
            <div class="form-group">
                <label class="custom-label">Database Name</label>
                <input type="text" class="form-control" name="db_name" value="" placeholder="Database Name">
            </div>
            <div class="form-group">
                <label class="custom-label">Username</label>
                <input type="text" class="form-control" name="db_username" value="" placeholder="Username">
            </div>
            <div class="form-group">
                <label class="custom-label">Password</label>
                <input type="text" class="form-control" name="db_password" value="" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary next-btn btn-lg px-5 mx-auto" data-next="#controls">Finish Installation</button>
        </div>
    </div>
</form>