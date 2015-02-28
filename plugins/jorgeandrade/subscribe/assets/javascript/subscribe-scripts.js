(function ($){
	navigator.geolocation.getCurrentPosition(success, error);
	function success(position) {
	    var latitude  = position.coords.latitude;
	    var longitude = position.coords.longitude
	    var $lati = $('#latitude');
	    var $lon = $('#longitude');

	    $('#latitude').val(latitude);
		$('#longitude').val(longitude);
	  };

	  function error() {
	    console.log('dont worry proud!');
	  };
})(jQuery)