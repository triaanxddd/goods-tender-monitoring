<x-app-layout>
    <x-slot name="title">
        Dahsboard
    </x-slot>

    <section class="row">
        <x-card-sum 
            text="Total Pekerjaan" 
            value="{{ $tasks }}" 
            icon="pen" 
            color="primary"
        />
        <x-card-sum 
            text="Total Kapor" 
            value="{{ $category_1 }}" 
            icon="th-list" 
            color="warning"
        />
        <x-card-sum 
        text="Total Alsatri" 
        value="{{ $category_2 }}" 
        icon="th-list" 
        color="dark"
        />
        <x-card-sum 
            text="Total Member" 
            value="{{ $members }}" 
            icon="users" 
            color="info"
        />
        <x-card-sum 
            text="Total Kapor (Selesai)" 
            value="{{ $cat1Complete }}" 
            icon="check-circle" 
            color="success"
        />

        <x-card-sum 
            text="Total Kapor (Belum)" 
            value="{{ $cat1NotComplete }}" 
            icon="times-circle" 
            color="danger"
        />

        <x-card-sum 
            text="Total Alsatri (Selesai)" 
            value="{{ $cat2Complete }}" 
            icon="check-circle" 
            color="success"
        /> 

        <x-card-sum 
            text="Total Alsatri (Belum)" 
            value="{{ $roles }}" 
            icon="times-circle" 
            color="danger"
        /> 

    </section>
    <section class="row">
        {{-- log activity section --}}
        <div class="col-md-6">
            <x-card>
                <x-slot name="title">
                    Log Activity
                </x-slot>
                <x-slot name="option">
                    <a href="{{ route('admin.logs') }}" class="btn btn-primary btn-sm">More</a>
                </x-slot>
                <table class="table">
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->description }}</td>
                            <td><small>{{ $log->created_at->diffForHumans() }}</small></td>
                        </tr>
                        @empty
                        <td colspan="2" class="text-center">No Data</td>
                        @endforelse
                    </tbody>
                </table>
            </x-card>
        </div>

        {{-- chart section --}}
        <div class="col-md-6">
            <!-- Area Charts -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                </div>
                <div class="card-body">
                  <div class="panel">
                    <div id="chartTask"></div>
                  </div>
                </div>
              </div>
        </div>
    </section>

    <x-slot name="script">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script>
                Highcharts.chart('chartTask', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Tugas Pekerjaan'
                },
                xAxis: {
                    categories: {!! json_encode($items) !!},
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Tugas'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Barang',
                    data: [49.9, 71.5, 80]

                }]
            });
        </script>
    </x-slot>
</x-app-layout>