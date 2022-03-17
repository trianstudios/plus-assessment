<form method="{{ $formMethod }}" action="{{ $postRoute }}">
    @csrf
    @if(Route::currentRouteName() === 'admin.users.edit')
        @method("PUT")
    @endif
    <div class="width-50">
        <div class="form_group_row">
            <div class="form__group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{ optional($user)->first_name }}">
                @if($errors->has('first_name'))
                    <div class="error">{{ $errors->first('first_name') }}</div>
                @endif
            </div>
            <div class="form__group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{ optional($user)->last_name }}">
                @if($errors->has('last_name'))
                    <div class="error">{{ $errors->first('last_name') }}</div>
                @endif
            </div>
        </div>
        <div class="form_group_row">
            <div class="form__group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ optional($user)->email }}">
                @if($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form__group">
                <label for="roles">Role</label>
                <div id="output"></div>
                <select data-placeholder="Assign roles ..." id="roles" name="roles[]" multiple class="chosen-select">
                    <option value=""></option>
                    @if($roles->isNotEmpty())
                        @foreach($roles as $role)
                            @if(Route::currentRouteName() === 'admin.users.edit')
                                @if(in_array($role->id, $user->roles->pluck('id')->toArray(), true))
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                            @else
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
                @if($errors->has('roles'))
                    <div class="error">{{ $errors->first('roles') }}</div>
                @endif
            </div>
        </div>
        <div class="form_group_row">
            <div class="form__group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}">
                @if($errors->has('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="form__group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}">
                @if($errors->has('password_confirmation'))
                    <div class="error">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-secondary btn-bordered btn-cons btn-rounded">Apply Changes</button>
    </div>
</form>

@push('scripts')
    <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
    <script>
        $(".chosen-select").chosen();
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://harvesthq.github.io/chosen/chosen.css">
@endpush
