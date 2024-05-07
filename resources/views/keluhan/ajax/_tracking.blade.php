<div class="row">
    @foreach ($data_tracking->data as $item)
        <div class="col-12">
            <div class="d-flex mb-3">
                <div class="p-2">
                    <h5>{{ \Carbon\Carbon::parse($item->createdAt)->translatedFormat('l, d F Y') }}</h5>
                </div>
                <div class="p-2">
                    @switch($item->status)
                        @case('OPEN')
                            <span class="badge text-bg-primary">
                                <b>{{ $item->status }}</b>
                            </span>
                        @break

                        @case('INPROGRESS')
                            <span class="badge text-bg-warning">
                                <b>{{ $item->status }}</b>
                            </span>
                        @break

                        @case('REJECT')
                            <span class="badge text-bg-danger">
                                <b>{{ $item->status }}</b>
                            </span>
                        @break

                        @case('DONE')
                            <span class="badge text-bg-success">
                                <b>{{ $item->status }}</b>
                            </span>
                        @break

                        @default
                    @endswitch
                </div>
            </div>
        </div>
        <hr>
    @endforeach
</div>
