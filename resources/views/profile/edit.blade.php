<x-app-layout>
    <div class="mainRegDiv">

        <h1 class="orange-bar">My Profile</h1>

        <div class="flex flex-col lg:flex-row gap-6">
            <div class="formDiv">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="formDiv">
                @include('profile.partials.update-password-form')
            </div>
        </div>
        <div class="formDiv">
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</x-app-layout>