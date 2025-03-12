<p?php 
    include'Verify/Authentication.php';
    include'Connection/db_connect.php';
?>

<!--Login Modal-->
<div class="modal fade" id="LoginVerify" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modalcontainer">
            <div class="modal-body">
                <div class="container d-flex flex-column justify-content-center text-center">
                    <div class="container">
                        <p>Stay<span id="stayscan">Scan</span></p>
                        <h1 id="modalTitle">SIGN IN</h1>
                        <p id="modalSlogan">Sign in and enjoy the best resorts!</p>
                    </div>
                    <div class="container px-4 d-flex flex-column text-start w-75">
                        <!-- Login Form -->
                        <form method="post" action="Verify/Authentication.php" id="loginForm">
                            <label class="Formlabel ms-1" for="email">Email</label> <br>
                            <input class="p-2 w-100" type="email" name="email" required> <br>
                            <label class="Formlabel ms-1" for="password">Password</label> <br>
                            <input class="p-2 w-100" type="password" name="password" required> <br>
                            <input class="p-2 w-100 my-3 text-light border-0 shadow-sm" type="submit" name="login" value="SIGN IN"> <br>
                            <label class="Formlabel ms-4 ">Don't have an Account? <a href="#" id="showSignup" style="color: white;">Signup</a></label>
                        </form>

                        <!-- Signup Form user (Hidden by Default) -->
                        <form method="post" action="Verify/Authentication.php" id="signupForm" style="display: none;">
                            <label for="Fname">First Name</label> <br>
                            <input class="p-2 w-100" type="text" name="fname"> <br> 
                            <label for="Lname">Last Name</label> <br>
                            <input class="p-2 w-100" type="text" name="lname"> <br>
                            <label for="password">Password</label> <br>
                            <input class="p-2 w-100" type="password" name="password"> <br>
                            <label for="email">Email</label> <br>
                            <input class="p-2 w-100" type="email" name="email"> <br>
                            <input type="hidden" name="role" value="user"> <br>
                            <input class="p-2 w-100 my-1 text-light border-0 shadow-sm" type="submit" name="register" value="Register">
                            <label class="Formlabel ms-4">Already have an Account? <a href="#" id="showLogin" style="color: white;">Login</a></label> <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Toggle Forms -->
<script>
    document.getElementById("showSignup").addEventListener("click", function (event) {
        event.preventDefault();
        document.getElementById("loginForm").style.display = "none";
        document.getElementById("signupForm").style.display = "block";
        document.getElementById("modalTitle").textContent = "SIGN UP";
        document.getElementById("modalSlogan").textContent = "Sign up and enjoy the best resorts!";
        document.getElementById("submitButton").textContent = "SIGN UP";
    });

    document.getElementById("showLogin").addEventListener("click", function (event) {
        event.preventDefault();
        document.getElementById("signupForm").style.display = "none";
        document.getElementById("loginForm").style.display = "block";
        document.getElementById("modalTitle").textContent = "SIGN IN";
        document.getElementById("modalSlogan").textContent = "Sign in and enjoy the best resorts!";
        document.getElementById("submitButton").textContent = "SIGN IN";
    });
</script>