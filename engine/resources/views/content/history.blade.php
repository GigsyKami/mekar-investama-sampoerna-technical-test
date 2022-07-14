<div class="card">
    <div class="card-header">
        Transfer History
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h4>Saldo: {{ Auth::user()->wallet->balance ?? '' }}</h4>
            </div>
            <div class="col-12 mt-3">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Sumber</th>
                            <th>Tujuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($transaction->from_wallet_id == null)
                                        Top up
                                    @else
                                        Transfer
                                    @endif
                                </td>
                                <td>
                                    @if ($transaction->from_wallet_id == null)
                                        +
                                    @elseif ($transaction->to_wallet_id == Auth::user()->wallet->id)
                                        +
                                    @else
                                        -
                                    @endif
                                    {{ $transaction->amount }}
                                </td>
                                <td>
                                    @if ($transaction->from_wallet_id == null)
                                        Top up
                                    @else
                                        {{ $transaction->from->user->name ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    {{ $transaction->to->user->name ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
