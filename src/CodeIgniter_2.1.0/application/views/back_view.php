<html>
    <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type="text/javascript">
            function redirecter(url){
                window.location = url;		
            }
        </script>
        <link rel="stylesheet" href="/../../assets/css/admin_style.css"/>
    </head>
    <body>
        <div id="wrapper">
                    <?php
                    //print_r($visited);
                    print '<select onChange=redirecter(this.value)>';
                    foreach ($visited as $visit) {
                        print '<option (\'' . $visit . '\')>' . $visit . '</a></option>';
                    }
                    print '</select>';
                    ?>                
                </body>
                </html>