<?php

return [
    'userManagement'      => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'          => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'                => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'                => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'Name',
            'name_helper'               => ' ',
            'email'                     => 'Email',
            'email_helper'              => ' ',
            'email_verified_at'         => 'Email verified at',
            'email_verified_at_helper'  => ' ',
            'password'                  => 'Password',
            'password_helper'           => ' ',
            'roles'                     => 'Roles',
            'roles_helper'              => ' ',
            'remember_token'            => 'Remember Token',
            'remember_token_helper'     => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'image'                     => 'Image',
            'image_helper'              => ' ',
            'username'                  => 'Username',
            'username_helper'           => ' ',
            'total_credit'              => 'Total Credit',
            'total_credit_helper'       => ' ',
            'current_credit'            => 'Current Credit',
            'current_credit_helper'     => ' ',
            'total_point'               => 'Total Point',
            'total_point_helper'        => ' ',
            'current_point'             => 'Current Point',
            'current_point_helper'      => ' ',
            'ic_number'                 => 'IC Number',
            'ic_number_helper'          => ' ',
            'contact_number'            => 'Contact Number',
            'contact_number_helper'     => ' ',
            'verified'                  => 'Verified',
            'verified_helper'           => ' ',
            'verified_at'               => 'Verified At',
            'verified_at_helper'        => ' ',
            'verification_token'        => 'Verification Token',
            'verification_token_helper' => ' ',
        ],
    ],
    'carpark'             => [
        'title'          => 'Carpark',
        'title_singular' => 'Carpark',
    ],
    'vehicleBrand'        => [
        'title'          => 'Vehicle Brand',
        'title_singular' => 'Vehicle Brand',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'brand'             => 'Brand',
            'brand_helper'      => ' ',
            'is_enable'         => 'Is Enable',
            'is_enable_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'carparkLocation'     => [
        'title'          => 'Carpark Location',
        'title_singular' => 'Carpark Location',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'location'          => 'Location',
            'location_helper'   => ' ',
            'is_enable'         => 'Is Enable',
            'is_enable_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'vehicleManagement'   => [
        'title'          => 'Vehicle Management',
        'title_singular' => 'Vehicle Management',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'username'              => 'Username',
            'username_helper'       => ' ',
            'car_plate'             => 'Car Plate',
            'car_plate_helper'      => ' ',
            'is_verify'             => 'Is Verify',
            'is_verify_helper'      => ' ',
            'brand'                 => 'Brand',
            'brand_helper'          => ' ',
            'color'                 => 'Color',
            'color_helper'          => ' ',
            'is_season_park'        => 'Is Season Park',
            'is_season_park_helper' => ' ',
            'dirver_count'          => 'Dirver Count',
            'dirver_count_helper'   => ' ',
            'is_resident'           => 'Is Resident',
            'is_resident_helper'    => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'model'                 => 'Model',
            'model_helper'          => ' ',
        ],
    ],
    'resident'            => [
        'title'          => 'Resident',
        'title_singular' => 'Resident',
    ],
    'carparkLog'          => [
        'title'          => 'Carpark Log',
        'title_singular' => 'Carpark Log',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'time_in'           => 'Time In',
            'time_in_helper'    => ' ',
            'time_out'          => 'Time Out',
            'time_out_helper'   => ' ',
            'price'             => 'Price',
            'price_helper'      => ' ',
            'carplate'          => 'Carplate',
            'carplate_helper'   => ' ',
            'location'          => 'Location',
            'location_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'rateSetting'         => [
        'title'          => 'Rate Setting',
        'title_singular' => 'Rate Setting',
    ],
    'unit'                => [
        'title'          => 'Unit',
        'title_singular' => 'Unit',
    ],
    'event'               => [
        'title'          => 'Event',
        'title_singular' => 'Event',
    ],
    'eventCategory'       => [
        'title'          => 'Event Category',
        'title_singular' => 'Event Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'cateogey'          => 'Cateogey',
            'cateogey_helper'   => ' ',
            'is_enable'         => 'Is Enable',
            'is_enable_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'family'              => [
        'title'          => 'Family',
        'title_singular' => 'Family',
    ],
    'tenant'              => [
        'title'          => 'Tenant',
        'title_singular' => 'Tenant',
    ],
    'eventControl'        => [
        'title'          => 'Event Control',
        'title_singular' => 'Event Control',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'date'                  => 'Date',
            'date_helper'           => ' ',
            'time'                  => 'Time',
            'time_helper'           => ' ',
            'payment'               => 'Payment',
            'payment_helper'        => ' ',
            'participants'          => 'Participants',
            'participants_helper'   => ' ',
            'status'                => 'Status',
            'status_helper'         => ' ',
            'image'                 => 'Image',
            'image_helper'          => ' ',
            'category'              => 'Category',
            'category_helper'       => ' ',
            'audience_group'        => 'Audience Group',
            'audience_group_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'facility'            => [
        'title'          => 'Facility',
        'title_singular' => 'Facility',
    ],
    'visitor'             => [
        'title'          => 'Visitor',
        'title_singular' => 'Visitor',
    ],
    'defect'              => [
        'title'          => 'Defect',
        'title_singular' => 'Defect',
    ],
    'eventEnroll'         => [
        'title'          => 'Event Enroll',
        'title_singular' => 'Event Enroll',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'event'             => 'Event',
            'event_helper'      => ' ',
            'username'          => 'Username',
            'username_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'notice'              => [
        'title'          => 'Notice',
        'title_singular' => 'Notice',
    ],
    'accessManagement'    => [
        'title'          => 'Access Management',
        'title_singular' => 'Access Management',
    ],
    'userAlert'           => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'noticeBoard'         => [
        'title'          => 'Notice Board',
        'title_singular' => 'Notice Board',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'content'           => 'Content',
            'content_helper'    => ' ',
            'post_at'           => 'Post At',
            'post_at_helper'    => ' ',
            'post_to'           => 'Post To',
            'post_to_helper'    => ' ',
            'pinned'            => 'Pinned',
            'pinned_helper'     => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'post_by'           => 'Post By',
            'post_by_helper'    => ' ',
            'image'             => 'Image',
            'image_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'residentSetting'     => [
        'title'          => 'Resident Setting',
        'title_singular' => 'Resident Setting',
    ],
    'familySetting'       => [
        'title'          => 'Family Setting',
        'title_singular' => 'Family Setting',
    ],
    'form'                => [
        'title'          => 'Form',
        'title_singular' => 'Form',
    ],
    'tenantSetting'       => [
        'title'          => 'Tenant Setting',
        'title_singular' => 'Tenant Setting',
    ],
    'feedback'            => [
        'title'          => 'Feedback',
        'title_singular' => 'Feedback',
    ],
    'addFeedback'         => [
        'title'          => 'Add Feedback',
        'title_singular' => 'Add Feedback',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'content'           => 'Content',
            'content_helper'    => ' ',
            'username'          => 'Username',
            'username_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'feedbackCategory'    => [
        'title'          => 'Feedback Category',
        'title_singular' => 'Feedback Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'eBilling'            => [
        'title'          => 'e-Billing',
        'title_singular' => 'e-Billing',
    ],
    'addUnit'             => [
        'title'          => 'Add Unit',
        'title_singular' => 'Add Unit',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'unit'               => 'Unit',
            'unit_helper'        => ' ',
            'floor'              => 'Floor',
            'floor_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'block'              => 'Block',
            'block_helper'       => ' ',
            'unit_square'        => 'Unit Square',
            'unit_square_helper' => ' ',
        ],
    ],
    'paymentMethod'       => [
        'title'          => 'Payment Method',
        'title_singular' => 'Payment Method',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'method'             => 'Method',
            'method_helper'      => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'in_enable'          => 'In Enable',
            'in_enable_helper'   => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'addBlock'            => [
        'title'          => 'Add Block',
        'title_singular' => 'Add Block',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'block'             => 'Block',
            'block_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'carparkPayment'      => [
        'title'          => 'Carpark Payment',
        'title_singular' => 'Carpark Payment',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'carplate'              => 'Carplate',
            'carplate_helper'       => ' ',
            'payment'               => 'Payment',
            'payment_helper'        => ' ',
            'payment_method'        => 'Payment Method',
            'payment_method_helper' => ' ',
            'remark'                => 'Remark',
            'remark_helper'         => ' ',
            'status'                => 'Status',
            'status_helper'         => ' ',
            'location'              => 'Location',
            'location_helper'       => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'maintenancesPayment' => [
        'title'          => 'Maintenances Payment',
        'title_singular' => 'Maintenances Payment',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'amount'                => 'Amount',
            'amount_helper'         => ' ',
            'month'                 => 'Month',
            'month_helper'          => ' ',
            'receipt'               => 'Receipt',
            'receipt_helper'        => ' ',
            'status'                => 'Status',
            'status_helper'         => ' ',
            'username'              => 'Username',
            'username_helper'       => ' ',
            'payment_method'        => 'Payment Method',
            'payment_method_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'facilitypayment'     => [
        'title'          => 'Facilitypayment',
        'title_singular' => 'Facilitypayment',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'amount'                => 'Amount',
            'amount_helper'         => ' ',
            'reciept'               => 'Reciept',
            'reciept_helper'        => ' ',
            'status'                => 'Status',
            'status_helper'         => ' ',
            'username'              => 'Username',
            'username_helper'       => ' ',
            'payment_method'        => 'Payment Method',
            'payment_method_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'eventPayment'        => [
        'title'          => 'Event Payment',
        'title_singular' => 'Event Payment',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'payment'               => 'Payment',
            'payment_helper'        => ' ',
            'payment_method'        => 'Payment Method',
            'payment_method_helper' => ' ',
            'username'              => 'Username',
            'username_helper'       => ' ',
            'event'                 => 'Event',
            'event_helper'          => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'unitManagement'      => [
        'title'          => 'Unit Management',
        'title_singular' => 'Unit Management',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'unit'              => 'Unit',
            'unit_helper'       => ' ',
            'owner'             => 'Owner',
            'owner_helper'      => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'spa'               => 'Spa',
            'spa_helper'        => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'size'              => 'Size',
            'size_helper'       => ' ',
        ],
    ],
    'facilityCategory'    => [
        'title'          => 'Facility Category',
        'title_singular' => 'Facility Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'in_enable'         => 'In Enable',
            'in_enable_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'facilityManagement'  => [
        'title'          => 'Facility Management',
        'title_singular' => 'Facility Management',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'desctiption'        => 'Desctiption',
            'desctiption_helper' => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'image'              => 'Image',
            'image_helper'       => ' ',
            'category'           => 'Category',
            'category_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'open'               => 'Open',
            'open_helper'        => ' ',
            'closed'             => 'Closed',
            'closed_helper'      => ' ',
        ],
    ],
    'formCategory'        => [
        'title'          => 'Form Category',
        'title_singular' => 'Form Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'in_enable'         => 'In Enable',
            'in_enable_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'facilityBook'        => [
        'title'          => 'Facility Book',
        'title_singular' => 'Facility Book',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'date'              => 'Date',
            'date_helper'       => ' ',
            'time'              => 'Time',
            'time_helper'       => ' ',
            'facility'          => 'Facility',
            'facility_helper'   => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'addVisitor'          => [
        'title'          => 'Add Visitor',
        'title_singular' => 'Add Visitor',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'status'            => 'status',
            'status_helper'     => ' ',
            'username'          => 'Username',
            'username_helper'   => ' ',
            'add_by'            => 'Add By',
            'add_by_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'location'            => [
        'title'          => 'Location',
        'title_singular' => 'Location',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'location'          => 'Location',
            'location_helper'   => ' ',
            'in_enable'         => 'In Enable',
            'in_enable_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'history'             => [
        'title'          => 'History',
        'title_singular' => 'History',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'qr'                => 'Qr',
            'qr_helper'         => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'username'          => 'Username',
            'username_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'entrance'          => 'Entrance',
            'entrance_helper'   => ' ',
        ],
    ],
    'qr'                  => [
        'title'          => 'Qr',
        'title_singular' => 'Qr',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'code'              => 'Code',
            'code_helper'       => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'username'          => 'Username',
            'username_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'statusControl'       => [
        'title'          => 'Status Control',
        'title_singular' => 'Status Control',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'desctiption'        => 'Desctiption',
            'desctiption_helper' => ' ',
            'in_enable'          => 'In Enable',
            'in_enable_helper'   => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'defactCategory'      => [
        'title'          => 'Defact Category',
        'title_singular' => 'Defact Category',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'defact_category'        => 'Defact Category',
            'defact_category_helper' => ' ',
            'in_enable'              => 'In Enable',
            'in_enable_helper'       => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'addDefect'           => [
        'title'          => 'Add Defect',
        'title_singular' => 'Add Defect',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'defect'                => 'Defect',
            'defect_helper'         => ' ',
            'image'                 => 'Image',
            'image_helper'          => ' ',
            'available_date'        => 'Available Date',
            'available_date_helper' => ' ',
            'available_time'        => 'Available Time',
            'available_time_helper' => ' ',
            'remark'                => 'Remark',
            'remark_helper'         => ' ',
            'username'              => 'Username',
            'username_helper'       => ' ',
            'category'              => 'Category',
            'category_helper'       => ' ',
            'status'                => 'Status',
            'status_helper'         => ' ',
            'inchargeperson'        => 'Inchargeperson',
            'inchargeperson_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'activityLog'         => [
        'title'          => 'Activity Log',
        'title_singular' => 'Activity Log',
    ],
    'checkFacility'       => [
        'title'          => 'Check Facility',
        'title_singular' => 'Check Facility',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'user'               => 'User',
            'user_helper'        => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'image'              => 'Image',
            'image_helper'       => ' ',
            'date_time'          => 'Date Time',
            'date_time_helper'   => ' ',
            'facility'           => 'Facility',
            'facility_helper'    => ' ',
            'defect'             => 'Defect',
            'defect_helper'      => ' ',
        ],
    ],
    'addFamilyMember'     => [
        'title'          => 'Add Family Member',
        'title_singular' => 'Add Family Member',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'unit'                 => 'Unit',
            'unit_helper'          => ' ',
            'family_member'        => 'Family Member',
            'family_member_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'addTanent'           => [
        'title'          => 'Add Tanent',
        'title_singular' => 'Add Tanent',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'unit'              => 'Unit',
            'unit_helper'       => ' ',
            'tanent'            => 'Tanent',
            'tanent_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'entrance'            => [
        'title'          => 'Entrance',
        'title_singular' => 'Entrance',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'last_active'        => 'Last Active',
            'last_active_helper' => ' ',
            'in_enable'          => 'In Enable',
            'in_enable_helper'   => ' ',
            'location'           => 'Location',
            'location_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'auditLog'            => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'vehicleModel'        => [
        'title'          => 'Vehicle Model',
        'title_singular' => 'Vehicle Model',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'brand'             => 'Brand',
            'brand_helper'      => ' ',
            'model'             => 'Model',
            'model_helper'      => ' ',
            'is_enable'         => 'Is Enable',
            'is_enable_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];
