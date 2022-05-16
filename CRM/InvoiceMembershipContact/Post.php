<?php

class CRM_InvoiceMembershipContact_Post {
  /**
   * Process Post Hook for MembershipPayment creation.
   * This works better for webform_civicrm submissions, which don't necessarily
   * trigger civicrm_post for create operations on line items.
   *
   * @param $op - operation being performed (create, edit, delete).
   * @param $id - ID of the operated on payment.
   * @param $MembershipPayment - DAO representing the MembershipPayment.
   */
  public static function MembershipPayment($op, $id, &$MembershipPayment) {
    if ('create' == $op) {
      if(empty(Civi::$statics[__CLASS__]['contribution'][$MembershipPayment->contribution_id])) {
        // Only update the Contribution entity once.
        Civi::$statics[__CLASS__]['contribution'][$MembershipPayment->contribution_id] = TRUE;

        try {
          // Get the Membership and Contribution details
          $membership = civicrm_api3('Membership', 'getsingle', [
                          'id'     => $MembershipPayment->membership_id,
                          'return' => ['id','contact_id'],
                        ]);

          $contribution = civicrm_api3('Contribution', 'getsingle', [
                            'id'     => $MembershipPayment->contribution_id,
                            'return' => ['id','contact_id','total_amount','tax_amount'],
                          ]);

          // Check if the contact IDs match
          if ($membership['contact_id'] != $contribution['contact_id']) {
            // Contact IDs don't match, update the Contribution

            // Initialize soft credit to the original contact
            $soft_credit = [
              'contribution_id' => $contribution['id'],
              'contact_id' => $contribution['contact_id'],
              'amount' => $contribution['total_amount'],
            ];

            // Update Contribution with Membership's Contact ID
            $contribution['contact_id'] = $membership['contact_id'];
            civicrm_api3('Contribution', 'create', [
              'id' => $contribution['id'],
              'contact_id' => $membership['contact_id']
              ]);

            // Process soft credit
            civicrm_api3('ContributionSoft', 'create', $soft_credit);
          }

        }
        catch (CiviCRM_API3_Exception $e) {
          CRM_Core_Error::debug_log_message($e->getMessage());
        }
      }
    }
  }
}
