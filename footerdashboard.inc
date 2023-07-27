<!DOCTYPE html>
<html>
  <head>
    <meta name="description" content="Footer section" />
    <meta name="keywords" content="PHP, MySql" />
    <meta name="author" content="Ashmin Karki" />
  </head>

  <body>
    <footer
      class="bs-docs-footer"
      style="
        left: 50%;
        transform: translate(-50%, 0);
        padding-top: 4vh;
        position: absolute;
        bottom: 0;
        display: inline;
        justify-content: center;
      "
    >
      <p>Copyright © 2022. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"
    ></script>

    <script>
      $(document).ready(function () {
        $("table.dashboard").DataTable();
      });
      function openCity(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the link that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
      }
    </script>
  </body>
</html>
