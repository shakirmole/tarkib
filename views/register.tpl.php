
<div class='container mt-10'>
	<form class="register-form bg-white p-6 mx-auto border bd-default win-shadow" method="post" <?=createValidator()?> action="<?=url('authenticate','doregister')?>">
		<h2 class="text-light">REGISTER</h2>
		<hr class="thin mt-4 mb-4 bg-white">
		
		<div data-role="wizard" data-cls-help='d-none' data-cls-finish='d-none' data-cls-next='bg-green fg-white' data-cls-prev='bg-green fg-white' data-button-mode="button" data-icon-prev="<span>Prev</span>" data-icon-next="<span>Next</span>">
			<section>
				<div class="page-content p-10">
					<div class='grid'>
						<div class='row'>
							<div class='cell'>
								<h3>Company Details</h3> <br>	
							</div>
						</div>
						<div class='row'>
							<div class='cell'>
								<?=insertTextInput('|Name','company[name]',$company['name'],'firstfocus','Enter the company\'s name','text',1,'required|Name is required')?> <br>
								
								<?=insertTextInput('|Business Nature','company[businessnature]',$company['businessnature'],'','Enter the company\'s business nature','text',1,'required|Business nature is required')?> <br>
								
								<?=insertSelect('','company[businesstype]','','Select the business type',0,0,$bTypes,'name|name','name|'.$company['businesstype'],'required')?><br>
								
								<?=insertTextInput('|Tin No','company[tinno]',$company['tinno'],'tinno','Enter the company\'s tin no','text',1,'required|Tin no is required')?> <br>
								
								<?=insertTextInput('|NSSF Pension Reg No','company[nssfregno]',$company['nssfregno'],'','Enter the company\'s nssf reg no','text',1,'|NSSF Reg no is required')?> <br>

								<?=insertTextInput('|PSSSF Pension Reg No','company[psssfregno]',$company['psssfregno'],'','Enter the company\'s psssf reg no','text',1,'|PSSSF Reg no is required')?> <br>
								
								<label>Pension</label>
								<? if ($company['pension']) { ?>
									<?=insertTextInput('|Pension','',strtoupper($company['pension']),'','Company pension','text',1,'required|Tin no is required','readonly')?>
									<? } else { ?>
									<?=insertRadioInput('NSSF','company[pension]','nssf','pension','Company pension',0,'nssf|'.$company['pension'])?>
									<?=insertRadioInput('PSSSF','company[pension]','psssf','pension','Company pension',0,'psssf|'.$company['pension'])?>
								<? } ?> <br>
								
								<label>Contribution</label>
								<?=insertRadioInput('10-10','company[contribution]','10-10','contribution','Company Client contribution',0,'10-10|'.$company['contribution'])?>
								<?=insertRadioInput('15-5','company[contribution]','15-5','contribution','Company Client contribution',0,'15-5|'.$company['contribution'])?> <br> <br>
							</div>
							<div class='cell'>
								<?=insertTextInput('|Email','company[email]',$company['email'],'','Enter the company\'s email','text',1,'required|Email is required')?> <br>
								
								<?=insertTextInput('|Phone No','company[phoneno]',$company['phoneno'],'','Enter the company\'s phone no','text',1,'required|Phone no is required')?><br>
								
								<?=insertTextInput('|Plot No','company[plotno]',$company['plotno'],'','Enter the company\'s plot','text',1,'required|Plot is required')?> <br>
								
								<?=insertTextInput('|Block No','company[blockno]',$company['blockno'],'','Enter the company\'s block no','text',1,'required|Block no is required')?><br>
								
								<?=insertTextInput('|Postal City','company[postalcity]',$company['postalcity'],'','Enter the company\'s postal city','text',1,'required|Postal city is required')?><br>
								
								<?=insertTextInput('|Address','company[address]',$company['address'],'','Enter the company\'s address','text',1,'required|Address is required')?><br>
								
								<?=insertTextInput('|P.O. Box','company[pobox]',$company['pobox'],'','Enter the company\'s P.O. Box','text',1,'required|P.O. Box is required')?>
							</div>
						</div>
					</div>
			
				</div>
			</section>
			<section>
				<div class="page-content p-10">
					<div class='grid'>
						<div class='row'>
							<div class='cell'>
								<h3>Personal Info</h3> <br>
							</div>
						</div>
						<div class='row'>
							<div class='cell'>
								<?=insertTextInput('|Name','accountant[name]',$user['name'],'a-name','Enter your name','text',1,'required|Name is required')?> <br>
								
								<?=insertTextInput('|Mobile','accountant[mobile]',$user['mobile'],'a-mobile','Enter your mobile no','text',1,'required|Mobile no is required')?> <br>
								
								<?=insertTextInput('|Email','accountant[email]',$user['email'],'a-email','Enter your email address','text',1,'required|Email is required')?> <br>
							</div>
							<div class='cell'>
								<?=insertTextInput('|Username','user[username]',$user['username'],'username','Enter your username','text',1,'required|Username is required')?> <br>
								
								<?=insertTextInput('|Password','user[password]',$user['password'],'password','Enter your password','password',1,'required|Password is required')?> <br>

								<?=insertTextInput('|Confirm Password','',$user['password'],'c-password','Enter your password again','password',1,'required compare=user[password]|Password does not match')?> <br>
							</div>
						</div>
						<div class='row'>
							<!-- <div class='cell'>
								<?=insertTextInput('4+3=|Human Verification','hverify',$user['username'],'h-verify','Enter the answer','text',1,'required compare=cverify|Please enter the correct answer')?> <br>
							</div>
							<div class='cell'>
								<?=insertHiddenInput('cverify',7,'cverify');?>
							</div> -->
							<div class='cell'>
								<div class="g-recaptcha" data-sitekey="6LcmUYYUAAAAAIRPp8bYSxYS1q0LwhId8aIi3Nb6"></div>
							</div>
						</div>
					</div>
					
					<div class="form-group text-right ">
						<input type="submit" class="<?=BkgText?> button" value="Register">
					</div>
				</div>
			</section>
		</div>
	</form>
</div>


<script>
	function checkUsername() {
		var usernames = [
		<?php foreach ($usernames as $u) { ?>"<?=trim($u['username'])?>",<?php } ?>
		];
		var username = $.trim($('.username').val());
		
		if (username) {
			for (i=0;i<usernames.length;i++) {
				if ($.inArray( username, usernames ) >= 0 ) {
					triggerError('Duplicate username - new one assigned');
					var rusername =  username + (1 + Math.floor(Math.random() * 100));
					$('.username').val(rusername).focus();
					break;
					return false;
				}
			}
			return true;
		}
	}
	
	$( function(){
		$(document).on('change blur', '.username', function(){    
			checkUsername();
		})

		$('.tinno').inputmask('999999999');
	})
</script>