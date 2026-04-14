@extends('layouts.app')

@section('title', 'Peminjaman')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Data Peminjaman</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Alat</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($loans as $loan)
                        <!-- APPROVE MODAL -->
                        <div class="modal fade" id="approveModal{{ $loan->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form action="{{ route('petugas.peminjaman.approve', $loan->id) }}" method="POST">
                                        @csrf

                                        <div class="modal-header">
                                            <h5 class="modal-title">Approve Peminjaman</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <label>Catatan (Opsional)</label>
                                            <textarea name="notes" class="form-control" placeholder="Tambahkan catatan..."></textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-success">Approve</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- REJECT MODAL -->
                        <div class="modal fade" id="rejectModal{{ $loan->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form action="{{ route('petugas.peminjaman.reject', $loan->id) }}" method="POST">
                                        @csrf

                                        <div class="modal-header">
                                            <h5 class="modal-title">Tolak Peminjaman</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <label>Alasan Penolakan</label>
                                            <textarea name="notes" class="form-control" required></textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-danger">Reject</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>


                        <tr>
                            <td>{{ $loan->user->detail->name ?? '-' }}</td>
                            <td>{{ $loan->tool->name ?? '-' }}</td>
                            <td>{{ $loan->unit_code }}</td>

                            <td>
                                @if ($loan->return)
                                    <span class="badge badge-success">Sudah Dikembalikan</span>
                                @elseif($loan->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($loan->status == 'active')
                                    <span class="badge badge-primary">Dipinjam</span>
                                @elseif($loan->status == 'rejected')
                                    <span class="badge badge-danger">Ditolak</span>
                                @elseif($loan->status == 'closed')
                                    <span class="badge badge-dark">Expired</span>
                                @endif
                            </td>

                            <td>
                                {{-- APPROVE / REJECT --}}
                                @if ($loan->status == 'pending')
                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                        data-target="#approveModal{{ $loan->id }}">
                                        Approve
                                    </button>

                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#rejectModal{{ $loan->id }}">
                                        Reject
                                    </button>
                                @endif


                                {{-- RETURN --}}
                                @if ($loan->status == 'active' && $loan->return && !$loan->return->employee_id)
                                    <form action="{{ route('petugas.peminjaman.confirmReturn', $loan->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button class="btn btn-sm btn-primary">
                                            Konfirmasi Return
                                        </button>
                                    </form>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

@endsection
