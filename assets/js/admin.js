// This extends jQuery 'contains' to be case-insensitive for the search in the admin section
$.expr[":"].contains = $.expr.createPseudo(function(arg) {
    return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});
$.validator.addMethod("alphaNumOnly", function(value, element) {
	return this.optional(element) || /^[A-Za-z][a-z0-9\-\s]+$/i.test(value);
}, "Field must contain only letters, numbers, spaces or dashes.");



// Global Variables go here
// These can be referenced anywhere in this file.
// var globalString = 'EXAMPLE';

// Objects go here
// Reference objects and functions by OBJECT.FUNCTION(PARAMETERS);
objGeneral = {

	// Functions go here
	// Reference this function by objGeneral.init();
	init: function(){

		objGeneral.fnTinyMCE();
		objSearch.init();
		objFormFunctionality.init();
		objValidation.init();
		objGeneral.fnBindButtons();
		objSort.fnDragDropSort();
		objSort.fnMemberDragDropSort();
		objGeneral.fnShowAdd();
		objWorkSections.fnSection();
	},

	fnTinyMCE: function(){
		tinymce.init({
			selector: "textarea.TinyMce",
			plugins: [
				"autolink lists link  code preview anchor",
				"searchreplace visualblocks",
				"insertdatetime media paste"
			],
			toolbar: "formatselect fontsizeselect bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link unlink pastetext searchreplace table textcolor | code",
			menubar: false,
			statusbar: false,
			height:150,
			paste_data_images: true,
			relative_urls: false,
			valid_elements : '*[*]'
		});
	},

	fnBindButtons: function(){
		// When delete button is clicked show confirmation
		$('.deleteBtn').click(function(){
			var uuiditem = $(this).data('uuiditem');
			$('.deleteConfirm[data-uuiditem=' + uuiditem + ']').removeClass('hide');
			$('.deleteBtn[data-uuiditem=' + uuiditem + ']').hide();
			$('.deleteConfirm[data-uuiditem=' + uuiditem + '] .deleteNo').click(function(){
				$('.deleteBtn[data-uuiditem=' + uuiditem + ']').show();	
				$('.deleteConfirm[data-uuiditem=' + uuiditem + ']').addClass('hide');
			});
		});

		// Bind tooltips
		$('[data-toggle=tooltip]').tooltip();
	},

	fnShowAdd: function(){
		$(".addWorkTypeButton").click(function(){
		 	$(".addWorkType").show(800);
		});
	}

}

objValidation = {

	init: function(){

		objValidation.fnAddEditWork();

	},

	fnAddEditWork: function(){
		$("#addEditWorkForm").validate({
			rules: {
				title: "required",
				slug: {
					required: true,
					alphaNumOnly: true,
					remote: {
						url: "/admin/work/checkslug",
						type:"post"
					}
				},
				intro: "required",
				workType: "required"
			},
			messages: {
				slug: {
					remote: 'This slug is already in use'
				}
			}
		});
	}

}

objFormFunctionality = {

	init: function(){
		objFormFunctionality.fnLayoutSelector('init', null);
		$('.layoutSelect').click(function(){
			objFormFunctionality.fnLayoutSelector('update',$(this).data('uuid'));
		});
	},

	fnLayoutSelector: function(action, uuidTemplate){
		if(action == 'init'){
			uuidTemplate = $('#uuidTemplate').val();
		}
		$('.layoutSelect').removeClass('selected');
		$('.layoutSelect[data-uuid=' + uuidTemplate + ']').addClass('selected');
		$('#uuidTemplate').val(uuidTemplate);
	}

}

objSearch = {

	init: function(){
		$('#SearchControl').keyup(function(){
			objSearch.fnSearch($(this).val());
		});
	},

	fnSearch: function(searchString){
		$('.itemsWrapper .noItemsFound').hide();
		$(".adminItem").show();
		var matchingProducts = $(".adminItem .itemName:contains('" + searchString + "')").closest('.adminItem');
		$(".adminItem .itemName").not(":contains('" + searchString + "')").closest('.adminItem').hide();
		if (matchingProducts.length == 0){
			$('.itemsWrapper .noItemsFound').show();
		}
	}

}

objSort = {

	fnDragDropSort: function(){
		$(".itemsWrapper").sortable({
			opacity: 0.6, 
         	cursor: 'move',  
			update: function(){
				objSort.fnSave();
			}
		});
	},

	fnSave: function(){
		var order = $(".itemsWrapper").sortable('serialize');
		$.ajax({
			url: "/admin/work/sortGrid",
			method: 'post',
			data: order,
			success: function(){
				
			}
		});
	},

	fnMemberDragDropSort: function(){
		$(".teamMemberWrapper").sortable({
			opacity: 0.6, 
         	cursor: 'move',  
			update: function(){
				objSort.fnMemberSave();
			}
		});
	},

	fnMemberSave: function(){
		var order = $(".teamMemberWrapper").sortable('serialize');
		$.ajax({
			url: "/admin/team/sortGrid",
			method: 'post',
			data: order,
			success: function(){
				
			}
		});
	}

}

objWorkSections = {

	fnSection: function() {
		$('.sectionEdit').find('input[type="radio"]').on('click', function(){
			
			if ($(this).attr("value")=="imageSection1"){
				$(".sectionEdit .videoSection1").hide();
				$(".sectionEdit .imageSection1").show();
			}
			if ($(this).attr("value")=="videoSection1") {
				$(".sectionEdit .imageSection1").hide();
				$(".sectionEdit .videoSection1").show();
			}
			if ($(this).attr("value")=="imageSection2"){
				$(".sectionEdit .videoSection2").hide();
				$(".sectionEdit .imageSection2").show();
			}
			if ($(this).attr("value")=="videoSection2") {
				$(".sectionEdit .imageSection2").hide();
				$(".sectionEdit .videoSection2").show();
			}
			if ($(this).attr("value")=="imageSection3"){
				$(".sectionEdit .videoSection3").hide();
				$(".sectionEdit .imageSection3").show();
			}
			if ($(this).attr("value")=="videoSection3") {
				$(".sectionEdit .imageSection3").hide();
				$(".sectionEdit .videoSection3").show();
			}
		});
	}

}

$(document).ready(function(){

	objGeneral.init(); // Initialize the general object

});