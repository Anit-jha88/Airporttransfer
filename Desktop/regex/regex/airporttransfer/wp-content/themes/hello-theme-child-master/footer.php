<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	if ( did_action( 'elementor/loaded' ) && hello_header_footer_experiment_active() ) {
		get_template_part( 'template-parts/dynamic-footer' );
	} else {
		get_template_part( 'template-parts/footer' );
	}
}
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <div id="map_canvas" style="display:none"></div>

             
<?php wp_footer(); ?>

<script>
//paymethods object
var payMethodsObj = { cash_after:'Cash payment', cc_after:'Payment by creditcard', invoice:'Invoice payment' };
//month array
var monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
//create date vars
var s,
DateWidget = {
    settings: {
    months: monthNames,
    day: new Date().getUTCDate(),
    currMonth: new Date().getUTCMonth(),
    currYear: new Date().getUTCFullYear(),
    yearOffset: 3,
    containers: $(".dateDropdown")
  },
  init: function() {
    s = this.settings;
    DW = this;
    s.containers.each(function() {
      DW.removeFallback(this);
      DW.createSelects(this);
      DW.populateSelects(this);
      DW.initializeSelects(this);
      DW.bindUIActions();
    })
  },
  getDaysInMonth: function(month, year) {
    return new Date(year, month, 0).getDate();
  },
  addDays: function(daySelect, numDays, currentDaySelected) {
    $(daySelect).empty();
    for(var i = 0; i < numDays; i++) {
      if (i + 1 == currentDaySelected) {
        //add attribute
        $("<option selected='selected' />").text(i + 1).val(i + 1).appendTo(daySelect);
      } else {
        $("<option />").text(i + 1).val(i + 1).appendTo(daySelect);
      }
    }
  },
  addMonths: function(monthSelect) {
    for(var i = 0; i < 12; i++) {
      $("<option />").text(s.months[i]).val(s.months[i]).appendTo(monthSelect);
    }
  },
  addYears: function(yearSelect) {
    for(var i = 0; i < s.yearOffset; i++) {
      $("<option />").text(i + s.currYear).val(i + s.currYear).appendTo(yearSelect);
    }
  },
  removeFallback: function(container) {
    $(container).empty();
  },
  createSelects: function(container) {
    $("<select class='day bl-select-day form-control pull-left' name='select_day' style='width:auto; margin-bottom:3px;'>").appendTo(container);
    $("<select class='month bl-select-month form-control pull-left' name='select_month' style='width:90px; margin-left:3px; margin-bottom:3px;'>").appendTo(container);
    $("<select class='year bl-select-year form-control pull-left' name='select_year' style='width:auto; margin-left:3px; margin-right:3px; margin-bottom:3px;'>").appendTo(container);
  },
  populateSelects: function(container) {
    DW.addDays($(container).find('.day'), DW.getDaysInMonth(s.currMonth, s.currYear));
    DW.addMonths($(container).find('.month'));
    DW.addYears($(container).find('.year'));
  },
  initializeSelects: function(container) {
    $(container).find('.day').val(s.day);
    $(container).find('.currMonth').val(s.month);
    $(container).find('.currYear').val(s.year);
  },
  bindUIActions: function() {
    //months
    $(".month").on("change", function() {
      var currentDaySelected = $('.day').val(),
        daySelect = $(this).prev(),
        yearSelect = $(this).next(),
        month = s.months.indexOf($(this).val()) + 1,
        days = DW.getDaysInMonth(month, yearSelect.val());

      // if 31 > 30
      if (currentDaySelected > days) {
        currentDaySelected = 1;
      }
      DW.addDays(daySelect, days, currentDaySelected);
    });
    //years
    $(".year").on("change", function() {
      var currentDaySelected = $('.day').val(),
        daySelect = $(this).prev().prev(),
        monthSelect = $(this).prev(),
        month = s.months.indexOf(monthSelect.val()) + 1,
        days = DW.getDaysInMonth(month, $(this).val());

      // if 31 > 30
      if (currentDaySelected > days) {
        currentDaySelected = 1;
      }
      DW.addDays(daySelect, days, currentDaySelected);
    });
  }
};

