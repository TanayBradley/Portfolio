<div id="navBar">
    <div id="navBarLeft">
        <div id="name">Tanay Bradley</div>
    </div>
    <div id="navBarRight">
        <nav id="navMenu">
            <div class="navOption">
                <a href="index.php">Home</a>
            </div>
            <div class="navOption">
                <a href="designs.php">Designs</a>
                <i class="fa-solid fa-chevron-down dropdown-toggle"></i>
                <ul class="dropdown-menu">
                    <li><a href="design1.php">Keep Going Mobile App</a></li>
                    <li><a href="design2.php">Geek Going Website</a></li>
                    <li><a href="design3.php">Grante Mobile App</a></li>
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
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdownMenu = document.querySelector('.dropdown-menu');
    const contrastModeBtn = document.querySelector('#contrastMode');

    // Add click event to the chevron (dropdown toggle)
    dropdownToggle.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent click from affecting other elements
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    // Close the dropdown when clicking outside
    document.addEventListener('click', function (event) {
        if (!dropdownMenu.contains(event.target) && !dropdownToggle.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });

    // Switch between light and dark mode
    contrastModeBtn.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
        document.body.classList.toggle('light-mode');
    });
});
</script>
</body>
</html>