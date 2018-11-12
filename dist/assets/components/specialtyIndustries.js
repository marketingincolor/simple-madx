import { apiRoot, acfApiRoot } from './config.js';
export default{
	name: 'specialtyTransportation',
	data() {
		return{
	    taxonomies: [],
	    taxPosts: [],
	    taxonomy: '',
	    postType: 'specialty',
	    taxParentSlug: 'industries',
	    taxChildSlug: '',
	    taxParentId: 0,
	    singlePost: [],
	    singlePostActive: false,
		}
	},
	template:`<div class="grid-container small-12" id="tax-posts">
	            <div class="grid-x">
								<div class="small-10 small-offset-1 large-12 large-offset-0 cell" v-if="!singlePostActive" id="all-posts">
									<div class="grid-x grid-margin-x grid-margin-y">
										<div class="large-4 medium-6 cell module auto-height animated fadeIn" v-for="post in taxPosts">
											<a @click="getSinglePost(post.id)"><div class="module-bg" v-bind:style="{backgroundImage: 'url(' + post._embedded['wp:featuredmedia'][0].source_url + ')'}"></div></a>
											<div class="meta">
												<a @click="getSinglePost(post.id)"><h4 class="blue" v-html="post.title.rendered"></h4></a>
												<div class="content">{{ post.acf.specialty_short_description }}</div>
											</div>
										</div>
									</div>
								</div>
								<div class="small-10 small-offset-1 cell" id="single-post" v-if="singlePostActive">
									<div class="grid-x">
										<div class="small-12 cell module auto-height animated fadeIn">
											<img :src="singlePost._embedded['wp:featuredmedia'][0].source_url" :alt="singlePost.title.rendered">
											<div class="meta">
												<div class="medium-12 cell">
													<div class="grid-x grid-margin-x grid-margin-y">
														<div class="small-10 small-offset-1 cell">
															<h4 class="blue" v-html="singlePost.title.rendered"></h4>
															<article class="content" v-html="singlePost.content.rendered"></article>
															<a class="btn-lt-blue border" @click="scrollToProducts"><i class="fal fa-long-arrow-left"></i>&nbsp; Industries</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>`,
	mounted (){
		this.getTaxParentId();
	},
	methods:{
		getTaxParentId: function(){
			let $this = this;

			axios
			  .get(apiRoot + $this.postType + '-categories')
			  .then(function (response) {
			  	for (var i = 0; i < response.data.length; i++) {
			  		if (response.data[i].link.includes($this.taxParentSlug)) {
			  			$this.taxParentId = response.data[i].parent;
			  			break;
			  		}
			  	}
			    $this.getTaxPosts();
			  }
			)
		},
		getTaxPosts: function(){
			let $this = this;
			
			axios
			  .get(apiRoot + $this.postType + '?_embed&orderby=menu_order&order=asc&filter['+ $this.postType +'_taxonomies]=' + $this.taxParentSlug)
			  .then(function (response) {
			    $this.taxPosts = response.data;
			    $this.singlePostActive = false;
			  }
			)
		},
		getNewTaxPosts: function(event){
			let $this = this;
			let taxonomyName = event.target.innerHTML.toLowerCase().split(' ').join('-');
			
			axios
			  .get(apiRoot + $this.postType + '?_embed&orderby=menu_order&order=asc&filter['+ $this.postType +'_taxonomies]=' + taxonomyName)
			  .then(function (response) {
			    $this.taxPosts = response.data;
			    $this.activeItem = event.target.innerHTML;
			    $this.singlePostActive = false;
			  }
			)
		},
		getSinglePost: function(postID){
			let $this = this;

		  axios.all([
		      axios.get(apiRoot + $this.postType + '/' + postID + '?_embed'),
		      axios.get(acfApiRoot + $this.postType + '/' + postID)
		    ])
		    .then(axios.spread((postRes, acfRes) => {
		      $this.singlePost       = postRes.data;
		      $this.benefits         = acfRes.data.acf.film_benefits;
		      $this.pdfLink          = acfRes.data.acf.pdf_link;
		      $this.singlePostActive = true;
		    }));
		},
		scrollToProducts: function(){
			let $this = this;
			
	    $('html, body').animate({
        scrollTop: $("#tax-posts").offset().top - 100
      }, 500, function() {
        $this.singlePostActive = false;
      });
		}
	}
};