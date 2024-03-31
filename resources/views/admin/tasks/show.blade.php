<x-app-layout>
    <x-slot name="title">Task Info</x-slot>
    
    <x-card>
        <div class="container-lg">
        <div class="row">
            <div class="col">
                <a class="btn btn-primary " href="/admin/tasks" role="button">Back to Pekerjaan</a>
            </div>
            <div class="col">
                <h1>Keterangan:
                    @if( is_null($task->file_jamlak)
                    || is_null($task->file_kontrak)
                    || is_null($task->file_jamuk)
                    || is_null($task->file_sprin_pc)
                    || is_null($task->file_pc)
                    || is_null($task->file_izin_bekal)
                    || is_null($task->file_sprin_komisi)
                    || is_null($task->file_bek)
                    || is_null($task->file_komisi)
                    || is_null($task->file_bagudang)
                    || is_null($task->file_pem_gudang)
                    || is_null($task->file_bast)
                    || is_null($task->file_lpp)
                    || is_null($task->file_pemerataan))
                        <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                    @else
                        <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                    @endif
                </h1>
            </div>
        </div>
            <div class="col-lg-10">
            <article>
                <h2 class="border-bottom mb-1">{{ $task->title }}</h2>
                @if(auth()->user()->name == 'admin' )
                    <form action="/admin/tasks/{{ $task->slug}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger row btn-sm" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span><i class="fas fa-trash"></i> Delete</button>
                    </form>
                    <a href="/admin/tasks/{{ $task->slug }}/edit" class="btn btn-warning ml-3 btn-sm"><i class="fas fa-edit"></i> Edit</a>
                @endif
                <div class="mt-2">
                    @if($task->file)
                                <div style="max-height: 200px; overflow: hidden;">
                                    <img src="{{ asset('storage/' . $task->file) }}" class="img-fluid" >
                                </div>
                    @endif
                </div>
                <div class="row row-cols-2">
                    <div class="col-sm">
                        Kategori: 
                    </div>
                    <div class="col-sm">
                        <strong> {{ $task->category->name }}</strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        Date started
                    </div>
                    <div class="col-sm">
                        <strong>{{ date('d-m-Y', strtotime($task->created_at)) }}</strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        Date ended
                    </div>
                    <div class="col-sm">
                        <strong>{{ date('d-m-Y', strtotime($task->due_date)) }}</strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        Nilai
                    </div>
                    <div class="col-sm">
                        <strong>Rp {{  number_format($task->price, 2, ',', '.') }}</strong>
                    </div>
                </div>
                <div class="table-responsive col-lg-8">
                    <form method="post" action="/admin/tasks/{{ $task->slug }}">
                        @method('put')
                        @csrf
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
                                    <td>Jamlak</td>
                                    <td>
                                        <div class="row">
                                            @if($task->file_jamlak)
                                                <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                            @else
                                                <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Kontrak</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_kontrak)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Jamuk</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_jamuk)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Surat Perintah Product Control</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_sprin_pc)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Product Control</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_pc)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Izin Masuk Bekal</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_izin_bekal)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>Surat Perintah Komisi</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_sprin_komisi)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>Osbek</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_bek)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td>Komisi</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_komisi)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">10</th>
                                    <td>Bagudang</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_bagudang)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">11</th>
                                    <td>Pemerataan Gudang</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_pem_gudang)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">12</th>
                                    <td>Bast</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_bast)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">13</th>
                                    <td>LPP</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_lpp)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">14</th>
                                    <td>Pemerataan</td>
                                    <td>
                                        <div class="row">
                                                @if($task->file_pemerataan)
                                                    <span class="btn btn-success rounded-circle"><i class="fa fa-check"></i></span>
                                                @else
                                                    <span class="btn btn-danger rounded-circle"><i class="fa fa-times"></i></span>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                
                <!-- <div class="mt-3">
                    @if($task->file)
                        <a href="{{ asset('storage/' . $task->file) }}">
                            <button class="btn btn-success row"><i class="fas fa-file"></i> Dokumen</button>
                        </a>
                    @else
                        <span>Tidak tercantum link dokumen</span>
                    @endif
                </div> -->
                <p class="row mt-1">Deskripsi: {!! $task->body !!}</p>
            </article>
           
            </div>
        </div>
    </x-card>
</x-app-layout>

