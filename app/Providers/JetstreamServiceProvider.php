<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\UpdateTeamName;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::loginView(function () {
            // dd("in");
    return view('auth.login');
});
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::authenticateUsing(function (Request $request) {
            // dd($request->user());
            $user = User::where('email', $request->email)->first();
        });
    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', __('Administrator'), [
            'create',
            'read',
            'update',
            'delete',
        ])->description(__('Administrator users can perform any action.'));

        Jetstream::role('editor', __('Editor'), [
            'read',
            'create',
            'update',
        ])->description(__('Editor users have the ability to read, create, and update.'));
    }
}
