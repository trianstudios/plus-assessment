<x-admin-layout>

    <x-slot name="backButton">
        <a href="{{ route('admin.users.index') }}" class="pb-5 link">
            <small>Back to Users</small>
        </a>
    </x-slot>

    <x-slot name="title">
        Add New User
    </x-slot>

    <x-slot name="content">
        <div class="pt-50">
            <x-admin.users.user-form :roles="$roles" :user="null" :post-route="route('admin.users.store')" :form-method="'POST'" />
        </div>
    </x-slot>

</x-admin-layout>
