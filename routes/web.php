<?php

//===================Root Route====================================
Route::get('/', function () {
    return view('welcome');
});

//=================Auth Routes=====================================

Auth::routes();

//==================Home routes====================================

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/check', 'GeneralController@check')->name('home');

//=================MiddleWare Bucket to check Auth=================

Route::group(['middleware'=>['auth']],function(){
	Route::get('/studentpage',function(){
	return view('studentpage');
	});
    
     Route::get('/attendanceportal','GeneralController@redirectto');
});

//=========Middleware Bucket To MainPage Redirections====================

Route::group(['middleware'=>['auth','AssignRole']],function (){
    //----------------Route To ADMIN Page Redirect-------------------
    Route::get('/adminpage',function(){
        return view('adminpage');
    });

    //----------------Route To FACULTY Page Redirect-----------------
    Route::get('/facultypage',function(){
        return view('facultypage');
    });

    //----------------Route To HOD Page Redirect----------------------
    Route::get('/hodpage',function(){
        return view('hodpage');
    });
});

//==============MiddleWare Bucket For Attendance======================


//==========Routes for Add Attendance AjaxRequests===================

Route::group(['middleware'=>['auth','AssignRole']],function (){
    
//------------Add/update attendance------------------//    
    Route::get('/attendance','AttendanceController@index');
    Route::get('/attendance/edit','AttendanceController@edit');
    Route::get('/attendance/update','AttendanceController@update');
    Route::get('/attendance/updateattendance','AttendanceController@updatesave');
    Route::get('/attendance/deleteattendance','AttendanceController@delete');
    Route::post('/attendance/saveupdates','AttendanceController@saveupdate');
     Route::get('/showSec','GeneralController@showSec');
    Route::get('/showSub1','GeneralController@showSub1');




//-----------------Add Attendance ajax----------------//
    Route::get('/searchsubject', 'GeneralController@searchsub');
    Route::get('/getstudentcount/{sec}/{sem}', 'GeneralController@getstudentcount');
    Route::get('/searchsubjectname/{id}', 'GeneralController@searchsubname');
    Route::get('/searchsubjectsem/{id}', 'GeneralController@searchsubsem');
    Route::get('/searchsubjectsec/{id}', 'GeneralController@searchsubsec');
    Route::get('/validate/{subid}/{sec}/{sem}/{fdate}/{tdate}/{status}', 'GeneralController@validatedate');
    Route::get('/showstudentattend/{sec}/{sem}/{noc}/{mb}/{subid}/{fdate}/{tdate}','GeneralController@showattend');
    Route::post('/saveattend','GeneralController@store')->name('saveat');


//---------------------VIEW ATTENDANCE---------------------//


    Route::get('showhodattendthirdmul', 'AttendanceController@showhodattendthirdmul') ;  
    Route::get('/searchsubject2','AttendanceController@searchsub');
    Route::get('/showhodattendfourthmul','AttendanceController@showhodattendfourthmul');
    Route::get('/searchfaculty','GeneralController@searchfac');
    
});

//==================Routes for Add subject --SAURASS-- ===============

Route::group(['middleware'=>['auth','AssignRole']],function (){
    //-------------Routes to subject control -- SAURASS----------------

    Route::get('/subject/deletesub','SubjectController@deletesub');
    Route::resource('/subject','SubjectController');
    Route::get('/subject/{id}/edit/{branch}','SubjectController@edit');
    Route::get('/searchsubdata','SubjectController@searchsubdata');
    Route::get('/searchdelsubdata','SubjectController@searchdelsubdata');

});

//==================Routes for AssignRole --SAURASS-- ==================

Route::group(['middleware'=>['auth','AssignRole']],function (){

    Route::get('/viewAssignRole','AssignRoleController@show');
    Route::resource('/assignrole','AssignRoleController');
    Route::post('/assignrole/showall','AssignRoleController@showall');
    Route::post('/assignrole/create','AssignRoleController@create');

    //------------Routes to AssignRole Ajax Requests -- SAURASS---------
        //========Saurass ----      26/09/2017  --------------------
    Route::get('/viewAssignSection','AssignRoleController@viewAssignSection');
    Route::get('/viewAssignSem2','AssignRoleController@viewAssignSem2');
    Route::get('/viewAssignGetData','AssignRoleController@viewAssignGetData');
    Route::get('/viewAssignGetData2','AssignRoleController@viewAssignGetData2');

    Route::get('/showSem','GeneralController@showSem');
    Route::get('/showCategory','GeneralController@showCategory');
    Route::get('/showSub','GeneralController@showSub');
    Route::get('/showFac','GeneralController@showFac');
    Route::get('/showBatch','GeneralController@showBatch');
});



