<div class="container-fluid bg-body py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 mx-auto">
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" class="row p-4 border rounded-3 bg-body">
                    <div class="form-logo text-emerald-900 text-center mb-4">
                        <i class="bi bi-tags-fill"></i>
                        <h1 class="display-3 fw-normal">Sign In</h1>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control shadow-none border-emerald" placeholder="First name" aria-label="First name" name="firstName" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control shadow-none border-emerald" placeholder="Last name" aria-label="Last name" name="lastName" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="tel" class="form-control shadow-none border-emerald" placeholder="Telephone" aria-label="Telephone" name="telephone" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <select class="form-select shadow-none border-emerald" aria-label="State" name="state" required>
                                <option>Masculine</option>
                                <option>Feminine</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <select class="form-select shadow-none border-emerald" aria-label="State" name="state" required>
                                <option>Lisboa</option>
                                <option>Porto</option>
                                <option>Setúbal</option>
                                <option>Braga</option>
                                <option>Aveiro</option>
                                <option>Faro</option>
                                <option>Leiria</option>
                                <option>Santarém</option>
                                <option>Coimbra</option>
                                <option>Viseu</option>
                                <option>Madeira</option>
                                <option>Açores</option>
                                <option>Viana do Castelo</option>
                                <option>Vila Real</option>
                                <option>Castelo Branco</option>
                                <option>Évora</option>
                                <option>Beja</option>
                                <option>Guarda</option>
                                <option>Bragança</option>
                                <option>Portalegre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control shadow-none border-emerald" placeholder="Zip code" aria-label="Zip code" name="zipCode" required>
                            <input type="text" class="form-control shadow-none border-emerald" placeholder="City" aria-label="City" name="city" required>
                        </div>
                    </div>
                    <div class="input-group input-group-lg mb-3">
                        <input type="email" class="form-control shadow-none border-emerald" placeholder="Email" aria-label="Email" name="email" required>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="password" class="form-control shadow-none border-emerald" placeholder="Password" aria-label="Password" name="password" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="password" class="form-control shadow-none border-emerald" placeholder="Confirm password" aria-label="Confirm password" name="verify-password" required>
                        </div>
                    </div>
                    <div class="input-group input-group-lg mb-3">
                        <button type="submit" class="w-100 btn btn-lg btn-emerald fw-bold shadow-none" name="submit" value="submit">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>