<!-- Display Messages -->
<div class="container-lg text-center">
    <?php if (!empty($_SESSION['message'])): ?>
        <div id="alert-box" class="alert alert-<?= $_SESSION['message_type'] ?? 'info' ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['message']); ?>
        </div>

        <!-- JavaScript to Hide Alert After 3 Seconds -->
        <script>
            setTimeout(function () {
                var alertBox = document.getElementById('alert-box');
                if (alertBox) {
                    alertBox.style.transition = "opacity 0.5s";
                    alertBox.style.opacity = "0";
                    setTimeout(function () {
                        alertBox.remove();
                    }, 500); // Wait for fade out before removing
                }
            }, 3000); // 3 seconds delay
        </script>

        <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
    <?php endif; ?>
</div>