Route::group(['middleware'=>['auth','AssignRole']],function (){


    Route::get('/viewattendance','AttendanceController@viewattendancepage');
    Route::get('/showsection','GeneralController@showsection');

    //----------Route to view attendance FACULTY-----------------------------
    Route::get('/viewfacultyattendance','AttendanceController@viewFacAttPage');

    //****************AJAX ROUTES view attendance Faculty***************
    Route::get('/viewatt','AttendanceController@showSem1');
    Route::get('/viewattsec','AttendanceController@showClass1');
    Route::get('/viewfacatt','AttendanceController@showFacultyAttendance');

    
});



Route::group(['middleware'=>['auth','AssignRole']],function (){


   Route::get('/addstud/{sem}','StudentController@branch');
Route::get('/addstud','StudentController@index');
Route::get('/addstud/{sem}/{branch}','StudentController@section');
Route::post('/addstud','StudentController@store');
Route::get('/updatestud','StudentController@updatepage');
Route::post('/updatestud','StudentController@edit');
Route::post('/updatestud1','StudentController@update');
Route::get('/deletestud','StudentController@deleteit');
Route::post('/deletestud','StudentController@showdetails');
Route::post('/delete','StudentController@delete');
    
});



Route::get('/show',function(){

    return view('attendance');
});


Route::group(['middleware'=>['auth','AssignRole']],function (){

    Route::resource('/managefaculty','FacultyController');

    Route::get('/facultyupdate','FacultyController@facupdate');
    Route::get('/managefaculty2','FacultyController@index1');
    Route::get('/managefaculty3','FacultyController@index3');


    //---------Ajax Routes--------------------------------------------------
    Route::get('/getNewId','FacultyController@getNewId');
});


Route::group(['middleware'=>['auth','AssignRole']],function (){

    Route::get('/allow_menu','AdminControlPanelController@show_allow_menu');

});

//==================Marks Routes SAURASS and SHIVI==========================
Route::group(['middleware'=>['auth','AssignRole']],function (){

    //-----------Faculty Only Add Mark Routes -- SAURASS--------------------
    Route::get('/addmarks','MarksController@index1');
    Route::post('/addmarks/add','MarksController@saveMarks');
    //----------Faculty , HOD , Admin Update Marks----SAURASS---------------
    Route::post('/marks/update','MarksController@updateMarks');
    //----------Admin and HOD Update,Delete Mark Route---SAURASS-------------------
    Route::get('/marks/update','MarksController@marksUpdater');
    Route::get('/marks/delete','MarksController@deleteMarks');
    Route::post('/marksdel','MarksController@marksdel');
    //----------------Admin and HOD View Mark Routes------------------------
    Route::get('/marks/view','MarksController@markViewer');

    //---------Add Exam Routes ---SHIVI-------------------------------------
    Route::get('/addExam','MarksController@index');
    Route::post('/storeExams','MarksController@store');
    Route::get('/addExam/new','MarksController@showBranch');
    Route::get('/updateExamStatus/{id}','MarksController@update_exam_status');
    //-------Delete Exam Routes------SHIVI----------------------------------
    Route::get('/del', 'MarksController@index2');
    Route::get('/deletes/{id}', 'MarksController@destroy');



    //------AJAX Routes Add Mark , Update Mark , View Mark ---SAURASS--------
    Route::get('/AddMarksShowSection','MarksController@showSection');
    Route::get('/AddMarksShowExams','MarksController@showExams');
    Route::get('/AddMarksShowStudentList','MarksController@showStudentList');
    Route::get('/UpdateMarksShowStudentList','MarksController@showUpdateStudentList');
    Route::get('/UpdateMarksShowSem','MarksController@UpdateMarksShowSem');
    Route::get('/UpdateMarksShowSec','MarksController@UpdateMarksShowSec');
    Route::get('/UpdateMarksShowSub','MarksController@UpdateMarksShowSub');
    Route::get('/UpdateMarksShowExam','MarksController@UpdateMarksShowExam');
    Route::get('/AddMarksFacultyCheck','MarksController@AddMarksFacultyCheck');

    Route::get('/ViewMarksAdminGetSem','MarksController@ViewMarksAdminGetSem');
    Route::get('/ViewMarksAdminGetSec','MarksController@ViewMarksAdminGetSec');
    Route::get('/ViewMarksAdminGetExam','MarksController@ViewMarksAdminGetExam');
    Route::get('/ViewMarksAdminGetViewMark','MarksController@ViewMarksAdminGetViewMark');
    //---------------AJAX Routes Add Exam -- SHIVI--------------------------
    Route::get('/showMarksSem','MarksController@showMarksSem');
    Route::get('/showTypeExam','MarksController@showTypeExam');
    Route::get('/getExamName','MarksController@getExamName');

});



//********************************************---IMPORTANT NOTES---*****************************************************

//======================================AssignRole Middleware===========================================================
    /*
        **  The Middleware Name Is AssignPriveledge and registered as AssignRole In Kernel.php
        **  It Checks whether the user belongs only to ADMIN or HOD category only
    */