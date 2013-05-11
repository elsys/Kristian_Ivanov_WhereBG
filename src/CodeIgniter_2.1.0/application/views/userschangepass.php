<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
        <link rel="stylesheet" href="/../../assets/css/admin_style.css"/>
        <script type="text/javascript" src="/assets/js/jquery-1.6.1.min.js"> </script>
        <title>Log in</title>
    </head>
    <body>
        <div id="wrapper">
            <div id="change_pass">
                <?php
                echo form_open(site_url('users/change_pass/'));
                $username_data = array(
                    'name' => 'username',
                    'id' => 'username',
                    'maxlength' => '20',
                    'size' => '20',
                );
                $password_data = array(
                    'name' => 'old_pass',
                    'id' => 'old_pass',
                    'maxlength' => '20',
                    'size' => '20',
                );
                $new_password_data = array(
                    'name' => 'new_pass',
                    'id' => 'new_pass',
                    'maxlength' => '20',
                    'size' => '20',
                );

//        $height_data = array(
//            'name' => 'height',
//            'id' => 'height',
//            'maxlength' => '20',
//            'size' => '20',
//        );
                echo form_label('Вашето потребителско име', 'username');
                echo form_input($username_data) . "<br>";
                echo form_label('Вашата парола', 'password');
                echo form_password($password_data) . "<br>";
                echo form_label('Новата Ви парола', 'password');
                echo form_password($new_password_data) . "<br>";

//        echo form_label('Your height', 'height');
//        echo form_input($height_data) . "<br>";

                echo form_submit('mysubmit', 'Промени паролата');
                echo form_close();
                ?>
            </div>
        </div>
    </body>
</html>