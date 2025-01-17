
<div id="navBar">
    <div id="navBarLeft">
        <div id="name" class="navOption">Tanay Bradley</div>
    </div>
    <div id="navBarRight">
        <nav id="navMenu">
            <div class="navOption">
                <a href="index.php">Home</a>
            </div>
            <div class="navOption dropdown-trigger">
                Designs <i class="fa-solid fa-chevron-down"></i>
                <ul class="dropdown-menu">
                    <li><a href="KeepGoingMobile.php">Keep Going Mobile App</a></li>
                    <li><a href="KeepGoingWeb.php">Keep Going Website</a></li>
                    <li><a href="GanteMobile.php">Grante Mobile App</a></li>
                </ul>
            </div>
            <div class="navOption">
                <a href="about.php">About</a>
            </div>
        </nav>
        <div id="contrastMode" class="light-mode" onclick="switchMode()">Light/Dark</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropdownTriggers = document.querySelectorAll('.dropdown-trigger');
    
    // Loop through each dropdown trigger
    dropdownTriggers.forEach(trigger => {
        const dropdownMenu = trigger.querySelector('.dropdown-menu');
        
        // Show the dropdown on hover
        trigger.addEventListener('mouseover', function() {
            dropdownMenu.style.display = 'block';
        });

         // Hide the dropdown when the mouse leaves
        trigger.addEventListener('mouseleave', function() {
            dropdownMenu.style.display = 'none';
        });
    });
});
</script>
<!-- <script>
   document.addEventListener('DOMContentLoaded', function () {
    const dropdownTriggers = document.querySelectorAll('.dropdown-trigger');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    // Add click event to both the text and the arrow
    dropdownTriggers.forEach(trigger => {
        trigger.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior
            event.stopPropagation(); // Prevent click from affecting other elements
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });
    });

    // Close the dropdown when clicking outside
    document.addEventListener('click', function (event) {
        if (!dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});
</script> -->
</body>
</html>