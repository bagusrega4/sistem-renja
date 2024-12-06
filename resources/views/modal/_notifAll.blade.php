<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">All Notifications</h5>
            </div>
            <div class="modal-body">
                <!-- Notification Item for Pengajuan Selesai -->
                <div class="notification-item d-flex align-items-center mb-3">
                    <div class="notif-icon notif-success me-2">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="notification-text w-100">
                        <a class="d-flex justify-content-between align-items-center text-decoration-none" data-bs-toggle="collapse" href="#base-selesai" role="button" aria-expanded="false" aria-controls="base-selesai">
                            <div>
                                <strong>Pengajuan Selesai</strong>
                                <p class="mb-0 text-muted">1 Pengajuan</p>
                            </div>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse mt-2" id="base-selesai">
                            <ul class="list-unstyled ps-3">
                                <li>
                                    <div class="notif-content" data-bs-toggle="modal" data-bs-target="#accModalCenter">
                                        <span class="block">Supervisi Sakernas</span>
                                        <span class="time text-muted">No. FP: 195</span>
                                        </a>
                                    </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Notification Item for Pengajuan Ditolak -->
                <div class="notification-item d-flex align-items-center">
                    <div class="notif-icon notif-danger me-2">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="notification-text w-100">
                        <a class="d-flex justify-content-between align-items-center text-decoration-none" data-bs-toggle="collapse" href="#base-ditolak" role="button" aria-expanded="false" aria-controls="base-ditolak">
                            <div>
                                <strong>Pengajuan Ditolak</strong>
                                <p class="mb-0 text-muted">1 Pengajuan</p>
                            </div>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse mt-2" id="base-ditolak">
                            <ul class="list-unstyled ps-3">
                                <li>
                                    <div class="notif-content" data-bs-toggle="modal" data-bs-target="#tolakModalCenter">
                                        <span class="block">Supervisi Sensus Penduduk</span>
                                        <span class="time text-muted">No. FP: 175</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>