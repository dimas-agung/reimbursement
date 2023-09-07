@extends('layouts.default')

@section('content')
    <style>
        #drop-zone {
            max-width: 450px;
            height: 150px;
            border: 2px dotted blue;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        img {
            object-fit: cover;
            width: 100%;
            height: 100%;
            display: none;
        }

        .image-preview-container img {
            width: 100%;
            display: none;
            margin-bottom: 30px;
        }

        .image-preview-container input {
            display: none;
        }

        .image-preview-container label {
            display: block;
            width: 45%;
            height: 45px;
            margin-left: 25%;
            text-align: center;
            background: #8338ec;
            color: #fff;
            font-size: 15px;
            text-transform: Uppercase;
            font-weight: 400;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger alert-has-icon w-100 mx-3">
                        <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                        <div class="alert-body">
                            <div class="alert-title">Validate error</div>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card mb-2">
                        <div class="card-header">{{ __('Show Reimbursement') }}</div>

                        <div class="card-body" style="font-size: 14px;">
                            <form >
                                @csrf
                                <div id="data">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input id="date" type="date"
                                                class="form-control @error('date') is-invalid @enderror" name="date"
                                                value="{{ $reimbursement->date }}" required autocomplete="date" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ $reimbursement->name }}" required autocomplete="name" readonly >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" id="description" cols="30" rows="2" class="form-control @error('description') is-invalid @enderror" readonly
                                                required>{{ $reimbursement->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Attachment</label>
                                            <br>
                                            @if ($reimbursement->attachment)
                                            <a href="{{ url('storage/'.$reimbursement->attachment)}}" target="_blank" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> File Attachment</a>
                                            @else
                                            <a class="btn btn-warning"></i>No File Attachment</a>
                                            @endif

                                        </div>
                                    </div>
                           
                                </div>
                                
                                <br>
                                <div class="row mb-0">
                                    
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
@endsection

@section('js')
    {{-- <script src="{{ asset('dashboard/js/datatable-1.10.20.min.js') }}"></script>
<script src="{{ asset('dashboard/js/jquery.maskMoney.min.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            @if ($message = Session::get('success'))
                iziToast.success({
                    title: 'Sukses!',
                    message: '{{ $message }}',
                    position: 'topRight'
                });
            @endif

            $('table').DataTable({});
        });
    </script>
@endsection
