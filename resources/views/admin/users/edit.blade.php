<x-admin-layout>

    <x-slot name="backButton">
        <a href="{{ route('admin.users.index') }}" class="pb-5 link">
            <small>Back to Users</small>
        </a>
    </x-slot>

    <x-slot name="title">
        {{ $user->first_name . ' ' . $user->last_name }}
    </x-slot>

    <x-slot name="content">
        <div class="pt-50">
            <x-admin.users.user-form :roles="$roles" :user="$user" :post-route="route('admin.users.update', $user)" :form-method="'POST'" />
        </div>
    </x-slot>

</x-admin-layout>
