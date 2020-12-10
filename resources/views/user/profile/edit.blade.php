{{-- Stored in /resources/views/user/profile/edit.blade.php --}}
@extends('user.layouts.master')
@section('html-title', 'Edit Profile')
@section('page-class', 'user-edit')
{{--[content]--}}
@section('content-body')
    @component('components.bootstrap.container', [
        'fluid' => false
    ])
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                @component('components.bootstrap.card', [
                    'id' => 'user-edit-profile-card'
                ])
                    <div class="card-header">
                        {{ __('User Profile') }}
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-9">
                                @component('components.forms.form',[
                                    'id'        => 'user-edit-profile-form',
                                    'action'    => '#',
                                    'method'    => 'POST',
                                    'confirmed' => true
                                ])
                                    @component('components.forms.file', ['id' => 'profile_image', 'name' => 'profile_image', 'label' => 'Profile Image'])
                                        @error('profile_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endcomponent
                                    @if($profile_image = $user->getMedia('profile_image')->first())
                                        @component('components.forms.media.single_image', ['path' => $profile_image->getFullUrl('thumb'), 'route' => route('admin.profile.media.delete', ['image' => $profile_image->id])])
                                        @endcomponent
                                    @endif
                                    @component('components.forms.input', ['type' => 'text', 'name' => 'company', 'label' => 'Company', 'value' => old('company') ?? $user->company, 'placeholder' => 'MDRepTime, LLC'])
                                        @error('company')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endcomponent
                                    @component('components.forms.input', ['type' => 'text', 'name' => 'first_name', 'label' => 'First Name', 'value' => old('first_name')?? $user->first_name, 'placeholder' => 'John'])
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endcomponent
                                    @component('components.forms.input', ['type' => 'text', 'name' => 'last_name', 'label' => 'Last Name', 'value' => old('last_name')?? $user->last_name, 'placeholder' => 'Doe'])
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endcomponent
                                    @component('components.forms.input', ['type' => 'text', 'name' => 'address', 'label' => 'Address', 'value' => old('address')?? $user->address, 'placeholder' => 'Address'])
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endcomponent
                                    @component('components.forms.input', ['type' => 'text', 'name' => 'address_2', 'label' => 'Apt/Unit', 'value' => old('address_2')?? $user->address_2, 'placeholder' => 'Apt/Unit'])
                                        @error('address_2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endcomponent
                                    @component('components.forms.input', ['type' => 'text', 'name' => 'city', 'label' => 'City/Town', 'value' => old('city')?? $user->city, 'placeholder' => 'City/Town'])
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endcomponent
                                    @component('components.forms.input', ['type' => 'text', 'name' => 'zipcode', 'label' => 'Zipcode', 'value' => old('zipcode')?? $user->zipcode, 'placeholder' => 'Zipcode'])
                                        @error('zipcode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endcomponent
                                    @component('components.forms.states', ['label' => 'State/Province', 'name' => 'state', 'value' => old('state')?? $user->state])
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endcomponent
                                    @component('components.forms.select', ['id' => 'country', 'name' => 'country',  'label' => 'Country', 'options' => [], 'value' => old('country') ?? $user->country, 'withIndex' => true])
                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endcomponent
                                    @component('components.forms.input', ['type' => 'tel', 'name' => 'phone', 'inputmask' => "'mask': '+9(999)-999-9999'", 'label' => 'Phone', 'value' => old('phone')?? $user->phone])
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endcomponent
                                    @component('components.forms.input', ['type' => 'tel', 'name' => 'mobile_phone', 'inputmask' => "'mask': '+9(999)-999-9999'", 'label' => 'Mobile Phone', 'value' => old('mobile_phone')?? $user->mobile_phone])
                                        @error('mobile_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endcomponent
                                @endcomponent
                            </div>
                        </div>
                    </div>
                @endcomponent
            </div>
        </div>
    @endcomponent
@endsection