//initialize google map
function initializeMap() {




    initAutocomplete();

  var mapOptions = {
    center: new google.maps.LatLng(52.3738,4.89093),
    zoom: 7,

  };

  var map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);

  var options = {



  componentRestrictions: { country: "nl" },
  fields: ["address_components", "geometry", "icon", "name"],

  strictBounds: true,
  types: ["airport",'taxi_stand','tourist_attraction','shopping_mall'],



  
   
    
   
  };





  

  var types = document.getElementById('type-selector');
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

  var input_1 = document.getElementById('transfer_departure');

 

  var autocomplete_1 = new google.maps.places.Autocomplete(input_1, options);
  autocomplete_1.bindTo('bounds', map);



  //var input_2 = document.getElementById('transfer_destination');
  //var autocomplete_2 = new google.maps.places.Autocomplete(input_2, options);
 // autocomplete_2.bindTo('bounds', map);

  var input_3 = document.getElementById('pick_up_departure');
  var autocomplete_3 = new google.maps.places.Autocomplete(input_3, options);
  autocomplete_3.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
  });

  //autocomplete_1 - pickup
  google.maps.event.addListener(autocomplete_1, 'place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete_1.getPlace();
    if (!place.geometry) {
        return;
    }



    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
    } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
    }

    marker.setIcon(/** @type {google.maps.Icon} */ ({
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(35, 35)
    }));

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
  });

  //autocomplete_2 - destination
  google.maps.event.addListener(autocomplete_2, 'place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete_2.getPlace();
    if (!place.geometry) {
        return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
    } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
    }

    marker.setIcon(/** @type {google.maps.Icon} */ ({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));



    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
  });

  //autocomplete_3 = hourly service
  google.maps.event.addListener(autocomplete_3, 'place_changed', function() {

    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete_3.getPlace();
    if (!place.geometry) {
        return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
    } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
    }

    marker.setIcon(/** @type {google.maps.Icon} */ ({
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(35, 35)
    }));

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.



  
}

