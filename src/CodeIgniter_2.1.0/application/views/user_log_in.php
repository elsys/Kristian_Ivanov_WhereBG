<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
    <link rel="stylesheet" href="/../../assets/css/admin_style.css"/>
<title>Log in</title>
</head>
<body>
    <div id="wrapper">
        <div id="log_in">
    <?php    
    echo form_open(site_url('users/log_in/'));
        $username_data = array(
              'name'        => 'username',
              'id'          => 'username',
              'maxlength'   => '20',
              'size'        => '20',
        );
        $password_data = array(
              'name'        => 'password',
              'id'          => 'password',
              'maxlength'   => '20',
              'size'        => '20',
            );
        echo form_label('Потребителско име', 'username')."<br>";
        echo form_input($username_data)."<br>";
        echo form_label('Парола', 'password')."<br>";
        echo form_password($password_data)."<br>";
        echo form_submit('mysubmit', 'Вход');

    echo form_close();   
    ?>
        </div>
    </div>
</body>
</html>