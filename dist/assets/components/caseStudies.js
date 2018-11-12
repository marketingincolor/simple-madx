import { apiRoot, acfApiRoot } from './config.js';
export default{
	name: 'caseStudies',
	data() {
		return{
	    taxonomies: [],
	    taxPosts: [],
	    taxonomy: '',
	    postType: '',
	    taxParentSlug: 'case-studies',
	    taxChildSlug: '',
	    taxParentId: 0,
	    singlePost: [],
	    singlePostActive: false,
		}
	},
	template:`<div class="grid-container" id="tax-posts">
	            <div class="grid-x">
								<div class="small-10 small-offset-1 large-12 large-offset-0 cell" v-if="!singlePostActive" id="all-posts">
									<div class="grid-x grid-margin-y">
									  <div class="small-12 medium-10 medium-offset-1 cell case-study-block" v-for="post in taxPosts">
											<div class="grid-x">
												<aside class="large-5 cell case-study-img" :style="{ backgroundImage: 'url(' + post._embedded['wp:featuredmedia'][0].source_url + ')' }"></aside>
												<article class="large-7 cell">
													<p class="industry">{{ post.acf.case_study_industry_type }}</p>
													<h3 class="blue" v-html="post.title.rendered"></h3>
													<p class="excerpt" v-html="post.acf.case_study_excerpt"></p>
													<a @click="getSinglePost(post.id)" class="btn-yellow border">{{ post.acf.case_study_cta_text }}</a>
												</article>
											</div>
										</div>
									</div>
								</div>
								<div class="small-10 small-offset-1 cell" id="single-post" v-if="singlePostActive">
									<div class="grid-x grid-margin-x grid-margin-y">
										<div class="small-12 cell module auto-height animated fadeIn">
											<img :src="singlePost._embedded['wp:featuredmedia'][0].source_url" :alt="singlePost._embedded['wp:featuredmedia'][0].alt_text">
											<div class="meta">
												<div class="grid-x">
													<div class="medium-3 medium-offset-1 cell">
														<p class="industry">Project</p>
														<p class="subhead" v-html="singlePost.acf.case_study_project"></p>
														<p class="industry">Location</p>
														<p class="subhead" v-html="singlePost.acf.case_study_location"></p>
														<p class="industry">Product</p>
														<p class="subhead" v-html="singlePost.acf.case_study_product"></p>
													</div>
													<div class="medium-7 cell">
														<h2 class="blue" style="margin-bottom:30px" v-html="singlePost.title.rendered"></h2>
														<article class="content" v-html="singlePost.content.rendered"></article>
														<div class="grid-x grid-margin-y subhead" v-if="singlePost.acf.case_study_pdf">
															<div class="large-1 medium-2 cell text-center">
																<i class="fal fa-file-pdf" style="font-size:2.875rem;color:#4d7da6"></i>
															</div>
															<div class="medium-10 cell">
																<a :href="singlePost.acf.case_study_pdf" target="_blank">Case Study PDF</a>
																<p>Click to download case study</p>
															</div>
														</div>
														<a class="btn-lt-blue border" @click="scrollToProducts">View Case Studies</a>
													</div>
												</div>
											</div>
									  </div>
									</div>
								</div>
							</div>
						</div>`,
	created (){
		this.getPostType(location.href);
	},
	methods:{
		getPostType: function(currentURL){
			if (currentURL.includes('residential')) {
				this.postType = 'residential';
			}else if(currentURL.includes('commercial')){
				this.postType = 'commercial';
			}else if (currentURL.includes('automotive')) {
				this.postType = 'automotive';
			}else if (currentURL.includes('safety-security')) {
				this.postType = 'safety';
			}else if (currentURL.includes('specialty-solutions')) {
				this.postType = 'specialty';
			}
			this.getTaxParentId();
		},
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
			  .get(apiRoot + $this.postType + '?_embed&filter['+ $this.postType +'_taxonomies]=' + $this.taxParentSlug)
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
			  .get(apiRoot + $this.postType + '?_embed&filter['+ $this.postType +'_taxonomies]=' + taxonomyName)
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