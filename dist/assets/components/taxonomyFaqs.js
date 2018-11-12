import { apiRoot, acfApiRoot } from './config.js';
export default {
	props: ['termId'],
	name: 'taxonomyFaqs',
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
							</article>
					  </div>`,
		created (){
			this.getAllFAQs();
		},
		methods:{
			getAllFAQs: function(){
				let $this = this;

				axios
				  .get(apiRoot + $this.postType + '?faq-categories=' + $this.termId + '&per_page=99')
				  .then(function (response) {
				    $this.faqPosts = response.data;
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
		}
};