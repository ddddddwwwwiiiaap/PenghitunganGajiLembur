@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset ('css/sweetalert.css') }}">
@endsection

@section('content')
<div class="content-wrapper pb-3">
    <div class="content-header">
        <div class="container-fluid">
            <form>
                <div class="form-inline">
                    <div class="input-group app-shadow">
                        <div class="input-group-append">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="content pb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Data Roles
                            <span class="badge badge-danger float-right float-xl-right mt-1">{{ $count }}</span>
                        </div>
                        <table id="datatable" class="table table-hover table-striped ">
                            <thead class="bg-white">
                                <tr>
                                    <th>
                                        <center>
                                            Name
                                        </center>
                                    </th>
                                    <th>
                                        <center>
                                            Display Name
                                        </center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $item)
                                <tr id="hide{{ $item->id }}">
                                    <td>
                                        <center>
                                            {{ $item->name }}
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            {{ $item->display_name}}
                                        </center>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/sweetalert-dev.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script>
    function hapus(id) {
        swal({
                title: 'Yakin.. ?',
                text: "Data anda akan dihapus. Tekan tombol yes untuk melanjutkan.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{URL::to('/roles/destroy')}}",
                        data: "id=" + id,
                        success: function(html) {
                            swal("Deleted", "Data Berhasil Di Hapus.", "success");
                            $("#hide" + id).hide(300);
                        }
                    });

                } else {
                    swal("Canceled", "Anda Membatalkan! :)", "error");
                }
            });
    }
</script>
@endsection