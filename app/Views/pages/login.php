<div class="position-relative" style="height: 100vh; background-image: url('<?php echo base_url(); ?>assets/img/kost/kost-3.jpeg'); background-size: cover; background-position: center;">

    <div class="d-flex justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100">
        <div class="card p-2 shadow p-3 mb-5 bg-body rounded" style="width: 18rem; z-index: 1;">
            <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                <form action="<?php echo base_url(); ?>dashboard">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    <label for="exampleFormControlInput2" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleFormControlInput2">
                    <button type="submit" class="btn btn-primary ms-auto mb-2 mt-2">Login</button>
                </form>
                <a href="">Lupa Password?</a>
            </div>
        </div>
    </div>
</div>