<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
        <link rel="stylesheet" href="/../../assets/css/admin_style.css"/>
        <script type="text/javascript" src="/assets/js/jquery-1.6.1.min.js"> </script>
        <title>Keywords</title>
    </head>
    <body>
        <?php
        echo form_open(site_url('keywords/addType'));

        $type_data = array(
            'name' => 'type',
            'id' => 'type',
            'maxlength' => '20',
            'size' => '20',
        );

        echo form_label('New Type', 'type');
        echo form_input($type_data) . "<br>";

        echo form_submit('mysubmit', 'Add Type');
        echo form_close();



        echo form_open(site_url('keywords/addWord'));
        $word_data = array(
            'name' => 'word',
            'id' => 'word',
            'maxlength' => '20',
            'size' => '20',
        );

        echo form_label('New word', 'word');
        echo form_input($word_data);

//        print'<select name="type" id="type">';
//        foreach ($types as $type) {
//            print '<option value="' . $type->id . '">' . $type->type . '</option>';
//        }
//        print'</select>';

        foreach ($types as $type) {
            echo form_label($type->type, 'type');
            echo form_checkbox('type' . $type->id, $type->id, FALSE);
        }
        echo form_submit('mysubmit', 'Add Word');
        echo form_close();

        echo '<div id="keywords">';

        echo '<div class="keyword_group">';
        echo 'Positive Food Keywords<br/>';
        foreach ($pFood as $id=>$word) {
            print'<a href="' . site_url('keywords/deleteWord/' . $id) . '">' . $word . '</a> <br/>';
        }

        echo '</div> <div class="keyword_group">';
        echo 'Negative Food Keywords<br/>';
        foreach ($nFood as $id=>$word) {
            print'<a href="' . site_url('keywords/deleteWord/' . $id) . '">' . $word . '</a> <br/>';
        }
        echo '</div> <div class="keyword_group">';
        echo 'Positive Service Keywords <br/>';
        foreach ($pService as $id=>$word) {
            print'<a href="' . site_url('keywords/deleteWord/' . $id) . '">' . $word . '</a> <br/>';
        }
        echo '</div> <div class="keyword_group">';
        echo 'Negative Service Keywords <br/>';
        foreach ($nService as $id=>$word) {
            print'<a href="' . site_url('keywords/deleteWord/' . $id) . '">' . $word . '</a> <br/>';
        }
        echo '</div> </div>';
        ?>
        <div style="clear:both"></div>
    </body>
</html>