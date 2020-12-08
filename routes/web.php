<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::post('roles/parse-csv-import', 'RolesController@parseCsvImport')->name('roles.parseCsvImport');
    Route::post('roles/process-csv-import', 'RolesController@processCsvImport')->name('roles.processCsvImport');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Vehicle Brands
    Route::delete('vehicle-brands/destroy', 'VehicleBrandController@massDestroy')->name('vehicle-brands.massDestroy');
    Route::post('vehicle-brands/parse-csv-import', 'VehicleBrandController@parseCsvImport')->name('vehicle-brands.parseCsvImport');
    Route::post('vehicle-brands/process-csv-import', 'VehicleBrandController@processCsvImport')->name('vehicle-brands.processCsvImport');
    Route::resource('vehicle-brands', 'VehicleBrandController');

    // Carpark Locations
    Route::delete('carpark-locations/destroy', 'CarparkLocationController@massDestroy')->name('carpark-locations.massDestroy');
    Route::post('carpark-locations/parse-csv-import', 'CarparkLocationController@parseCsvImport')->name('carpark-locations.parseCsvImport');
    Route::post('carpark-locations/process-csv-import', 'CarparkLocationController@processCsvImport')->name('carpark-locations.processCsvImport');
    Route::resource('carpark-locations', 'CarparkLocationController');

    // Vehicle Managements
    Route::delete('vehicle-managements/destroy', 'VehicleManagementController@massDestroy')->name('vehicle-managements.massDestroy');
    Route::post('vehicle-managements/parse-csv-import', 'VehicleManagementController@parseCsvImport')->name('vehicle-managements.parseCsvImport');
    Route::post('vehicle-managements/process-csv-import', 'VehicleManagementController@processCsvImport')->name('vehicle-managements.processCsvImport');
    Route::resource('vehicle-managements', 'VehicleManagementController');

    // Carpark Logs
    Route::delete('carpark-logs/destroy', 'CarparkLogController@massDestroy')->name('carpark-logs.massDestroy');
    Route::resource('carpark-logs', 'CarparkLogController');

    // Rate Settings
    Route::resource('rate-settings', 'RateSettingController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Event Categories
    Route::delete('event-categories/destroy', 'EventCategoryController@massDestroy')->name('event-categories.massDestroy');
    Route::resource('event-categories', 'EventCategoryController');

    // Event Controls
    Route::delete('event-controls/destroy', 'EventControlController@massDestroy')->name('event-controls.massDestroy');
    Route::post('event-controls/media', 'EventControlController@storeMedia')->name('event-controls.storeMedia');
    Route::post('event-controls/ckmedia', 'EventControlController@storeCKEditorImages')->name('event-controls.storeCKEditorImages');
    Route::resource('event-controls', 'EventControlController');

    // Event Enrolls
    Route::delete('event-enrolls/destroy', 'EventEnrollController@massDestroy')->name('event-enrolls.massDestroy');
    Route::resource('event-enrolls', 'EventEnrollController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController');

    // Notice Boards
    Route::delete('notice-boards/destroy', 'NoticeBoardController@massDestroy')->name('notice-boards.massDestroy');
    Route::post('notice-boards/media', 'NoticeBoardController@storeMedia')->name('notice-boards.storeMedia');
    Route::post('notice-boards/ckmedia', 'NoticeBoardController@storeCKEditorImages')->name('notice-boards.storeCKEditorImages');
    Route::resource('notice-boards', 'NoticeBoardController');

    // Family Settings
    Route::resource('family-settings', 'FamilySettingController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Tenant Settings
    Route::resource('tenant-settings', 'TenantSettingController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Add Feedbacks
    Route::delete('add-feedbacks/destroy', 'AddFeedbackController@massDestroy')->name('add-feedbacks.massDestroy');
    Route::post('add-feedbacks/media', 'AddFeedbackController@storeMedia')->name('add-feedbacks.storeMedia');
    Route::post('add-feedbacks/ckmedia', 'AddFeedbackController@storeCKEditorImages')->name('add-feedbacks.storeCKEditorImages');
    Route::resource('add-feedbacks', 'AddFeedbackController');

    // Feedback Categories
    Route::delete('feedback-categories/destroy', 'FeedbackCategoryController@massDestroy')->name('feedback-categories.massDestroy');
    Route::resource('feedback-categories', 'FeedbackCategoryController');

    // Add Units
    Route::delete('add-units/destroy', 'AddUnitController@massDestroy')->name('add-units.massDestroy');
    Route::post('add-units/parse-csv-import', 'AddUnitController@parseCsvImport')->name('add-units.parseCsvImport');
    Route::post('add-units/process-csv-import', 'AddUnitController@processCsvImport')->name('add-units.processCsvImport');
    Route::resource('add-units', 'AddUnitController');

    // Payment Methods
    Route::delete('payment-methods/destroy', 'PaymentMethodController@massDestroy')->name('payment-methods.massDestroy');
    Route::resource('payment-methods', 'PaymentMethodController');

    // Add Blocks
    Route::delete('add-blocks/destroy', 'AddBlockController@massDestroy')->name('add-blocks.massDestroy');
    Route::post('add-blocks/parse-csv-import', 'AddBlockController@parseCsvImport')->name('add-blocks.parseCsvImport');
    Route::post('add-blocks/process-csv-import', 'AddBlockController@processCsvImport')->name('add-blocks.processCsvImport');
    Route::resource('add-blocks', 'AddBlockController');

    // Carpark Payments
    Route::delete('carpark-payments/destroy', 'CarparkPaymentController@massDestroy')->name('carpark-payments.massDestroy');
    Route::resource('carpark-payments', 'CarparkPaymentController');

    // Maintenances Payments
    Route::delete('maintenances-payments/destroy', 'MaintenancesPaymentController@massDestroy')->name('maintenances-payments.massDestroy');
    Route::post('maintenances-payments/media', 'MaintenancesPaymentController@storeMedia')->name('maintenances-payments.storeMedia');
    Route::post('maintenances-payments/ckmedia', 'MaintenancesPaymentController@storeCKEditorImages')->name('maintenances-payments.storeCKEditorImages');
    Route::resource('maintenances-payments', 'MaintenancesPaymentController');

    // Facilitypayments
    Route::delete('facilitypayments/destroy', 'FacilitypaymentController@massDestroy')->name('facilitypayments.massDestroy');
    Route::post('facilitypayments/media', 'FacilitypaymentController@storeMedia')->name('facilitypayments.storeMedia');
    Route::post('facilitypayments/ckmedia', 'FacilitypaymentController@storeCKEditorImages')->name('facilitypayments.storeCKEditorImages');
    Route::resource('facilitypayments', 'FacilitypaymentController');

    // Event Payments
    Route::delete('event-payments/destroy', 'EventPaymentController@massDestroy')->name('event-payments.massDestroy');
    Route::resource('event-payments', 'EventPaymentController');

    // Unit Managements
    Route::delete('unit-managements/destroy', 'UnitManagementController@massDestroy')->name('unit-managements.massDestroy');
    Route::post('unit-managements/media', 'UnitManagementController@storeMedia')->name('unit-managements.storeMedia');
    Route::post('unit-managements/ckmedia', 'UnitManagementController@storeCKEditorImages')->name('unit-managements.storeCKEditorImages');
    Route::post('unit-managements/parse-csv-import', 'UnitManagementController@parseCsvImport')->name('unit-managements.parseCsvImport');
    Route::post('unit-managements/process-csv-import', 'UnitManagementController@processCsvImport')->name('unit-managements.processCsvImport');
    Route::resource('unit-managements', 'UnitManagementController');

    // Facility Categories
    Route::delete('facility-categories/destroy', 'FacilityCategoryController@massDestroy')->name('facility-categories.massDestroy');
    Route::post('facility-categories/parse-csv-import', 'FacilityCategoryController@parseCsvImport')->name('facility-categories.parseCsvImport');
    Route::post('facility-categories/process-csv-import', 'FacilityCategoryController@processCsvImport')->name('facility-categories.processCsvImport');
    Route::resource('facility-categories', 'FacilityCategoryController');

    // Facility Managements
    Route::delete('facility-managements/destroy', 'FacilityManagementController@massDestroy')->name('facility-managements.massDestroy');
    Route::post('facility-managements/media', 'FacilityManagementController@storeMedia')->name('facility-managements.storeMedia');
    Route::post('facility-managements/ckmedia', 'FacilityManagementController@storeCKEditorImages')->name('facility-managements.storeCKEditorImages');
    Route::post('facility-managements/parse-csv-import', 'FacilityManagementController@parseCsvImport')->name('facility-managements.parseCsvImport');
    Route::post('facility-managements/process-csv-import', 'FacilityManagementController@processCsvImport')->name('facility-managements.processCsvImport');
    Route::resource('facility-managements', 'FacilityManagementController');

    // Form Categories
    Route::delete('form-categories/destroy', 'FormCategoryController@massDestroy')->name('form-categories.massDestroy');
    Route::resource('form-categories', 'FormCategoryController');

    // Facility Books
    Route::delete('facility-books/destroy', 'FacilityBookController@massDestroy')->name('facility-books.massDestroy');
    Route::resource('facility-books', 'FacilityBookController');

    // Add Visitors
    Route::delete('add-visitors/destroy', 'AddVisitorController@massDestroy')->name('add-visitors.massDestroy');
    Route::resource('add-visitors', 'AddVisitorController');

    // Locations
    Route::delete('locations/destroy', 'LocationController@massDestroy')->name('locations.massDestroy');
    Route::resource('locations', 'LocationController');

    // Histories
    Route::delete('histories/destroy', 'HistoryController@massDestroy')->name('histories.massDestroy');
    Route::resource('histories', 'HistoryController');

    // Qrs
    Route::delete('qrs/destroy', 'QrController@massDestroy')->name('qrs.massDestroy');
    Route::resource('qrs', 'QrController');

    // Status Controls
    Route::delete('status-controls/destroy', 'StatusControlController@massDestroy')->name('status-controls.massDestroy');
    Route::post('status-controls/parse-csv-import', 'StatusControlController@parseCsvImport')->name('status-controls.parseCsvImport');
    Route::post('status-controls/process-csv-import', 'StatusControlController@processCsvImport')->name('status-controls.processCsvImport');
    Route::resource('status-controls', 'StatusControlController');

    // Defact Categories
    Route::delete('defact-categories/destroy', 'DefactCategoryController@massDestroy')->name('defact-categories.massDestroy');
    Route::post('defact-categories/parse-csv-import', 'DefactCategoryController@parseCsvImport')->name('defact-categories.parseCsvImport');
    Route::post('defact-categories/process-csv-import', 'DefactCategoryController@processCsvImport')->name('defact-categories.processCsvImport');
    Route::resource('defact-categories', 'DefactCategoryController');

    // Add Defects
    Route::delete('add-defects/destroy', 'AddDefectController@massDestroy')->name('add-defects.massDestroy');
    Route::post('add-defects/media', 'AddDefectController@storeMedia')->name('add-defects.storeMedia');
    Route::post('add-defects/ckmedia', 'AddDefectController@storeCKEditorImages')->name('add-defects.storeCKEditorImages');
    Route::resource('add-defects', 'AddDefectController');

    // Activity Logs
    Route::resource('activity-logs', 'ActivityLogController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Check Facilities
    Route::delete('check-facilities/destroy', 'CheckFacilityController@massDestroy')->name('check-facilities.massDestroy');
    Route::post('check-facilities/media', 'CheckFacilityController@storeMedia')->name('check-facilities.storeMedia');
    Route::post('check-facilities/ckmedia', 'CheckFacilityController@storeCKEditorImages')->name('check-facilities.storeCKEditorImages');
    Route::resource('check-facilities', 'CheckFacilityController');

    // Add Family Members
    Route::delete('add-family-members/destroy', 'AddFamilyMemberController@massDestroy')->name('add-family-members.massDestroy');
    Route::resource('add-family-members', 'AddFamilyMemberController');

    // Add Tanents
    Route::delete('add-tanents/destroy', 'AddTanentController@massDestroy')->name('add-tanents.massDestroy');
    Route::post('add-tanents/parse-csv-import', 'AddTanentController@parseCsvImport')->name('add-tanents.parseCsvImport');
    Route::post('add-tanents/process-csv-import', 'AddTanentController@processCsvImport')->name('add-tanents.processCsvImport');
    Route::resource('add-tanents', 'AddTanentController');

    // Entrances
    Route::delete('entrances/destroy', 'EntranceController@massDestroy')->name('entrances.massDestroy');
    Route::resource('entrances', 'EntranceController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Vehicle Models
    Route::delete('vehicle-models/destroy', 'VehicleModelController@massDestroy')->name('vehicle-models.massDestroy');
    Route::post('vehicle-models/parse-csv-import', 'VehicleModelController@parseCsvImport')->name('vehicle-models.parseCsvImport');
    Route::post('vehicle-models/process-csv-import', 'VehicleModelController@processCsvImport')->name('vehicle-models.processCsvImport');
    Route::resource('vehicle-models', 'VehicleModelController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
