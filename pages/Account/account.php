<?php
if (!isset($_SESSION['logged'])) {
    header('location: ' . HOME_URL_PREFIX . '/signin');
}
$account = new Account();
$user = $account->getUser($_SESSION['id'], $_SESSION['email']);
$gender = new Gender();
$genders = $gender->getGenders();
$state = new State();
$states = $state->getStates();
?>
<div class="container-fluid color-emerald-50 py-5">
    <div class="container">
        <h1 class="display-4 fw-bold text-capitalize text-center text-emerald-900">Account</h1>
        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" class="row gx-5 mt-2">
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 col-xxl-3">
                <div class="d-flex flex-column bg-white px-4 py-4">
                    <div class="flex-column text-center">
                        <img src="./assets/images/uploads/users/<?php echo $user[0]['imagePath'] ?>" class="rounded-circle" alt="Avatar" width="120" height="120">
                        <div class="mt-4">
                            <input type="file" class="form-control" id="fileUpload" name="avatar">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 col-xxl-9">
                <div class="row px-4 py-4 bg-white">
                    <div class="col-md-6 mt-2">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control shadow-none border-emerald text-emerald-900" placeholder="First name" aria-label="First name" name="firstName" value="<?php echo $user[0]['firstName'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control shadow-none border-emerald" placeholder="Last name" aria-label="Last name" name="lastName" value="<?php echo $user[0]['lastName'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group input-group-lg mb-3">
                            <input type="tel" class="form-control shadow-none border-emerald" placeholder="Telephone" aria-label="Telephone" name="telephone" value="<?php echo $user[0]['telephone'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group input-group-lg mb-3">
                            <?php
                            if (isset($genders)) { ?>
                                <select class="form-select shadow-none border-emerald" aria-label="Gender" name="gender" required>
                                    <?php
                                    foreach ($genders as $gender) { ?>
                                        <option value="<?php echo $gender['id']; ?>" <?php if ($user[0]['gender_id'] === $gender['id']) {
                                                                                            echo ('selected');
                                                                                        } ?>><?php echo $gender['gender']; ?></option>
                                    <?php
                                    } ?>
                                </select>
                            <?php
                            } ?>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group input-group-lg mb-3">
                            <?php
                            if (isset($states)) { ?>
                                <select class="form-select shadow-none border-emerald" aria-label="State" name="state" required>
                                    <?php
                                    foreach ($states as $state) { ?>
                                        <option value="<?php echo $state['id']; ?>" <?php if ($user[0]['state_id'] === $state['id']) {
                                                                                        echo ('selected');
                                                                                    } ?>><?php echo $state['state']; ?></option>
                                    <?php
                                    } ?>
                                </select>
                            <?php
                            } ?>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control shadow-none border-emerald" placeholder="City" aria-label="City" name="city" value="<?php echo $user[0]['city'] ?>" required>
                            <input type="text" class="form-control shadow-none border-emerald" placeholder="Zip code" aria-label="Zip code" name="zipCode" value="<?php echo $user[0]['zipCode'] ?>" required>
                        </div>
                    </div>
                    <div class="input-group input-group-lg mt-2">
                        <button type="submit" class="w-100 btn btn-lg btn-emerald fw-bold shadow-none" name="submit" value="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>