<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

        <link href="/assets/css/Style.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/colorbox.css" rel="stylesheet" type="text/css"></link>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="/assets/js/jquery.colorbox-min.js" ></script>

        <script>
            $(document).ready(function(){
                //Examples of how to assign the ColorBox event to elements
			
                $(".colorbox").colorbox({width:"80%", height:"80%", iframe:true});
			
                $("#opt_button").click(function() {
                    $('#options').show('slow', function() {
                        // Animation complete.
                    });
                });  
                
                 $("#hide").click(function() {
                    $('#options').hide('slow', function() {
                        // Animation complete.
                    });
                });  
                
               
            });              
            
        </script>

        <script type="text/javascript"
                src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBU0qyx6kq0BR_xOVCvR3rp2p4HMT_Xnqg&sensor=false">
        </script>
        <script type="text/javascript">
             
<?php
print 'var venues=' . $datas . ';';
?>                           
    var map;
    function initialize() {
        
        
        var venueMarkers = new Array();
        var markerTemp=new Array();
        var t=0;
        var sofia_center = new google.maps.LatLng(42.697556, 23.323638);
        var init_marker_infowindow=0; //if the initial marker infowindow is open
        //define init_marker infowindow
        var infowindow = new google.maps.InfoWindow({
            content: "I am at 42.697556 latitude and 23.323638 longitude"
        });
                
       
        var myOptions = {
            center: sofia_center,
            zoom: 18,
            minZoom:12,
            disableDefaultUI: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
                
        //define where bg guy (user marker)
                
        var user_marker_image = new google.maps.MarkerImage(
        '/assets/images/user_marker/marker-images/user_marker.png',
        new google.maps.Size(15,39),
        new google.maps.Point(0,0),
        new google.maps.Point(8,39)
    );

        var user_marker_shadow = new google.maps.MarkerImage(
        '/assets/images/user_marker/marker-images/user_marker_shadow.png',
        new google.maps.Size(39,39),
        new google.maps.Point(0,0),
        new google.maps.Point(8,39)
    );

        var user_marker_shape = {
            coord: [9,0,10,1,10,2,10,3,10,4,10,5,11,6,13,7,14,8,14,9,14,10,14,11,14,12,14,13,14,14,14,15,14,16,14,17,14,18,14,19,14,20,14,21,14,22,11,23,11,24,11,25,11,26,11,27,11,28,11,29,11,30,11,31,11,32,11,33,11,34,11,35,11,36,11,37,10,38,3,38,3,37,3,36,3,35,3,34,3,33,3,32,3,31,3,30,3,29,3,28,3,27,3,26,3,25,3,24,3,23,0,22,0,21,0,20,0,19,0,18,0,17,0,16,0,15,0,14,0,13,0,12,0,11,0,10,0,9,0,8,1,7,2,6,4,5,4,4,3,3,4,2,4,1,5,0,9,0],
            type: 'poly'
        };

        map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);
        
        
        //initial marker- ideal center of Sofia
        var init_marker= new google.maps.Marker({
            position: sofia_center, 
            map: map, 
            title:"Аз съм тук",
            animation:google.maps.Animation.DROP,
            icon: user_marker_image,
            shadow: user_marker_shadow,
            shape: user_marker_shape
        });
              
        //change position of the initial marker
        google.maps.event.addListener(map, 'click', function(event) {                                        
            var venueAdded=false;       
            init_marker.setPosition(event.latLng);
            infowindow.close(map,init_marker);
            var myLatLng = event.latLng;
            var lat = myLatLng.lat();
            var lng = myLatLng.lng();
            infowindow.setContent("I am at "+lat+" latitude and "+lng+" longitude")
            init_marker_infowindow=0;
            init_marker.setAnimation(google.maps.Animation.BOUNCE);            
            $.each(venues, function(i) {  
                var lat_=venues[i].lat;
                var lng_=venues[i].lng;
                if(Number(lat_).toFixed(3)==event.latLng.lat().toFixed(3) && Number(lng_).toFixed(3)==event.latLng.lng().toFixed(3)){
                    addMarker(new google.maps.LatLng(venues[i].lat, venues[i].lng), venues[i].name, venues[i].ID);                    
                    venueAdded=true;       
                }                
            });   
            if(!venueAdded){
                find_closest_marker(event);                       
            }
        });    

        function rad(x) {return x*Math.PI/180;}
        function find_closest_marker( event ) {            
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();
            var R = 6371;
            var distances = [];
            var closest = -1;                        
            for( i=0;i<venues.length; i++ ) {
                var mlat = venues[i].lat;                
                var mlng = venues[i].lng;
                var dLat  = rad(mlat - lat);
                var dLong = rad(mlng - lng);
                var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                    Math.cos(rad(lat)) * Math.cos(rad(lat)) * Math.sin(dLong/2) * Math.sin(dLong/2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                var d = R * c;
                distances[i] = d;
                if ( closest == -1 || d < distances[closest] ) {
                    closest = i;
                }
            }
            addMarker(addMarker(new google.maps.LatLng(venues[closest].lat, venues[closest].lng), venues[closest].name, venues[closest].ID));
        }

        
        function addMarker(location,caption, id_) {                            
            markerTemp[t] = new google.maps.Marker({
                position: location, 
                map: map, 
                title: caption,
                animation:google.maps.Animation.DROP    
            });                        
            
            var temp=markerTemp[t];                         
            google.maps.event.addListener(temp, 'click', function() {                          
                //infowindow.setContent( "<iframe class=\"fb-comments\" src=\"http://localhost/data_reg_users/one/"+id+"\"></iframe>" );
                infowindow.setContent(caption);
                //        $(".example7").colorbox({width:"80%", height:"80%", iframe:true});			
                $.colorbox({href:"http://wherebg.info/data_reg_users/one/"+id_});      
                infowindow.open(map, this);
            });
            t++;   
        }
        
        
        
        
            
        //listener and infowindow for initial marker                
                
        google.maps.event.addListener(init_marker, 'click', function() {
            if(init_marker_infowindow==0)
            {                
                infowindow.open(map, init_marker);
                init_marker_infowindow=1;
            }
        });
                  
                    
  
                
               
    
    }
    function change_map_type(type)
    {
        if(type=='sat'){
            map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
            $('#satellite').css("text-decoration", "underline");
            $('#road').css("text-decoration", "none");
        }else if(type=='road'){
            map.setMapTypeId(google.maps.MapTypeId.ROADMAP);	
            $('#road').css("text-decoration", "underline");
            $('#satellite').css("text-decoration", "none");
        }
    }   
    
    function zoomVal(newValue)
    {
        map.setZoom(Number(newValue));
        document.getElementById("range").innerHTML=newValue;

    }   
    
    function color_select(color)
    {
        if (color=='white')
        {
            $('#overlay_top').css("background-image", "url(/assets/images/overlay.png)");
            $('#overlay_bottom').css("background-image", "url(/assets/images/overlay.png)");
            $('#overlay_left').css("background-image", "url(/assets/images/overlay.png)");
            $('#overlay_right').css("background-image", "url(/assets/images/overlay.png)");
            $('html').css("color", "#000000");
            $('label').css("color", "#000000");
            $('a').css("color", "#000000");
            $('legend').css("color", "#000000");
            $('input').css("color", "#000000");
        }else if (color=='whine')
        {
            $('#overlay_top').css("background-image", "url(/assets/images/overlay_wine.png)");
            $('#overlay_bottom').css("background-image", "url(/assets/images/overlay_wine.png)");
            $('#overlay_left').css("background-image", "url(/assets/images/overlay_wine.png)");
            $('#overlay_right').css("background-image", "url(/assets/images/overlay_wine.png)");
            $('legend').css("color", "#cccccc");
            $('input').css("color", "#cccccc");
            $('label').css("color", "#ffffff");
            $('a').css("color", "#ffffff");
        }else if (color=='green')
        {
            $('#overlay_top').css("background-image", "url(/assets/images/overlay_green.png)");
            $('#overlay_bottom').css("background-image", "url(/assets/images/overlay_green.png)");
            $('#overlay_left').css("background-image", "url(/assets/images/overlay_green.png)");
            $('#overlay_right').css("background-image", "url(/assets/images/overlay_green.png)");
            $('legend').css("color", "#ffffff");
            $('input').css("color", "#cccccc");
            $('a').css("color", "#ffffff");
            $('label').css("color", "#ffffff");
        }
       
    }
          
        </script>
    </head>
    <body onload="initialize()">
        <div id="wrapper">            
            <div id="map_canvas">
            </div>
            <div id="overlay_left">
               
            </div>
            <div id="overlay_right">

            </div>
            <div id="overlay_top">
                 <div id="logo">

                </div>
                <div id="menu">
                    <ul>
                        <li><a href="/data_reg_users/about" class="colorbox" >За Wherebg</a>
                        </li><li><a id="opt_button" href="#">Опции</a>
                        </li>
                    </ul> 
                </div>
                <div id="options">
                    <form id="map_t">
                        <ul>
                            <li>
                                <fieldset>
                                    <legend>Изглед на картата:</legend>
                                    
                                    <label onclick="change_map_type('road');" id="road">пътища</label>                        
                                    <label onclick="change_map_type('sat');" id="satellite">сателит</label>
                                </fieldset>
                            </li><li><fieldset>
                                    <legend>Приближение (12 - 19):</legend>
                                    <input type="range" id="zoom" min="12" max="19" value="18" onchange="zoomVal(this.value)" />
                                    <span id="range">18</span>
                                </fieldset>                                
                            <li><fieldset>
                                    <legend>Цвят:</legend>
                                    <label id="white" onclick="color_select('white');"><img src="/assets/images/overlay_thumb.png"></label>
                                    <label id="green" onclick="color_select('green');"><img src="/assets/images/overlay_green_thumb.png"></label>
                                    <label id="whine" onclick="color_select('whine');"><img src="/assets/images/overlay_wine_thumb.png"></label>
                                </fieldset>
                            </li><li>
                                <a href="#" id="hide">скрий опциите</div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>  
            <div id="overlay_bottom">

            </div>
        </div>

    </body>
</html>