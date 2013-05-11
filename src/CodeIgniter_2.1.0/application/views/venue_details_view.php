<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '131194860335143', // App ID
                    channelUrl : '', // Channel File
                    status     : true, // check login status
                    cookie     : true, // enable cookies to allow the server to access the session
                    xfbml      : true  // parse XFBML
                });

                // Additional initialization code here
            };

            // Load the SDK Asynchronously
            (function(d){
                var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
                js = d.createElement('script'); js.id = id; js.async = true;
                js.src = "//connect.facebook.net/en_US/all.js";
                d.getElementsByTagName('head')[0].appendChild(js);
            }(document));
   
  
        </script>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=131194860335143";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    </head>
    <body>
        <div id="venue">
            <?php
            print '<ul>';
            foreach ($venueDescr as $name => $piece) {
                if ($piece['showUser']) {
                    print '<li>' . $name . '-' . $venue['venue'][0]->$name . '</li>';
                }
            }
            print '</ul>';
            ?>
            <div style="clear:both"></div>
        </div>
        <div id="container">
            <div id="comments">
                <?php
                foreach ($venue['comments']as $comment) {
                    echo '<div class="comment">';
                    if ($comment->approved == 1) {
                        foreach ($commentDescr as $name => $piece) {
                            if ($piece['showUser']) {
                                echo '<div class="comment_part">';
                                print_r($comment->$name);
                                echo '</div>';
                            }
                        }
                    }
                    echo'</div>';
                }

//        print site_url('data_reg_users/one/');
                ?>


            </div>            
            <div id="fb-root"></div>

            <div id="fb">
                <div class="fb-comments" data-href=<?php print current_url(); ?> data-num-posts="2" data-width="800"></div>                    
            </div>
        </div>
        <div style="clear:both"></div>
    </body>
</html>


