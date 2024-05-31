@php
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-type: application/octet-stream");
header ("Content-Disposition: attachment; filename=Laporan-Lembur-Pegawai-periode-".ucwords($filter ?? 'All').".xls");
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>Apurav - Report</title>
    <style>
        #master td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div style="text-align: center; font-size: 20px;">
        <b>TRANSPORT PELAYANAN WEEKEND BANKING KK POLRES, KK SCH, ATM & AKHIR BULANBL.</b>
    </div>

    <br>
    <table style="">
        <tr>
            <td>Periode</td>
            <td colspan="3">: {{ ucwords($filter ?? 'All') }}</td>
        </tr>
    </table>
    <br>

    <table border="1" style="font-size: 14px;width: 100%;">
        <thead>
            <tr style="background-color: royalblue">
                <th>
                    <center>
                        No
                    </center>
                </th>
                <th>
                    <center>
                        Nama
                    </center>
                </th>
                <th>
                    <center>
                        Tanggal<br> Lembur
                    </center>
                </th>
                <th>
                    <center>
                        Upah<br> Pokok
                    </center>
                </th>
                <th>
                    <center>
                        Premium
                    </center>
                </th>
                <th>
                    <center>
                        Job Grade
                    </center>
                </th>
                <th>
                    <center>
                        Upah per-<br>bulan
                    </center>
                </th>
                <th>
                    <center>
                        Jam<br>mulai<br>lembur
                    </center>
                </th>
                <th>
                    s/d
                </th>
                <th>
                    <center>
                        Akhir jam<br>lembur yg<br>diperhitungkan
                    </center>
                </th>
                <th>
                    <center>
                        Jml jam
                    </center>
                </th>
                <th>
                    <center>
                        1/173
                    </center>
                </th>
                <th>
                    <center>
                        Up.Lembur<br>hr kerja 1<br>jam pertama
                    </center>
                </th>
                <th>
                    <center>
                        Up.Lembur<br>hr kerja jam<br>ke 2 dst
                    </center>
                </th>
                <th>
                    <center>
                        Up.Lembur<br>hari libur jam<br>ke 1-7
                    </center>
                </th>
                <th>
                    <center>
                        Up.Lembur<br>hari libur<br>jam ke 8
                    </center>
                </th>
                <th>
                    <center>
                        Up.Lembur<br>hari libur<br>jam ke 9 dst
                    </center>
                </th>
                <th>
                    <center>
                        Jumlah<br>Upah<br>Lembur
                    </center>
                </th>
                <th>
                    <center>
                        Pembulatan
                    </center>
                </th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($lembur_pegawai as $data)
            <tr style="line-height: 1;" id="hide{{$data->id}}">
                <td>
                    <center>{{$no++}}</center>
                </td>
                <td>
                    <center>{{$data->staff->name}}</center>
                </td>
                <td>
                    <center>{{$data->tanggal_lembur}}</center>
                </td>
                <td>
                    <center>
                        {{ 'Rp. ' . number_format($data->staff->salary_staff ?? '', 0, ',', '.') }}
                    </center>
                </td>
                <td>
                    {{ 'Rp. ' . number_format($data->staff->premium->salary_premium ?? '', 0, ',', '.') }}
                </td>
                <td>
                    <center>
                        {{ 'Rp. ' . number_format($data->staff->jobgrade->salary_jobgrade ?? '', 0, ',', '.') }}
                    </center>
                </td>
                <td>
                    <center>
                        {{ 'Rp. ' . number_format($data->staff->jumlah ?? '', 0, ',', '.') }}
                    </center>
                </td>
                <td>
                    <center>{{date('H:i', strtotime($data->mulai_lembur))}}</center>
                </td>
                <td>
                    <center>-</center>
                </td>
                <td>
                    <center>{{date('H:i', strtotime($data->selesai_lembur))}}</center>
                </td>
                <td>
                    <center>{{$data->jumlah_jam}}</center>
                </td>
                <td>
                    <center>0.0058</center>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                    <center>
                        Rp. {{ number_format($data->jumlah_upah_lembur ?? '', 2, ',', '.') }}
                    </center>
                </td>
                <td>
                    <center>
                        <!--Untuk membulatkan ribu rupiah dari 500-999 ke atas 0-499 ke bawah-->
                        Rp. {{ number_format($data->pembulatan ?? '', 0, ',', '.')}}

                    </center>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>