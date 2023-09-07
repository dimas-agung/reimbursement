@extends('layouts.default')
@section('css')
<style>
    
</style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Reimbursement') }}</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div>
                            <a href="{{ url('anggota/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add
                                Reimbursement</a>
                        </div>
                        <br />

                      
                        <br>
                        <div class="table-responsive">
                            <table class="table-reimbursement table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Doc No</th>
                                        <th>Name</td>
                                        <th>Description</th>
                                        <th>User Request</th>
                                        <th>User Action</th>
                                        <th>Status</th>
                                        <th>Attachment</th>
                                        @if (Auth::User()->jabatan != 'STAFF')    
                                        <th>Approval</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reimbursements as $key=> $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->doc_no }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->userCreate->name }}</td>
                                            
                                            <td>{{ $item->user_action != null ?$item->userAction->name : '' }}</td>
                                          
                                            <td>
                                                @php
                                                    switch ($item->status) {
                                                        case '0':
                                                        echo '<a class="btn btn-warning">PENDING</a>';
                                                            break;
                                                        case '1':
                                                        echo '<a class="btn btn-success">APPROVED</a>';
                                                            break;
                                                        case '2':
                                                        echo '<a class="btn btn-danger">REJECTED</a>';
                                                            break;
                                                        default:
                                                            # code...
                                                            break;
                                                    }
                                                @endphp
                                            </td>
                                            <td>
                                                @if ($item->attachment)
                                                    
                                                <a href="{{ url('storage/'.$item->attachment)}}" target="_blank" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                @endif
                                            </td>
                                            @if ($item->status == 0 && Auth::User()->jabatan != 'STAFF')    
                                            <td>
                                                <form style="display:inline-block"
                                                    action="{{ url('reimbursement/approved/' . $item->id) }}" method="POST">
                                                    @method('POST')
                                                    @csrf
                                                    <button class="btn btn-sm btn-success"
                                                        onclick="confirm('Want to Approve?')"> <i
                                                            class="fas fa-check"></i></button>
                                                </form> 
                                                <form style="display:inline-block"
                                                    action="{{ url('reimbursement/rejected/' . $item->id) }}" method="POST">
                                                    @method('POST')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="confirm('Want to Reject?')"> <i
                                                            class="fas fa-ban"></i></button>
                                                </form> 
                                            </td>
                                            @endif
                                            <td>
                                                <a class="btn btn-sm btn-info" href="{{ url('reimbursement/' . $item->id) }}"> <i
                                                        class="fas fa-eye"></i></a>
                                                @if ($item->status == 0 && Auth::User()->jabatan == 'STAFF')     
                                                <a class="btn btn-sm btn-success" title="Edit"
                                                    href="{{ url('reimbursement/' . $item->id . '/edit') }}"><i
                                                        class="fas fa-pen"></i></a>

                                                @endif
                                                <form style="display:inline-block"
                                                    action="{{ url('reimbursement/' . $item->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="confirm('Want to delete?')"> <i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">Data Anggota Kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/r-2.2.7/rr-1.2.7/datatables.min.css"/>
 
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/r-2.2.7/rr-1.2.7/datatables.min.js"></script> --}}
@endsection

@section('js')
    {{-- // @if ($message = Session::get('success'))
//     iziToast.success({
//     title: 'Sukses!',
//     message: '{{ $message }}',
//     position: 'topRight'
//   });
// @endif --}}
    {{-- <script src="{{ asset('dashboard/js/datatable-1.10.20.min.js') }}"></script>
<script src="{{ asset('dashboard/js/jquery.maskMoney.min.js') }}"></script> --}}
    <script>
        //   const tableRBA = $('.table-reimbursement').DataTable({
        //     scrollX: true,
        //     scrollCollapse: true,
        //     paging: true,
        //     info: true,
        //     bFilter: true,
        //     ordering: true,
        //     columns: [{
        //             data: 'No'
        //         },
        //         {
        //             data: 'Doc No'
        //         },
        //         {
        //             data: 'Name'
        //         },
        //         {
        //             data: 'Description'
        //         },
        //         {
        //             data: 'User Request'
        //         },
        //         {
        //             data: 'User Action'
        //         },
        //         {
        //             data: 'Status'
        //         },
        //         {
        //             data: 'Action'
        //         },
        //     ],
        //     // fixedColumns: true,
        //     display: true
        // });
        $(document).ready(function() {
            // modalExport()
            $('.table-reimbursement').DataTable({});

        });
    </script>
@endsection
