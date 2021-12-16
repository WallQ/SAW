	<!-- FORM -->

	<div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<h3 class="ltext-103 cl5">
			</h3>
			<div class="row">
				<div class="col-md-12 col-xl-12 p-b-30 m-lr-auto">

					<?php
					if ($_POST) {
						if ($this->doLogin($_POST["username"], $_POST["password"])) {
							echo "Login com sucesso!";
							echo "<BR>Clique para voltar à <a href='" . HOME_URL_PREFIX . "'>homepage</a>!";
						} else {
							echo "Autentiação errada, tente novamente...";
						}
					} else {
					?>
						<form method="post" action="">
							<h4 class="mtext-105 cl2 txt-center p-b-30">
								Autenticação
							</h4>

							<div class="bor8 m-b-20 how-pos4-parent">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="username" placeholder="Your username">

							</div>

							<div class="bor8 m-b-20 how-pos4-parent">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="password" placeholder="Your Password">

							</div>

							<div class="m-b-20 how-pos4-parent">
								<p>
									Já tem conta no nosso site? Se ainda não tem conta, crie a sua conta clicando <a href='register'>aqui</a>.
								</p>

							</div>


							<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
								Login
							</button>
						</form>
					<?php
					}

					?>
				</div>
			</div>
		</div>