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
                    <div class="card-header">{{ __('Employee') }}</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div>
                            <a href="{{ url('employee/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add
                                Employee</a>
                        </div>
                        <br />

                      
                        <br>
                        <div class="table-responsive">
                            <table class="table-employee table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Name</td>
                                        <th>Email</th>
                                        <th>Jabatan</th>
                                        @if (Auth::User()->jabatan == 'DIREKTUR')   
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($employees as $key=> $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->nip }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->jabatan }}</td>
                                           
                                            @if (Auth::User()->jabatan == 'DIREKTUR')    
                                        
                                            <td>
                                                <a class="btn btn-sm btn-info" href="{{ url('employee/' . $item->id) }}"> <i
                                                        class="fas fa-eye"></i></a>
                                               
                                                <a class="btn btn-sm btn-success" title="Edit"
                                                    href="{{ url('employee/' . $item->id . '/edit') }}"><i
                                                        class="fas fa-pen"></i></a>
                                                <form style="display:inline-block"
                                                    action="{{ url('employee/' . $item->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="confirm('Want to delete?')"> <i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                            @endif
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
        //   const tableRBA = $('.table-employee').DataTable({
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
            $('.table-employee').DataTable({});

        });
    </script>
@endsection
