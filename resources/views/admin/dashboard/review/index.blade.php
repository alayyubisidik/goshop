@extends('admin.dashboard.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product Reviews</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="order_table table m-0 mt-20">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 300px">Product</th>
                                <th>Rating</th>
                                <th>Review</th>
                                <th>Date</th>
                                <th class="w-1"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reviews as $review)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <img style="width: 50px; height: 50px; object-fit: cover"
                                                src="{{ asset($review->product->primaryImage->path) }}" alt="">
                                            <a href="{{ route('products.show', ['slug' => $review->product->slug]) }}">
                                                <p>{{ Str::limit($review->product->name, 50) }}</p>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        @for ($i = 1; $i <= $review->rating; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="gold"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-star">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                                            </svg>
                                        @endfor
                                    </td>
                                    <td>
                                        {{ $review->review }}
                                    </td>
                                    <td>
                                        {{ date('Y-m-d', strtotime($review->created_at)) }}
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger delete-btn"
                                                data-name="review">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No data found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $reviews->links() }}
                </div>
                <div class="card-footer">
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
