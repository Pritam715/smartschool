<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::put('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::get('/profile/changepassword', 'HomeController@changePasswordForm')->name('profile.change.password');
Route::post('/profile/changepassword', 'HomeController@changePassword')->name('profile.changepassword');

Route::group(['middleware' => ['auth','role:Admin']], function () 
{
    Route::get('/roles-permissions', 'RolePermissionController@roles')->name('roles-permissions');
    Route::get('/role-create', 'RolePermissionController@createRole')->name('role.create');
    Route::post('/role-store', 'RolePermissionController@storeRole')->name('role.store');
    Route::get('/role-edit/{id}', 'RolePermissionController@editRole')->name('role.edit');
    Route::put('/role-update/{id}', 'RolePermissionController@updateRole')->name('role.update');

    Route::get('/permission-create', 'RolePermissionController@createPermission')->name('permission.create');
    Route::post('/permission-store', 'RolePermissionController@storePermission')->name('permission.store');
    Route::get('/permission-edit/{id}', 'RolePermissionController@editPermission')->name('permission.edit');
    Route::put('/permission-update/{id}', 'RolePermissionController@updatePermission')->name('permission.update');

    Route::get('assign-subject-to-class/{id}', 'GradeController@assignSubject')->name('class.assign.subject');
    Route::post('assign-subject-to-class/{id}', 'GradeController@storeAssignedSubject')->name('store.class.assign.subject');

    Route::resource('assignrole', 'RoleAssign');
    Route::resource('classes', 'GradeController');
    Route::resource('subject', 'SubjectController');
    Route::resource('teacher', 'TeacherController');
    Route::resource('parents', 'ParentsController');
    Route::resource('student', 'StudentController');
    Route::get('attendance', 'AttendanceController@index')->name('attendance.index');

    
    //FindClass
    Route::get('/findclass','SubjectController@findclass');


    //Setting
    Route::get('setting','SettingController@create')->name('setting.create');
    Route::post('setting/store','SettingController@store')->name('setting.store');
    Route::get('setting/edit','SettingController@edit')->name('setting.edit');
    Route::post('setting/update/{id}','SettingController@update')->name('setting.update');


});

Route::group(['middleware' => ['auth','role:Teacher']], function () 
{
    Route::post('attendance', 'AttendanceController@store')->name('teacher.attendance.store');
    Route::get('attendance-create/{classid}', 'AttendanceController@createByTeacher')->name('teacher.attendance.create');
  
    //Topic
    Route::get('{slug}/subjects/topic','TopicController@index')->name('topic.index'); 
    Route::get('{slug}subjects/topic/create','TopicController@create')->name('topic.create');
    Route::post('subjects/topic/store','TopicController@store')->name('topic.store');
    Route::get('subjects/topic/edit/{id}','TopicController@edit')->name('topic.edit');
    Route::post('subjects/topic/update/{id}','TopicController@update')->name('topic.update');
    Route::get('subjects/topic/delete/{id}','TopicController@delete')->name('topic.delete');

    //FindSubject
    Route::get('/findsubject','TopicController@findSubject');


   //FindTopic
      Route::get('/pdftopic','PdfController@findtopic');

    //Pdf
    Route::get('{slug}/subjects/topic/pdf','PdfController@index')->name('pdf.index'); 
    Route::get('{slug}/subjects/topic/pdf/create','PdfController@create')->name('pdf.create');
    Route::post('subjects/topic/pdf/store','PdfController@store')->name('pdf.store');
    Route::get('subjects/topic/pdf/edit/{id}','PdfController@edit')->name('pdf.edit');
    Route::post('subjects/topic/pdf/update/{id}','PdfController@update')->name('pdf.update');
    Route::get('subjects/topic/pdf/delete/{id}','PdfController@delete')->name('pdf.delete');

    //Terminal Question
    Route::get('{slug}/subjects/topic/terminal_question','TerminalController@index')->name('terminal.index'); 
    Route::get('{slug}/subjects/topic/terminal_question/create','TerminalController@create')->name('terminal.create');
    Route::post('subjects/topic/terminal_question/store','TerminalController@store')->name('terminal.store');
    Route::get('subjects/topic/terminal_question/edit/{id}','TerminalController@edit')->name('terminal.edit');
    Route::post('subjects/topic/terminal_question/update/{id}','TerminalController@update')->name('terminal.update');
    Route::get('subjects/topic/terminal_question/delete/{id}','TerminalController@delete')->name('terminal.delete');
       //FindTopic
       Route::get('/terminaltopic','TerminalController@findtopic');

         //Important Question
    Route::get('{slug}/subjects/topic/important_question','ImportantQuestionController@index')->name('important.index'); 
    Route::get('{slug}/subjects/topic/important_question/create','ImportantQuestionController@create')->name('important.create');
    Route::post('subjects/topic/important_question/store','ImportantQuestionController@store')->name('important.store');
    Route::get('subjects/topic/important_question/edit/{id}','ImportantQuestionController@edit')->name('important.edit');
    Route::post('subjects/topic/importnat_question/update/{id}','ImportantQuestionController@update')->name('important.update');
    Route::get('subjects/topic/important_question/delete/{id}','ImportantQuestionController@delete')->name('important.delete');
  //FindTopic
    Route::get('/importanttopic','ImportantQuestionController@findtopic');


             //Video
             Route::get('{slug}/subjects/topic/video','VideoController@index')->name('video.index'); 
             Route::get('{slug}/subjects/topic/video/create','VideoController@create')->name('video.create');
             Route::post('subjects/topic/video/store','VideoController@store')->name('video.store');
             Route::get('subjects/topic/video/edit/{id}','VideoController@edit')->name('video.edit');
             Route::post('subjects/topic/video/update/{id}','VideoController@update')->name('video.update');
             Route::get('subjects/topic/video/delete/{id}','VideoController@delete')->name('video.delete');
           //FindTopic
             Route::get('/videotopic','VideoController@findtopic');
         


});



Route::group(['middleware' => ['auth','role:Student']], function () {

    //View Pdf
    Route::get('{slug}/pdf/subjects','StudentDataController@Pdfsubject')->name('pdf.subject'); 
    Route::get('{id}/pdf/subjects/topic','StudentDataController@Pdfsubjecttopic')->name('pdf.subject.topic'); 
    Route::get('{id}/pdf/subjects/topic/file','StudentDataController@Pdffile')->name('pdf.subject.topic.file'); 


   //View Terminal Paper
    Route::get('{slug}/terminal/subjects','StudentDataController@Terminalsubject')->name('terminal.subject'); 
    Route::get('{id}/terminal/subjects/topic','StudentDataController@Terminalsubjecttopic')->name('terminal.subject.topic'); 
    Route::get('{id}/terminal/subjects/topic/file','StudentDataController@Terminalfile')->name('terminal.subject.topic.file'); 
    

       //View Important Paper
       Route::get('{slug}/important_paper/subjects','StudentDataController@Importantsubject')->name('important.subject'); 
       Route::get('{id}/important_paper/subjects/topic','StudentDataController@Importantsubjecttopic')->name('important.subject.topic'); 
       Route::get('{id}/important_paper/subjects/topic/file','StudentDataController@Importantfile')->name('important.subject.topic.file'); 
       
       //Video
       Route::get('{slug}/video/subjects','StudentDataController@Videosubject')->name('video.subject'); 
       Route::get('{id}/video/subjects/topic','StudentDataController@Videosubjecttopic')->name('video.subject.topic'); 
       Route::get('{id}/video/subjects/topic/file','StudentDataController@Videofile')->name('video.subject.topic.file'); 
      
});



Route::group(['middleware' => ['auth','role:Parent']], function () 
{
    Route::get('attendance/{attendance}', 'AttendanceController@show')->name('attendance.show');
});