function initializeRoute() {



  var from =document.getElementById('transfer_departure').value;

  var to =document.getElementById('transfer_destination').value;

  var datefield =document.getElementById('datefild').value;

  var timehr = document.getElementById('booking_starts_at_transfer_hour').value;

  var timemin = document.getElementById('booking_starts_at_transfer_minute').value;

  var returnbooking = document.getElementById('returnvalue');

  var returndate = document.getElementById('datefild2').value;

  var returntimehr = document.getElementsByName("return_booking_starts_at_transfer_hour")[0].value;

  var returntimemin = document.getElementsByName("return_booking_starts_at_transfer_minute")[0].value;
  
   if (returnbooking.checked){
        var bookingstatus='Yes';
    }else{
        var bookingstatus='No';
    }

   if(bookingstatus=='Yes'){



    if(returndate==''){
    
     Swal.fire('Please select Return date');
     
     return false;

    }

   }


  if(from==''){
   Swal.fire('Please select Pickup location');
   document.getElementById('transfer_departure').focus();
   return false;
  }

   if(to==''){
   Swal.fire('Please select Destination location');
   document.getElementById('transfer_destination').focus();
   return false;
  }
   
    var ts = new Date(new Date().getTime() + (12 * 60 * 60 * 1000));
    // var date = new Date(ts);
    let ts_timestamp = ts.getTime();
  

   
   
   var givendate= datefield.split("/"); 

   

  var finalgivendate=givendate[0]+'-'+givendate[1]+'-'+givendate[2]+' '+timehr+':'+timemin;

 
var dateString =finalgivendate,
    dateTimeParts = dateString.split(' '),
    timeParts = dateTimeParts[1].split(':'),
    dateParts = dateTimeParts[0].split('-'),
    date1;

date1 = new Date(new Date(dateParts[2], parseInt(dateParts[1], 10) - 1, dateParts[0], timeParts[0], timeParts[1]));



 
  let date1_timestamp = date1.getTime();


  //alert(ts_timestamp);
  //alert(date1_timestamp);


  if(datefield==''){
   Swal.fire('Please select Pickup date');
   //document.getElementById('datefild').focus();
   return false;
  }


 if(date1_timestamp < ts_timestamp){

 Swal.fire('Please choose another date.');

 return false;
 
 }
  
 

var returngivendate= returndate.split("/"); 




let datepickfinal = new Date(givendate[2], givendate[1], givendate[0]);
let datereturnfinal = new Date(returngivendate[2], returngivendate[1], returngivendate[0]);



if(datepickfinal.getTime() >= datereturnfinal.getTime()){

 Swal.fire('Return date should be greater than pickup date');

 return false;
 
 }


  

 document.getElementById('bookingsection').style.display='block';

 document.getElementById('openmap').style.display='block';


  $('.book-popup').addClass('active');

  var body = document.body;

  body.classList.add("openpopup");


  $('html').css('overflow','hidden');

   

  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var directionsDisplay = new google.maps.DirectionsRenderer();

  var mapOptions = {
    zoom: 5,
    center: new google.maps.LatLng(52.0309054,6.2640176)
  };

  var map_route = new google.maps.Map(document.getElementById('map_canvas_route'),
    mapOptions);
  
  directionsDisplay.setMap(map_route);
  directionsDisplay.setPanel(document.getElementById('directions_panel'));




  function calcRoute() {

   

      var returnbooking = document.getElementById('returnvalue');


      if (returnbooking.checked){
      var bookingstatus='Yes';
      }else{
      var bookingstatus='No';
      }

    



      var start = document.getElementById('transfer_departure').value;
      var end = document.getElementById('transfer_destination').value;
    
      var a = start.includes('Airport');

      if(a==true){

        var airportcharge=15;

      }else{

        var airportcharge=0;

      }

    

      var request = {
      origin: start,
      destination: end,
      provideRouteAlternatives: true,
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC
      };

    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {

       

       //round distance 2 decimals
       var sub_distance = ( response.routes[0].legs[0].distance.value / 1000 );
       var tot_distance = Math.round((sub_distance) * 100) / 100;



       // Display the distance:
       document.getElementById('distance').innerHTML +=
        tot_distance + " KM";

       

       // Display the distance in step4
       //document.getElementById('distance_step4').innerHTML +=
        tot_distance + " KM";

       // Display the distance in step5
       //document.getElementById('distance_step5').innerHTML +=
        tot_distance + " KM";

       var total_distance = response.routes[0].legs[0].distance.value / 1000;



       //round duration 2 decimals
       var sub_duration = ( response.routes[0].legs[0].duration.value / 60 );



       var tot_duration = Math.round((sub_duration) * 100) / 100;

       // Display the duration
       document.getElementById('duration').innerHTML +=
        tot_duration  + " Minutes";

       // Display the duration in step4
       //document.getElementById('duration_step4').innerHTML +=
        tot_duration  + " Minutes";

       // Display the duration in step5
       //document.getElementById('duration_step5').innerHTML +=
        tot_duration + " Minutes";

       var time_duration = response.routes[0].legs[0].duration.value / 60;



       calculate_price_transfer(total_distance, time_duration,airportcharge,bookingstatus);
      
       directionsDisplay.setDirections(response);

      document.getElementById('pick_up_location').innerHTML = start;
    
      document.getElementById('destination_location').innerHTML = end;

      document.getElementById('pickup_date').innerHTML =datefield;

      document.getElementById('pickup_time').innerHTML=timehr+':'+timemin;

      document.getElementById('booking-status').innerHTML=bookingstatus;

      


      }else{

        $('.book-popup').removeClass('active');


        Swal.fire('Please select valid Pickup and dropup location');

        return false;

      }
    });
  }



  calcRoute();
}

