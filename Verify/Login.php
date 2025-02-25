<?php 
    include'Verify/Authentication.php';
    include'Connection/db_connect.php';
?>

<!--Login Modal-->
<div class="modal fade" id="LoginVerify" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modalTitle">Login</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <div class="container d-flex flex-column text-center">
                    <!-- Login Form -->
                    <form method="post" action="index.php" id="loginForm">
                        <label for="username">Username</label> <br>
                        <input type="text" name="username"> <br>
                        <label for="password">Password</label> <br>
                        <input type="password" name="password"> <br>
                        <label>Don't have an Account? <a href="#" id="showSignup" style="color: black;">Signup</a></label> <br>
                        <input type="submit" name="login" value="login">
                        
                    </form>

                    <!-- Signup Form (Hidden by Default) -->
                    <form method="post" action="index.php" id="signupForm" style="display: none;">
                        <label for="signup_name">Username</label> <br>
                        <input type="text" name="signup_name"> <br>
                        <label for="signup_email">Email</label> <br>
                        <input type="email" name="signup_email"> <br>
                        <label for="signup_password">Password</label> <br>
                        <input type="password" name="signup_password"> <br>
                        <label>Already have an Account? <a href="#" id="showLogin" style="color: black;">Login</a></label> <br>
                        <input type="submit" name="register" value="register">
                    </form>
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
        document.getElementById("modalTitle").textContent = "Signup";
        document.getElementById("submitButton").textContent = "Signup";
    });

    document.getElementById("showLogin").addEventListener("click", function (event) {
        event.preventDefault();
        document.getElementById("signupForm").style.display = "none";
        document.getElementById("loginForm").style.display = "block";
        document.getElementById("modalTitle").textContent = "Login";
        document.getElementById("submitButton").textContent = "Login";
    });
</script>