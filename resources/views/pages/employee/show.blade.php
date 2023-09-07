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
                        <div class="card-header">{{ __('Detail Employee') }}</div>

                        <div class="card-body" style="font-size: 14px;">
                            <form>
                                @csrf
                                <div id="data">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input id="nip" type="text"
                                                class="form-control @error('nip') is-invalid @enderror" name="nip"
                                                value="{{ $employee->nip }}" readonly autocomplete="nip" autofocus readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ $employee->name }}" readonly autocomplete="name" autofocus readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input id="email" type="text"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $employee->email }}" readonly autocomplete="email" autofocus readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select class="form-control" name="jabatan" id="jabatan" readonly disabled>
                                                <option value="DIREKTUR" <?= $employee->jabatan == 'DIREKTUR' ?'selected' : ''?>>DIREKTUR</option>
                                                <option value="FINANCE" <?=$employee->jabatan == 'FINANCE'?'selected' : ''?>>FINANCE</option>
                                                <option value="STAFF" <?=$employee->jabatan == 'STAFF'?'selected' : ''?>>STAFF</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                           
                                </div>
                                
                                <br>
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-9">
                                        
                                    </div>
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
