
export default {
	name: 'jotForm',
	props:['formId'],
	template: `<div id="jotForm"></div>`,
	mounted (){
		this.createFormScript();
	},
	methods:{
		createFormScript: function(){
			postscribe('#jotForm', '<script src=https://form.jotform.com/jsform/'+this.formId+'><\/script>');
		}
	}
};