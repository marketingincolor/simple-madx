import { apiRoot, acfApiRoot } from './config.js';
import findDealerForm from '../components/findDealerForm.js';
export default{
	name: 'filmSelector',
	components: {
		'find-dealer-form': findDealerForm
	},
	data(){
		return{
			glareReduction: 10,
			safetySecurity: 10,
			heatReduction: 10,
			postType: '',
			results: [],
			postData: [],
			premiumPostData: [],
			dialog: false,
			modalTitle: '',
			modalBody: '',
			modalImage: '',
			modalLogo: '',
			modalBrochure: '',
			maskColor: '',
			carSize: '',
			autoSwatches: {
				0: { color: 'rgba(0,0,0,.05)',percent: '90%' },
				1: { color: 'rgba(0,0,0,.2)' ,percent: '75%' },
				2: { color: 'rgba(0,0,0,.25)',percent: '70%' },
				3: { color: 'rgba(0,0,0,.35)',percent: '60%' },
				4: { color: 'rgba(0,0,0,.4)' ,percent: '55%' },
				5: { color: 'rgba(0,0,0,.5)' ,percent: '45%' },
				6: { color: 'rgba(0,0,0,.6)' ,percent: '35%' },
				7: { color: 'rgba(0,0,0,.65)',percent: '30%' },
				8: { color: 'rgba(0,0,0,.75)',percent: '20%' },
				9: { color: 'rgba(0,0,0,.8)' ,percent: '15%' },
				10:{ color: 'rgba(0,0,0,.85)',percent: '10%' },
				11:{ color: 'rgba(0,0,0,.9)' ,percent: '5%'  }
			},
		}
	},
	template:
	 `<div id="film-container">
		  <div class="grid-x grid-margin-x grid-margin-y">
				<div class="small-12 cell relative warning-parent">
					<i class="fas fa-info-circle absolute"></i>
					<div class="grid-x warning-child">
						<div class="small-12 cell">
							<p>For information on tint laws in the United States and Canada, refer to the International Window Film Association <a href="http://www.iwfa.com/News/StateLawCharts-AutomotiveWindowFilm.aspx" target="_blank">chart here</a>. Consult an authorized Madico window film dealer to find the window film most appropriate to fit your autmotive needs.</p>
						</div>
					</div>
				</div>
				<div class="medium-5 cell no-print">
					<div class="grid-x grid-margin-x relative">
						<div class="number absolute"><span>1</span></div>
						<div class="small-10 small-offset-1 medium-12 medium-offset-0 cell">
							<h5 class="blue">Heat Reduction</h5>
							<p>Comfortable interior, infared rejection.</p>
						</div>
					</div>
				</div>
				<div class="medium-7 cell flex-column no-print">
		      <div class="slider no-print" v-slider data-initial-start="10" data-end="100">
		        <span class="slider-handle"  data-slider-handle role="slider" tabindex="1"></span>
		        <span class="slider-fill" data-slider-fill></span>
		        <input id="heatInput" type="hidden">
		      </div>
	        <ul class="range-labels no-print">
	          <li>Low Importance</li>
	          <li class="text-center">Medium</li>
	          <li class="text-right">High Importance</li>
	        </ul>
				</div>
				<div class="medium-5 cell no-print">
					<div class="grid-x grid-margin-x relative">
						<div class="number absolute"><span>2</span></div>
						<div class="small-10 small-offset-1 medium-12 medium-offset-0 cell">
							<h5 class="blue">Glare Reduction</h5>
							<p>Block the sun’s UV rays and reduce the fading of vehicle’s interior.</p>
						</div>
					</div>
				</div>
				<div class="medium-7 cell flex-column no-print">
		      <div class="slider no-print" v-slider data-initial-start="10" data-end="100">
		        <span class="slider-handle"  data-slider-handle role="slider" tabindex="1"></span>
		        <span class="slider-fill" data-slider-fill></span>
		        <input id="glareInput" type="hidden">
		      </div>
	        <ul class="range-labels no-print">
	          <li>Low Importance</li>
	          <li class="text-center">Medium</li>
	          <li class="text-right">High Importance</li>
	        </ul>
				</div>
				<div class="medium-5 cell no-print">
					<div class="grid-x grid-margin-x relative">
						<div class="number absolute"><span>3</span></div>
						<div class="small-10 small-offset-1 medium-12 medium-offset-0 cell">
							<h5 class="blue">Privacy & Security</h5>
							<p>A wide range of shades offer privacy for you and your passengers and security for valuables inside.</p>
						</div>
					</div>
				</div>
				<div class="medium-7 cell flex-column no-print">
		      <div class="slider no-print" v-slider data-initial-start="10" data-end="100">
		        <span class="slider-handle" data-slider-handle role="slider" tabindex="1"></span>
		        <span class="slider-fill" data-slider-fill></span>
		        <input id="safetyInput" type="hidden">
		      </div>
	        <ul class="range-labels no-print">
	          <li>Low Importance</li>
	          <li class="text-center">Medium</li>
	          <li class="text-right">High Importance</li>
	        </ul>
				</div>
				<div class="medium-12 cell no-print">
					<div class="grid-x grid-margin-x relative">
						<div class="number absolute"><span>4</span></div>
						<div class="small-10 small-offset-1 medium-12 medium-offset-0 cell">
							<h5 class="blue">Appearance</h5>
							<p>Madico window film is offered in a variety of styles and hues, giving you the freedom to design as bold or as subtle as you’d like.</p>
						</div>
					</div>
				</div>
				<div class="medium-12 cell no-print">
					<div class="grid-x grid-margin-x grid-margin-y">
						<div class="small-10 small-offset-1 medium-12 medium-offset-0 cell appearance">
							<div class="film-image">
								<img id="car-original" src="/wp-content/themes/madx/dist/assets/images/film-selector-car.png">
								<div id="mask" :style="{backgroundColor: maskColor,height: this.carSize}"></div>
								<img id="car-transparent" src="/wp-content/themes/madx/dist/assets/images/film-selector-car-transparent.png">
							</div>
							<ul class="film-colors">
								<li v-for="(swatch,index) in autoSwatches">
									<div class="color-swatch" @click="changeSwatch" :style="{ backgroundColor: swatch.color }"></div>
									<div class="img-wrap" v-bind:class="{ 'active-film':index == 0 }"></div>
								  <p v-bind:class="[index == 0 || index == Object.keys(autoSwatches).length - 1 ? 'outer-percent' : 'middle-percent']">{{ swatch.percent }}</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="medium-12 cell no-print">
					<div class="grid-x grid-margin-x relative">
						<div class="number absolute"><span>5</span></div>
						<div class="small-10 small-offset-1 medium-12 medium-offset-0 cell">
							<h5 class="blue">Find Recommendations for Your Vehicle</h5>
							<hr>
							<div class="grid-x grid-margin-x">
								<div class="large-7 cell recommendation">
									<p>The following recommendations are meant to show a variety of Madico solutions that may meet your needs. Please consult an authorized Madico automotive film dealer to discuss your individual window film needs and to determine the most appropriate film for your vehicle.</p>
								</div>
								<div class="large-5 cell btn-container">
									<p><a @click="getFilms" class="btn-yellow solid">View Results &nbsp;&nbsp;<i class="fas fa-caret-down"></i></a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="medium-12 cell top-results animated fadeIn" v-if="postData.length > 0">
				<hr />
				<div class="grid-x grid-margin-y">
					<div class="medium-7 cell">
						<span class="energy">
							<span><strong>Heat:</strong> {{ heatReduction | importance }}</span>
						</span>
						<span class="glare">
							<span><strong>Glare:</strong> {{ glareReduction | importance }}</span>
						</span>
						<span class="safety">
							<span><strong>Safety:</strong> {{ safetySecurity | importance }}</span>
						</span>
					</div>
					<div class="medium-5 cell text-right">
						<span @click="print" class="no-print print-results"><i class="fal fa-print light-blue"></i>&nbsp;&nbsp;Print List</span>&nbsp;&nbsp;
						<span @click="sendEmail" class="no-print print-results"><i class="fal fa-envelope light-blue"></i>&nbsp;&nbsp;Email List</span>
					</div>
				</div>
				<hr />
				<div class="grid-x grid-margin-y">
					<div class="small-12 cell post-container" v-if="postData.length == 0 && premiumPostData.length == 0">
						<p>No Films match your criteria. Please select something else.</p>
					</div>
					<div class="post-container small-12 cell">
						<div class="grid-x grid-margin-x">
							<div class="medium-12 cell premium-post" v-for="(post,index) in premiumPostData" v-if="premiumPostData.length > 0">
							  <h4 class="blue best-match">Best Match</h4>
								<i class="fas fa-star yellow"></i>&nbsp;&nbsp;&nbsp;<a href="#!" @click.stop="dialog = true;setModalContent(post.id)" v-html="post.title.rendered"></a>
								<p v-html="post.film_description"></p>
							</div>
							<div class="medium-12 cell">
	 							<h4 class="other-headline">Other Products to Consider</h4>
							</div>
							<div class="medium-12 cell other-posts" v-for="(post,index) in postData">
								<i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;<a href="#!" @click.stop="dialog = true;setModalContent(post.id)" v-html="post.title.rendered"></a>
								<p v-html="post.film_description"></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>

			<div class="reveal" id="filmSelectorModal" v-reveal>
	      <div class="grid-container">
	        <div class="grid-x grid-margin-x">
	        	<div class="small-9 medium-6 cell" style="margin-bottom:30px">
							<img :src="modalLogo">
	        	</div>
	        	<div class="small-3 medium-6 cell text-right">
							<span @click="closeModal" style="cursor:pointer"><i class="fas fa-times"></i></span>
	        	</div>
						<div class="medium-6 cell">
							<img :src="modalImage" class="featured-image" style="width:100%">
							<h5 class="blue show-for-medium-only" style="margin-top:20px">Find Dealer</h5>
							<find-dealer-form class="show-for-medium-only"></find-dealer-form>
						</div>
						<div class="medium-6 cell">
							<h4 class="blue" v-html="modalTitle"></h4>
							<p v-html="modalBody"></p>
							<div class="grid-x grid-margin-y" v-if="modalBrochure" style="margin-top:0">
								<div class="small-3 medium-2 large-1 cell pdf-icon">
									<i class="fal fa-file-pdf"></i>
								</div>
								<div class="small-7 medium-10 cell download">
									<a :href="modalBrochure" target="_blank">Download</a>
									<p>Product Brochure</p>
								</div>
								<div class="small-12 cell hide-for-medium-only">
									<h5 class="blue">Find Dealer</h5>
								</div>
							</div>
							<find-dealer-form class="hide-for-medium-only"></find-dealer-form>
						</div>
	        </div>
	      </div>
			</div>
		</div>`,
	created(){
		this.getPostType(location.href);
	},
	mounted(){
		window.addEventListener('resize', this.getCarSize);
	},
	beforeUpdate(){
		this.getCarSize();
	},
	methods:{
		getCarSize: function(){
			this.carSize = $('#car-original').height() + 'px';
		},
		getPostType: function(currentURL){
		  if (currentURL.includes('residential')) {
		  	this.postType = 'residential';
		  }else if (currentURL.includes('automotive')) {
		  	this.postType = 'automotive';
		  }
		},
		changeSwatch: function(event){
			$('.img-wrap').removeClass('active-film');
			$('.middle-percent').css({'display':'none'});
			let $imgWrap = $(event.target).next('div');
			let bgColor  = event.target.style.backgroundColor;
			let $watches = $('.color-swatch');

			$imgWrap.addClass('active-film');
			$imgWrap.next('p').css({'display':'block'});
			this.maskColor = bgColor;
		},
  	getFilms: function(){
  		const $this = this;
  		this.heatReduction  = document.getElementById('heatInput').value;
  		this.glareReduction = document.getElementById('glareInput').value; 
  		let heat   = this.$options.filters.importance(this.heatReduction);
  		let glare  = this.$options.filters.importance(this.glareReduction);

  		
  		axios
	      .get(apiRoot + $this.postType + '?per_page=99')
	      .then(function (response) {
	      	$this.postData = [];
	      	$this.premiumPostData = [];

	      	response.data.forEach(function(post) {
	      		if (post.acf.combinations) {
	      			post.acf.combinations.forEach(function(combination){
	      				if (combination.heat_reduction.indexOf(heat) > -1 && combination.glare_reduction.indexOf(glare) > -1) {
	      					console.log(post)
	      					post.film_description = combination.description;
	      					if (combination.best_match.length > 0) {
	      						$this.premiumPostData.push(post);
	      					}else{
	      						$this.postData.push(post);
	      					}
	      				}
	      			});
	      		}
	      	});
	      }
	    );
  	},
  	setModalContent: function(postID){
  		var $this  = this;
  		axios
	      .get(apiRoot + 'automotive/' + postID + '?_embed')
	      .then(function (response) {
	      	$this.modalTitle    = response.data.title.rendered;
	      	$this.modalBody     = response.data.content.rendered;
	      	$this.modalImage    = response.data.acf.film_selector_product_image;
	      	$this.modalLogo     = response.data.acf.film_selector_product_logo;
	      	$this.modalBrochure = response.data.acf.pdf_link;
	      	$('#filmSelectorModal').foundation('open');
	      }
	    );
  	},
  	sendEmail: function(){
  		let link = "mailto:?subject=Madico%20Film%20Selector%20Results"
  		             + "&body=" + document.getElementsByClassName("post-container")[0].innerText;

  		window.location.href = link;
  	},
  	print: function(){
  		print();
  	},
  	closeModal: function(){
  		$('#filmSelectorModal').foundation('close');
  	}
	},
};