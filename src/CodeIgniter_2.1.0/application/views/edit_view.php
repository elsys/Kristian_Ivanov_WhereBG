<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <title>Edit "<?php echo  $venue[0]->name; ?>"</title>
    </head>
    <body>
        <div id="venue">
            <?php
            echo form_open(site_url('edit') . '/edit_action');
            $label_data = array(
                'class' => 'edit_label',
            );
            foreach ($fields as $key => $field) {
                $data = array(
                    'name' => $key,
                    'value' => $venue[0]->$key,
                    'class' => 'edit_field'
                );
                if ($field['edit'] == 1) {
                    switch ($field['type']) {
                        case 'text':
                            $data['cols'] = '30';
                            echo form_label($field['label'], $key, $label_data);
                            echo form_textarea($data);
                            echo'<br>';
                            break;
                        case 'input':
                            $data['maxlength'] = '30';
                            echo form_label($field['label'], $key, $label_data);
                            echo form_input($data);
                            echo'<br>';
                            break;
                    }
                }
            }
            echo form_hidden('id', $venue[0]->id);
            echo form_submit('mysubmit', 'Редактирай');
            echo form_close();
            ?>
        </div>
        <div id="comments">
            <?php
//foreach($comments as $comment)
//    print_r($comment);
            if (!empty($comments)) {
                foreach ($comments as $comment) {
                    print '<div class="comment">';
                    echo form_open(site_url('edit') . '/edit_comment_action');
                    foreach ($commentFields as $key => $field) {
                        if ($field['edit'] == 1) {
                            $data = array(
                                'name' => $key,
                                'value' => $comment->$key,
                                'class' => 'edit_field'
                            );
                            switch ($field['type']) {
                                case 'text':
                                    $data['cols'] = '30';
                                    echo form_label($field['label'], $key, $label_data);
                                    echo form_textarea($data);
                                    echo'<br>';
                                    break;
                                case 'input':
                                    $data['maxlength'] = '30';
                                    echo form_label($field['label'], $key, $label_data);
                                    echo form_input($data);
                                    echo'<br>';
                                    break;
                            }
                        }
                    }
                    echo form_hidden('id', $comment->id);
                    echo form_submit('mysubmit', 'Редактирай');
                    echo form_close();
                    print '</div>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
