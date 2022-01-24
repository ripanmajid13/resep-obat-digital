


<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="emial" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="" value="admin@gmail.com">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Email</label>
        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="" value="password">
    </div>

    <button type="submit">Login</button>
</form>
