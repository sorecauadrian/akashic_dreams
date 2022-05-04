<nav class="navbar navbar-expand-lg">
    <div class="container-fluid" style="width: 90%;">
        <a class="navbar-brand" href="./index.php?page=main">
            <img src="./logos/logos.png" alt="logo" style="height: 80px; width: auto;">
        </a>
        <div>
            <ul class="navbar-nav me-auto">
                <li class="nav-item d-flex">
                    <a class="nav-link" href="./index.php?page=main" data-bs-toggle="modal" data-bs-target="#delete_account"><i class="fa fa-thin fa-user-slash fa-2x text-white mx-3"></i></a>
                    <a class="nav-link" href="./index.php?page=logout"><i class="fa fa-thin fa-arrow-right-from-bracket fa-2x text-white mx-3"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal fade" id="delete_account" tabindex="-1" aria-labelledby="delete_account" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #4D1E6A;">
        <div class="modal-header">
            <h5 class="modal-title">delete account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            are you sure you want to delete your account? you won't be able to recover it.
        </div>
        <div class="modal-footer d-inline-block">
            <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal"><i class="fa fa-thin fa-xmark"></i></button>
            <button type="button" class="btn btn-dark w-25" onclick="location.href='./index.php?page=delete_account'"><i class="fa fa-thin fa-check"></i></button>
        </div>
    </div>
  </div>
</div>