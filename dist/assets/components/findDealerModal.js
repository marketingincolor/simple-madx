
export default{
	data() {
		return{
	    dealerName: '',
	    dealerEmail: '',
	    firstName: '',
	    lastName: '',
	    email: '',
	    phone: '',
	    message: '',
	    successMessage: ''
		}
	},
	name: 'findDealerModal',
	template:`<div class="reveal" id="dealer-modal" v-reveal>
							<div class="grid-container">
								<div class="grid-x">
									<div id="modal-content" class="small-10 small-offset-1 cell">
										<h3 class="blue">{{ dealerName }}</h3>
										<aside class="yellow-underline center"></aside>
										<p class="subhead">Please fill out the information below to contact {{ dealerName }} directly</p>
									  <form method="post">
											<div class="grid-x grid-margin-x">
												<div class="medium-6 cell">
													<input v-model="firstName" type="text" name="first_name" placeholder="First Name *" required>
												</div>
												<div class="medium-6 cell">
													<input v-model="lastName" type="text" name="last_name" placeholder="Last Name *" required>
												</div>
												<div class="medium-6 cell">
													<input v-model="email" type="email" name="email" placeholder="Email *" required email>
												</div>
												<div class="medium-6 cell">
													<input v-model="phone" type="number" name="phone" placeholder="Phone Number *" required>
												</div>
												<div class="medium-12 cell">
													<textarea v-model="message" name="message" id="message" cols="20" rows="10" placeholder="Message *" required></textarea>
													<input v-model="dealerEmail" type="hidden" name="dealer_email" value="dealerEmail">
												</div>
												<div class="medium-12 cell">
													<button class="btn-blue solid" type="submit" @click="sendForm">Submit</button>
												</div>
												<div class="medium-12 cell">
													<p>{{ successMessage }}</p>
												</div>
											</div>
									  </form>
									</div>
								</div>
							</div>
						</div>`,
	created(){
		$(document).on('open.zf.reveal', '#dealer-modal[data-reveal]', function(event) {
		  
		});
	},
	mounted(){
		let $this = this;
		$(document).find('a').on('click',function(){
			$this.dealerName  = $(this).parent().data('dealername');
			$this.dealerEmail = $(this).parent().next('.dealer-meta').find('.email').data('dealeremail');
		});
	},
	methods:{
		sendForm: function(event){
			let $this = this;
			event.preventDefault();

	    $.ajax({
  			url: '/wp-content/themes/madx/email-dealer.php',
  			type: 'POST',
  			data: { 
  				firstName: $this.firstName,
  				lastName: $this.lastName,
  				email: $this.email,
  				phone: $this.phone,
  				message: $this.message,
  				dealer_email: $this.dealerEmail
  			},
  			success:function(data){
  				$this.successMessage = data;
  				$('#modal-content').html('<p>'+ $this.dealerName +' has received your message and will respond soon. Thank you!</p>');
  			},
  			error: function(error){
  				alert(error);
  			}
  		});
		}
	}
};