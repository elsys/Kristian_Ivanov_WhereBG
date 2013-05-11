<html>
    <head>
        <title>Admin Panel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="/assets/css/admin_style.css"/>
    </head>
    <body>
        <div id="search">
            <?php
            echo form_open(site_url('admin/search/'));
            $input = array(
                'name' => 'searched',
                'maxlength' => '10',
            );
            echo form_input($input);
            echo form_submit('mysubmit', 'Търсене');
            echo form_close();
            ?>
        </div>
        <br/>
            <?php
            print '<a href="' . site_url('update') . '">Еднократно обновяване</a>';
            print '<a href="' . site_url('systematic_update') . '">Систематично обновяване</a>';
            print '<a href="' . site_url('users/pre_change') . '">Смяна на паролата </a>';
            print '<a href="' . site_url('keywords') . '">Ключови думи</a>';
            print '<a href="' . site_url('users/add_user') . '">Добави потребител</a>';
            print '<a href="' . site_url('users/log_out') . '">Изход</a>';

            if (!empty($search_))
                $search = $search_;
            print '<table>';

            foreach ($view as $key => $value) {
                if ($value['grid']) {
                    if ((current_url() != site_url('admin') . '/listing/' . $key . '/asc') || (!empty($search) && current_url() != site_url('admin') . '/listing/' . $key . '/asc' . $search)) {
                        print '<th class="' . $value['grid_class'] . '" id="' . $value['grid_id'] . '"> <a href="' . site_url('admin') . '/listing/' . $key . '/asc/">' . $key . '</a> </th>';
                    } else {
                        print '<th class="' . $value['grid_class'] . '" id="' . $value['grid_id'] . '"> <a href="' . site_url('admin') . '/listing/' . $key . '/desc/">' . $key . '</a> </th>';
                    }
                }
            }

            foreach ($datas as $val) {
                print '<tr>';
                foreach ($val as $innerKey => $innerVal) {
                    foreach ($view as $key => $value)
                        if ($innerKey == $key && $value['grid'] == 1) {
                            print '<td class="' . $value['grid_class'] . '" id="' . $value['grid_id'] . '"> <a href="' . site_url('edit') . '/edit_it/' . $val->id . '">' . $innerVal . '</a> </td>';
                        }
                }

                print '</tr>';
            }

            print '</table>';
            ?>
        
        </div>       
    </body>
</html>