<?php
/**
 * Template Name: Home
 
 */

get_header(); ?>


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

 <div class="shadow_box booking step_1 clearfix " id="booking-process">
            <div class="map-sec">
               
              
                        <div class="input-wrapper row">
                            <div class="tooltip-info">
                                <div class="tooltip-popup to-the-left">
                                    <div class="tooltip-right">
                                        Please enter a public location like an airport (e.g. Schiphol) or a hotel name, or your pickup street number and name here (e.g. Dam. 9, Amsterdam). Then please select one of the listed suggestions.                                    </div>
                                </div>
                            </div>
                            <div class="form-group string optional controls">
                                <label class="string optional control-label col-md-12" for="booking_departure">Pickup location</label>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input autocomplete="off" class="string optional autocomplete-departure-transfer ui-autocomplete-input form-control" id="transfer_departure" name="transfer_departure" placeholder="Address, airport, train station, hotel, ..." size="50" value="" type="text" required>
                                        <span class="input-group-addon"><a href="javascript:void(0);" id="pickup_tip" data-placement="left"><i class="glyphicon glyphicon-info-sign"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-wrapper row">
                            <div class="tooltip-info">
                                <div class="tooltip-popup to-the-left">
                                    <div class="tooltip-right">
                                        Please enter a public location like an airport (e.g. Schiphol) or a hotel name, or your pickup street number and name here (e.g. Dam. 9, Amsterdam). Then please select one of the listed suggestions.                                    </div>
                                </div>
                            </div>
                            <div class="form-group string optional">
                                <label class="string optional control-label col-md-12" for="booking_destination">Destination</label>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input autocomplete="off" class="string optional autocomplete-destination ui-autocomplete-input form-control" id="transfer_destination" name="transfer_destination" placeholder="Address, airport, train station, hotel, ..." size="50" value="" type="text" required>
                                        <span class="input-group-addon"><a href="javascript:void(0);" id="destination_tip" data-placement="left"><i class="glyphicon glyphicon-info-sign"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pac-container" style="display: none; left: 10px;"></div>
                        <div class="form-group optional clearfix row-fluid" style="margin-top: 3px;">
                            <label class="optional control-label date-select" for="booking_starts_at-transfer">Pickup date</label>
                            <div class="controls">
                                <div class="bl-datepicker">
                                    <div class="dateDropdown"></div>
                                    <a class="datepicker_2 pull-left btn btn-default" type="button"><i class="glyphicon glyphicon-calendar"></i></a>
                                    <br /><br />
                                    <div class="input-wrapper row-fluid pull-left" style="margin-top: 3px;">
                                        <label>Time</label><br />
                                        <div class="controls clearfix">
                                            <select class="bl-select-hour form-control pull-left" id="booking_starts_at_transfer_hour" name="booking_starts_at_transfer_hour" style="width:auto; margin-bottom: 3px;">
                                                <option value="00">00 (midnight)</option>
                                                <option value="01">01 (1 am)</option>
                                                <option value="02">02 (2 am)</option>
                                                <option value="03">03 (3 am)</option>
                                                <option value="04">04 (4 am)</option>
                                                <option value="05">05 (5 am)</option>
                                                <option value="06">06 (6 am)</option>
                                                <option value="07">07 (7 am)</option>
                                                <option value="08">08 (8 am)</option>
                                                <option value="09">09 (9 am)</option>
                                                <option value="10">10 (10 am)</option>
                                                <option value="11">11 (11 am)</option>
                                                <option value="12">12 (noon)</option>
                                                <option value="13">13 (1 pm)</option>
                                                <option value="14">14 (2 pm)</option>
                                                <option value="15">15 (3 pm)</option>
                                                <option value="16" selected="selected">16 (4 pm)</option>
                                                <option value="17">17 (5 pm)</option>
                                                <option value="18">18 (6 pm)</option>
                                                <option value="19">19 (7 pm)</option>
                                                <option value="20">20 (8 pm)</option>
                                                <option value="21">21 (9 pm)</option>
                                                <option value="22">22 (10 pm)</option>
                                                <option value="23">23 (11 pm)</option>
                                            </select>
                                            <select class="bl-select-minute form-control pull-left" id="booking_starts_at_transfer_minute" name="booking_starts_at_transfer_minute" style="width:auto; margin-left: 3px; margin-right: 3px; margin-bottom: 3px;">
                                                <option value="00">00</option>
                                                <option value="05">05</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="30">30</option>
                                                <option value="35" selected="selected">35</option>
                                                <option value="40">40</option>
                                                <option value="45">45</option>
                                                <option value="50">50</option>
                                                <option value="55">55</option>
                                            </select>
          <a href="javascript:void(0);" id="time_tip" data-placement="top" class="btn btn-default"><i class="glyphicon glyphicon-info-sign"></i></a>
                                            
                                            <div class="tooltip-time">
                                                <div class="tooltip-popup to-the-right" id="tooltip-time">
                                                    <div class="tooltip-top">
                                                        Please allow for sufficient time after landing to cross the airport and collect your checked luggage, if your ride starts at the airport.                                                    
                                                      </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <!--   <input class="btn btn-success submit-button" name="next" value="Calculate price" type="submit" style="margin-bottom: 10px;"> -->

                      <button onclick="initializeRoute()">Calculate price</button>
              
               <div class="inner-map-text"><p> Map goes here</p>
        
                <div id="map_canvas"></div>
                <div id="type-selector" class="controls">
                    <input type="radio" name="type" id="changetype-all" checked="checked">
                    <label for="changetype-all">All</label>
                    <input type="radio" name="type" id="changetype-establishment">
                    <label for="changetype-establishment">Establishments</label>
                    <input type="radio" name="type" id="changetype-geocode">
                    <label for="changetype-geocode">Geocodes</label>
                </div>
            </div>
            </div>


             <div class="shadow_box step_2 row" id="car-select">

             <div class="inner-map-text">
                <div class="select-info">
                    <h3>Booking details</h3>
                    <!-- details -->
                    <hr />
                    <b>Pickup location:</b> <span class="pull-right"><a class="change_address" href="#">change</a></span>
                    <br />
                    <span id="pick_up_location"></span>
                    <hr />
                    <span id="destination_field">
                        <b>Destination:</b> <span class="pull-right"><a class="change_address" href="#">change</a></span>
                        <br />
                        <span id="destination_location"></span>
                    </span>
                    <hr />
                    <b>Pickup date:</b> <span class="pull-right"><a class="change_address" href="#">change</a></span>
                    <br />
                    <span id="pickup_date"></span>
                    <hr />
                    <span id="duration_field">
                        <b>Duration:</b><br />
                        <span id="duration"></span>
                    </span>
                    <hr />
                    <span id="distance_field">
                        <b>Distance:</b><br />
                        <span id="distance"></span>
                    </span>
                    <span id="route_map">
                        <br /><br />
                        <div id="map_canvas_route"></div>
                    </span>
                </div>
            </div>
   
