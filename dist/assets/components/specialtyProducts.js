import { apiRoot, acfApiRoot } from './config.js';
export default{
	name: 'specialtyProducts',
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
	    singlePost: [],
	    singlePostActive: false,
	    benefits: [],
	    pdfLink: '',
	    taxDescription: ''
		}
	},
	template:``,
	created (){
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
			    $this.getTaxonomies();
			  }
			)
		},
		getTaxonomies: function(){
			let $this = this;

			axios
			  .get(apiRoot + $this.postType + '-categories?parent=' + $this.taxParentId)
			  .then(function (response) {
			    $this.taxonomies = response.data;

			    // Check if url has params before setting activeItem
			    let urlParams = new URLSearchParams(window.location.search);
			    if (urlParams.has('product')) {
			    	$this.activeItem = urlParams.get('product').replace(/®/g,'<sup>®</sup>');	
				    $this.getTaxPosts($this.taxonomies[0].description);
			    }else{
				    $this.activeItem = 'All';
				    $this.getAllPosts();
			    }
			  }
			)
		},
		getTaxPosts: function(description){
			let $this = this;
			let taxonomyName = $this.activeItem.toLowerCase().split(' ').join('-');
			
			axios
			  .get(apiRoot + $this.postType + '?_embed&filter['+ $this.postType +'_taxonomies]=' + taxonomyName)
			  .then(function (response) {
			    $this.taxPosts = response.data;
			    $this.taxDescription = description;
			    $this.singlePostActive = false;
			    setTimeout($this.replaceRegMark,300);
			  }
			)
		},
		getNewTaxPosts: function(event){
			let $this = this;
			let taxonomyName = event.target.innerHTML.toLowerCase().split(' ').join('-').replace(/<[^>]+>/g, '');
			
		  axios.all([
		      axios.get(apiRoot + $this.postType + '?_embed&filter['+ $this.postType +'_taxonomies]=' + taxonomyName),
		      axios.get(apiRoot + $this.postType + '-categories?parent=' + $this.taxParentId)
		    ])
		    .then(axios.spread((postRes, acfRes) => {
		      $this.taxPosts = postRes.data;
		      $this.activeItem = event.target.innerHTML;
		      acfRes.data.forEach(function(element) {
		      	if(element.name.replace(/®/g,'<sup>®</sup>') == $this.activeItem)
		        $this.taxDescription = element.description;
		      });
		      $this.singlePostActive = false;
		    }));
		},
		getAllPosts: function(event){
			let $this = this;
			let taxonomyName = event.target.innerHTML.toLowerCase().split(' ').join('-').replace(/<[^>]+>/g, '');
			
		  axios
		    .get(apiRoot + $this.postType + '?_embed&filter['+ $this.postType +'_taxonomies]=' + taxonomyName)
		    .then(function (response) {
		      $this.taxPosts = response.data;
		      $this.taxDescription = description;
		      $this.singlePostActive = false;
		      setTimeout($this.replaceRegMark,300);
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
        scrollTop: $("#posts-container").offset().top
      }, 500, function() {
        $this.singlePostActive = false;
      });
		},
		replaceRegMark: function(){
			let menuItems = document.getElementById('posts-container').querySelectorAll('li a,h4,span');
			for(let i = 0;i < menuItems.length;i++){
				let str = menuItems[i].innerHTML;
				menuItems[i].innerHTML = str.replace(/®/g,'<sup>®</sup>');
			}
		}
	}
};