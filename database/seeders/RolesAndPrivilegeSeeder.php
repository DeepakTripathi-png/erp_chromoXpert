<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RolesAndPrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [];
        $input['role_name'] = "Super Admin";
        $input['privileges'] = 'dashboard_view,master_view,category_view,category_add,category_edit,category_delete,category_status_change,cms_view,page_content_view,home_page_view,home_page_add,home_page_edit,about_us_view,about_us_add,about_us_edit,service_consulting_view,service_consulting_add,service_consulting_edit,service_subscription_view,service_subscription_add,service_subscription_edit,custom_research_service_view,custom_research_service_add,custom_research_service_edit,we_market_client_support_view,we_market_client_support_add,we_market_client_support_edit,research_methodology_view,research_methodology_add,research_methodology_edit,testimonials_view,testimonials_add,testimonials_edit,testimonials_delete,testimonials_status_change,privacy_policy_view,privacy_policy_add,privacy_policy_edit,terms_of_use_view,terms_of_use_add,terms_of_use_edit,media_view,blog_press_release_view,blog_press_release_add,blog_press_release_edit,blog_press_release_delete,blog_press_release_status_change,infographics_view,infographics_add,infographics_edit,infographics_delete,infographics_status_change,publisher_report_view,careers_view,careers_add,careers_edit,careers_delete,careers_status_change,report_view,report_add,report_edit,report_delete,report_status_change,report_other,related_report_view,related_report_add,related_report_delete,related_report_status_change,enquiries_view,enquiries_delete,enquiries_other,payment_transaction_details_view,payment_transaction_details_delete,payment_transaction_details_other,contact_enquiry_view,contact_enquiry_delete,contact_enquiry_other,career_applicant_view,career_applicant_delete,career_applicant_other,subscriber_view,subscriber_delete,system_user_view,user_view,user_add,user_edit,user_delete,user_status_change,role_privileges_view,role_privileges_add,role_privileges_edit,role_privileges_delete,role_privileges_status_change,setting_view,general_setting_view,general_setting_add,general_setting_edit,email_setting_view,email_setting_add,email_setting_edit,visual_setting_view,visual_setting_add,visual_setting_edit';

        DB::table('role_privileges')->insert($input);
    }
}