function calculate_price_transfer(total_distance, time_duration,airportcharge,bookingstatus) {


  
    var price = $('#car_price_' + 77).val();


    var xprice = $('#car_xprice_' + 77).val();
    var start_price = $('#car_start_' + 77).val();
    var km_price = $('#car_km_' + 77).val();
    var minute_price = $('#car_min_' + 77).val();
    var hour_price = $('#car_hour_' + 77).val();
    //calculate formula taxi

    if(bookingstatus=='Yes') {
     
     if(parseFloat(total_distance)>8){


     

    var didecteddistance= parseFloat(total_distance)-8;

    var didectedtime= parseFloat(time_duration)-15;
    
    var total_price_km = parseFloat(didecteddistance) * parseFloat(km_price);
    var total_price_min = parseFloat(didectedtime) * parseFloat(minute_price);
    var total_price = parseFloat(total_price_km) + parseFloat(total_price_min) + parseFloat(hour_price) + parseFloat(total_price_km) + parseFloat(total_price_min)+ parseFloat(hour_price) +15;
    var total = (Math.round(total_price * 100) / 100).toFixed(2)  ;

   
    }else{
   
   

   var total = (parseFloat(hour_price) + parseFloat(airportcharge))*2 ;

   }


 }else{


  if(parseFloat(total_distance)>8){


     

    var didecteddistance= parseFloat(total_distance)-8;

    var didectedtime= parseFloat(time_duration)-15;
    
    var total_price_km = parseFloat(didecteddistance) * parseFloat(km_price);
    var total_price_min = parseFloat(didectedtime) * parseFloat(minute_price);
    var total_price = parseFloat(total_price_km) + parseFloat(total_price_min) + parseFloat(hour_price) + parseFloat(airportcharge);
    var total = (Math.round(total_price * 100) / 100).toFixed(2) ;

   
    }else{
   
   

   var total = (parseFloat(hour_price) + parseFloat(airportcharge)).toFixed(2); ;

   }



 }




    //show price and car
    $('#car1').html('EUR ' + total);
    //fill hidden element total
    $('#bokingcar1').val(total);
    var price = $('#car_price_' + 80).val();
    var xprice = $('#car_xprice_' + 80).val();
    var start_price = $('#car_start_' + 80).val();
    var km_price = $('#car_km_' + 80).val();
    var minute_price = $('#car_min_' + 80).val();
    var hour_price = $('#car_hour_' + 80).val();

    if(bookingstatus=='Yes') {

     if(parseFloat(total_distance)>8){


    var didecteddistance= parseFloat(total_distance)-8;

    var didectedtime= parseFloat(time_duration)-15;
    
    var total_price_km = parseFloat(didecteddistance) * parseFloat(km_price);
    var total_price_min = parseFloat(didectedtime) * parseFloat(minute_price);
    var total_price = parseFloat(total_price_km) + parseFloat(total_price_min) + parseFloat(hour_price) + parseFloat(total_price_km) + parseFloat(total_price_min)+parseFloat(hour_price)+15;
    var total = (Math.round(total_price * 100) / 100).toFixed(2);


     }else{
   
   var total = (parseFloat(hour_price) + parseFloat(airportcharge)).toFixed(2);

   }

 }else{



     if(parseFloat(total_distance)>8){


    var didecteddistance= parseFloat(total_distance)-8;

    var didectedtime= parseFloat(time_duration)-15;
    
    var total_price_km = parseFloat(didecteddistance) * parseFloat(km_price);
    var total_price_min = parseFloat(didectedtime) * parseFloat(minute_price);
    var total_price = parseFloat(total_price_km) + parseFloat(total_price_min) + parseFloat(hour_price) + parseFloat(airportcharge);
    var total = (Math.round(total_price * 100) / 100).toFixed(2);


     }else{
   
   var total = (parseFloat(hour_price) + parseFloat(airportcharge)).toFixed(2);

   }


 }

    //show price and car
    $('#car2').html('EUR ' + total);
    //fill hidden element total
    $('#bokingcar2').val(total);
        var price = $('#car_price_' + 83).val();
    var xprice = $('#car_xprice_' + 83).val();
    var start_price = $('#car_start_' + 83).val();
    var km_price = $('#car_km_' + 83).val();
    var minute_price = $('#car_min_' + 83).val();
    var hour_price = $('#car_hour_' + 83).val();

    if(bookingstatus=='Yes') {

     if(parseFloat(total_distance)>8){

    var didecteddistance= parseFloat(total_distance)-8;

    var didectedtime= parseFloat(time_duration)-15;

    //calculate formula taxi
    var total_price_km = parseFloat(didecteddistance) * parseFloat(km_price);
    var total_price_min = parseFloat(didectedtime) * parseFloat(minute_price);
    var total_price = parseFloat(total_price_km) + parseFloat(total_price_min) + parseFloat(hour_price) + parseFloat(total_price_km) + parseFloat(total_price_min)+ parseFloat(hour_price) +15;
    var total = (Math.round(total_price * 100) / 100).toFixed(2);

   }else{
   
   var total = (parseFloat(hour_price) + parseFloat(airportcharge)).toFixed(2);

   }
}else{

    if(parseFloat(total_distance)>8){

    var didecteddistance= parseFloat(total_distance)-8;

    var didectedtime= parseFloat(time_duration)-15;

    //calculate formula taxi
    var total_price_km = parseFloat(didecteddistance) * parseFloat(km_price);
    var total_price_min = parseFloat(didectedtime) * parseFloat(minute_price);
    var total_price = parseFloat(total_price_km) + parseFloat(total_price_min) + parseFloat(hour_price) + parseFloat(airportcharge);
    var total = (Math.round(total_price * 100) / 100).toFixed(2);

   }else{
   
   var total = (parseFloat(hour_price) + parseFloat(airportcharge)).toFixed(2);

   }



}

    $('#car3').html('EUR ' + total);
    
    $('#bokingcar3').val(total);
        var price = $('#car_price_' + 92).val();
    var xprice = $('#car_xprice_' + 92).val();
    var start_price = $('#car_start_' + 92).val();
    var km_price = $('#car_km_' + 92).val();
    var minute_price = $('#car_min_' + 92).val();
    var hour_price = $('#car_hour_' + 92).val();
    //calculate formula taxi
    var total_price_km = parseFloat(total_distance) * parseFloat(km_price);
    var total_price_min = parseFloat(time_duration) * parseFloat(minute_price);
    var total_price = parseFloat(start_price) + parseFloat(total_price_km) + parseFloat(total_price_min) + parseFloat(price) + parseFloat(xprice);
    var total = (Math.round(total_price * 100) / 100).toFixed(2);

    //start location
    var start = document.getElementById('transfer_departure').value;
    //schiphol / RAI / Amsterdam centraal / Passengers Terminal Ams / Extra fee
    if( start.match(/rai/i) && start.match(/amsterdam/i) ) {
      // found rai & amsterdam
      total = (parseFloat(total) + 10).toFixed(2);
      console.log('RAI Amsterdam Fee');
    } else if ( start.match(/schiphol/i) ) {
      // found schiphol
      total = (parseFloat(total) + 10).toFixed(2);
      console.log('Schiphol Fee');
    } else if ( start.match(/amsterdam/i) && start.match(/centraal/i) ) {
      // found amsterdam centraal
      total = (parseFloat(total) + 10).toFixed(2);
      console.log('Amsterdam centraal Fee');
    } else if ( (start.match(/passenger/i) && start.match(/terminal/i)) || start.match(/passenger terminal/i) ) {
      // found passengers Terminal
      total = (parseFloat(total) + 10).toFixed(2);
      console.log('Passengers Terminal Fee');
    } else {
      console.log('No extra fee');
    }

    //show price and car
    $('#car4').html('EUR ' + total);
    //fill hidden element total
    $('#bokingcar4').val(total);
    }

