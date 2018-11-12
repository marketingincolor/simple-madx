import { apiRoot, acfApiRoot } from './config.js';
export default{
	name: 'safetyFilmTypes',
	data() {
		return{
			acfPosts: [],
	    imgHeight: 135,
	    metaHeight: {
	    	height: 'auto'
	    }
		}
	},
	template:
	 `<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0">
				<div class="grid-x grid-margin-x grid-margin-y">
					<div class="medium-6 large-3 cell module auto-height text-center" v-for="post in acfPosts">
						<a :href="post.safety_film_link"><img :src="post.safety_film_image" :alt="post.safety_film_title"></a>
						<div class="meta" v-bind:style="metaHeight">
							<a :href="post.safety_film_link"><h4 class="blue">{{ post.safety_film_title }}</h4></a>
							<p class="content">{{ post.safety_film_content }}</p>
							<a :href="post.safety_film_link" class="btn-yellow border">{{ post.safety_film_button_text }}</a>
						</div>
					</div>
				</div>
			</div>
		</div>`,
	created(){
		this.getACFdata();
	},
	mounted(){
		// window.addEventListener('resize', this.getImageHeight);
	},
	updated(){
		// setTimeout(this.getImageHeight(),2000)
	},
	methods: {
		getACFdata: function(){
			let $this = this;

			axios
				// Get page ID in order to get ACF Data
			  .get(apiRoot + 'pages?slug=safety-security')
			  .then(function (response) {
			  	let pageID = response.data[0].id

			  	axios
			  	  .get(acfApiRoot + 'pages/' + pageID)
			  	  .then(function(response){
			  	  	$this.acfPosts = response.data.acf.safety_film_types;
			  	  	console.log($this.acfPosts)
			  	  })
			  }
			)
		},
		getImageHeight: function(){
			this.imgHeight = document.querySelector('.module').querySelector('img').height;
			this.metaHeight.height = 'calc(' + 100 + '% - ' + this.imgHeight + 'px)'
		},
	}
};