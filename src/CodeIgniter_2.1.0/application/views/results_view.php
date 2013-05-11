<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>         
        <title>Report</title>
        <?php
            print'Venues found -- '.$foursquareVenues.'<br>';
            print'Comments found by foursquare -- '.$foursquareComments.'<br>';
            print'Comments found by twitter -- '.$twitter.'<br>';
            print'New venues found -- '.$foursquareVenues - $updated.'<br>';
            print'Updated venues found -- '.$updated.'<br>';
        ?>
    </head>
    <body>
        
    </body>
</html>