
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
                    <form id="loginForm">
                        <label for="usr_name">Username</label> <br>
                        <input type="text" name="usr_name"> <br>
                        <label for="usr_password">Password</label> <br>
                        <input type="password" name="usr_password"> <br>
                        <label>Don't have an Account? <a href="#" id="showSignup" style="color: black;">Signup</a></label>
                    </form>

                    <!-- Signup Form (Hidden by Default) -->
                    <form id="signupForm" style="display: none;">
                        <label for="signup_name">Username</label> <br>
                        <input type="text" name="signup_name"> <br>
                        <label for="signup_email">Email</label> <br>
                        <input type="email" name="signup_email"> <br>
                        <label for="signup_password">Password</label> <br>
                        <input type="password" name="signup_password"> <br>
                        <label>Already have an Account? <a href="#" id="showLogin" style="color: black;">Login</a></label>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" id="submitButton">Login</button>
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