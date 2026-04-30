<div class="custom-cursor"></div>
<div class="cursor-dot"></div>

<div class="floating-balls"></div>

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
                    <li><a href="keepgoingmobile.php">Keep Going Mobile App</a></li>
                    <li><a href="keepgoingweb.php">Keep Going Website</a></li>
                    <li><a href="gantemobile.php">Grante Mobile App</a></li>
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
