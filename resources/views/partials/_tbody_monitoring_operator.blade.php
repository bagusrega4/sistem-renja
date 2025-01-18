@foreach ($pengajuan as $fp)
<tr>
    <th scope="row">
        {{ $loop->iteration }}
    </th>
    <td class="text-end">{{ $fp->no_fp }}</td>
    <td class="text-start">{{ $fp->uraian }}</td>
    <td class="text-end">{{ $fp->tanggal_mulai }} s.d. {{ $fp->tanggal_akhir }}</td>
    <td class="text-end">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-sm me-2"
                data-bs-toggle="modal"
                data-bs-target="#viewModalCenter{{ $fp->id }}"
                data-bs-no-fp="{{ $fp->id }}">
                <i class="fas fa-eye"></i>
            </button>
            @if($fp->id_status == 1)
            <button class="btn btn-secondary btn-sm me-2"
                onclick="window.location.href='{{ route('form.edit', $fp->id) }}'">
                <i class="fas fa-edit"></i>
            </button>
            @endif
            <button class="btn btn-info btn-sm me-2"
                onclick="window.location.href='{{ route('monitoring.operator.upload', $fp->id) }}'">
                <i class="fas fa-desktop"></i>
            </button>

            <button type="button" class="btn btn-danger btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#deleteModalCenter-{{ $fp->id }}">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
    </td>
    <td class="text-start">
        @switch($fp->id_status)
        @case(1)
        <span
            class="badge bg-light text-dark">{{ $fp->statusPengajuan->status }}</span>
        @break

        @case(2)
        <span class="badge bg-warning">{{ $fp->statusPengajuan->status }}</span>
        @break

        @case(3)
        <span class="badge bg-danger">{{ $fp->statusPengajuan->status }}</span>
        @break

        @case(4)
        <span class="badge bg-primary">{{ $fp->statusPengajuan->status }}</span>
        @break

        @case(5)
        <span
            class="badge bg-success fw-bold">{{ $fp->statusPengajuan->status }}</span>
        @break

        @default
        <span class="badge bg-warning text-dark">Status Tidak Dikenal</span>
        @endswitch
    </td>
</tr>
@endforeach