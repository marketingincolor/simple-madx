import { apiRoot, acfApiRoot } from './config.js';
export default{
	name: 'specialtyProductsHome',
	data() {
		return{
	    taxonomies: [],
	    taxPosts: [],
	    taxonomy: '',
	    postType: 'specialty',
	    taxParentSlug: 'products',
	    taxChildSlug: '',
	    taxParentId: 0,
	    activeItem: '',
	    taxDescription: '',
	    bgImage: ''
		}
	},
	template:`<div id="posts-container">
	            <div class="grid-x">
								<div class="small-12 medium-3 medium-offset-0 cell">
									<ul id="tax-menu" class="tax-menu vertical menu">
								    <li @click="getNewTaxPosts" v-for="(taxonomy,index) in taxonomies.slice(0,3)" v-bind:class="{active: (activeItem == taxonomy.name)}">
								      <a href="#!" v-html="taxonomy.name"></a>
								    </li>
							    </ul>
								</div>
								<div id="all-posts" class="small-12 medium-9 medium-offset-0 cell" :style="{ backgroundImage: 'url(' + bgImage + ')' }">
									<div class="grid-x">
										<div class="medium-12 cell breadcrumbs">
											<h4 class="blue" v-html="activeItem"></h4>
											<p v-html="taxDescription"></p>
											<a @click="queryLink" class="btn-yellow solid">View Product Details</a>
										</div>
									</div>
								</div>
							</div>
						</div>`,
	created (){
		this.getTaxParentId();
	},
	mounted(){
		
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
			    $this.getTaxonomies();
			  }
			)
		},
		getTaxonomies: function(){
			let $this = this;

			axios
			  .get(apiRoot + $this.postType + '-categories?parent=' + $this.taxParentId)
			  .then(function (response) {
			    $this.taxonomies     = response.data;
			    $this.activeItem     = $this.taxonomies[0].name;
			    $this.queryString    = $this.taxonomies[0].name;
			    $this.taxDescription = $this.taxonomies[0].acf.specialty_short_description;
			    $this.bgImage        = $this.taxonomies[0].acf.specialty_background_image;
			    
			    setTimeout($this.replaceRegMark,300)
			  }
			)
		},
		getNewTaxPosts: function(event){
			let $this = this;
			let node = event.target.nodeName.toLowerCase();
			let taxonomyName;

			if (node == 'a') {
				taxonomyName = event.target.innerText.toLowerCase().split(' ').join('-').replace(/<[^>]+>/g, '');
			}else if(node == 'li'){
				taxonomyName = event.target.querySelector('a').innerHTML.toLowerCase().split(' ').join('-').replace(/<[^>]+>/g, '');
			}
			
		  axios.all([
		      axios.get(apiRoot + $this.postType + '?_embed&filter['+ $this.postType +'_taxonomies]=' + taxonomyName),
		      axios.get(apiRoot + $this.postType + '-categories?parent=' + $this.taxParentId)
		    ])
		    .then(axios.spread((postRes, acfRes) => {
		      $this.taxPosts = postRes.data;
		      $this.activeItem = event.target.innerHTML.replace(/<[^>]+>/g, '');
		      acfRes.data.forEach(function(element) {
		      	if(element.name == $this.activeItem){
			        $this.taxDescription = element.acf.specialty_short_description;
			        $this.queryString    = element.name;
			        $this.bgImage        = element.acf.specialty_background_image;
			      }
		      });
		      $this.singlePostActive = false;
		    }));
		},
		queryLink: function(){
			location.href = '/specialty-solutions/products?product=' + this.queryString;
		},
		replaceRegMark: function(){
			let menuItems = document.getElementById('posts-container').querySelectorAll('li a,h4');
			for(let i = 0;i < menuItems.length;i++){
				let str = menuItems[i].innerHTML;
				menuItems[i].innerHTML = str.replace(/®/g,'<sup>®</sup>');
				menuItems[i].innerHTML = str.replace(/™/g,'<sup>™</sup>');
			}
		}
	}
};