function calculate_price_hourly(duration) {
  //var data
  var minutes = (duration / 60);
  var hours = (minutes / 60);

  h = false;
  if (hours != Math.floor(hours)) {
    var h = true;
    hduration = duration - 1800; // minus half hour
    var hminutes = (hduration / 60);
  }
      //data
    var price = $('#car_price_' + 77).val();
    var xprice = $('#car_xprice_' + 77).val();
    var hour_price = $('#car_hour_' + 77).val();
    var half_hour_price = ( parseFloat(hour_price) / 2) + 3.5;

    //check for decimal or number - first caculate the hours
    if( h ) {
      //duration for half hour
      var hminutes = parseFloat(hour_price) / 60;
      var hhours = parseFloat(hminutes) / 60;

      //total price per hour
      var total_price_hourly = ( parseFloat(hduration) * parseFloat(hhours) ) + ( parseFloat(price) + parseFloat(xprice) + parseFloat(half_hour_price) );
      var total = (Math.round(total_price_hourly * 100) / 100).toFixed(2);
      $('.total_fare_' + 77).html('EUR ' + total);
      //fill hidden element total
      $('#car_price_total_' + 77).val(total);
    }
    else {
      //we have whole hours so lets calculate the price with this formula
      var wminutes = parseFloat(hour_price) / 60;
      var whours = parseFloat(wminutes) / 60;
      //total price per hour
      var total_price_hourly = ( parseFloat(duration) * parseFloat(whours) ) + parseFloat(price) + parseFloat(xprice);
      var total = (Math.round(total_price_hourly * 100) / 100).toFixed(2);
      $('.total_fare_' + 77).html('EUR ' + total);
      //fill hidden element total
      $('#car_price_total_' + 77).val(total);
    }
        //data
    var price = $('#car_price_' + 80).val();
    var xprice = $('#car_xprice_' + 80).val();
    var hour_price = $('#car_hour_' + 80).val();
    var half_hour_price = ( parseFloat(hour_price) / 2) + 3.5;

    //check for decimal or number - first caculate the hours
    if( h ) {
      //duration for half hour
      var hminutes = parseFloat(hour_price) / 60;
      var hhours = parseFloat(hminutes) / 60;

      //total price per hour
      var total_price_hourly = ( parseFloat(hduration) * parseFloat(hhours) ) + ( parseFloat(price) + parseFloat(xprice) + parseFloat(half_hour_price) );
      var total = (Math.round(total_price_hourly * 100) / 100).toFixed(2);
      $('.total_fare_' + 80).html('EUR ' + total);
      //fill hidden element total
      $('#car_price_total_' + 80).val(total);
    }
    else {
      //we have whole hours so lets calculate the price with this formula
      var wminutes = parseFloat(hour_price) / 60;
      var whours = parseFloat(wminutes) / 60;
      //total price per hour
      var total_price_hourly = ( parseFloat(duration) * parseFloat(whours) ) + parseFloat(price) + parseFloat(xprice);
      var total = (Math.round(total_price_hourly * 100) / 100).toFixed(2);
      $('.total_fare_' + 80).html('EUR ' + total);
      //fill hidden element total
      $('#car_price_total_' + 80).val(total);
    }
        //data
    var price = $('#car_price_' + 83).val();
    var xprice = $('#car_xprice_' + 83).val();
    var hour_price = $('#car_hour_' + 83).val();
    var half_hour_price = ( parseFloat(hour_price) / 2) + 3.5;

    //check for decimal or number - first caculate the hours
    if( h ) {
      //duration for half hour
      var hminutes = parseFloat(hour_price) / 60;
      var hhours = parseFloat(hminutes) / 60;

      //total price per hour
      var total_price_hourly = ( parseFloat(hduration) * parseFloat(hhours) ) + ( parseFloat(price) + parseFloat(xprice) + parseFloat(half_hour_price) );
      var total = (Math.round(total_price_hourly * 100) / 100).toFixed(2);
      $('.total_fare_' + 83).html('EUR ' + total);
      //fill hidden element total
      $('#car_price_total_' + 83).val(total);
    }
    else {
      //we have whole hours so lets calculate the price with this formula
      var wminutes = parseFloat(hour_price) / 60;
      var whours = parseFloat(wminutes) / 60;
      //total price per hour
      var total_price_hourly = ( parseFloat(duration) * parseFloat(whours) ) + parseFloat(price) + parseFloat(xprice);
      var total = (Math.round(total_price_hourly * 100) / 100).toFixed(2);
      $('.total_fare_' + 83).html('EUR ' + total);
      //fill hidden element total
      $('#car_price_total_' + 83).val(total);
    }
        //data
    var price = $('#car_price_' + 92).val();
    var xprice = $('#car_xprice_' + 92).val();
    var hour_price = $('#car_hour_' + 92).val();
    var half_hour_price = ( parseFloat(hour_price) / 2) + 3.5;

    //check for decimal or number - first caculate the hours
    if( h ) {
      //duration for half hour
      var hminutes = parseFloat(hour_price) / 60;
      var hhours = parseFloat(hminutes) / 60;

      //total price per hour
      var total_price_hourly = ( parseFloat(hduration) * parseFloat(hhours) ) + ( parseFloat(price) + parseFloat(xprice) + parseFloat(half_hour_price) );
      var total = (Math.round(total_price_hourly * 100) / 100).toFixed(2);
      $('.total_fare_' + 92).html('EUR ' + total);
      //fill hidden element total
      $('#car_price_total_' + 92).val(total);
    }
    else {
      //we have whole hours so lets calculate the price with this formula
      var wminutes = parseFloat(hour_price) / 60;
      var whours = parseFloat(wminutes) / 60;
      //total price per hour
      var total_price_hourly = ( parseFloat(duration) * parseFloat(whours) ) + parseFloat(price) + parseFloat(xprice);
      var total = (Math.round(total_price_hourly * 100) / 100).toFixed(2);
      $('.total_fare_' + 92).html('EUR ' + total);
      //fill hidden element total
      $('#car_price_total_' + 92).val(total);
    }
   
    }

