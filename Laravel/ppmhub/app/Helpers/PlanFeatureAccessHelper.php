<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\Payment\user_subscription;
use App\Models\Payment\plan_features;
use App\Project;
use App\register;
class PlanFeatureAccessHelper {

   public static function getCurrentPlan() {
      $current_subscription = user_subscription::query()
              ->select('user_subscription.*', 'plan_features.*')
              ->leftJoin('plans', 'user_subscription.braintree_subscription_plan', 'plans.braintree_plan')
              ->leftJoin('plan_features', 'plans.braintree_plan', 'plan_features.plan_id')
              ->where('user_subscription.company_id', Auth::user()->company_id)
//              ->where('user_subscription.active_subsription', '1')
              ->first();
      return ($current_subscription) ? $current_subscription : NULL;
   }

   /**
    * 
    * Return true if the admin can create user as per plan
    * 
    */
   public static function canCreateUser() {
      $currentPlan = self::getCurrentPlan();
      $invitedUsers = register::where('company_id',Auth::user()->company_id)->count()-1;
      return true; // please remove when project get started with new user
      return (isset($currentPlan->user) && ($invitedUsers < $currentPlan->user));
   }

   /**
    * 
    * Return true if the admin can create project as per plan
    */
   public static function canCreateProject() {
      $currentPlan = self::getCurrentPlan();
      $createdProject = Project::where('company_id', Auth::user()->company_id)->count();
      return true; // please remove when project get started with new user
      return (isset($currentPlan->project) && ($createdProject < $currentPlan->project));
   }

}
