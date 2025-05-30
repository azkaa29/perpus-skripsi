@extends('layouts.main')

@section('main')
    <h3 class="mb-4"  style="font-weight: bold; font-size: 24px;">Detail Buku</h3>
    <div class="mb-3">
        <a href="{{route('home.index')}}" class="btn btn-sm btn-dark">Kembali</a>
        @can('update.books')
            <a href="{{ route('book.edit', ['book' => $book]) }}" class="btn btn-sm btn-dark">Edit</a>
        @endcan
        @can('delete.books')
            <form action="{{ route('book.destroy', ['book' => $book]) }}" method="post" class="d-inline">
                @csrf
                @method('delete')
                <button onclick="return confirm('Hapus buku: {{ $book->title }} ?')" type="submit"
                    class="btn btn-danger btn-sm">Hapus</button>
            </form>
        @endcan
    </div>
    <div class="row">
        <div class="col-lg-8 mb-3">
            <h5>Judul</h5>
            <p>{{ $book->title }}</p>
            <h5>Deskripsi</h5>
            <p>{{ $book->description }}</p>
            <h5>Kategori</h5>
            <p>{{ $book->category->name }}</p>
            <h5>Pengarang</h5>
            <p>{{ $book->author }}</p>
            <h5>Penerbit</h5>
            <p>{{ $book->publisher->name }}</p>
            <h5>Tahun Terbit</h5>
            <p>{{ $book->publication_year }}</p>
            <h5>Jumlah Tersedia</h5>
            <p>{{ $book->stock }}</p>
            <h5>Kode Rak Buku</h5>
            @forelse ($book->category->racks as $rack)
                <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="{{ $rack->description }}">{{ $rack->code }}</span>
            @empty
                <span class="badge bg-warning">Sedang Tidak Tersedia</span>
            @endforelse
        </div>
        <div class="col-lg-4 mb-3">
            <h5>Sampul</h5>
            <img src="{{ $book->cover() }}" class="img-fluid w-100">
            <div class="mt-3">
                {{-- <input type="checkbox" id="love" class="love-checkbox">
                <label for="love" class="love-label"></label> --}}
                <form action="{{ route('wishlist.add-or-remove', ['book' => $book]) }}" method="post">
                    @csrf
                    @method('put')
                    @if ($isAddedToWishlist)
                        <button type="submit" class="d-flex align-items-center btn p-0" style="cursor: pointer;">
                            <span class="material-symbols-outlined fs-2 me-2 text-danger">
                                heart_check
                            </span> Remove from Wishlist</button>
                    @else
                        <button type="submit" class="d-flex align-items-center btn p-0" style="cursor: pointer;">
                            <span class="material-symbols-outlined fs-2 me-2 text-secondary">
                                favorite
                            </span> Add to Wishlist</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
