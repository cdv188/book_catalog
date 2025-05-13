

// Live Search for index.php
$(document).ready(function() {
    $('#getName').on('keyup', function() {
        var getName = $(this).val();

        if (getName !== "") {
            $.ajax({
                url: 'server/search-index.php',
                method: 'POST',
                data: {
                    searchQuery: getName
                },
                success: function(response) {
                    $('#searchResult').html(response);
                }
            });
        } else {
            $('#searchResult').html("");
        }
    });
});

// Live Search for the compoents folder
$(document).ready(function() {
    $('#Name').on('keyup', function() {
        var getName = $(this).val();

        if (getName !== "") {
            $.ajax({
                url: '../server/livesearch.php',
                method: 'POST',
                data: {
                    searchQuery: getName
                },
                success: function(response) {
                    $('#searchResult').html(response);
                }
            });
        } else {
            $('#searchResult').html("");
        }
    });
});

// Message promt indicating success or failure
document.addEventListener("DOMContentLoaded", function() {
    let msg = document.getElementById("successMessage");
    if (msg) {
        setTimeout(() => {
            msg.style.opacity = "0";
            setTimeout(() => msg.remove(), 500);
        }, 1000);
    }
});

// Sidebar Toggle
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".sidebar");

    menuToggle.addEventListener("click", function () {
        sidebar.classList.toggle("active"); // Toggle Sidebar
    });
});