
if (isset($user)) {
    $navbar->username = $user->getName();
    $navbar->password = $user->getPassword();
    $navbar->email = $user->getEmail();
    $navbar->dni = $user->getDni();
    $navbar->birthday = $user->getBirthday();
}

if (isset($user)) {
    $navbar->username = $user->getName();
    $navbar->password = $user->getPassword();
    $navbar->email = $user->getEmail();
    $navbar->dni = $user->getDni();
    $navbar->birthday = $user->getBirthday();
}

echo $navbar->render();


?>
<!-- Modal -->
<div class=" modal fade" id="loginopt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Session menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#edit">
                    Edit acount
                </button>
                <br><br>
                <a href="<?php echo FRONT_ROOT ?>Session/Logout" class="btn btn-outline-success my-2 my-sm-0">Logout</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit acount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo FRONT_ROOT ?>Session/Edit" method="POST">
                <div class="modal-body">
                    <label>Name:</label>
                    <input type="text" name="username" required value="<?php echo $username ?>" class="form-control form-control-lg" required />
                    <br>
                    <label>Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" required value="<?php echo $password ?>" />
                    <br>
                    <label>Email:</label>
                    <input type="email" name="email" required class="form-control form-control-lg" value="<?php echo $email ?>" />
                    <br>
                    <label>DNI:</label>
                    <input type="number" name="dni" required class="form-control form-control-lg" value="<?php echo $dni ?>" min="5000000" max="99999999" />
                    <br>
                    <label>Birthday:</label>
                    <input type="date" name="birthday" class="form-control form-control-lg" required value="<?php echo $birthday ?>" />


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>