//initialize date
DateWidget.init();
</script>




<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/gmap3.min.js"></script>

<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoUYrsY91qHNpuTrhKDk36Q2e3NVLsEIk&v=3.52&callback=initializeMap&libraries=places&language=en&fields=name,icon_mask_base_uri,icon_background_color"></script>-->

<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoUYrsY91qHNpuTrhKDk36Q2e3NVLsEIk&libraries=places&callback=initializeMap">
</script>





    <style type="text/css">
    #map_canvas{
    height: 400px;

    }
    #map_canvas_route{
    height: 600px;
    }
    </style>


    <script>

      function calculateprice(str1,str2){

        document.getElementById('finalprice').value=str1;

        document.getElementById('productid').value=str2;

        document.getElementById('Pickuptime').value=document.getElementById('pickup_time').innerHTML; 

        document.getElementById('Pickuplocation').value=document.getElementById('pick_up_location').innerHTML; 

        document.getElementById('Destination').value=document.getElementById('destination_location').innerHTML; 

        document.getElementById('Pickupdate').value=document.getElementById('pickup_date').innerHTML; 

        document.getElementById('returnbooking').value=document.getElementById('booking-status').innerHTML;

        document.getElementById('returndate').value=document.getElementById('datefild2').value; 

        if(document.getElementById('booking-status').innerHTML=='Yes'){

        var a=document.getElementsByName("return_booking_starts_at_transfer_hour")[0].value+':'+document.getElementsByName("return_booking_starts_at_transfer_minute")[0].value;

         document.getElementById('returntime').value=a;

       }
      
       
       
        

         

        
        
         var form = document.getElementById("form-id");

         form.submit();

         return true;



       
       } 

         function calprice(str){

          


          var price = 0;
          var xprice = 0;
          var start_price = str;
          var km_price = 2.65;
          var minute_price = 0.44;
         // var hour_price = getSelectedValue.value;

          var distance=document.getElementById('distance').innerHTML;

    
           
          var total_distance= distance.split(" ");

          var duration=document.getElementById('duration').innerHTML;
           
          var time_duration= duration.split(" ");

          var total_price_km = parseFloat(total_distance[0]) * parseFloat(km_price);
          var total_price_min = parseFloat(time_duration[0]) * parseFloat(minute_price);
          var total_price = parseFloat(start_price) + parseFloat(total_price_km) + parseFloat(total_price_min) + parseFloat(price) + parseFloat(xprice);
          var total = (Math.round(total_price * 100) / 100).toFixed(2);



         document.getElementById('totalprice').innerHTML='EUR ' + total; 

         document.getElementById('finalprice').value=total; 

         document.getElementById('Pickuplocation').value=document.getElementById('pick_up_location').innerHTML; 

         document.getElementById('Destination').value=document.getElementById('destination_location').innerHTML; 

         document.getElementById('Pickupdate').value=document.getElementById('pickup_date').innerHTML; 

         document.getElementById('Pickuptime').value=document.getElementById('pickup_time').innerHTML; 

         

       }

    </script>




