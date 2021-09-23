@extends('layouts.app')
@section('title', 'Category | Blog')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Category</h3>
                <form action="{{ route('category.store') }}" method="POST" class="p-3 p-md-5 bg-light">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug *</label>
                        <input type="text" class="form-control" id="slug" name="slug">
                        <div class="form-group">
                            <input type="submit" value="Add Category" class="btn py-3 mt-4 px-4 btn-primary">
                        </div>
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <td>SL.</td>
                        <td>Name</td>
                        <td>Slug</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <a class="btn btn-outline-info"
                                    href="{{ route('category.edit', $category->id) }}">Edit</a>
                                <a class="btn btn-outline-danger" href="{{ route('category.destroy', $category->id) }}"
                                    onclick="event.preventDefault(); document.querySelector('#delete-{{ $index }}').submit();">Delete</a>
                                <form id="delete-{{ $index }}"
                                    action="{{ route('category.destroy', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <h1 class="text-center">No Data available</h1>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('script')
    <script>
        (function() {
            document.querySelector('#name').addEventListener('input', (event) => {
                let name = event.target.value;
                if (name) {
                    document.querySelector('#slug').value = name.replace(/[^a-zA-Z0-9 -]/g, "").toLowerCase()
                        .split(" ").join(
                            '-');
                } else {
                    document.querySelector('#slug').value = "";
                }
            })
        }())
    </script>
@endpush
