@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Poplular Categories</h3>
                <div class="card-actions">
                </div>
            </div>
            <div class="card-body ">
                <form action="{{ route('admin.popular-categories.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Code</label>
                                <select name="categories[]" id="categories" class="form-select select2 "
                                    multiple="multiple">
                                    @foreach (getNestedCategories() as $category)
                                        <option @selected(in_array($category->id, $categories)) value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                        @if (count($category->children_nested) > 0)
                                            @foreach ($category->children_nested as $child)
                                                <option @selected(in_array($child->id, $categories)) value="{{ $child->id }}">--
                                                    {{ $child->name }}</option>
                                                @if (count($child->children_nested) > 0)
                                                    @foreach ($child->children_nested as $subchild)
                                                        <option @selected(in_array($subchild->id, $categories)) value="{{ $subchild->id }}">
                                                            ---- {{ $subchild->name }}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                <p class="text-muted mt-1">The selected categories products will be shown on top products
                                    section in home page</p>
                                <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
