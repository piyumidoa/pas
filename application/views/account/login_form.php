<div class="container estb-content">
	<div class="row ">
		<div class="col-lg-11">
			<div class="row">
				<div>
					<h1 class="estb-page-header"><?php echo $page_title; ?></h1>
				</div>
			</div>

			<div class="row">
				<?php echo form_open(''.base_url().'index.php/login', array('method' => 'post')); ?>
					<div
						class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
						<label>Username</label> <input type="text" name="username"
							class="form-control"
							value="<?php echo (!empty($username)) ? $username : ''; ?>"> <span
							class="help-block"><?php echo (!empty($username_err)) ? $username_err : ''; ?></span>
					</div>
					<div
						class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
						<label>Password</label> <input type="password" name="password"
							class="form-control"> <span class="help-block"><?php echo (!empty($password_err)) ? $password_err:''; ?></span>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Login">
					</div>
					<!-- <p>
						Don't have an account? <a
							href="<?php echo base_url();?>index.php/signin">Sign up
							now</a>.
					</p> -->
				</form>
			</div>

			</div>
	</div>
</div>
<?php include __DIR__.'/../common/footer.php';?>
