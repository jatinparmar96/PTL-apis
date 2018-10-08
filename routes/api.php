<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
     
    $api->group(['prefix' => 'auth'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\Authentication\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\Authentication\\LoginController@login');
        $api->get('logout', 'App\\Api\\V1\\Controllers\\Authentication\\LogoutController@logout');
        $api->post('recovery', 'App\\Api\\V1\\Controllers\\Authentication\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\Authentication\\ResetPasswordController@resetPassword');
        $api->get('refresh_token', 'App\\Api\\V1\\Controllers\\Authentication\\LoginController@refresh_token' );
    });

    $api->group( ['prefix'=> 'admin', 'middleware'=> 'jwt.auth'], function (Router $api) {

        /* Companies table*/
        $api->post('company', 'App\\Api\\V1\\Controllers\\Masters\\CompanyController@store');
        $api->post('company_other_details','App\\Api\\V1\\Controllers\\Masters\\CompanyController@storeOtherDetails');
        $api->post('setCompany/{id}','App\\Api\\V1\\Controllers\\Masters\\CompanyController@setCompany');
        $api->post('company_wizard','App\\Api\\V1\\Controllers\\Masters\\CompanyController@createCompanyWizard'); //Create Companies from Wizard

        //Chart of Accounts
        $api->post('coa','App\\Api\\V1\\Controllers\\Masters\\ChartAccountsMaster@form');
        $api->get('coa','App\\Api\\V1\\Controllers\\Masters\\ChartAccountsMaster@index');
        $api->get('coa_full_list','App\\Api\\V1\\Controllers\\Masters\\ChartAccountsMaster@full_list');

        //Godown
        $api->post('godown','App\\Api\\V1\\Controllers\\Masters\\GodownMasterController@form');
        $api->get('godown','App\\Api\\V1\\Controllers\\Masters\\GodownMasterController@index');
        $api->get('godown_full_list','App\\Api\\V1\\Controllers\\Masters\\GodownMasterController@full_list');

        //Bank
        $api->post('bank','App\\Api\\V1\\Controllers\\Masters\\BankMasterController@form');
        $api->get('bank','App\\Api\\V1\\Controllers\\Masters\\BankMasterController@index');
        $api->get('bank_full_list','App\\Api\\V1\\Controllers\\Masters\\BankMasterController@full_list');

        //Branch
        $api->post('branch','App\\Api\\V1\\Controllers\\Masters\\BranchController@form');
        $api->get('branch','App\\Api\\V1\\Controllers\\Masters\\BranchController@index');
        $api->get('branch_full_list','App\\Api\\V1\\Controllers\\Masters\\BranchController@full_list');

        //Unit Of Measurement
        $api->post('uom','App\\Api\\V1\\Controllers\\Masters\\UnitofMeasurementController@form');
        $api->get('uom','App\\Api\\V1\\Controllers\\Masters\\UnitofMeasurementController@index');       
        $api->get('uom_full_list','App\\Api\\V1\\Controllers\\Masters\\UnitofMeasurementController@full_list');

        //Store Raw Products
        $api->post('raw_product','App\\Api\\V1\\Controllers\\Masters\\RawProductController@form');
        $api->get('raw_product','App\\Api\\V1\\Controllers\\Masters\\RawProductController@index');
        $api->get('raw_product_full_list','App\\Api\\V1\\Controllers\\Masters\\RawProductController@full_list');

        /* Attachment table*/
        $api->get('attachment', 'App\\Api\\V1\\Controllers\\AttachmentController@index');
        $api->post('attachment', 'App\\Api\\V1\\Controllers\\AttachmentController@store');
        $api->get('attachment/{id}', 'App\\Api\\V1\\Controllers\\AttachmentController@show');
        $api->delete('attachment/{id}', 'App\\Api\\V1\\Controllers\\AttachmentController@destroy');
        
        //Taxes
        $api->get('tax_full_list','App\\Api\\V1\\Controllers\\Masters\\TaxController@full_list');

    });

    $api->group( ['prefix'=> 'open'], function (Router $api) {
        $api->get('setting_by_option/app_version', 'App\\Api\\V1\\Controllers\\Authentication\\SettingController@app_version');
    });

});



?>