<?php 
    function formLoop($title, $file_name, $error_file){
       echo"<label for='$title'>Jamlak</label>
            <div class='col-sm-6'>
            @if($file_name)
                <!-- <span>{{ $file_name }}</span> -->
                <a href='{{ asset('storage/' . $file_name) }}'><span class='btn btn-success btn-sm'>Dokumen</span></a>
            @else
                <span>No file </span>
            @endif
                <a href=''><span class='btn btn-danger btn-sm'>Delete</span></a>

            <input class='form-control  @error($error_file) is-invalid  @enderror mt-2' type='file' id=$error_file name=$error_file onchange='previewFile()'>
            @error($error_file) 
                <div class='invalid-feedback'>
                    // {{ $message }}
                </div>
            @enderror
            
            </div>";
    }
?>

<x-app-layout>
    <x-slot name="title">Ubah Status Pekerjaan</x-slot>
    <x-card>
    
        <a class="btn btn-primary" href="/admin/tasks" role="button">Back to Tampilan Utama</a>
        <div class="col-lg-6 mt-4">
            <form method="post" action="/admin/tasks/{{ $task->slug }}" enctype="multipart/form-data" class="mb-7">
                @method('put')
                @csrf
                <div class="row mt-2">
                    <h2>{{ $task->title }}</h2>
                </div>
                <a href="/admin/tasks/{{ $task->slug }}" class="btn btn-info mr-1"><i class="fas fa-eye"></i> View</a>
                <div class="row mt-2">
                    <div class="col-sm">
                        @if($task->file)
                            <div style="max-height: 350px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $task->file) }}" class="img-fluid" >
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm">
                        <p>{!! $task->body !!}</p>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm">
                        Date started
                    </div>
                    <div class="col-sm">
                        <strong>{{ date('d-m-Y', strtotime($task->created_at)) }}</strong>
                        <!-- <strong>{{ Str::limit($task->created_at, 10) }}</strong> -->
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm">
                        Date ended
                    </div>
                    <div class="col-sm">
                        <strong>{{ date('d-m-Y', strtotime($task->due_date)) }}</strong>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm">
                        Nilai
                    </div>
                    <div class="col-sm">
                        <strong>Rp {{  number_format($task->price, 2, ',', '.') }}</strong>
                    </div>
                </div>
                <div class="row mt-5">
                    <h4>Pekerjaan</h4>
                </div>
                <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kegiatan</th>
                                <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>
                                    <label for="file_jamlak">Jamlak</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" name="oldJamlak" value="{{ $task->file_jamlak }}">
                                            @if($task->file_jamlak)
                                            <button type="button" class="btn btn-success btn-sm info-jamlak" data-uploader="{{ $task->jamlak_name}}">
                                                Dokumen
                                            </button>
                                                <a href="/admin/tasks/delete_file/{{ $task->file_jamlak }}/1" onclick="return confirm('Yakin Mau hapus file Jamlak?')" class="btn btn-danger btn-sm">Delete</a>
                                            @else
                                                <span>No file </span>
                                            @endif
                                            <input type="hidden" name="send_track" value="jamlak">
                                            <input class="form-control @error('file_jamlak') is-invalid  @enderror mt-2" type="file" id="file_jamlak" name="file_jamlak" onchange="previewFile()">
            
                                            @error('file_jamlak') 
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                </td>
                                <td>
                                    @if($task->file_jamlak)
                                        <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                    @else
                                        <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                    @endif
                                </td>
                                </tr>
                                    @if($task->file_jamlak)
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>
                                            <label for="file_kontrak">Kontrak</label>
                                            <div class="col-sm-6">
                                            <input type="hidden" name="oldKontrak" value="{{ $task->file_kontrak }}">
                                                @if($task->file_kontrak)
                                                    <!-- <span>{{ $task->file_kontrak }}</span> -->
                                                    <button type="button" class="btn btn-success btn-sm info-kontrak" data-uploader="{{ $task->kontrak_name}}">
                                                        Dokumen
                                                    </button>
                                                    <a href="/admin/tasks/delete_file/{{ $task->file_kontrak}}/2" onclick="return confirm('Yakin Mau hapus file Kontrak?')" class="btn btn-danger btn-sm">Delete</a>

                                                @else
                                                    <span>No file </span>
                                                @endif
                                                {{ $task->kontrak_pc_name}}
                                                <input class="form-control @error('file_kontrak') is-invalid  @enderror mt-2" type="file" id="file_kontrak" name="file_kontrak" onchange="previewFile()">
                                                @error('file_kontrak') 
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            @if($task->file_kontrak )
                                                <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                            @else
                                                <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                            @endif
                                        </td>
                                    </tr>
                                        @if($task->file_kontrak)
                                        <tr>
                                        <th scope="row">3</th>
                                        <td>
                                            <label for="file_jamuk">Jamuk</label>
                                            <div class="col-sm-6">
                                                <input type="hidden" name="oldJamuk" value="{{ $task->file_jamuk }}">
                                                @if($task->file_jamuk)
                                                    <!-- <span>{{ $task->file_jamuk }}</span> -->
                                                    <button type="button" class="btn btn-success btn-sm info-jamuk" data-uploader="{{ $task->jamuk_name}}">
                                                            Dokumen
                                                        </button>
                                                    <a href="/admin/tasks/delete_file/{{ $task->file_jamuk }}/3" onclick="return confirm('Yakin Mau hapus file Jamuk?')" class="btn btn-danger btn-sm">Delete</a>

                                                @else
                                                    <span>No file </span>
                                                @endif
                                                <input class="form-control @error('file_jamuk') is-invalid  @enderror mt-2" type="file" id="file_jamuk" name="file_jamuk" onchange="previewFile()">
                                                @error('file_jamuk') 
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                                @if($task->file_jamuk )
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </td>
                                        </tr>
                                            @if($task->file_jamuk)
                                                <tr>
                                                    <th scope="row">4</th>
                                                    <td>
                                                        <label for="file_sprin_pc">Surat Perintah Product Control</label>
                                                        <div class="col-sm-6">
                                                            <input type="hidden" name="oldSprin_pc" value="{{ $task->file_sprin_pc }}">
                                                            @if($task->file_sprin_pc)
                                                                <!-- <span>{{ $task->file_sprin_pc }}</span> -->
                                                                <button type="button" class="btn btn-success btn-sm info-kontrak" data-uploader="{{ $task->sprin_pc_name}}" >
                                                                        Dokumen
                                                                    </button>
                                                                <a href="/admin/tasks/delete_file/{{ $task->file_sprin_pc }}/4" onclick="return confirm('Yakin Mau hapus file Surat Perintah Product Control?')" class="btn btn-danger btn-sm">Delete</a>

                                                            @else
                                                                <span>No file </span>
                                                            @endif
                                                            <input class="form-control @error('file_sprin_pc') is-invalid  @enderror mt-2" type="file" id="file_sprin_pc" name="file_sprin_pc" onchange="previewFile()">
                                                            @error('file_sprin_pc') 
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($task->file_sprin_pc)
                                                            <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                        @else
                                                            <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @if($task->file_sprin_pc)
                                                    <tr>
                                                        <th scope="row">5</th>
                                                        <td>
                                                            <label for="file_pc">Product Control</label>
                                                            <div class="col-sm-6">
                                                                <input type="hidden" name="oldPC" value="{{ $task->file_pc }}">
                                                                @if($task->file_pc)
                                                                    <!-- <span>{{ $task->file_pc }}</span> -->
                                                                    <button type="button" class="btn btn-success btn-sm info-pc" data-uploader="{{ $task->pc_name}}">
                                                                            Dokumen
                                                                        </button>
                                                                    <a href="/admin/tasks/delete_file/{{ $task->file_pc }}/5" onclick="return confirm('Yakin Mau hapus file Product Control?')" class="btn btn-danger btn-sm">Delete</a>

                                                                @else
                                                                    <span>No file </span>
                                                                @endif
                                                                <input class="form-control @error('file_pc') is-invalid  @enderror mt-2" type="file" id="file_pc" name="file_pc" onchange="previewFile()">
                                                                @error('file_pc') 
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if($task->file_pc)
                                                                <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                            @else
                                                                <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @if($task->file_pc)
                                                        <tr>
                                                            <th scope="row">6</th>
                                                            <td>
                                                                <label for="file_izin_bekal">Izin Masuk Bekal</label>
                                                                <div class="col-sm-6">
                                                                    <input type="hidden" name="oldIzin_bekal" value="{{ $task->file_izin_bekal }}">
                                                                    @if($task->file_izin_bekal)
                                                                        <!-- <span>{{ $task->file_izin_bekal }}</span> -->
                                                                        <button type="button" class="btn btn-success btn-sm info-izin-bekal" data-uploader="{{ $task->izin_bekal_name}}">
                                                                                Dokumen
                                                                            </button>
                                                                        <a href="/admin/tasks/delete_file/{{ $task->file_izin_bekal }}/6" onclick="return confirm('Yakin Mau hapus file Izin Masuk Bekal?')" class="btn btn-danger btn-sm">Delete</a>

                                                                    @else
                                                                        <span>No file </span>
                                                                    @endif
                                                                    <input class="form-control @error('file_izin_bekal') is-invalid  @enderror mt-2" type="file" id="file_izin_bekal" name="file_izin_bekal" onchange="previewFile()">
                                                                    @error('file_izin_bekal') 
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </td>
                                                            <td>
                                                                @if($task->file_izin_bekal)
                                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                                @else
                                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @if($task->file_izin_bekal)
                                                        <tr>
                                                            <th scope="row">7</th>
                                                            <td>
                                                                <label for="file_sprin_komisi">Surat Perintah Komisi</label>
                                                                <div class="col-sm-6">
                                                                    <input type="hidden" name="oldSprin_komisi" value="{{ $task->file_sprin_komisi }}">
                                                                    @if($task->file_sprin_komisi)
                                                                        <!-- <span>{{ $task->file_sprin_komisi }}</span> -->
                                                                        <button type="button" class="btn btn-success btn-sm info-sprin-komisi" data-uploader="{{ $task->sprin_komisi_name}}">
                                                                                Dokumen
                                                                            </button>
                                                                        <a href="/admin/tasks/delete_file/{{ $task->file_sprin_komisi }}/7" onclick="return confirm('Yakin Mau hapus file Surat Perintah Komisi?')" class="btn btn-danger btn-sm">Delete</a>

                                                                    @else
                                                                        <span>No file </span>
                                                                    @endif
                                                                    <input class="form-control @error('file_sprin_komisi') is-invalid  @enderror mt-2" type="file" id="file_sprin_komisi" name="file_sprin_komisi" onchange="previewFile()">
                                                                    @error('file_sprin_komisi') 
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>    
                                                            </td>
                                                            <td>
                                                                @if($task->file_sprin_komisi)
                                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                                @else
                                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                            @if($task->file_sprin_komisi)
                                                                <tr>
                                                                    <th scope="row">8</th>
                                                                    <td>
                                                                        <label for="file_osbek">Osbek</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="hidden" name="oldOsbek" value="{{ $task->file_osbek }}">
                                                                            @if($task->file_bek)
                                                                                <!-- <span>{{ $task->file_bek }}</span> -->
                                                                                <button type="button" class="btn btn-success btn-sm info-bek" data-uploader="{{ $task->bek_name}}">
                                                                                        Dokumen
                                                                                    </button>
                                                                                <a href="/admin/tasks/delete_file/{{ $task->file_bek }}/8" onclick="return confirm('Yakin Mau hapus file Osbek?')" class="btn btn-danger btn-sm">Delete</a>

                                                                            @else
                                                                                <span>No file </span>
                                                                            @endif
                                                                            <input class="form-control @error('file_bek') is-invalid  @enderror mt-2" type="file" id="file_bek" name="file_bek" onchange="previewFile()">
                                                                            @error('file_bek') 
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>      
                                                                    </td>
                                                                    <td>
                                                                        @if($task->file_bek)
                                                                            <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                                        @else
                                                                            <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                    @if($task->file_bek)
                                                                        <tr>
                                                                            <th scope="row">9</th>
                                                                            <td>
                                                                                <label for="file_komisi">Komisi</label>
                                                                                <div class="col-sm-6">
                                                                                    <input type="hidden" name="oldKomisi" value="{{ $task->file_komisi }}">
                                                                                    @if($task->file_komisi)
                                                                                        <!-- <span>{{ $task->file_komisi }}</span> -->
                                                                                        <button type="button" class="btn btn-success btn-sm info-komisi" data-uploader="{{ $task->komisi_name}}">
                                                                                                Dokumen
                                                                                            </button>
                                                                                        <a href="/admin/tasks/delete_file/{{ $task->file_komisi }}/9" onclick="return confirm('Yakin Mau hapus file Komisi?')" class="btn btn-danger btn-sm">Delete</a>

                                                                                    @else
                                                                                        <span>No file </span>
                                                                                    @endif
                                                                                    <input class="form-control @error('file_komisi') is-invalid  @enderror mt-2" type="file" id="file_komisi" name="file_komisi" onchange="previewFile()">
                                                                                    @error('file_komisi') 
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                @if($task->file_komisi)
                                                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                                                @else
                                                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        @if($task->file_komisi)
                                                                            <tr>
                                                                                <th scope="row">10</th>
                                                                                <td>
                                                                                    <label for="file_bagudang">Bagudang</label>
                                                                                    <div class="col-sm-6">
                                                                                        <input type="hidden" name="oldBagudang" value="{{ $task->file_bagudang }}">
                                                                                        @if($task->file_bagudang)
                                                                                            <!-- <span>{{ $task->file_bagudang }}</span> -->
                                                                                            <button type="button" class="btn btn-success btn-sm info-bagudang" data-uploader="{{ $task->bagudang_name}}">
                                                                                                    Dokumen
                                                                                                </button>
                                                                                            <a href="/admin/tasks/delete_file/{{ $task->file_bagudang}}/10" onclick="return confirm('Yakin Mau hapus file Bagudang?')" class="btn btn-danger btn-sm">Delete</a>

                                                                                        @else
                                                                                            <span>No file </span>
                                                                                        @endif
                                                                                        <input class="form-control @error('file_bagudang') is-invalid  @enderror mt-2" type="file" id="file_bagudang" name="file_bagudang" onchange="previewFile()">
                                                                                        @error('file_bagudang') 
                                                                                            <div class="invalid-feedback">
                                                                                                {{ $message }}
                                                                                            </div>
                                                                                        @enderror
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    @if($task->file_bagudang)
                                                                                        <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                                                    @else
                                                                                        <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                                @if($task->file_bagudang)
                                                                                <tr>
                                                                                    <th scope="row">11</th>
                                                                                    <td>
                                                                                        <label for="file_pem_gudang">Pemerataan Gudang</label>
                                                                                        <div class="col-sm-6">
                                                                                            <input type="hidden" name="oldPem_gudang" value="{{ $task->file_pem_gudang }}">
                                                                                            @if($task->file_pem_gudang)
                                                                                                <!-- <span>{{ $task->file_pem_gudang }}</span> -->
                                                                                                <button type="button" class="btn btn-success btn-sm info-pem-gudang" data-uploader="{{ $task->pem_gudang_name}}">
                                                                                                        Dokumen
                                                                                                    </button>
                                                                                                <a href="/admin/tasks/delete_file/{{ $task->file_pem_gudang }}/11" onclick="return confirm('Yakin Mau hapus file Pemerataan Gudang?')" class="btn btn-danger btn-sm">Delete</a>

                                                                                            @else
                                                                                                <span>No file </span>
                                                                                            @endif
                                                                                            <input class="form-control @error('file_pem_gudang') is-invalid  @enderror mt-2" type="file" id="file_pem_gudang" name="file_pem_gudang" onchange="previewFile()">
                                                                                            @error('file_pem_gudang') 
                                                                                                <div class="invalid-feedback">
                                                                                                    {{ $message }}
                                                                                                </div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        @if($task->file_pem_gudang)
                                                                                            <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                                                        @else
                                                                                            <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                                                        @endif      
                                                                                    </td>
                                                                                </tr>
                                                                                    @if($task->file_pem_gudang)
                                                                                        <tr>
                                                                                            <th scope="row">12</th>
                                                                                            <td>
                                                                                                <label for="file_bast">Bast</label>
                                                                                                <div class="col-sm-6">
                                                                                                    <input type="hidden" name="oldBast" value="{{ $task->file_bast }}">
                                                                                                    @if($task->file_bast)
                                                                                                        <!-- <span>{{ $task->file_bast }}</span> -->
                                                                                                        <button type="button" class="btn btn-success btn-sm info-bast" data-uploader="{{ $task->bast_name}}">
                                                                                                                Dokumen
                                                                                                            </button>
                                                                                                        <a href="/admin/tasks/delete_file/{{ $task->file_bast }}/12" onclick="return confirm('Yakin Mau hapus file Bast?')" class="btn btn-danger btn-sm">Delete</a>

                                                                                                    @else
                                                                                                        <span>No file </span>
                                                                                                    @endif
                                                                                                    <input class="form-control  @error('file_bast') is-invalid  @enderror mt-2" type="file" id="file_bast" name="file_bast" onchange="previewFile()">
                                                                                                    @error('file_bast') 
                                                                                                        <div class="invalid-feedback">
                                                                                                            {{ $message }}
                                                                                                        </div>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                @if($task->file_bast)
                                                                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                                                                @else
                                                                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                                                                @endif
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                            @if($task->file_bast)
                                                                                                <tr>
                                                                                                    <th scope="row">13</th>
                                                                                                    <td>
                                                                                                        <label for="file_lpp">LPP</label>
                                                                                                        <div class="col-sm-6">
                                                                                                            <input type="hidden" name="oldLpp" value="{{ $task->file_lpp }}">
                                                                                                            @if($task->file_lpp)
                                                                                                                <!-- <span>{{ $task->file_lpp }}</span> -->
                                                                                                                <button type="button" class="btn btn-success btn-sm info-lpp" data-uploader="{{ $task->lpp_name}}">
                                                                                                                        Dokumen
                                                                                                                    </button>
                                                                                                                <a href="/admin/tasks/delete_file/{{ $task->file_lpp }}/13" onclick="return confirm('Yakin Mau hapus file LPP?')" class="btn btn-danger btn-sm">Delete</a>

                                                                                                            @else
                                                                                                                <span>No file </span>
                                                                                                            @endif
                                                                                                            <input class="form-control @error('file_lpp') is-invalid  @enderror mt-2" type="file" id="file_lpp" name="file_lpp" onchange="previewFile()">
                                                                                                            @error('file_lpp') 
                                                                                                                <div class="invalid-feedback">
                                                                                                                    {{ $message }}
                                                                                                                </div>
                                                                                                            @enderror
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        @if($task->file_lpp)
                                                                                                            <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                                                                        @else
                                                                                                            <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                                                                        @endif
                                                                                                    </td>
                                                                                                </tr>
                                                                                                    @if($task->file_lpp)
                                                                                                        <tr>
                                                                                                            <th scope="row">14</th>
                                                                                                            <td>
                                                                                                                <label for="file_pemerataan">Pemerataan</label>
                                                                                                                <div class="col-sm-6">
                                                                                                                    <input type="hidden" name="oldPemerataan" value="{{ $task->file_pemerataan }}">
                                                                                                                    @if($task->file_pemerataan)
                                                                                                                        <!-- <span>{{ $task->file_pemerataan }}</span> -->
                                                                                                                        <button type="button" class="btn btn-success btn-sm info-pemerataan" data-uploader="{{ $task->pemerataan_name}}">
                                                                                                                                Dokumen
                                                                                                                            </button>
                                                                                                                        <a href="/admin/tasks/delete_file/{{ $task->file_pemerataan }}/14" onclick="return confirm('Yakin Mau hapus file Jamlak?')" class="btn btn-danger btn-sm">Delete</a>

                                                                                                                    @else
                                                                                                                        <span>No file </span>
                                                                                                                    @endif
                                                                                                                    <input class="form-control @error('file_pemerataan') is-invalid  @enderror mt-2" type="file" id="file_pemerataan" name="file_pemerataan" onchange="previewFile()">
                                                                                                                    @error('file_pemerataan') 
                                                                                                                        <div class="invalid-feedback">
                                                                                                                            {{ $message }}
                                                                                                                        </div>
                                                                                                                    @enderror
                                                                                                                </div></td>
                                                                                                            <td>
                                                                                                                @if($task->file_pemerataan)
                                                                                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                                                                                @else
                                                                                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                                                                                @endif
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endif
                                                                                            @endif
                                                                                    @endif
                                                                                @endif
                                                                        @endif
                                                                    @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                    
                               
                            </tbody>
                        </table>

                <button type="submit" class="btn btn-primary" onclick="return confirm('Tambah File?')" >Update Pekerjaan</button>
            </form>
        </div>
    </x-card>
    <x-modal>
		<x-slot name="id">infoModal</x-slot>
		<x-slot name="title">Information</x-slot>

		<div class="row mb-2">
            <div >
				<b>Pengirim : </b>
			</div>
			    <strong>
                    <div class="ml-2" id="uploader-modal"></div>
                </strong>
                <iframe id="frame-modal" style="width:750px; height:500px;" frameborder="0"></iframe>
		</div>
	</x-modal>
    <x-slot name="script">
		<script>
			$('.info-jamlak').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_jamlak) }}";
			})
            $('.info-kontrak').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_kontrak) }}";
			})
            $('.info-jamuk').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_jamuk) }}";
			})
            $('.info-sprin-pc').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_sprin_pc) }}";
			})
            $('.info-pc').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_pc) }}";
			})
            $('.info-izin-bekal').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_izin_bekal) }}";
			})
            $('.info-sprin-komisi').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_sprin_komisi) }}";
			})
            $('.info-bek').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_bek) }}";
			})
            $('.info-komisi').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_komisi) }}";
			})
            $('.info-bagudang').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_bagudang) }}";
			})
            $('.info-pem-gudang').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_pem_gudang) }}";
			})
            $('.info-bast').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_bast) }}";
			})
            $('.info-lpp').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_lpp) }}";
			})
            $('.info-pemerataan').click(function(e) {
				e.preventDefault()
                $('#name-modal').text($(this).data('name'));
                $('#uploader-modal').text($(this).data('uploader'));
				$('#infoModal').modal('show')
                document.getElementById("frame-modal").src = "{{ asset('storage/' . $task->file_pemerataan) }}";
			})
		</script>
	</x-slot>
    <script>       
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/admin/tasks/checkSlug?title=' + title.value)
             .then(response => response.json())
             .then(data => slug.value = data.slug)
        });
        
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
        
        function previewFile(){
            const file = document.querySelector('#file');
            const filePreview = document.querySelector('.file-preview');

            filePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(file.files[0]);
            oFReader.onload = function(oFREvent){
                filePreview.src = oFREvent.target.result;
            }
        }
    </script>
</x-app-layout>

