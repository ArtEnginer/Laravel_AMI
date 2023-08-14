@extends('layouts.app')

@section('title', 'Kesimpulan')

@section('content')
    <form action="{{ route('dashboard.update_kesimpulan', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Input Kesimpulan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kelengkapan">Apakah Dokumen Audit Mutu Internal Sudah Terisi dengan Lengkap</label>
                            <select name="kelengkapan" id="kelengkapan" class="form-control">
                                <option value="">...Jawaban...</option>
                                <option value="lengkap">Lengkap</option>
                                <option value="tidak">Tidak/Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kesimpulan">Jika Tidak / Lainnya</label>
                            <textarea style="height: 100px" class="form-control @error('kesimpulan') is-invalid @enderror" name="kesimpulan"
                                id="kesimpulan" placeholder="Kesimpulan">{{ old('kesimpulan', $item->kesimpulan) }}</textarea>
                            @error('kesimpulan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
