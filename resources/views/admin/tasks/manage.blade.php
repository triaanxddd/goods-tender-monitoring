<!-- check file  -->
<?php 
    function checkFile($task){
        $empty_file = "";

        if( is_null($task->file_jamlak)){
            $empty_file = "Jamlak kosong";;
        }
        else{
            if(is_null($task->file_kontrak)){
                $empty_file = "Kontrak kosong";;
            }
            else{
                if(is_null($task->file_jamuk)){
                    $empty_file = "Jamuk kosong";;
                }
                else{
                    if(is_null($task->file_sprin_pc)){
                        $empty_file = "Surat Perintah Product Control kosong";;
                    }
                    else{
                        if(is_null($task->file_pc)){
                            $empty_file = "Product Control kosong";;
                        }
                        else{
                            if(is_null($task->file_izin_bekal)){
                                $empty_file = "Izin Bekal kosong";;
                            }
                            else{
                                if(is_null($task->file_sprin_komisi)){
                                    $empty_file = "Surat Perintah Komisi kosong";;
                                }
                                else{
                                    if(is_null($task->file_bek)){
                                        $empty_file = "Osbek kosong";;
                                    }
                                    else{
                                        if(is_null($task->file_komisi)){
                                            $empty_file = "Komisi kosong";;
                                        }
                                        else{
                                            if(is_null($task->file_bagudang)){
                                                $empty_file = "Bagudang kosong";;
                                            }
                                            else{
                                                if(is_null($task->file_pem_gudang)){
                                                    $empty_file = "Pemerataan Gudang kosong";;
                                                }
                                                else{
                                                    if(is_null($task->file_bast)){
                                                        $empty_file = "Bast kosong";;
                                                    }
                                                    else{
                                                        if(is_null($task->file_lpp)){
                                                            $empty_file = "LPP kosong";;
                                                        }
                                                        else{
                                                            if(is_null($task->file_pemerataan)){
                                                                $empty_file = "Pemerataan kosong";;
                                                            }
                                                            else{
                                                                $empty_file = "Sudah Terisi Semua";
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        if($empty_file == "Sudah Terisi Semua"){
            echo "<label class='badge badge-success'>" . $empty_file . "</label>";

        }
        else{
            echo "<label class='badge badge-danger'>" . $empty_file . "</label>";

        }
        // return echo "<label class='badge badge-success'>" . $empty_file . "</label>";
    }
?>
<x-app-layout>
    <x-slot name="title">Kelola Pekerjaan</x-slot>
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <x-card>
        <div class="row">
            <div class="col">
                <x-slot name="title">Seluruh Pekerjaan</x-slot>
            </div>
            <div class="col">
                <h2>
                    Total:
                    <span style="font-size:70%;" class="badge badge-warning">
                         Rp {{ number_format( $tasks->sum('price'), 2) }}
                    </span>
                </h2>
            </div>
        </div>
        <span>
            <h2>Kapor</h2>
        </span>
            <strong clas="ml-2">
                Total : 
                <span style="font-size:100%;" class="badge badge-warning">
                    Rp {{ number_format( $categories_1->sum('price'), 2) }}
                </span>
            </strong>
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                    <th width="2%" scope="col">#</th>
                    <th width="30%" scope="col">Pekerjaan</th>
                    <th scope="col">File Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories_1 as $task)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $task->title }}</td>
                            <td>
                                    {{ checkFile($task) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Task</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
    <div class="mt-5">
        <h2>Alsatri</h2>
    </div>
    <strong clas="ml-2">
                Total : 
                <span style="font-size:100%;" class="badge badge-warning">
                    Rp {{ number_format( $categories_2->sum('price'), 2) }}
                </span>
            </strong>
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                    <th width="2%" scope="col">#</th>
                    <th width="30%" scope="col">Pekerjaan</th>
                    <th scope="col">
                        File Terakhir
                    </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories_2 as $task)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $task->title }}</td>
                            <td>
                                    {{ checkFile($task) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Task</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
    </x-card>
</x-app-layout>