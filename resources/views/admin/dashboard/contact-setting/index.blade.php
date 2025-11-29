@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $section ? 'Update Contact Setting' : 'Create Contact Setting' }}
                </h3>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.contact-settings.store') }}" method="post">
                    @csrf

                    <div class="row">

                        {{-- Map URL --}}
                        <div class="col-md-12 mb-3">
                            <div class="mb-3">
                                <label class="form-label">Map URL</label>
                                <input type="text" class="form-control" name="map_url"
                                    value="{{ old('map_url', $section->map_url ?? '') }}">
                                <x-input-error :messages="$errors->get('map_url')" class="mt-2" />
                            </div>
                        </div>

                        <hr>

                        {{-- Title One --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Box Title One</label>
                            <input type="text" class="form-control" name="box_title_one"
                                value="{{ old('box_title_one', $section->box_title_one ?? '') }}">
                            <x-input-error :messages="$errors->get('box_title_one')" class="mt-2" />
                        </div>


                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="description_one">Description One</label>
                                <textarea name="description_one" id="short-editor">{!! old('description_one', $section->description_one ?? '') !!}</textarea>
                                <x-input-error :messages="$errors->get('description_one')" class="mt-2" />
                            </div>
                        </div>

                        <hr>

                        {{-- Title Two --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Box Title Two</label>
                            <input type="text" class="form-control" name="box_title_two"
                                value="{{ old('box_title_two', $section->box_title_two ?? '') }}">
                            <x-input-error :messages="$errors->get('box_title_two')" class="mt-2" />
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="description_two">Description Two</label>
                                <textarea name="description_two" id="short-editor">{!! old('description_two', $section->description_two ?? '') !!}</textarea>
                                <x-input-error :messages="$errors->get('description_two')" class="mt-2" />
                            </div>
                        </div>


                        <hr>

                        {{-- Title Three --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Box Title Three</label>
                            <input type="text" class="form-control" name="box_title_three"
                                value="{{ old('box_title_three', $section->box_title_three ?? '') }}">
                            <x-input-error :messages="$errors->get('box_title_three')" class="mt-2" />
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="description_three">Description Three</label>
                                <textarea name="description_three" id="short-editor">{!! old('description_three', $section->description_three ?? '') !!}</textarea>
                                <x-input-error :messages="$errors->get('description_three')" class="mt-2" />
                            </div>
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-primary mt-3" type="submit">
                            {{ $section ? 'Update' : 'Create' }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
