<div class="card">
    <div class="card-header">
        Login
    </div>
    <div class="card-body">
        <form action="{{ route('login.store') }}">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password">
            </div>
            <button type="button" class="btn btn-primary" id="submit-login">Submit</button>
        </form>
    </div>
</div>
