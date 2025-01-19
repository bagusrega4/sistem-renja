@section('modal-view')
@foreach($formPengajuan as $fp)
<div class="modal fade" id="viewModalCenter{{ $fp->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalCenterTitle" aria-labelledby="viewModalCenterTitle{{ $fp->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalCenterTitle">View Pengajuan</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table-monitoring" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No. FP</th>
                                <th>Nama Permintaan</th>
                                <th>Rincian Output</th>
                                <th>Komponen</th>
                                <th>Sub Komponen</th>
                                <th>Akun</th>
                                <th>Tanggal Kegiatan</th>
                                <th>No. SK</th>
                                <th>Nominal</th>
                                <th>Catatan</th>
                                <th>Bukti Transfer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td class="text-start">{{$fp -> no_fp}}</td>
                            <td class="text-start"><strong>{{ $fp->uraian }}</strong></td>
                            <td class="text-start">[{{$fp -> output -> kegiatan -> kode}}.{{$fp -> output -> kro -> kode}}.{{$fp -> output -> kode_ro}}] {{$fp -> output -> output}}</td>
                            <td class="text-start">{{$fp -> komponen -> komponen}}</td>
                            <td class="text-start">{{$fp -> subKomponen -> sub_komponen}}</td>
                            <td class="text-start">{{$fp -> akunBelanja -> nama_akun}}</td>
                            <td class="text-start">{{$fp -> tanggal_mulai}} s.d. {{$fp -> tanggal_akhir}}</td>
                            <td class="text-start">{{$fp -> no_sk}}</td>
                            <td class="text-start nominal-currency">{{ $fp -> nominal }}</td>
                            <td class="text-center">{{ $fp -> rejection_note ?? '-' }}</td>
                            <td class="text-start">
                                @if ($fp->fileUploadKeuangan->where('akunFileKeuangan.jenisFileKeuangan.id', 12)->first())
                                <button type="button" class="btn btn-primary btn-sm me-2" onclick="previewBuktiTransfer({{ $fp->id }})"
                                    title="Preview Bukti Transfer">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @else
                                -
                                @endif
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection