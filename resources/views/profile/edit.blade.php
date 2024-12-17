@extends('layouts/app')
@section('stylecss')
<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
    }

    .label {
        min-width: 120px;
        color: rgb(129, 129, 255);
        font-weight: bold;
        font-size: 16px;
        white-space: nowrap;
        margin-right: 40px;
    }

    .mb-3 {
        display: flex;
        flex-direction: row;
    }

    .value {
        flex: 1;
        font-size: 16px;
    }

    .name {
        font-size: 2em;
        font-weight: bold;
        color: #333333;
        margin-top: 30px;
        margin-bottom: 10px;
        text-align: center;
        font-family: "Arial", sans-serif;
    }

    .nim {
        font-size: 1.5em;
        font-weight: normal;
        color: #333333;
        text-align: center;
        font-family: "Arial", sans-serif;
    }

    .tab-link {
        position: relative;
        padding-bottom: 5px;
    }

    .tab-link.active::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #007bff;
        border-radius: 2px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="page-inner">
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-1"></div>
        <div class="row mt-2">
            <div class="col-md-4 mx-auto">
                <div
                    class="card text-center d-flex align-items-center justify-content-center"
                    style="
                                        padding: 20px;
                                        border-radius: 20px;
                                        height: 100%;
                                    ">
                    <div
                        class="card-body d-flex flex-column align-items-center">
                        <div
                            class="avatar-sm"
                            style="width: 150px; height: 150px">
                            <img
                                src="{{!Auth::user()->photo ? 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y': asset('/storage/'.Auth::user()->photo) }}"
                                alt="..."
                                class="rounded-circle img-fluid"
                                style="
                                                    width: 100%;
                                                    height: 100%;
                                                    object-fit: cover;
                                                " />
                        </div>
                        <h5 class="name">
                            {{$pegawai->nama}}
                        </h5>
                        <h4 class="nip">{{ Auth::user()->niplama }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card h-100 ">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title mb-0 me-4 tab-link active" id="profile-tab" style="cursor: pointer;">
                            {{ __('Detail Profile') }}
                        </h4>
                        <h4 class="card-title mb-0 tab-link" id="password-tab" style="cursor: pointer;">
                            {{ __('Update Password') }}
                        </h4>
                    </div>

                    <div class="card-body" id="profile-content">
                        <form method="POST" action="{{route('edit.profile')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div
                                    class="mb-3 d-flex align-items-center">
                                    <div class="label">
                                        {{__("Nama")}}
                                    </div>
                                    <div class="value">
                                        {{$pegawai->nama}}
                                    </div>
                                </div>
                                <div
                                    class="mb-3 d-flex align-items-center">
                                    <div class="label">{{__("NIP")}}</div>
                                    <div class="value">
                                        {{$pegawai->nip_baru}}
                                    </div>
                                </div>
                                <div
                                    class="mb-3 d-flex align-items-center">
                                    <div class="label">{{__("Email")}}</div>
                                    <div class="value">
                                        {{ Auth::user()->email }}
                                    </div>
                                </div>
                                <div
                                    class="mb-3 d-flex align-items-center">
                                    <div class="label">{{__("Jabatan")}}</div>
                                    <div class="value">
                                        {{$pegawai->jabatan}}
                                    </div>
                                </div>
                                <div
                                    class="mb-3 d-flex align-items-center">
                                    <div class="label">
                                        {{__("Golongan")}}
                                    </div>
                                    <div class="value">IV A</div>
                                </div>
                                <div
                                    class="mb-3 d-flex align-items-center">
                                    <div class="label">{{__("Role")}}</div>
                                    <div class="value text-capitalize">
                                        {{ Auth::user()->role }}
                                    </div>
                                </div>
                                <div
                                    class="mb-3 d-flex align-items-center">
                                    <div class="label">
                                        {{__("Foto Profil")}}
                                    </div>
                                    <input
                                        type="file"
                                        id="profilePhoto"
                                        name="image"
                                        class="form-control"
                                        accept="image/*" />
                                </div>
                            </div>
                            <div class="text-end mt-4">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-round">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body" id="password-content">
                        <div class="container">
                            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('put')

                                <div class="row mb-3 align-items-center">
                                    <label for="update_password_current_password" class="col-sm-3 col-form-label">
                                        Current Password
                                    </label>
                                    <div class="col-sm-9">
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="update_password_current_password"
                                            name="current_password"
                                            autocomplete="current-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <label for="update_password_password" class="col-sm-3 col-form-label">
                                        New Password
                                    </label>
                                    <div class="col-sm-9">
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="update_password_password"
                                            name="password"
                                            autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <label for="update_password_password_confirmation" class="col-sm-3 col-form-label">
                                        Confirm Password
                                    </label>
                                    <div class="col-sm-9">
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="update_password_password_confirmation"
                                            name="password_confirmation"
                                            autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-4">
                                    <button type="sumbit" class="btn btn-primary btn-round">{{ __('Save') }}</button>
                                    @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script>
    const profileTab = document.getElementById('profile-tab');
    const passwordTab = document.getElementById('password-tab');

    const profileContent = document.getElementById('profile-content');
    const passwordContent = document.getElementById('password-content');
    passwordContent.style.display = 'none';

    profileTab.addEventListener('click', () => {
        profileContent.style.display = 'block';
        passwordContent.style.display = 'none';
    });

    passwordTab.addEventListener('click', () => {
        passwordContent.style.display = 'block';
        profileContent.style.display = 'none';
    });
</script>
<script>
    const tabs = document.querySelectorAll('.tab-link');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        });
    });
</script>
@endsection