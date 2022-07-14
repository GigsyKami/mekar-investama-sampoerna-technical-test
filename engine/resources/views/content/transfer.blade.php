<div class="card">
    <div class="card-header">
        Transfer
    </div>
    <div class="card-body">
        <form action="{{ route('transfer.store') }}">
            <div class="mb-3">
                <label for="to_user_id" class="form-label">Amount</label>
                <select class="form-select" id="to_user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount">
            </div>
            <button type="button" class="btn btn-primary" id="submit-transfer">Transfer</button>
        </form>
    </div>
</div>
