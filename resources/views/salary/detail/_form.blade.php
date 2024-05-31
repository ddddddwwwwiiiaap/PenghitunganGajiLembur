<div class="card-body pt-0 pl-1 pr-1 pb-0">

    @if (empty($staff))
    <div class="alert alert-warning text-justify">
        <strong>Warning !!</strong> Data staff belum ada, anda tidak dapat melakukan absensi. Silahkan input data staff terlebih dulu
        <a class="float-right" href="{{ route('salary.index') }}" data-toggle="tooltip" title="Silahkan klik untuk menginput data pekerja" style="text-decoration-color: blue;">
            <span class="text-primary">Input Sekarang ?</span>
        </a>
    </div>
    @endif

    <div class="container-fluid row p-2" style="font-size: 14px;">
        <div class="col-md-9 p-0">
            <table class="table no-border header-table mb-0 mt-0" style="">
                <tr style="line-height: 1px;">
                    <td width="100">Karyawan Status</td>
                    <td width="10">:</td>
                    <td class="text-left">
                        <span class="badge {{ $request->status == 'Staff' ? 'badge-info' : 'badge-secondary' }}">{{ $request->status ?? '' }}</span>
                    </td>
                </tr>
                <tr style="line-height: 1px;">
                    <td width="100">Periode</td>
                    <td width="10">:</td>
                    <td class="text-left">{{ $request->periode }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="table-responsive pl-2 pr-2">
        <table class='table table-striped table-bordered'>
            {{-- <tbody> --}}
            <tr>
                <td>
                    <label class="text-bold">{{ $request->status }}</label><br>
                    <select name="staff_id" class="form-control select2" required>
                        <option value=""></option>
                        @foreach ($premium as $premium)
                        @foreach ($premium->staff as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        @endforeach
                    </select>
                    @error('staff_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('staff_id') }}</strong>
                    </span>
                    @enderror
                </td>
                <td colspan="2">
                    <label class="font-weight-bold">Tanggal Gaji</label><br>
                    <input type="text" name="tgl_salary" class="form-control datepicker @error('tgl_salary') is-invalid @enderror" placeholder="01/31/2020" autocomplete="off" onkeypress="return false">
                    @error('tgl_salary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tgl_salary') }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
        </table>
    </div>

</div>
<div class="card-footer">

    <div class="text-right">
        <div class="form-group mb-0">
            <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
            <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-check mr-1"></i> Simpan</button>
        </div>
    </div>
</div>