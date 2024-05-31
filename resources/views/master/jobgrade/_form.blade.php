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
        <span class="col-form-label text-bold">JOB GRADE</span>
    </div>
    <br>
    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Nama <span class="text-danger">*</span></label>
        <div class="col-12 col-md-5 col-lg-5">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $jobgrade->name ?? '') }}" placeholder="Name.." autocomplete="off">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Besaran Uang</label>
        <div class="col-12 col-md-5 col-lg-5">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                </div>
                <input type="text" name="salary_jobgrade" class="form-control @error('salary_jobgrade') is-invalid @enderror" value="{{ old('salary_jobgrade', $jobgrade->salary_jobgrade ?? '') }}" placeholder="100.000" autocomplete="off" oninput="format(this)">
                @error('salary_jobgrade')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('salary_jobgrade') }}</strong>
                </span>
                @enderror
            </div>
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