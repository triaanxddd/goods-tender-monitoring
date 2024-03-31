<x-app-layout>
    <x-slot name="title">Pekerjaan</x-slot>
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <x-card>
        <x-slot name="title">Seluruh Pekerjaan</x-slot>
        <x-slot name="option">
            @can('task-create')
			<a href="{{ route('admin.tasks.create') }}" class="btn btn-success">
				    <i class="fas fa-plus"></i>
            </a>
            @endcan
            
		</x-slot>
                <h2>Kapor</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th >Batas Tanggal</th>
                            <th>Ket</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($categories_1 as $task)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>
                                    Rp {{ number_format($task->price, 2) }}
                                </td>
                                <td>
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
                                </td>     
                                <td class="text-center">
                                    <a href="/admin/tasks/{{ $task->slug }}" class="btn btn-info mr-1"><i class="fas fa-eye"></i></a>
                                    @if( !empty($task->user->getRoleNames()))
                                    <a href="/admin/tasks/{{ $task->slug }}/edit" class="btn btn-primary mr-1"><i class="fas fa-edit"></i></a>
                                    <form action="/admin/tasks/{{ $task->slug}}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        @can('task-delete')
                                            <button class="btn btn-warning delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                        @endcan
                                    </form>
                                    @endif
                                </td>
                            </tr>
                    @empty
                            <tr>
                                <td colspan="6" class="text-center">No Task</td>
                            </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $categories_1->links() }}
                
                <div class="mt-5"><h2>Alsatri</h2></div>
                <table class="table table-bordered table-fixed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Batas Tanggal</th>
                            <th>Ket</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($categories_2 as $task)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>
                                    Rp {{ number_format($task->price, 2) }}
                                </td>
                                <td>
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
                                </td>
                                <td class="text-center">
                                    <a href="/admin/tasks/{{ $task->slug }}" class="btn btn-info mr-1"><i class="fas fa-eye"></i></a>
                                    @if(!empty($task->user->getRoleNames()) )
                                    <a href="/admin/tasks/{{ $task->slug }}/edit" class="btn btn-primary mr-1"><i class="fas fa-edit"></i></a>
                                    <form action="/admin/tasks/{{ $task->slug}}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        @can('task-delete')
                                            <button class="btn btn-warning delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                        @endcan
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Task</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $categories_2->links() }}
                

    </x-card>
    
</x-app-layout>