</body>
</html>

<main style="display:none">
<form action="<?php echo get_page_link(1812);?>" method="POST" enctype="multipart/form-data" id="form-id">
    <input type="text" name="demoproduct" placeholder="Name" value="demoproduct" required/>
    <input typoe="text" name="q" placeholder="Quantity" required value="1"/>
    <input type="text" name="price" placeholder="Price" id="finalprice"/>
    <input type="hidden" name="Pickuplocation"  id="Pickuplocation"/>
    <input type="hidden" name="Destination"  id="Destination"/>
    <input type="hidden" name="Pickupdate"  id="Pickupdate"/>
    <input type="hidden" name="Pickuptime"  id="Pickuptime"/>
    <input type="hidden" name="productid" id="productid" />

    <input type="hidden" name="Return-Booking" id="returnbooking" />

    <input type="hidden" name="Return-Date" id="returndate" />

    <input type="hidden" name="Return-Time" id="returntime" />
    
</form>
</main>
<style>
button[name='update_cart'] {
  display: none !important;
}

</style>


<script>

function  initAutocomplete(){

  var mapOptions = {
    center: new google.maps.LatLng(52.3738,4.89093),
    zoom: 7,

  };

  var map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);

  var options2 = {



  componentRestrictions: { country: "nl" },
 
    
   
  };


  var input_2 = document.getElementById('transfer_destination');
  var autocomplete_2 = new google.maps.places.Autocomplete(input_2, options2);
  autocomplete_2.bindTo('bounds', map);


}



