<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\Admin\AdminMainController;
    use App\Http\Controllers\Manager\ManagerMainController;
    use App\Http\Controllers\Employee\EmployeeMainController;

    Auth::routes();

    Route::redirect('/', 'login');
    Route::redirect('/home', 'admin');

    // --------------------------------------------------------------admin------------------------------------------

    Route::controller(AdminMainController::class)->prefix('admin')->middleware(['auth', 'useraccess:1'])->group(function () {
    
        Route::get('/',                      'dashboard');

        Route::get('/employee/list',                'employee');
        Route::get('/employee/add',                 'add_employee');
        Route::post('/employee/store',              'store_employee');
        Route::get('/employee/edit/{id}',           'edit_employee')->name('edit-employee');
        Route::post('/employee/update/{id}',        'update_employee');
        Route::get('employee/delete/{id}',          'emp_delete')->name('delete-employee');
        Route::get('/employee/report/{id}',         'employee_report')->name('report-employee');
        

        Route::get('/team/list',                    'team');
        Route::get('/team/add',                     'add_team');
        Route::post('/team/store',                  'store_team');
        Route::get('/team/edit/{id}',               'edit_team')->name('edit-team');
        Route::post('/team/update/{id}',            'update_team');
        Route::get('team/delete/{id}',              'team_delete')->name('delete-team');
        Route::get('/team/members/{id}',            'members')->name('team-members');

        Route::get('/project/list',                'project');
        Route::get('/project/add',                 'add_project');
        Route::post('/project/store',              'store_project');
        Route::get('/project/edit/{id}',           'edit_project')->name('edit-project');
        Route::post('/project/update/{id}',        'update_project');
        Route::get('project/delete/{id}',          'project_delete')->name('delete-project');

        Route::get('/report/list',                'daily_report');
        Route::get('/reports/{date?}',            'reports');
        Route::get('/report/add',                 'add_report');
        Route::post('/report/store',              'store_report');
        Route::get('/report/edit/{id}',           'edit_report')->name('edit-manager-report');
        Route::post('/report/update/{id}',        'update_report');
        Route::get('report/delete/{id}',          'emp_delete')->name('delete-manager-report');

        Route::get('/chat/list',                  'chat');
        Route::get('/chat/contacts',              'get_contacts')->name('admin_get_contacts');
        Route::get('/chat/messages/{id}',         'get_messages')->name('admin_get_messages');
        Route::post('/chat/send/message',         'send_messages')->name('admin_send_message');

    });


    // ------------------------------------------------------------------manager-------------------------------------


    Route::controller(ManagerMainController::class)->prefix('manager')->middleware(['auth', 'useraccess:2'])->group(function () {
    
        Route::get('/','dashboard');
        Route::get('/report/list',                'report');
        Route::get('/report/add',                 'add_report');
        Route::post('/report/store',              'store_report')->name('manager_store_report');
        Route::get('/report/edit/{id}',           'edit_report')->name('manager-edit-report');
        Route::post('/report/update/{id}',        'update_report');

        Route::get('/report/daily',                'daily_report');
        Route::get('/reports/{date?}',            'reports');

        Route::get('/chat/list',                  'chat');
        Route::get('/chat/contacts',              'get_contacts')->name('manager_get_contacts');
        Route::get('/chat/messages/{id}',         'get_messages')->name('manager_get_messages');
        Route::post('/chat/send/message',         'send_messages')->name('manager_send_message');
        
        Route::get('/report/aprrove-report/{id}',           'approve_report');
        Route::get('/report/reject-report/{id}',            'reject_report');
        Route::get('/report/rate-commment/{id}',            'rate_comment_report');
        Route::post('/report/rate-commment/{id}',           'rate_comment');

    });


    // -----------------------------------------------------------employee----------------------------------------------


    Route::controller(EmployeeMainController::class)->prefix('employee')->middleware(['auth', 'useraccess:3'])->group(function () {
        Route::get('/','dashboard');
        Route::get('/report/list',                'report');
        Route::get('/report/add',                 'add_report');
        Route::post('/report/store',              'store_report');
        Route::get('/report/edit/{id}',           'edit_report')->name('edit-report');
        Route::post('/report/update/{id}',        'update_report');
        Route::get('report/delete/{id}',          'emp_delete')->name('delete-report');

        Route::get('/chat/list',                  'chat');
        Route::get('/chat/contacts',              'get_contacts')->name('employee_get_contacts');
        Route::get('/chat/messages/{id}',         'get_messages')->name('employee_get_messages');
        Route::post('/chat/send/message',         'send_messages')->name('employee_send_message');

        // Route::redirect('/', '/employee/chat/list');
    });



    Route::get('/logout',function(){
        Auth::logout();
        return redirect('login');
    });

