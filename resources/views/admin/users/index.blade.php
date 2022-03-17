<x-admin-layout>

    <x-slot name="title">
        Users
    </x-slot>

    <x-slot name="createNewButton">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-md">Create New User</a>
    </x-slot>

    <x-slot name="content">
        <div class="search">
            <div class="form_group">
                <label for="searchText">User name</label>
                <div class="form__group__inner pt-20">
                    <input type="text" onkeyup="searchingTable();" placeholder="Search for users" name="searchText" id="searchText" />
                    <button type="submit" class="search__btn">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="pt-50 pb-50">
            @if($users->isNotEmpty())
                <table id="dataTable">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Role(s)</th>
                        <th>Member Since</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}" class="link">{{ $user->first_name }}</a>
                            </td>
                            <td>
                                {{ $user->last_name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                @if($user->roles->isNotEmpty())
                                    @foreach($user->roles as $role)
                                        <small class="badge badge-secondary">{{ $role->name }}</small>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                {{ $user->created_at->format('d F Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($users->hasPages())
                    <div class="pagination-wrapper pb-50 pt-30">
                        {{ $users->links() }}
                    </div>
                @endif
            @else
                <h2>We currently do not have any users available</h2>
            @endif
        </div>
    </x-slot>

    @push('scripts')
        <script>
            function searchingTable() {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("searchText");
                filter = input.value.toUpperCase();
                table = document.getElementById("dataTable");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }

        </script>
    @endpush

</x-admin-layout>
