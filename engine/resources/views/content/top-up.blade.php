<div class="card">
    <div class="card-header">
        Top Up
    </div>
    <div class="card-body">
        <form action="{{ route('top-up.store') }}">
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount">
            </div>
            <button type="button" class="btn btn-primary" id="submit-topup">Top up</button>
        </form>
    </div>
</div>
