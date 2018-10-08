<?php
        $api->post('save_token', 'App\\Api\\V1\\Controllers\\Authentication\\LoginController@save_token');


        /*Menus table*/
        $api->get('menu', 'App\\Api\\V1\\Controllers\\MenuController@index');
        $api->post('menu', 'App\\Api\\V1\\Controllers\\MenuController@store');
        $api->get('menu/{id}', 'App\\Api\\V1\\Controllers\\MenuController@show');
        $api->put('menu/{id}', 'App\\Api\\V1\\Controllers\\MenuController@update');
        $api->delete('menu/{id}', 'App\\Api\\V1\\Controllers\\MenuController@destroy');

        /*Logs table*/
        $api->get('logs', 'App\\Api\\V1\\Controllers\\LogsController@index');
        $api->post('logs', 'App\\Api\\V1\\Controllers\\LogsController@store');
        $api->get('logs/{id}', 'App\\Api\\V1\\Controllers\\LogsController@show');
        $api->put('logs/{id}', 'App\\Api\\V1\\Controllers\\LogsController@update');
        $api->delete('logs/{id}', 'App\\Api\\V1\\Controllers\\LogsController@destroy');

        /*Menu Userlevel (permission) table*/
        $api->get('permission', 'App\\Api\\V1\\Controllers\\MenuUserlevelController@index');
        $api->post('permission', 'App\\Api\\V1\\Controllers\\MenuUserlevelController@store');
        $api->get('permission/{id}', 'App\\Api\\V1\\Controllers\\MenuUserlevelController@show');
        $api->put('permission/{id}', 'App\\Api\\V1\\Controllers\\MenuUserlevelController@update');
        $api->delete('permission/{id}', 'App\\Api\\V1\\Controllers\\MenuUserlevelController@destroy');

        /* Settings table*/
        $api->get('setting', 'App\\Api\\V1\\Controllers\\Authentication\\SettingController@index');
        $api->get('setting/{id}', 'App\\Api\\V1\\Controllers\\Authentication\\SettingController@show');
        $api->get('setting_by_option/{option}', 'App\\Api\\V1\\Controllers\\Authentication\\SettingController@by_option');
        $api->get('setting_by_option', 'App\\Api\\V1\\Controllers\\Authentication\\SettingController@by_option');

        /* userlevels table*/
        $api->get('userlevels', 'App\\Api\\V1\\Controllers\\Authentication\\UserlevelController@index');
        $api->post('userlevels', 'App\\Api\\V1\\Controllers\\Authentication\\UserlevelController@store');
        $api->get('userlevels/{id}', 'App\\Api\\V1\\Controllers\\Authentication\\UserlevelController@show');
        $api->put('userlevels/{id}', 'App\\Api\\V1\\Controllers\\Authentication\\UserlevelController@update');
        $api->delete('userlevels/{id}', 'App\\Api\\V1\\Controllers\\Authentication\\UserlevelController@destroy');


        /*User*/
        $api->get('users', 'App\\Api\\V1\\Controllers\\Authentication\\UserController@index');
        $api->get('user_by_dept/{department_id}', 'App\\Api\\V1\\Controllers\\Authentication\\UserController@user_by_dept');
        $api->get('user_by_dept', 'App\\Api\\V1\\Controllers\\Authentication\\UserController@user_by_dept');
        $api->get('user_info/{id}', 'App\\Api\\V1\\Controllers\\Authentication\\UserController@user_info');
        $api->get('office_boy/', 'App\\Api\\V1\\Controllers\\Authentication\\UserController@office_boy');
        $api->post('users', 'App\\Api\\V1\\Controllers\\Authentication\\UserController@store');
        $api->put('users/{id}', 'App\\Api\\V1\\Controllers\\Authentication\\UserController@update');


        /* Department table*/
        $api->get('department', 'App\\Api\\V1\\Controllers\\Masters\\DepartmentController@index');
        $api->post('department', 'App\\Api\\V1\\Controllers\\Masters\\DepartmentController@store');
        $api->get('department/{id}', 'App\\Api\\V1\\Controllers\\Masters\\DepartmentController@show');
        $api->put('department/{id}', 'App\\Api\\V1\\Controllers\\Masters\\DepartmentController@update');
        $api->delete('department/{id}', 'App\\Api\\V1\\Controllers\\Masters\\DepartmentController@destroy');
        $api->get('department_fulllist', 'App\\Api\\V1\\Controllers\\Masters\\DepartmentController@full_list');

        
        /* LeaveType table*/
        $api->get('leavetype', 'App\\Api\\V1\\Controllers\\Masters\\LeaveTypeController@index');
        $api->post('leavetype', 'App\\Api\\V1\\Controllers\\Masters\\LeaveTypeController@store');
        $api->get('leavetype/{id}', 'App\\Api\\V1\\Controllers\\Masters\\LeaveTypeController@show');
        $api->put('leavetype/{id}', 'App\\Api\\V1\\Controllers\\Masters\\LeaveTypeController@update');
        $api->delete('leavetype/{id}', 'App\\Api\\V1\\Controllers\\Masters\\LeaveTypeController@destroy');
        $api->get('leavetype_fulllist', 'App\\Api\\V1\\Controllers\\Masters\\LeaveTypeController@full_list');

        /* Leave table*/
        $api->get('leave', 'App\\Api\\V1\\Controllers\\Operations\\LeaveController@index');
        $api->post('leave', 'App\\Api\\V1\\Controllers\\Operations\\LeaveController@store');
        $api->get('leave/{id}', 'App\\Api\\V1\\Controllers\\Operations\\LeaveController@show');
        $api->get('leave_approve/{id}/{approve}', 'App\\Api\\V1\\Controllers\\Operations\\LeaveController@leave_approve');
        $api->get('leave_approve/{id}', 'App\\Api\\V1\\Controllers\\Operations\\LeaveController@leave_approve');
        $api->delete('leave/{id}', 'App\\Api\\V1\\Controllers\\Operations\\LeaveController@destroy');


        /* Clients table*/
        $api->get('clients', 'App\\Api\\V1\\Controllers\\Operations\\ClientController@index');
        $api->post('clients', 'App\\Api\\V1\\Controllers\\Operations\\ClientController@form');
        $api->get('clients/{id}', 'App\\Api\\V1\\Controllers\\Operations\\ClientController@show');
        $api->delete('clients/{id}', 'App\\Api\\V1\\Controllers\\Operations\\ClientController@destroy');
        $api->get('search_client/{id}', 'App\\Api\\V1\\Controllers\\Operations\\ClientController@search_client');
        $api->get('search_client/', 'App\\Api\\V1\\Controllers\\Operations\\ClientController@search_client');


        /* Master Table Call   */
        $api->get('mastercall_task_form', 'App\\Api\\V1\\Controllers\\Masters\\MasterCallController@task_form');



        

        /* Dashboard */
        $api->get('dashboard/all_data', 'App\\Api\\V1\\Controllers\\Reports\\DashboardController@all_data');
        $api->get('dashboard/dashboard_summary_numbers', 'App\\Api\\V1\\Controllers\\Reports\\DashboardController@dashboard_summary_numbers');


        /* Notification */
        $api->get('notify', 'App\\Api\\V1\\Controllers\\Others\\NotificationController@singleNotification');

?>