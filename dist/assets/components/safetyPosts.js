import { apiRoot, acfApiRoot } from './config.js';
export default {
	name: 'safetyPosts',
	data() {
		return{
	    activeItem: '',
	    safetyPosts: [],
	    safetyPostID: 0,
	    safetySinglePost: [],
	    taxParentSlug: '',
	    getTaxParentId: 0,
	    postType: 'safety'
		}
	},
	template:`<div class="grid-container" id="posts-container">
	            <div class="grid-x grid-margin-x">
								<div class="medium-3 cell">
									<ul id="tax-menu" class="tax-menu vertical menu">
								    <li v-for="post in safetyPosts" v-bind:class="{active: (activeItem == post.title.rendered)}"><a href="#!" @click="getSafetyPostSingle(post.slug)" v-html="post.title.rendered"></a></li>
							    </ul>
								</div>
								<div class="medium-9 cell animated fadeIn" id="single-post" v-if="safetySinglePost.length > 0">
									<div class="grid-x grid-margin-x grid-margin-y">
										<div class="medium-12 cell breadcrumbs">
											<h5 class="breadcrumb-title">{{ taxParentSlug | changeSlug }} > <span v-html="activeItem"></span></h5>
										</div>
										<div class="medium-12 cell module auto-height">
											<img :src="safetySinglePost[0]._embedded['wp:featuredmedia'][0].source_url" :alt="safetySinglePost[0].title.rendered">
											<div class="meta">
												<div class="medium-12 cell">
													<div class="grid-x grid-margin-x grid-margin-y">
														<div class="medium-10 medium-offset-1 cell">
															<h4 class="blue" v-html="safetySinglePost[0].title.rendered"></h4>
															<p class="content" v-html="safetySinglePost[0].content.rendered"></p>
															<div class="grid-x grid-margin-y subhead" v-if="safetySinglePost[0].acf.pdf_link">
																<div class="large-1 medium-2 cell text-center">
																	<i class="fal fa-file-pdf"></i>
																</div>
																<div class="medium-10 cell">
																	<a :href="safetySinglePost[0].acf.pdf_link" target="_blank">Product Brochure</a>
																	<p>Click to download brochure</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>`,
		created (){
			this.getTaxParent(location.href);
		},
		methods:{
			getTaxParent: function(currentURL){
				if (currentURL.includes('anti-intrusion')) {
					this.taxParentSlug = 'anti-intrusion';
				}else if(currentURL.includes('blast-mitigation')){
					this.taxParentSlug = 'blast-mitigation';
				}else if (currentURL.includes('graffiti-mitigation')) {
					this.taxParentSlug = 'graffiti-mitigation';
				}else if (currentURL.includes('natural-disaster-mitigation')) {
					this.taxParentSlug = 'natural-disaster-mitigation';
				}
				this.getSafetyPosts();
			},
			getSafetyPosts: function(){
				let $this = this;

				axios
				  .get(apiRoot + $this.postType)
				  .then(function (response) {
				    for (var i = 0; i < response.data.length; i++) {
				    	if (response.data[i].link.includes($this.taxParentSlug)) {
				    		$this.safetyPosts.push(response.data[i]);
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

				    $this.safetyPosts.sort(compare)
				    $this.activeItem = $this.safetyPosts[0].title.rendered;
				    let slug = $this.safetyPosts[0].slug;
				    $this.getSafetyPostSingle(slug);
				  }
				)
			},
			getSafetyPostSingle: function(postSlug){
				let $this    = this;

				axios
				  .get(apiRoot + $this.postType + '?_embed&slug=' + postSlug)
				  .then(function (response) {
				    $this.safetySinglePost = response.data;
				    $this.activeItem = $this.safetySinglePost[0].title.rendered;
				  }
				)
			}
		}
};