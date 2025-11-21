@extends('admin.dashboard.layouts.app')


@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Tag</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.tags.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tags.update', $tag) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required" for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name', $tag->name) }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="" class="form-check form-switch form-switch-3">
                                    <input type="checkbox" class="form-check-input" name="status"
                                        @checked($tag->is_active)>
                                    <span class="form-check-label">Active</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary mt-3" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
