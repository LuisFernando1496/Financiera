<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $sup_manager = Role::create(['name' => 'supManager']);
        $manager = Role::create(['name' => 'manager']);
        $admin = Role::create(['name' => 'admin']);

        //Permiso de creación de usuarios
        $user_store = Permission::create(['name' => 'users.store']);
        $user_edit = Permission::create(['name' => 'users.update']);
        $user_delete = Permission::create(['name' => 'users.delete']);
        $user_list = Permission::create(['name' => 'users.index']);

        $client_store = Permission::create(['name' => 'clients.store']);
        $client_edit = Permission::create(['name' => 'clients.update']);
        $client_delete = Permission::create(['name' => 'clients.delete']);
        $client_list = Permission::create(['name' => 'clients.index']);

        $credit_store = Permission::create(['name' => 'credits.store']);
        $credit_accept = Permission::create(['name' => 'credits.accept']);
        $credit_cancel = Permission::create(['name' => 'credits.cancel']);
        $credit_list = Permission::create(['name' => 'credits.index']);

        $branch_store = Permission::create(['name' => 'branches.store']);
        $branch_edit = Permission::create(['name' => 'branches.update']);
        $branch_delete = Permission::create(['name' => 'branches.delete']);
        $branch_list = Permission::create(['name' => 'branches.index']);

        $insurance_store = Permission::create(['name' => 'insurances.store']);
        $insurance_edit = Permission::create(['name' => 'insurances.update']);
        $insurance_delete = Permission::create(['name' => 'insurances.delete']);
        $insurance_list = Permission::create(['name' => 'insurances.index']);

        $survey_store = Permission::create(['name' => 'surveys.store']);
        $survey_edit = Permission::create(['name' => 'surveys.update']);
        $survey_delete = Permission::create(['name' => 'surveys.delete']);
        $survey_list = Permission::create(['name' => 'surveys.index']);

        $generate_reports = Permission::create(['name' => 'reports.generate']);

        $expenses_store = Permission::create(['name' => 'expenses.store']);
        $expenses_edit = Permission::create(['name' => 'expenses.update']);
        $expenses_delete = Permission::create(['name' => 'expenses.delete']);
        $expenses_list = Permission::create(['name' => 'expenses.index']);

        $boxes_store = Permission::create(['name' => 'boxes.store']);
        $boxes_edit = Permission::create(['name' => 'boxes.update']);
        $boxes_delete = Permission::create(['name' => 'boxes.delete']);
        $boxes_list = Permission::create(['name' => 'boxes.index']);

        $cash_store = Permission::create(['name' => 'cash.store']);
        $cash_edit = Permission::create(['name' => 'cash.update']);
        $cash_delete = Permission::create(['name' => 'cash.delete']);
        $cash_list = Permission::create(['name' => 'cash.index']);

        $payments_store = Permission::create(['name' => 'payments.store']);
        $payments_edit = Permission::create(['name' => 'payments.update']);
        $payments_delete = Permission::create(['name' => 'payments.delete']);
        $payments_list = Permission::create(['name' => 'payments.index']);

        $route_day = Permission::create(['name' => 'routes.index']);

        $visit_list = Permission::create(['name' => 'visits.index']);
        $visit_process = Permission::create(['name' => 'visits.process']);
        $visit_status = Permission::create(['name' => 'visits.status']);
        $visit_done = Permission::create(['name' => 'visits.done']);

        $sup_manager->givePermissionTo([
            $user_store, $user_edit, $user_delete, $user_list, $client_store, $client_edit,
            $client_delete, $client_list, $credit_accept, $credit_store, $credit_cancel, $credit_list,
            $branch_store, $branch_edit, $branch_delete, $branch_list, $insurance_store, $insurance_edit, $insurance_delete, $insurance_list,
            $survey_store, $survey_edit, $survey_delete, $survey_list, $generate_reports, $expenses_store, $expenses_edit, $expenses_delete, $expenses_list,
            $boxes_store, $boxes_edit, $boxes_delete, $boxes_list, $cash_store, $cash_edit, $cash_delete, $cash_list,
            $payments_store, $payments_edit, $payments_delete, $payments_list, $route_day, $visit_list, $visit_process, $visit_status, $visit_done
        ]);

        $manager->givePermissionTo([
            $user_store, $user_edit, $user_delete, $user_list, $client_store, $client_edit,
            $client_delete, $client_list, $credit_accept, $credit_store, $credit_cancel, $credit_list,
            $branch_store, $branch_edit, $branch_delete, $branch_list, $insurance_store, $insurance_edit, $insurance_delete, $insurance_list,
            $survey_store, $survey_edit, $survey_delete, $survey_list, $generate_reports, $expenses_store, $expenses_edit, $expenses_delete, $expenses_list,
            $boxes_store, $boxes_edit, $boxes_delete, $boxes_list, $cash_store, $cash_edit, $cash_delete, $cash_list,
            $payments_store, $payments_edit, $payments_delete, $payments_list, $route_day, $visit_list, $visit_process, $visit_status, $visit_done
        ]);

        $admin->givePermissionTo([
            $user_store, $user_edit, $user_delete, $user_list, $client_store, $client_edit,
            $client_delete, $client_list, $credit_store, $credit_list,
            $branch_store, $branch_edit, $branch_delete, $branch_list, $insurance_store, $insurance_edit, $insurance_delete, $insurance_list,
            $survey_store, $survey_edit, $survey_delete, $survey_list, $generate_reports, $expenses_store, $expenses_edit, $expenses_delete, $expenses_list,
            $boxes_store, $boxes_edit, $boxes_delete, $boxes_list, $cash_store, $cash_edit, $cash_delete, $cash_list,
            $payments_store, $payments_edit, $payments_delete, $payments_list, $route_day, $visit_list, $visit_process, $visit_status, $visit_done
        ]);
    }
}