<?php get_footer(); ?>

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


  

  var mapOptions = {
    center: new google.maps.LatLng(52.3738,4.89093),
    zoom: 7
  };

  var map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);

  var options = {
    componentRestrictions: {country: "nl"}
  };


  

  var types = document.getElementById('type-selector');
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

  var input_1 = document.getElementById('transfer_departure');
  var autocomplete_1 = new google.maps.places.Autocomplete(input_1, options);
  autocomplete_1.bindTo('bounds', map);



  var input_2 = document.getElementById('transfer_destination');
  var autocomplete_2 = new google.maps.places.Autocomplete(input_2, options);
  autocomplete_2.bindTo('bounds', map);

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



      var start = document.getElementById('transfer_departure').value;
      var end = document.getElementById('transfer_destination').value;



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

       calculate_price_transfer(total_distance, time_duration);
       directionsDisplay.setDirections(response);

      document.getElementById('pick_up_location').innerHTML = start;
    
      document.getElementById('destination_location').innerHTML = end;

      }
    });
  }
  calcRoute();
}

function calculate_price_transfer(total_distance, time_duration) {
  //var data
      var price = $('#car_price_' + 77).val();
    var xprice = $('#car_xprice_' + 77).val();
    var start_price = $('#car_start_' + 77).val();
    var km_price = $('#car_km_' + 77).val();
    var minute_price = $('#car_min_' + 77).val();
    var hour_price = $('#car_hour_' + 77).val();
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
    $('.total_fare_' + 77).html('EUR ' + total);
    //fill hidden element total
    $('#car_price_total_' + 77).val(total);
        var price = $('#car_price_' + 80).val();
    var xprice = $('#car_xprice_' + 80).val();
    var start_price = $('#car_start_' + 80).val();
    var km_price = $('#car_km_' + 80).val();
    var minute_price = $('#car_min_' + 80).val();
    var hour_price = $('#car_hour_' + 80).val();
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
    $('.total_fare_' + 80).html('EUR ' + total);
    //fill hidden element total
    $('#car_price_total_' + 80).val(total);
        var price = $('#car_price_' + 83).val();
    var xprice = $('#car_xprice_' + 83).val();
    var start_price = $('#car_start_' + 83).val();
    var km_price = $('#car_km_' + 83).val();
    var minute_price = $('#car_min_' + 83).val();
    var hour_price = $('#car_hour_' + 83).val();
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
    $('.total_fare_' + 83).html('EUR ' + total);
    //fill hidden element total
    $('#car_price_total_' + 83).val(total);
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
    $('.total_fare_' + 92).html('EUR ' + total);
    //fill hidden element total
    $('#car_price_total_' + 92).val(total);
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




<script src="<?php echo get_template_directory_uri(); ?>/js/gmap3.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoUYrsY91qHNpuTrhKDk36Q2e3NVLsEIk&v=3.52&callback=initializeMap&libraries=places&language=en"></script>

    <style type="text/css">
    #map_canvas{
    height: 400px;

    }
    #map_canvas_route{
    height: 600px;
    }
    </style>








