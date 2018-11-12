import { apiRoot, acfApiRoot } from './config.js';
export default{
	name: 'findDealerPage',
	data(){
		return{
			googleKey: '',
			zipCode: '',
			zipCodesInRadius: [],
			radius: 25,
			type: ''
		}
	},
	template:
	 `<form action="/dealer-results" method="post" name="find-dealer-form">
			<fieldset>
		    <input name="type" value="automotive" id="radio1" type="radio" v-model="type"><label for="radio1"><i class="fal fa-car"></i><br>Automotive</label>
		    <input name="type" value="architectural" id="radio3" type="radio" v-model="type"><label for="radio3"><i class="fal fa-building"></i><br>Architectural</label>
		    <input name="type" value="safety-security" id="radio4" type="radio" v-model="type"><label for="radio4"><i class="fal fa-shield"></i><br>Safety</label>
		  </fieldset>
		  <br class="hide-for-large">
		  <fieldset class="radius-zip">
		  	<select name="radius">
	  	    <option value="10">Within 10 miles</option>
	  	    <option value="25" selected>Within 25 miles</option>
	  	    <option value="50">Within 50 miles</option>
	  	    <option value="75">Within 75 miles</option>
	  	    <option value="100">Within 100 miles</option>
	  	  </select>
	  	  <div class="zip">
	  	  	<input type="text" placeholder="Zip Code" id="zip" name="zip" maxlength="5" pattern="\\d{5}" required v-model="zipCode">
	  	  	<button type="submit" class="btn-yellow solid"><i class="fas fa-caret-right"></i></button>
	  	  </div>
		  </fieldset>
		  <br class="hide-for-large">
		  <fieldset class="my-location">
		  	<a id="use-location" @click="findLocation" class="yellow"><i class="far fa-location-arrow yellow"></i> &nbsp;Use My Location</a>
		  </fieldset>
		</form>`,
	created(){
		this.getGoogleApiKey();
	},
	mounted(){
		this.validateZip();
	},
	methods:{
		validateZip: function(){
			let form = document.forms['find-dealer-form'];
			let zip  = form.querySelector("#zip");

			zip.addEventListener("invalid", function(){
			  this.setCustomValidity("Zip code must be a 5-digit number");
			});
			zip.addEventListener("input", function(){
			  this.setCustomValidity("");
			});
		},
		zipCodeLookup: function(){
		  this.sendZip(this.zipCode);
		},
		findLocation: function() {
	    if (navigator.geolocation) {
	      navigator.geolocation.getCurrentPosition(this.getPosition);
	    }else{
	      alert("Geolocation is not supported by this browser. Please manually type in your zip code and press Enter");
	    }
		},
		getPosition: function(position) {
			let $this = this;
	    let apiURL = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+ position.coords.latitude +','+ position.coords.longitude +'&key=' + this.googleKey;
	    
  		axios
  		  .get(apiURL)
  		  .then(function (response) {
  	    	$this.zipCode = response.data.results[0].address_components[7].long_name;
  	    	let form = document.forms['find-dealer-form'];
  	    	let zip  = form.querySelector("#zip");

  	    	zip.setCustomValidity("");
  	    	// $this.sendZip($this.zipCode);
  		  }
  		)
		},
		getGoogleApiKey: function(){
			let $this = this;

			axios
			  .get('/google-api-key.php')
			  .then(function (response) {
		    	$this.googleKey = response.data;
			  }
			)
		},
		sendZip: function(zip){
			let $this = this;

		    $.ajax({
    			url: '/wp-content/themes/madx/zip-code-search.php',
    			type: 'POST',
    			data: { type: $this.type, zip: $this.zipCode, radius: $this.radius },
    			dataType: 'json',
    			success:function(data){
    				if (data.error_code) {
    					alert(data.error_msg + ' Please enter a valid zip code');
    				}else{
    					console.log(data.zip_codes);
    				}
    			}
    		});
		},
	}
};