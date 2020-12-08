<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'carpark_access',
            ],
            [
                'id'    => 18,
                'title' => 'vehicle_brand_create',
            ],
            [
                'id'    => 19,
                'title' => 'vehicle_brand_edit',
            ],
            [
                'id'    => 20,
                'title' => 'vehicle_brand_show',
            ],
            [
                'id'    => 21,
                'title' => 'vehicle_brand_delete',
            ],
            [
                'id'    => 22,
                'title' => 'vehicle_brand_access',
            ],
            [
                'id'    => 23,
                'title' => 'carpark_location_create',
            ],
            [
                'id'    => 24,
                'title' => 'carpark_location_edit',
            ],
            [
                'id'    => 25,
                'title' => 'carpark_location_show',
            ],
            [
                'id'    => 26,
                'title' => 'carpark_location_delete',
            ],
            [
                'id'    => 27,
                'title' => 'carpark_location_access',
            ],
            [
                'id'    => 28,
                'title' => 'vehicle_management_create',
            ],
            [
                'id'    => 29,
                'title' => 'vehicle_management_edit',
            ],
            [
                'id'    => 30,
                'title' => 'vehicle_management_show',
            ],
            [
                'id'    => 31,
                'title' => 'vehicle_management_delete',
            ],
            [
                'id'    => 32,
                'title' => 'vehicle_management_access',
            ],
            [
                'id'    => 33,
                'title' => 'resident_access',
            ],
            [
                'id'    => 34,
                'title' => 'carpark_log_create',
            ],
            [
                'id'    => 35,
                'title' => 'carpark_log_edit',
            ],
            [
                'id'    => 36,
                'title' => 'carpark_log_show',
            ],
            [
                'id'    => 37,
                'title' => 'carpark_log_delete',
            ],
            [
                'id'    => 38,
                'title' => 'carpark_log_access',
            ],
            [
                'id'    => 39,
                'title' => 'rate_setting_access',
            ],
            [
                'id'    => 40,
                'title' => 'unit_access',
            ],
            [
                'id'    => 41,
                'title' => 'event_access',
            ],
            [
                'id'    => 42,
                'title' => 'event_category_create',
            ],
            [
                'id'    => 43,
                'title' => 'event_category_edit',
            ],
            [
                'id'    => 44,
                'title' => 'event_category_show',
            ],
            [
                'id'    => 45,
                'title' => 'event_category_delete',
            ],
            [
                'id'    => 46,
                'title' => 'event_category_access',
            ],
            [
                'id'    => 47,
                'title' => 'family_access',
            ],
            [
                'id'    => 48,
                'title' => 'tenant_access',
            ],
            [
                'id'    => 49,
                'title' => 'event_control_create',
            ],
            [
                'id'    => 50,
                'title' => 'event_control_edit',
            ],
            [
                'id'    => 51,
                'title' => 'event_control_show',
            ],
            [
                'id'    => 52,
                'title' => 'event_control_delete',
            ],
            [
                'id'    => 53,
                'title' => 'event_control_access',
            ],
            [
                'id'    => 54,
                'title' => 'facility_access',
            ],
            [
                'id'    => 55,
                'title' => 'visitor_access',
            ],
            [
                'id'    => 56,
                'title' => 'defect_access',
            ],
            [
                'id'    => 57,
                'title' => 'event_enroll_create',
            ],
            [
                'id'    => 58,
                'title' => 'event_enroll_edit',
            ],
            [
                'id'    => 59,
                'title' => 'event_enroll_show',
            ],
            [
                'id'    => 60,
                'title' => 'event_enroll_delete',
            ],
            [
                'id'    => 61,
                'title' => 'event_enroll_access',
            ],
            [
                'id'    => 62,
                'title' => 'notice_access',
            ],
            [
                'id'    => 63,
                'title' => 'access_management_access',
            ],
            [
                'id'    => 64,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 65,
                'title' => 'user_alert_edit',
            ],
            [
                'id'    => 66,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 67,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 68,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 69,
                'title' => 'notice_board_create',
            ],
            [
                'id'    => 70,
                'title' => 'notice_board_edit',
            ],
            [
                'id'    => 71,
                'title' => 'notice_board_show',
            ],
            [
                'id'    => 72,
                'title' => 'notice_board_delete',
            ],
            [
                'id'    => 73,
                'title' => 'notice_board_access',
            ],
            [
                'id'    => 74,
                'title' => 'resident_setting_access',
            ],
            [
                'id'    => 75,
                'title' => 'family_setting_access',
            ],
            [
                'id'    => 76,
                'title' => 'form_access',
            ],
            [
                'id'    => 77,
                'title' => 'tenant_setting_access',
            ],
            [
                'id'    => 78,
                'title' => 'feedback_access',
            ],
            [
                'id'    => 79,
                'title' => 'add_feedback_create',
            ],
            [
                'id'    => 80,
                'title' => 'add_feedback_edit',
            ],
            [
                'id'    => 81,
                'title' => 'add_feedback_show',
            ],
            [
                'id'    => 82,
                'title' => 'add_feedback_delete',
            ],
            [
                'id'    => 83,
                'title' => 'add_feedback_access',
            ],
            [
                'id'    => 84,
                'title' => 'feedback_category_create',
            ],
            [
                'id'    => 85,
                'title' => 'feedback_category_edit',
            ],
            [
                'id'    => 86,
                'title' => 'feedback_category_show',
            ],
            [
                'id'    => 87,
                'title' => 'feedback_category_delete',
            ],
            [
                'id'    => 88,
                'title' => 'feedback_category_access',
            ],
            [
                'id'    => 89,
                'title' => 'e_billing_access',
            ],
            [
                'id'    => 90,
                'title' => 'add_unit_create',
            ],
            [
                'id'    => 91,
                'title' => 'add_unit_edit',
            ],
            [
                'id'    => 92,
                'title' => 'add_unit_show',
            ],
            [
                'id'    => 93,
                'title' => 'add_unit_delete',
            ],
            [
                'id'    => 94,
                'title' => 'add_unit_access',
            ],
            [
                'id'    => 95,
                'title' => 'payment_method_create',
            ],
            [
                'id'    => 96,
                'title' => 'payment_method_edit',
            ],
            [
                'id'    => 97,
                'title' => 'payment_method_show',
            ],
            [
                'id'    => 98,
                'title' => 'payment_method_delete',
            ],
            [
                'id'    => 99,
                'title' => 'payment_method_access',
            ],
            [
                'id'    => 100,
                'title' => 'add_block_create',
            ],
            [
                'id'    => 101,
                'title' => 'add_block_edit',
            ],
            [
                'id'    => 102,
                'title' => 'add_block_show',
            ],
            [
                'id'    => 103,
                'title' => 'add_block_delete',
            ],
            [
                'id'    => 104,
                'title' => 'add_block_access',
            ],
            [
                'id'    => 105,
                'title' => 'carpark_payment_create',
            ],
            [
                'id'    => 106,
                'title' => 'carpark_payment_edit',
            ],
            [
                'id'    => 107,
                'title' => 'carpark_payment_show',
            ],
            [
                'id'    => 108,
                'title' => 'carpark_payment_delete',
            ],
            [
                'id'    => 109,
                'title' => 'carpark_payment_access',
            ],
            [
                'id'    => 110,
                'title' => 'maintenances_payment_create',
            ],
            [
                'id'    => 111,
                'title' => 'maintenances_payment_edit',
            ],
            [
                'id'    => 112,
                'title' => 'maintenances_payment_show',
            ],
            [
                'id'    => 113,
                'title' => 'maintenances_payment_delete',
            ],
            [
                'id'    => 114,
                'title' => 'maintenances_payment_access',
            ],
            [
                'id'    => 115,
                'title' => 'facilitypayment_create',
            ],
            [
                'id'    => 116,
                'title' => 'facilitypayment_edit',
            ],
            [
                'id'    => 117,
                'title' => 'facilitypayment_show',
            ],
            [
                'id'    => 118,
                'title' => 'facilitypayment_delete',
            ],
            [
                'id'    => 119,
                'title' => 'facilitypayment_access',
            ],
            [
                'id'    => 120,
                'title' => 'event_payment_create',
            ],
            [
                'id'    => 121,
                'title' => 'event_payment_edit',
            ],
            [
                'id'    => 122,
                'title' => 'event_payment_show',
            ],
            [
                'id'    => 123,
                'title' => 'event_payment_delete',
            ],
            [
                'id'    => 124,
                'title' => 'event_payment_access',
            ],
            [
                'id'    => 125,
                'title' => 'unit_management_create',
            ],
            [
                'id'    => 126,
                'title' => 'unit_management_edit',
            ],
            [
                'id'    => 127,
                'title' => 'unit_management_show',
            ],
            [
                'id'    => 128,
                'title' => 'unit_management_delete',
            ],
            [
                'id'    => 129,
                'title' => 'unit_management_access',
            ],
            [
                'id'    => 130,
                'title' => 'facility_category_create',
            ],
            [
                'id'    => 131,
                'title' => 'facility_category_edit',
            ],
            [
                'id'    => 132,
                'title' => 'facility_category_show',
            ],
            [
                'id'    => 133,
                'title' => 'facility_category_delete',
            ],
            [
                'id'    => 134,
                'title' => 'facility_category_access',
            ],
            [
                'id'    => 135,
                'title' => 'facility_management_create',
            ],
            [
                'id'    => 136,
                'title' => 'facility_management_edit',
            ],
            [
                'id'    => 137,
                'title' => 'facility_management_show',
            ],
            [
                'id'    => 138,
                'title' => 'facility_management_delete',
            ],
            [
                'id'    => 139,
                'title' => 'facility_management_access',
            ],
            [
                'id'    => 140,
                'title' => 'form_category_create',
            ],
            [
                'id'    => 141,
                'title' => 'form_category_edit',
            ],
            [
                'id'    => 142,
                'title' => 'form_category_show',
            ],
            [
                'id'    => 143,
                'title' => 'form_category_delete',
            ],
            [
                'id'    => 144,
                'title' => 'form_category_access',
            ],
            [
                'id'    => 145,
                'title' => 'facility_book_create',
            ],
            [
                'id'    => 146,
                'title' => 'facility_book_edit',
            ],
            [
                'id'    => 147,
                'title' => 'facility_book_show',
            ],
            [
                'id'    => 148,
                'title' => 'facility_book_delete',
            ],
            [
                'id'    => 149,
                'title' => 'facility_book_access',
            ],
            [
                'id'    => 150,
                'title' => 'add_visitor_create',
            ],
            [
                'id'    => 151,
                'title' => 'add_visitor_edit',
            ],
            [
                'id'    => 152,
                'title' => 'add_visitor_show',
            ],
            [
                'id'    => 153,
                'title' => 'add_visitor_delete',
            ],
            [
                'id'    => 154,
                'title' => 'add_visitor_access',
            ],
            [
                'id'    => 155,
                'title' => 'location_create',
            ],
            [
                'id'    => 156,
                'title' => 'location_edit',
            ],
            [
                'id'    => 157,
                'title' => 'location_show',
            ],
            [
                'id'    => 158,
                'title' => 'location_delete',
            ],
            [
                'id'    => 159,
                'title' => 'location_access',
            ],
            [
                'id'    => 160,
                'title' => 'history_create',
            ],
            [
                'id'    => 161,
                'title' => 'history_edit',
            ],
            [
                'id'    => 162,
                'title' => 'history_show',
            ],
            [
                'id'    => 163,
                'title' => 'history_delete',
            ],
            [
                'id'    => 164,
                'title' => 'history_access',
            ],
            [
                'id'    => 165,
                'title' => 'qr_create',
            ],
            [
                'id'    => 166,
                'title' => 'qr_edit',
            ],
            [
                'id'    => 167,
                'title' => 'qr_show',
            ],
            [
                'id'    => 168,
                'title' => 'qr_delete',
            ],
            [
                'id'    => 169,
                'title' => 'qr_access',
            ],
            [
                'id'    => 170,
                'title' => 'status_control_create',
            ],
            [
                'id'    => 171,
                'title' => 'status_control_edit',
            ],
            [
                'id'    => 172,
                'title' => 'status_control_show',
            ],
            [
                'id'    => 173,
                'title' => 'status_control_delete',
            ],
            [
                'id'    => 174,
                'title' => 'status_control_access',
            ],
            [
                'id'    => 175,
                'title' => 'defact_category_create',
            ],
            [
                'id'    => 176,
                'title' => 'defact_category_edit',
            ],
            [
                'id'    => 177,
                'title' => 'defact_category_show',
            ],
            [
                'id'    => 178,
                'title' => 'defact_category_delete',
            ],
            [
                'id'    => 179,
                'title' => 'defact_category_access',
            ],
            [
                'id'    => 180,
                'title' => 'add_defect_create',
            ],
            [
                'id'    => 181,
                'title' => 'add_defect_edit',
            ],
            [
                'id'    => 182,
                'title' => 'add_defect_show',
            ],
            [
                'id'    => 183,
                'title' => 'add_defect_delete',
            ],
            [
                'id'    => 184,
                'title' => 'add_defect_access',
            ],
            [
                'id'    => 185,
                'title' => 'activity_log_access',
            ],
            [
                'id'    => 186,
                'title' => 'check_facility_create',
            ],
            [
                'id'    => 187,
                'title' => 'check_facility_edit',
            ],
            [
                'id'    => 188,
                'title' => 'check_facility_show',
            ],
            [
                'id'    => 189,
                'title' => 'check_facility_delete',
            ],
            [
                'id'    => 190,
                'title' => 'check_facility_access',
            ],
            [
                'id'    => 191,
                'title' => 'add_family_member_create',
            ],
            [
                'id'    => 192,
                'title' => 'add_family_member_edit',
            ],
            [
                'id'    => 193,
                'title' => 'add_family_member_show',
            ],
            [
                'id'    => 194,
                'title' => 'add_family_member_delete',
            ],
            [
                'id'    => 195,
                'title' => 'add_family_member_access',
            ],
            [
                'id'    => 196,
                'title' => 'add_tanent_create',
            ],
            [
                'id'    => 197,
                'title' => 'add_tanent_edit',
            ],
            [
                'id'    => 198,
                'title' => 'add_tanent_show',
            ],
            [
                'id'    => 199,
                'title' => 'add_tanent_delete',
            ],
            [
                'id'    => 200,
                'title' => 'add_tanent_access',
            ],
            [
                'id'    => 201,
                'title' => 'entrance_create',
            ],
            [
                'id'    => 202,
                'title' => 'entrance_edit',
            ],
            [
                'id'    => 203,
                'title' => 'entrance_show',
            ],
            [
                'id'    => 204,
                'title' => 'entrance_delete',
            ],
            [
                'id'    => 205,
                'title' => 'entrance_access',
            ],
            [
                'id'    => 206,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 207,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 208,
                'title' => 'vehicle_model_create',
            ],
            [
                'id'    => 209,
                'title' => 'vehicle_model_edit',
            ],
            [
                'id'    => 210,
                'title' => 'vehicle_model_show',
            ],
            [
                'id'    => 211,
                'title' => 'vehicle_model_delete',
            ],
            [
                'id'    => 212,
                'title' => 'vehicle_model_access',
            ],
            [
                'id'    => 213,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
