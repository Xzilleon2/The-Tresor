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
                        <label for="email">Email</label> <br>
                        <input type="email" name="email" required> <br>
                        <label for="password">Password</label> <br>
                        <input type="password" name="password" required> <br>
                        <label>Don't have an Account? <a href="#" id="showSignup" style="color: black;">Signup</a></label> <br>
                        <input type="submit" name="login" value="login">
                        
                    </form>

                    <!-- Signup Form user (Hidden by Default) -->
                    <form method="post" action="index.php" id="signupForm" style="display: none;">
                        <label for="Fname">First Name</label> <br>
                        <input type="text" name="fname"> <br> 
                        <label for="Lname">Last Name</label> <br>
                        <input type="text" name="lname"> <br>
                        <label for="password">Password</label> <br>
                        <input type="password" name="password"> <br>
                        <label for="email">Email</label> <br>
                        <input type="email" name="email"> <br>
                        <input type="hidden" name="role" value="user"> <br>
                        <label>Already have an Account? <a href="#" id="showLogin" style="color: black;">Login</a></label> <br>
                        <input type="submit" name="register" value="Register">
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