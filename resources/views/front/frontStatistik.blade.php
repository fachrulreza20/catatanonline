
@push('styles')
    <link href="{{ asset('front/css/AdminLTE.min.css') }}" rel="stylesheet">


@endpush

<?php

$totalDsa = 0;
$totalPhl = 0;


?>

@foreach ($collectionDsa as $item)
        <?php $totalDsa = $totalDsa + $item->counttitle;  ?>
@endforeach


@foreach ($collectionPhl as $item)
        <?php $totalPhl = $totalPhl + $item->counttitle;  ?>
@endforeach



<div class="container">

    <div class="row" style="font-size:12px;">
                <!-- /.col -->
                <div class="col-6"><br>
                    <h6 style="text-danger">Top Dosa</h6>
                    @foreach ($collectionDsa as $item)
                    
                        <div class="progress-group">
                            <span class="text-right">{{ $item->title }} ({{ $item->counttitle }}) | </span>
                            <span class="progress-number"><b>{{ number_format(($item->counttitle/$totalDsa)*100,1)  }}%</b></span>
        
                            <div class="progress sm">
                                <div class="progress-bar bg-danger" style="width: {{ ($item->counttitle/$totalDsa)*100  }}%"></div>
                            </div>
                        </div>
                        <!-- /.progress-group -->
                    @endforeach

                  </div>
                  <!-- /.col -->
                <!-- /.col -->
                <div class="col-6"><br>
                    <h6 style="text-success">Top Pahala</h6>
                    @foreach ($collectionPhl as $item)
                    
                        <div class="progress-group">
                            <span class="text-right">{{ $item->title }} ({{ $item->counttitle }}) | </span>
                            <span class="progress-number"><b>{{ number_format(($item->counttitle/$totalPhl)*100,1)  }}%</b></span>
        
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: {{ ($item->counttitle/$totalPhl)*100  }}%"></div>
                            </div>
                        </div>
                        <!-- /.progress-group -->
                    @endforeach

                  </div>
                  <!-- /.col -->

</div>
<br>
<br>
<br>
<div class="row "  style="font-size:12px;">
    <!-- /.col -->
    <div class="col-6">
        <h6 style="text-align: left;">Top User Dosa terbanyak</h6>
        @foreach ($topUserDsa as $item)
            <p style="text-align: left;">{{ strtoupper($item->users->name) }} <span class="badge badge-danger"> {{ $item->totalnilai }} </span> </p>
        @endforeach


    </div>
    <div class="col-6">
        <h6 style="text-align: left;">Top User Pahala terbanyak</h6>
        @foreach ($topUserPhl as $item)
            <p style="text-align: left;">{{ strtoupper($item->users->name) }} <span class="badge badge-success"> {{ $item->totalnilai }} </span> </p>
        @endforeach

    </div>
</div>
</div>
