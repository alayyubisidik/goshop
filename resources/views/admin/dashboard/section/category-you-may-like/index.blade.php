@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Category You May Like
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category-you-may-like.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label required">Section One Category</label>
                                <select name="category_one" id="" class="form-control select2">
                                    <option value="">No Category</option>
                                    @foreach (GetNestedCategories() as $category)
                                        <option @selected($category->id == $categoryYouMayLike?->category_one) value="{{ $category->id }}">{{ $category->name }}</option>
                                        @if (count($category->children_nested) > 0)
                                            @foreach ($category->children_nested as $child)
                                                <option @selected($child->id == $categoryYouMayLike?->category_one) value="{{ $child->id }}">- {{ $child->name }}</option>
                                                @if (count($child->children_nested) > 0)
                                                    @foreach ($child->children_nested as $subchild)
                                                        <option @selected($subchild->id == $categoryYouMayLike?->category_one) value="{{ $subchild->id }}">-- {{ $subchild->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('sale_start')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label required">Section Two Category</label>
                                <select name="category_two" id="" class="form-control select2">
                                    <option value="">No Category</option>
                                    @foreach (GetNestedCategories() as $category)
                                        <option @selected($category->id == $categoryYouMayLike?->category_two) value="{{ $category->id }}">{{ $category->name }}</option>
                                        @if (count($category->children_nested) > 0)
                                            @foreach ($category->children_nested as $child)
                                                <option @selected($child->id == $categoryYouMayLike?->category_two) value="{{ $child->id }}">- {{ $child->name }}</option>
                                                @if (count($child->children_nested) > 0)
                                                    @foreach ($child->children_nested as $subchild)
                                                        <option @selected($subchild->id == $categoryYouMayLike?->category_two) value="{{ $subchild->id }}">-- {{ $subchild->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('sale_start')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label required">Section Three Category</label>
                                <select name="category_three" id="" class="form-control select2">
                                    <option value="">No Category</option>
                                    @foreach (GetNestedCategories() as $category)
                                        <option @selected($category->id == $categoryYouMayLike?->category_three) value="{{ $category->id }}">{{ $category->name }}</option>
                                        @if (count($category->children_nested) > 0)
                                            @foreach ($category->children_nested as $child)
                                                <option @selected($child->id == $categoryYouMayLike?->category_three) value="{{ $child->id }}">- {{ $child->name }}</option>
                                                @if (count($child->children_nested) > 0)
                                                    @foreach ($child->children_nested as $subchild)
                                                        <option @selected($subchild->id == $categoryYouMayLike?->category_three) value="{{ $subchild->id }}">-- {{ $subchild->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('sale_start')" class="mt-2" />
                            </div>
                        </div>


                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-primary mt-3" type="submit">
                            {{-- {{ $flashSale ? 'Update' : 'Create' }} --}}
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
