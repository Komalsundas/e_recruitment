{{-- <x-app-layout> --}}
@extends('layouts.app2')
{{-- <x-slot name="header">
    </x-slot> --}}
<div class="div1  d-flex align-items-start"></div>
<div class="col-md-12">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Change Password') }}
                    </h2>
                    </header>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <form method="POST" action="{{ route('save_password') }}" class="mt-4">
                        @csrf

                        <!-- Password -->
                        <div class="mb-2">
                            <x-input-label for="password" :value="__('New Password')" />
                            <x-text-input id="password" class="form-control" style="width: 500px;" type="password"
                                name="password" :value="old('password')" required autofocus autocomplete="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-2">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="form-control" style="width: 500px;"
                                type="password" name="password_confirmation" :value="old('password_confirmation')" required autofocus
                                autocomplete="password_confirmation" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <br>
                        <div class="d-flex justify-content-left">
                            <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>
                        </div>

                    </form>

                    @if (session('success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Success',
                                    text: '{{ session('success') }}',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{ route('dashboard') }}";
                                    }
                                });
                            });
                        </script>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
{{-- </x-app-layout> --}}
