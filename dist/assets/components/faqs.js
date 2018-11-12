import { apiRoot, acfApiRoot } from './config.js';
export default {
	name: 'faqs',
	data() {
		return{
			searchText: '',
	    faqPosts: [],
	    taxonomyName: 'all',
	    postType: 'faq',
	    activeIndex: null,
	    searchPosts: [],
	    taxonomyTerms: []
		}
	},
	template: `<div class="small-10 small-offset-1 cell">
							<form class="subhead" id="faq-search" v-on:submit.prevent="getSearchResults">
								<div class="input-group relative">
								  <span class="input-group-label">
										<select v-model="taxonomyName" v-on:change="getSearchResults">
									    <option value="all">All</option>
									    <option v-for="term in taxonomyTerms" :value="term.slug">{{ term.name }}</option>
									  </select>
								  </span>
								  <input class="input-group-field" type="text" v-model="searchText" v-on:keyup="getSearchResults" placeholder="Start your search">
								  <button type="submit" class="absolute">
								     <i class="fas fa-search"></i>
								  </button>
								</div>
							</form>
							<article id="faq-results">
								<ul class="accordion" data-accordion v-if="faqPosts">
								  <li @click="setActive(post,index)" class="accordion-item" data-accordion-item  :class="{ 'is-active': activeIndex === index }" v-for="(post,index) in faqPosts" :key="post.id">
								    <div class="yellow-triangle"></div><a href="#!" class="accordion-title" v-html="'Q: ' + post.title.rendered"></a>
								    <transition
											name="custom-classes-transition"
									    enter-active-class="animated fadeIn"
									    leave-active-class="animated fadeOut"
								    >
											<div v-if="activeIndex === index"  class="accordion-content" data-tab-content v-html="'A. ' + post.content.rendered"></div>
								    </transition>
								  </li>
								</ul>
								<ul class="accordion" data-accordion v-if="searchPosts">
								  <li @click="setActive(post,index)" class="accordion-item" data-accordion-item  :class="{ 'is-active': activeIndex === index }" v-for="(post,index) in searchPosts" :key="post.id">
								    <div class="yellow-triangle"></div><a href="#!" class="accordion-title" v-html="'Q: ' + post.title.rendered"></a>
								    <transition
											name="custom-classes-transition"
									    enter-active-class="animated fadeIn"
									    leave-active-class="animated fadeOut"
								    >
											<div v-if="activeIndex === index"  class="accordion-content" data-tab-content v-html="'A. ' + post.content.rendered"></div>
								    </transition>
								  </li>
								</ul>
							</article>
					  </div>`,
		created (){
			this.getAllFAQs();
			this.getCategories();
		},
		methods:{
			getAllFAQs: function(){
				let $this = this;

				axios
				  .get(apiRoot + $this.postType + '?per_page=99')
				  .then(function (response) {
				    $this.faqPosts = response.data;
				  }
				)
			},
			getCategories: function(){
				let $this = this;

				axios
				  .get(apiRoot + this.postType + '-categories?per_page=99')
				  .then(function (response) {
				  	response.data.forEach(function(element){
				  		if (element.parent == 0) {
				  			$this.taxonomyTerms.push(element)
				  		}
				  	});
				  }
				)
			},
			setActive: function(post,index){
				// if you click on the current active FAQ, it will close
				// and set activeIndex to null : else set newly clicked
				// FAQ to active
				if (this.activeIndex == index) {
					this.activeIndex = null
				}else{
				  this.activeIndex = index;
				}
			},
			getSearchResults: function(){
				let $this = this;
				if (this.taxonomyName.toLowerCase() == 'all'){

					axios
					  .get(apiRoot + $this.postType + '?search=' + $this.searchText)
					  .then(function (response) {
					    $this.searchPosts = response.data;
					    $this.faqPosts = [];
					  }
					)

				}else{

					axios
					  .get(apiRoot + $this.postType + '?_embed&filter['+ $this.postType +'_taxonomies]=' + $this.taxonomyName.toLowerCase() + '&search=' + $this.searchText)
					  // .get(apiRoot + $this.postType + '?_embed&filter['+ $this.postType +'_taxonomies]')
					  .then(function (response) {
					    $this.searchPosts = response.data;
					    $this.faqPosts = [];
					    console.log(response.data)
					  }
					)
				}
			}
		}
};