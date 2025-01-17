@foreach ($pengajuan as $p)
<tr>
    <th scope="row">
        {{ $counter++ }}
    </th>
    <td class="text-end">{{ $p->no_fp }}</td>
    <td class="text-start">{{ $p->uraian }}</td>
    <td class="text-end">{{ $p->tanggal_mulai }} s.d. {{ $p->tanggal_akhir }}</td>
    <td class="text-end">{{ $p->pegawai->nama ?? '-' }}</td>
    <td class="text-end">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-sm me-2"
                data-bs-toggle="modal"
                data-bs-target="#viewModalCenter{{ $p->id }}"
                data-bs-id="{{ $p->id }}">
                <i class="fas fa-eye"></i>
            </button>
            <a class="btn btn-info btn-sm me-2"
                href="{{ route('monitoring.keuangan.file', $p->id) }}">
                <i class="fas fa-desktop"></i>
            </a>
            @if (in_array($p->id_status, [4, 5]))
            <a class="btn btn-success btn-sm me-2"
                aria-label="upload file"
                href="{{ route('monitoring.keuangan.upload', $p->id) }}">
                <i class="fas fa-upload"></i>
            </a>
            @endif
        </div>
    </td>
    <td class="text-end">
        @switch($p->id_status)
        @case(1)
        <span class="badge bg-light text-dark">{{ $p->statusPengajuan->status }}</span>
        @break
        @case(2)
        <span class="badge bg-warning">{{ $p->statusPengajuan->status }}</span>
        @break
        @case(3)
        <span class="badge bg-danger">{{ $p->statusPengajuan->status }}</span>
        @break
        @case(4)
        <span class="badge bg-primary">{{ $p->statusPengajuan->status }}</span>
        @break
        @case(5)
        <span class="badge bg-success fw-bold">{{ $p->statusPengajuan->status }}</span>
        @break
        @default
        <span class="badge bg-warning text-dark">Status Tidak Dikenal</span>
        @endswitch
    </td>
</tr>
@endforeach