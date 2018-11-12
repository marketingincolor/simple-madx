import { apiRoot, acfApiRoot } from './config.js';
export default{
	data() {
		return{
	    activeItem: '',
	    decorativePosts: [],
	    decorativePostID: 0,
	    decorativeSinglePost: [],
	    taxParentSlug: 'decorative',
	    postType: '',
		}
	},
	name: 'decorativePosts',
	template:`<div id="posts-container" class="grid-x grid-margin-x">
							<div class="medium-3 cell">
								<ul id="tax-menu" class="tax-menu vertical menu">
							    <li v-for="post in decorativePosts" v-bind:class="{active: (activeItem == post.title.rendered)}"><a href="#!" @click="getDecorativePostSingle(post.slug)" v-html="post.title.rendered"></a></li>
						    </ul>
							</div>
							<div class="medium-9 cell animated fadeIn" id="single-post" v-if="decorativeSinglePost.length > 0">
								<div class="grid-x grid-margin-x grid-margin-y">
									<div class="medium-12 cell breadcrumbs">
										<h5 class="breadcrumb-title">{{ taxParentSlug | changeSlug }} <i class="fas fa-chevron-right"></i> <span v-html="activeItem"></span></h5>
									</div>
									<div class="medium-12 cell module auto-height">
										<img :src="decorativeSinglePost[0]._embedded['wp:featuredmedia'][0].source_url" :alt="decorativeSinglePost[0]._embedded['wp:featuredmedia'][0].alt_text">
										<div class="meta">
											<div class="medium-12 cell">
												<h4 class="blue" v-html="decorativeSinglePost[0].title.rendered"></h4>
												<p class="content" v-html="decorativeSinglePost[0].content.rendered"></p>
												<div class="grid-x grid-margin-y" v-if="decorativeSinglePost[0].acf.pdf_link">
													<div class="large-1 medium-2 cell text-center">
														<i class="fal fa-file-pdf"></i>
													</div>
													<div class="medium-10 cell">
														<a :href="decorativeSinglePost[0].acf.pdf_link" target="_blank">Product Brochure</a>
														<p>Click to download brochure</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>`,
	mounted(){
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
			this.getDecorativePosts();
		},
		getDecorativePosts: function(){
			let $this = this;

			axios
			  .get(apiRoot + $this.postType)
			  .then(function (response) {
			    for (var i = 0; i < response.data.length; i++) {
			    	if (response.data[i].link.includes($this.taxParentSlug)) {
			    		$this.decorativePosts.push(response.data[i]);
			    	}
			    }
			    // Sort the array by title alphabetically
			    function compare(a, b) {
			      const titleA = a.title.rendered.toUpperCase();
			      const titleB = b.title.rendered.toUpperCase();

			      let comparison = 0;
			      if (titleA > titleB) {
			        comparison = 1;
			      } else if (titleA < titleB) {
			        comparison = -1;
			      }
			      return comparison;
			    }

			    $this.decorativePosts.sort(compare)
			    console.log($this.decorativePosts)
			    $this.activeItem = $this.decorativePosts[0].title.rendered;
			    $this.getDecorativePostSingle($this.decorativePosts[0].slug);
			  }
			)
		},
		getDecorativePostSingle: function(postSlug){
			let $this = this;

			axios
			  .get(apiRoot + $this.postType + '?_embed&slug=' + postSlug)
			  .then(function (response) {
			    $this.decorativeSinglePost = response.data;
			    $this.activeItem = $this.decorativeSinglePost[0].title.rendered;
			  }
			)
		}
	}
};