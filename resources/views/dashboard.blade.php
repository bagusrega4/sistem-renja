@extends('layouts/app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard SiReMon</h3>
                <h6 class="op-7 mb-2">Coming Soon</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('monitoring.operator.index') }}" class="btn btn-label-info btn-round me-2">Monitoring</a>
                <a href="{{ route('form.index') }}" class="btn btn-primary btn-round">Tambah Rencana Kerja</a>
            </div>
        </div>

    </div>
</div>
@endsection