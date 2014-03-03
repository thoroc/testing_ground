<?php

echo '<h3>demonstration of string matching in array</h3>';

$routes = array(
    "home",
    "admin_security",
    "admin_security_permissions",
    "admin_security_edit_permissions",
    "admin_security_set_access_level",
    "admin_roles",
    "admin_users",
    "admin_block_unblock_user",
    "admin_edit_user_roles",
    "legacy_siteadmin",
    "employeedb_actionrequests",
    "employeedb_requestinfo",
    "employeedb_assign_request",
    "employeedb_unassign_request",
    "employeedb_approve_request",
    "employeedb_reject_request",
    "employeedb_cancel_request",
    "employeedb_requesttask_complete",
    "employeedb_requesttask_revert",
    "employeedb_organisations",
    "employeedb_organisations_edit",
    "employeedb_organisations_enable",
    "employeedb_organisations_disable",
    "employeedb_organisations_delete",
    "employeedb_organisation_attributes",
    "employeedb_organisation_edit_attributes",
    "employeedb_organisation_sort_attributes",
    "employeedb_attributes",
    "employeedb_attributes_edit",
    "employeedb_attributes_enable",
    "employeedb_attributes_disable",
    "employeedb_attributes_delete",
    "employeedb_attributes_edit_values",
    "employeedb_attributes_sort_values",
    "employeedb_attributes_particulars",
    "employeedb_attributes_multiple",
    "employeedb_employee_data",
    "employeedb_actiontasks",
    "employeedb_edit_actiontask",
    "employeedb_disable_actiontask",
    "employeedb_autocomplete_employees",
    "employeedb_autocomplete_attributes",
    "legacy_engagementmetrics",
    "legacy_hipreports",
    "legacy_fsatreports",
    "legacy_entitlement",
    "legacy_icdrsearch",
    "legacy_accountlookup",
    "employeedb_report",
    "feedback_thread",
    "feedback",
    "triage_accuracy",
    "issuereport",
    "issuelist",
    "issue",
    "issue_forward",
    "issue_mark",
    "issue_raise",
    "wg_gitlab_issues",
    "wg_gitlab_issue_delete",
    "wg_gitlab_issue",
    "wg_gitlab_access",
    "wg_gitlab_access_delete",
    "legacy_activitytracker",
    "employeedb_report_attribute_add",
    "employeedb_report_attribute_remove",
    "employeedb_employee_history",
    "employeedb_valueconstraints_values",
    "employeedb_valueconstraints_delete",
    "employeedb_valueconstraints",
    "employeedb_reassign_request",
    "employeedb_organisation_schema",
    "employeedb_attributes_value_edit",
    "employeedb_attributes_value_remove",
    "usagelist",
    "usagedetails",
    "usagestats",
    "admin_tools",
    "admin_tools_hierarchy_loader",
    "admin_tools_fsatresult_loader",
    "admin_tools_fiscalmonth_loader",
    "admin_tools_fiscalmonth_remove",
    "admin_tools_fiscalmonth_add",
    "admin_tools_vovici_export",
    "sharedaccount_lookup",
    "entitlement",
    "entitlement_denial",
    "entitlement_denial_remove",
    "entitlement_role",
    "entitlement_role_remove",
    "entitlement_role_add",
    "entitlement_exception",
    "entitlement_exception_add",
    "entitlement_exception_remove",
    "ldap_attribute_batch_lookup",
    "employeedb_attributes_actionable",
    "metrics_home",
    "metrics_casecounts",
    "metrics_hip",
    "metrics_yoy",
    "metrics_fielduser",
    "metrics_adoption",
    "metrics_average_cases",
    "metrics_partnerplus_list",
    "metrics_partnerplus_detail",
    "metrics_partnerplus_autocomplete_names",
    "metrics_fsat_overview",
    "metrics_engagement_type",
    "metrics_export_rawdata",
    "cisco_audit_add",
    "cisco_audit_view",
    "cisco_audits",
    "cisco_audit_completed",
    "cisco_auditform_add",
    "cisco_auditform_list",
    "cisco_auditform_edit",
    "cisco_auditform_delete",
    "cisco_auditform_add_section",
    "cisco_auditform_new_section",
    "cisco_auditform_remove",
    "cisco_auditform_view",
    "cisco_auditforms",
    "cisco_auditsection_add",
    "cisco_auditsection_edit",
    "cisco_auditsection_delete",
    "cisco_auditsection_add_field",
    "cisco_auditsection_new_field",
    "cisco_auditsection_remove",
    "cisco_auditsection_view",
    "cisco_auditsection_load",
    "cisco_auditsections",
    "cisco_auditfield_add",
    "cisco_auditfield_edit",
    "cisco_auditfield_delete",
    "cisco_auditfield_calculate_score",
    "cisco_auditfield_view",
    "cisco_auditfield_load",
    "cisco_auditfields",
    "admin_tools_hierarchy_popup",
    "admin_tools_marcom_export",
    "legacy_icdrmetrics",
    "metrics_hierarchy_ssot",
    "metrics_hierarchy_ssot_detail",
    "metrics_hierarchy_ssot_edit",
    "metrics_hierarchy_autocomplete_userid",
    "metrics_hierarchy_autocomplete_reports",
    "fsat_lsfu_removal_requests",
    "fsat_lsfu_removal_report",
    "fsat_fsatresult_loader",
    "cisco_audit_adds",
    "cisco_audit_test",
);

//echo $routes;

echo '<div>';

foreach( $routes as $key => $value )
{
    echo '<div>' . $value;
    if( stripos( $value, 'cisco_audit' ) !== FALSE )
    {
        echo '<font color="red"> found \'audit\' in the string</font>';
    }
    echo '</div>';
}

echo '</div>';
?>