</script>

        <div class="maindivforcar" style="display:none">

        <?php
              $prod_arr = new WP_Query(array(
              'post_type' => 'product',
              'posts_per_page' => -1,
             
              'order' => 'ASC'
              ));

              $n=77;

              if($prod_arr->have_posts()): while($prod_arr->have_posts()): $prod_arr->the_post();

        ?>

        <div class="step2 box clearfix" id="car_<?php echo $n; ?>">
        <div class="col-md-8" id="car_photo_<?php echo $n; ?>">
       
        <input name="chosen_car" id="chosen_car" value="" type="hidden">
        <input name="car_start_<?php echo $n; ?>" id="car_start_<?php echo $n; ?>" value="8" type="hidden">
        <input name="car_km_<?php echo $n; ?>" id="car_km_<?php echo $n; ?>" value="<?php echo get_field('vehicle_per_km_price');?>" type="hidden">
        <input name="car_min_<?php echo $n; ?>" id="car_min_<?php echo $n; ?>" value="0.44" type="hidden">
        <input name="car_hour_<?php echo $n; ?>" id="car_hour_<?php echo $n; ?>" value="<?php echo get_field('vehicle_hourly_price');?>" type="hidden">
        <input name="car_price_<?php echo $n; ?>" id="car_price_<?php echo $n; ?>" value="00" type="hidden">
        <input name="car_xprice_<?php echo $n; ?>" id="car_xprice_<?php echo $n; ?>" value="0" type="hidden">
        <input name="car_price_total_<?php echo $n; ?>" id="car_price_total_<?php echo $n; ?>" value="0.00" type="hidden">
        <input name="car_name_<?php echo $n; ?>" id="car_name_<?php echo $n; ?>" value="<?php echo get_the_title();?>" type="hidden">
        <button class="btn btn-inverse to_personal_info" id="<?php echo $n; ?>">choose &amp; continue</button>
        </div>
        </div>

        <?php $n=$n+3; endwhile; endif; wp_reset_query();?>

      

       



        <div class="step2 box clearfix" id="car_92">
        <div class="col-md-8" id="car_photo_92">
        
        <input name="chosen_car" id="chosen_car" value="" type="hidden">
        <input name="car_start_92" id="car_start_92" value="8" type="hidden">
        <input name="car_km_92" id="car_km_92" value="3.44" type="hidden">
        <input name="car_min_92" id="car_min_92" value="0.49" type="hidden">
        <input name="car_hour_92" id="car_hour_92" value="70" type="hidden">
        <input name="car_price_92" id="car_price_92" value="0" type="hidden">
        <input name="car_xprice_92" id="car_xprice_92" value="0" type="hidden">
        <input name="car_price_total_92" id="car_price_total_92" value="0.00" type="hidden">
        <input name="car_name_92" id="car_name_92" value="First Class / VIP" type="hidden">
        <button class="btn btn-inverse to_personal_info" id="92">choose &amp; continue</button>
        </div>
        </div>


        </div>
  
 <script>
   
 function handler(str){
 var selectedText = document.getElementById('datefild').value;
 var selectedDate = new Date(selectedText);
   var now = new Date();
   if (selectedDate < now) {
    Swal.fire("The date you have selected is in the past. Please review your entry.");
    
    document.getElementById('datefild').value='';

   }

 }


	$('#returnvalue').click(function() {
         if(jQuery('input[id=returnvalue]').is(':checked')){
  $('#returncondiction').css("display", "block");
 }else{
    $('#returncondiction').css("display", "none")

 }
    });
	

 </script>

 <style>

#place_order{

  background-color: var( --e-global-color-primary ) !important;
 
}

</style>

<script>
$("#datefild").keydown(function (event) { event.preventDefault(); });
$("#datefild2").keydown(function (event) { event.preventDefault(); });
	jQuery('select').on('change', function() {
 var value = jQuery(this).val();

    if(value=='Yes'){
   
     jQuery("#numberofsuitcase").css("display", "block");

    }else{

        jQuery("#numberofsuitcase").css("display", "none");

        jQuery("#nsuitcase").val('');


    }
});


</script>

<script>

jQuery(document).ready(function() {

    console.log('anit');

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = dd + '/' + mm + '/' + yyyy;
  
  document.getElementById('datefild').placeholder= today;

  document.getElementById('datefild2').placeholder= today;


  } );  

</script>