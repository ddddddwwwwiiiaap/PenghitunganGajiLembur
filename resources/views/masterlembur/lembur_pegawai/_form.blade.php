<div class="card-body">
    <div class="card card-solid">
        <div class="card-body pb-0 pt-3">
            <blockquote>
                <b>Keterangan!!</b><br>
                <small><cite title="Source Title">Inputan Yang Ditanda Bintang Merah (<span class="text-danger">*</span>) Harus Di Isi !!</cite></small>
            </blockquote>
        </div>
    </div>
    <div class="card-header with-border pl-0 pb-1">
        <span class="col-form-label text-bold">Data Lembur Pegawai</span>
    </div>
    <br>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">PN & Nama Staff <span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <select name="staff_id" class="form-control @error('staff_id') is-invalid @enderror">
                <option value="">-- Pilih Staff --</option>
                @foreach ($staff as $item)
                <option value="{{ $item->id }}" {{ $item->id == old('staff_id', $lembur_pegawai->staff_id ?? '') ? 'selected' : '' }}>{{ $item->pn }} - {{ $item->name }}</option>
                @endforeach
            </select>
            @error('staff_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('staff_id') }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Mulai Lembur <span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="time" id="mulai_lembur" name="mulai_lembur" class="form-control @error('mulai_lembur') is-invalid @enderror" value="{{ old('mulai_lembur', $lembur_pegawai->mulai_lembur ?? '') }}">
            @error('mulai_lembur')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('mulai_lembur') }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Selesai Lembur <span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="time" id="selesai_lembur" name="selesai_lembur" class="form-control @error('selesai_lembur') is-invalid @enderror" value="{{ old('selesai_lembur', $lembur_pegawai->selesai_lembur ?? '') }}">
            @error('selesai_lembur')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('selesai_lembur') }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Jumlah Jam <span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="text" name="jumlah_jam" class="form-control @error('jumlah_jam') is-invalid @enderror" value="{{ old('jumlah_jam', $lembur_pegawai->jumlah_jam ?? '') }}">
            @error('jumlah_jam')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('jumlah_jam') }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Tanggal Lembur Pegawai<span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="date" name="tanggal_lembur" class="form-control @error('tanggal_lembur') is-invalid @enderror" value="{{ old('tanggal_lembur', $lembur_pegawai->tanggal_lembur ?? '') }}" autocomplete="off">
            @error('tanggal_lembur')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('tanggal_lembur') }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Periode <span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="text" name="periode" class="form-control datepicker @error('periode') is-invalid @enderror" value="{{ old('periode', $lembur_pegawai->periode ?? '') }}" placeholder="Pilih Periode">
            @if ($errors->has('periode'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('periode') }}</strong>
            </span>
            @endif
        </div>
    </div>
</div>

<div class="card-footer">
    <div class="offset-md-4">
        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-check-double mr-1"></i> Simpan</button>
            <button type="reset" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i> Reset</button>
        </div>
    </div>
</div>