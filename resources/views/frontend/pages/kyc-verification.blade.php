@extends('frontend.layouts.app')

@section('contents')
    <x-breadcrumb :items="[['label' => 'Home', 'url' => '/'], ['label' => 'Kyc Form']]" />

    <div class="page-content pt-150 pb-135">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 offset-lg-3">
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1 mb-3">
                                        <h4 class="mb-5">Kyc Verification</h4>
                                    </div>
                                    <form method="post" action="{{ route('kyc.store') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label class="font-weight-bold">Full Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="full_name" placeholder="Full name"
                                                value="{{ old('full_name') }}" />
                                            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Date of birth<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="date_of_birth" placeholder="7/9/2000"
                                                class="datepicker" autocomplete="off" value="{{ old('date_of_birth') }}" />
                                            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Gender<span class="text-danger">*</span></label>
                                            <select name="gender" class="form-control">
                                                <option value="">Select</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Full Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="full_address" placeholder="Full address"
                                                value="{{ old('full_address') }}" />
                                            <x-input-error :messages="$errors->get('full_address')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Document Type<span
                                                    class="text-danger">*</span></label>
                                            <select name="document_type" class="form-control">
                                                <option value="">Select</option>
                                                <option value="id_card"
                                                    {{ old('document_type') == 'id_card' ? 'selected' : '' }}>ID Card
                                                </option>
                                                <option value="passport"
                                                    {{ old('document_type') == 'passport' ? 'selected' : '' }}>Passport
                                                </option>
                                                <option value="driving_license"
                                                    {{ old('document_type') == 'driving_license' ? 'selected' : '' }}>
                                                    Driving License</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('document_type')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Document Scan Copy <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="document_scan_copy" />
                                            <x-input-error :messages="$errors->get('document_scan_copy')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-heading btn-block hover-up">Submit</button>
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
