// Global Variables go here
// These can be referenced anywhere in this file.
// var globalString = 'EXAMPLE';

// Objects go here
// Reference objects and functions by OBJECT.FUNCTION(PARAMETERS);
objGeneral = {

	// Functions go here
	// Reference this function by objGeneral.init();
	init: function(){
		objGeneral.fnNav();
		objGeneral.fnBindButtons();
		objValidation.init();
		objCookie.fnCookieCloser();
		objTeamPics.fnRollover();
		if ($('#mapCanvas').length == 1) {
			objMap.fnMap();
		};		
		$('[data-toggle=tooltip]').tooltip();
		objMailchimp.fnMail();
		objSocialLinks.init();
		objAnalytics.init();
	},
	
	fnNav: function(){
		$('.navTitle, .navBtn,.navClose').click(function(){
			if ($('nav').hasClass('navHidden')){
				$('nav').removeClass('navHidden');
			} else {
				$('nav').addClass('navHidden');
			}
		});
	},

	fnBindButtons: function(){
		$('.closeMessage').click(function(){
			$('.messageBox').fadeOut();
		});
		setTimeout(function(){
			$('.messageBox').fadeOut();
		},7000)
		$('.fadeIn').fadeIn();
	}

}

objCookie = {
	fnCookieCloser: function(){
		$('.cookieCloser').click(function(){
			$('.cookieNotification').hide();
		});
		setTimeout(function(){
			$('.cookieNotification').hide();
		}, 15000);
	}
}

objMap = {

	fnMap: function() {
		var myLatlng = new google.maps.LatLng(51.266779,0.072501);
		var mapOptions = {
			zoom: 15,
			minZoom: 6,
			maxZoom: 25,
			zoomControl:true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: false,
			panControl:false,
			mapTypeControl:false,
			mapTypeControlOptions: {				
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
			},
			scaleControl:false,
			streetViewControl:true,
			overviewMapControl:false,
			rotateControl:false,
			disableDoubleClickZoom: true,
			draggable: true,
			styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]
		}
		var map = new google.maps.Map(document.getElementById('mapCanvas'), mapOptions);
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: 'Beyond Local',
			icon: '/assets/images/pin.png'
		});
		var infowindow = new google.maps.InfoWindow({
			content:"<h5 style='margin-bottom:1px; margin-top:5px; font-weight:bold; text-align: center;'><a href='https://www.google.co.uk/maps/dir//Beyond+Local+Ltd,+The+Pheasantry,+Vicarage+Hill,+Westerham+TN16+1FY,+United+Kingdom' target='_blank' style='color:#000;'>Get Directions</a></h5>" // HTML contents of the InfoWindow
		});
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		});
		google.maps.event.addDomListener(window, 'resize', function() { map.setCenter(myLatlng); });
	}

}

objTeamPics = {

	fnRollover: function(){
		$('.person').mouseenter(function(){
			objTeamPics.fnToggleImg($(this).data('name'));
		});
		$('.person').mouseleave(function(){
			objTeamPics.fnToggleImg($(this).data('name'));
		});
		objTeamPics.fnToggleName();
	},

	fnToggleImg: function(name){
		imgObj = $('.person[data-name=' + name + '] img');
		currentImg = $(imgObj).attr('src');
		newImg = $(imgObj).data('imgtoggle');
		$(imgObj).data('imgtoggle',currentImg);
		$(imgObj).attr('src',newImg);
		$('.nameTag[data-name=' + name + ']').toggleClass('active');
	},

	fnToggleName: function(){
		$('.nameTag').mouseenter(function(){
			currentName = $(this).data('name');
			objTeamPics.fnToggleImg(currentName);
		});
		$('.nameTag').mouseleave(function(){
			currentName = $(this).data('name');
			objTeamPics.fnToggleImg(currentName);
		});
	}

}

objValidation = {

	init: function(){
		objValidation.fnValidateContact();
	},

	fnValidateContact: function(){
		$( "#urlForm" ).validate({
			rules: {
				siteURL: {
					required: true
				}
			},
			errorPlacement: function(error, element) {
				error.insertAfter(".siteUrl");
			}
		});

		$('#contactForm').validate({
			rules: {
				name: {
					required: true
	   			},
	   			comments: {
	   				required: true
	   			},
	   			email: {
	   				email: true
	   			}
			}
		});
	}

}

objMailchimp = {
	fnMail: function(){
		$('.mailSignUpForm').submit(function(){
			var email = {
				'email': $("#mce-EMAIL").val()
			};
			$.ajax({
				type: "POST",
				url: "/main/mailchimp",
				data: email,
				cache: false,
				async:false
			});			
			return true;
		});
	}
}

objSocialLinks = {
	init: function() {
		setTimeout(function(){
			$('.socialLinks').fadeIn(2000)
		}, 2000);
	}
}

objAnalytics = {

	init: function(){
		objAnalytics.fnTrackApprenticeGraphicDesignerDownload();
	},

	fnTrackApprenticeGraphicDesignerDownload: function(){
		$('.ApprenticeGraphicDesignerDownload').click(function(){
			_gaq.push(['_trackEvent', 'PDFs', 'Download', 'Apprentice graphic designer job description downloaded']);
		});
	}

}

$(document).ready(function(){

	objGeneral.init(); // Initialize the general object

});