<div class="text-center mt-5">
    <h1>LOGIN</h1>
</div>
<div class="card ms-auto me-auto shadow p-3 mb-5 bg-body-tertiary rounded" style="width: 18rem;">
    <div class="card-body">
        <div class="mb-3">
            <form action="<?php echo base_url(); ?>auth" method="post">
                <label for="exampleFormControlInput1" class="form-label">username</label>
                <input type="input" class="form-control" id="exampleFormControlInput1" name="username">
                <label for="exampleFormControlInput2" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleFormControlInput2" name="password">
                <button type="submit" class="btn btn-primary ms-auto mb-2 mt-2">Login</button>
        </div>
        </form>
        <a href="">Lupa Password?</a>
    </div>
</div>