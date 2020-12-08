<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Vehicle Brands
    Route::apiResource('vehicle-brands', 'VehicleBrandApiController');

    // Carpark Locations
    Route::apiResource('carpark-locations', 'CarparkLocationApiController');

    // Vehicle Managements
    Route::apiResource('vehicle-managements', 'VehicleManagementApiController');

    // Carpark Logs
    Route::apiResource('carpark-logs', 'CarparkLogApiController');

    // Event Categories
    Route::apiResource('event-categories', 'EventCategoryApiController');

    // Event Controls
    Route::post('event-controls/media', 'EventControlApiController@storeMedia')->name('event-controls.storeMedia');
    Route::apiResource('event-controls', 'EventControlApiController');

    // Event Enrolls
    Route::apiResource('event-enrolls', 'EventEnrollApiController');

    // User Alerts
    Route::apiResource('user-alerts', 'UserAlertsApiController');

    // Notice Boards
    Route::post('notice-boards/media', 'NoticeBoardApiController@storeMedia')->name('notice-boards.storeMedia');
    Route::apiResource('notice-boards', 'NoticeBoardApiController');

    // Add Feedbacks
    Route::post('add-feedbacks/media', 'AddFeedbackApiController@storeMedia')->name('add-feedbacks.storeMedia');
    Route::apiResource('add-feedbacks', 'AddFeedbackApiController');

    // Feedback Categories
    Route::apiResource('feedback-categories', 'FeedbackCategoryApiController');

    // Add Units
    Route::apiResource('add-units', 'AddUnitApiController');

    // Payment Methods
    Route::apiResource('payment-methods', 'PaymentMethodApiController');

    // Add Blocks
    Route::apiResource('add-blocks', 'AddBlockApiController');

    // Carpark Payments
    Route::apiResource('carpark-payments', 'CarparkPaymentApiController');

    // Maintenances Payments
    Route::post('maintenances-payments/media', 'MaintenancesPaymentApiController@storeMedia')->name('maintenances-payments.storeMedia');
    Route::apiResource('maintenances-payments', 'MaintenancesPaymentApiController');

    // Facilitypayments
    Route::post('facilitypayments/media', 'FacilitypaymentApiController@storeMedia')->name('facilitypayments.storeMedia');
    Route::apiResource('facilitypayments', 'FacilitypaymentApiController');

    // Event Payments
    Route::apiResource('event-payments', 'EventPaymentApiController');

    // Unit Managements
    Route::post('unit-managements/media', 'UnitManagementApiController@storeMedia')->name('unit-managements.storeMedia');
    Route::apiResource('unit-managements', 'UnitManagementApiController');

    // Facility Categories
    Route::apiResource('facility-categories', 'FacilityCategoryApiController');

    // Facility Managements
    Route::post('facility-managements/media', 'FacilityManagementApiController@storeMedia')->name('facility-managements.storeMedia');
    Route::apiResource('facility-managements', 'FacilityManagementApiController');

    // Form Categories
    Route::apiResource('form-categories', 'FormCategoryApiController');

    // Facility Books
    Route::apiResource('facility-books', 'FacilityBookApiController');

    // Add Visitors
    Route::apiResource('add-visitors', 'AddVisitorApiController');

    // Locations
    Route::apiResource('locations', 'LocationApiController');

    // Histories
    Route::apiResource('histories', 'HistoryApiController');

    // Qrs
    Route::apiResource('qrs', 'QrApiController');

    // Status Controls
    Route::apiResource('status-controls', 'StatusControlApiController');

    // Defact Categories
    Route::apiResource('defact-categories', 'DefactCategoryApiController');

    // Add Defects
    Route::post('add-defects/media', 'AddDefectApiController@storeMedia')->name('add-defects.storeMedia');
    Route::apiResource('add-defects', 'AddDefectApiController');

    // Check Facilities
    Route::post('check-facilities/media', 'CheckFacilityApiController@storeMedia')->name('check-facilities.storeMedia');
    Route::apiResource('check-facilities', 'CheckFacilityApiController');

    // Add Family Members
    Route::apiResource('add-family-members', 'AddFamilyMemberApiController');

    // Add Tanents
    Route::apiResource('add-tanents', 'AddTanentApiController');

    // Entrances
    Route::apiResource('entrances', 'EntranceApiController');

    // Vehicle Models
    Route::apiResource('vehicle-models', 'VehicleModelApiController');
});
